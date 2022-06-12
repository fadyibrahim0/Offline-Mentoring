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

        // Check if The Sent Category ID Is Exist Or Not
        $cat_id = filter_var($_POST['category_id'], FILTER_VALIDATE_INT);
        $query = "SELECT * FROM `category` WHERE `id` = '$cat_id'";
        $result = mysqli_query($conn, $query);

        // If the sent category ID is exist in our Database
        if(mysqli_num_rows($result) > 0) {

            // Free Result
            mysqli_free_result($result);

            // Sanitize Inputs
            $name           = validString($_POST['name']) ?? "";
            $price          = filter_var($_POST['price'], FILTER_VALIDATE_INT);
            $wholesalePrice = filter_var($_POST['wholesale_price'], FILTER_VALIDATE_INT);
            $basePrice      = filter_var($_POST['base_price'], FILTER_VALIDATE_INT);
            $qty            = filter_var($_POST['qty'], FILTER_VALIDATE_INT);
            $offer          = filter_var($_POST['offer'], FILTER_VALIDATE_INT);

            // Product Image
            $imgName    = $_FILES['image']['name'];
            $imgSize    = $_FILES['image']['size'];
            $imgType    = $_FILES['image']['type'];
            $imgTmp     = $_FILES['image']['tmp_name'];

            $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

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

                $image = time() . '_' . $imgName;
                move_uploaded_file($imgTmp, "../../uploads/images/product/".$image);

                $sql    = "INSERT INTO `product` (`name`, `price`, `wholesale_price`, `qty`, `offer`, `base_price`, `category_id`, `image`)
                        VALUES ('$name', '$price', '$wholesalePrice', '$qty', '$offer', '$basePrice', '$cat_id', '$image')";

                $result = mysqli_query($conn, $sql);
                $affectedRows = mysqli_affected_rows($conn);
                mysqli_close($conn);

                setSession('success', "Product Inserted Successfully. $affectedRows Rows affected!");
                redirect(URL . "views/product/all.php");

            } else {

                setSession('errors', $errors);
                redirect(URL . "views/product/add.php");
            }
        } else {

            setSession('errors', ['This Category ID Isn\'t Exist In Our Database!']);
            redirect(URL . 'views/product/add.php');
        }

    } else {
        redirect(URL . "views/product/all.php");
    }

} else {
    redirect( URL . 'login.php');
}