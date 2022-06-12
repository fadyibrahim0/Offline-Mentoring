<?php

require_once "../../core/config.php";
require_once PATH . "core/db.php";
require_once PATH . "core/validations.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

// Check if the user login and is Admin or Super Admin
if(existSession('logged') && getSession('logged')['type'] != 'user') {

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

        $errors = [];

        // Check if the Send Product ID Is Exist Or Not
        $product_id     = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
        $result1        = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` = '$product_id'");
        $old_image      = mysqli_fetch_assoc($result1)['image'];

        // Check if The Sent Category ID Is Exist Or Not
        $cat_id     = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
        $query      = "SELECT * FROM `category` WHERE `id` = '$cat_id'";
        $result2    = mysqli_query($conn, $query);

        // If the sent category ID, and Product ID are exist in our Database
        if(mysqli_num_rows($result1) > 0 && mysqli_num_rows($result2) > 0) {

            // Free Results
            mysqli_free_result($result1);
            mysqli_free_result($result2);

            // Sanitize Inputs
            $name           = validString($_POST['name']) ?? "";
            $price          = filter_var($_POST['price'], FILTER_VALIDATE_INT);
            $wholesalePrice = filter_var($_POST['wholesale_price'], FILTER_VALIDATE_INT);
            $basePrice      = filter_var($_POST['base_price'], FILTER_VALIDATE_INT);
            $qty            = filter_var($_POST['qty'], FILTER_VALIDATE_INT);
            $offer          = filter_var($_POST['offer'], FILTER_VALIDATE_INT);

            // If user wants to change the image (user actually uploads an image)
            $imageFlag = false;
            if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

                // User Sent an Image
                $imageFlag = true;

                // Product Image Data
                $imgName    = $_FILES['image']['name'];
                $imgSize    = $_FILES['image']['size'];
                $imgType    = $_FILES['image']['type'];
                $imgTmp     = $_FILES['image']['tmp_name'];

                // Allowed Image Extensions List
                $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

                // Split To Get The Image Extension Alone
                $explodes   = explode('.', $imgName);
                $imgEXT     = strtolower(end($explodes));

                // Validate Product Image
                if(empty($imgName)) {
                    $errors[] = "Product Image Is Required";
                } elseif (!in_array($imgEXT, $allowedEXT)) {
                    $errors[] = "This Extension Is Not Allowed";
                } elseif ($imgSize > 2097152) {
                    $errors[] = "Image Size Should Be Less Than 2MB";
                }
            }
            
            // Validate Product Name
            if(empty($name)) {
                $errors[] = "Product Name Field Is Required !!";
            }
            if(minVal($name, 3) || maxVal($name, 50) ) {
                $errors[] = "Product Name Should Be Between 3 and 50 Characters";
            }

            //  Validate Product Price
            if(empty($price) || $price === 0) {
                $errors[] = "Product Price Is Required, and Can't be 0!";
            }

            //  Validate Product Wholesale Price
            if(empty($wholesalePrice) || $wholesalePrice === 0) {
                $errors[] = "Product Wholesale Price Is Required, and Can't be 0!";
            }

            //  Validate Product Base Price
            if(empty($basePrice) || $basePrice === 0) {
                $errors[] = "Product Base Price Is Required, and Can't be 0!";
            }

            //  Validate Product QTY
            if(empty($qty)) {
                $errors[] = "Product Quantity Is Required!";
            }
            

            // If there are no errors
            if(empty($errors)) {

                if($imageFlag) {

                    // Delete Old Image
                    if(file_exists( PATH . "uploads/images/product/" . $old_image )) {
                        unlink( PATH . "uploads/images/product/" . $old_image );
                    }
                    
                    // The New Image
                    $image = time() . '_' . $imgName;
                    move_uploaded_file($imgTmp, "../../uploads/images/product/".$image);

                    // Update Statement with the new image
                    $sql = "UPDATE `product`
                            SET `name`='$name', `price`='$price', `wholesale_price`='$wholesalePrice', `qty`='$qty', `offer`='$offer', `base_price`='$basePrice', `category_id`='$cat_id', `image`='$image'
                            WHERE `id` = '$product_id'";
                } else {

                    // Update Statement without image
                    $sql = "UPDATE `product`
                    SET `name`='$name', `price`='$price', `wholesale_price`='$wholesalePrice', `qty`='$qty', `offer`='$offer', `base_price`='$basePrice', `category_id`='$cat_id'
                    WHERE `id` = '$product_id'";
                }

                $result = mysqli_query($conn, $sql);
                $affectedRows = mysqli_affected_rows($conn);
                mysqli_close($conn);

                setSession('success', "Product Updated Successfully. $affectedRows Rows affected!");
                redirect(URL . "views/product/all.php");

            } else {

                setSession('errors', $errors);
                redirect(URL . "views/product/edit.php?id=" . $product_id);
            }
        } else {

            setSession('errors', ['The Product ID or Category ID Isn\'t Exist In Our Database!']);
            redirect(URL . 'views/product/add.php');
        }

    } else {
        redirect(URL . "views/product/all.php");
    }

} else {
    redirect( URL . 'login.php');
}