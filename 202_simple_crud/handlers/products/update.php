<?php

include_once '../../core/connect.php';
include_once '../../core/validation.php';
include_once '../../core/session.php';
include_once '../../core/helpers.php';


if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    // Errors Arr
    $errors = [];

    // Inputs
    $id             = $_POST['id'];
    $name           = validString($_POST['name']) ?? "";
    $category_id    = $_POST['category_id'];

    $sql        = "SELECT * FROM `products` WHERE `id`='$id'";
    $result     = mysqli_query($conn, $sql);

    // Check If This Product Exist Or Not
    if(mysqli_num_rows($result) >= 1){
        $product    = mysqli_fetch_assoc($result);
        $img        = $product['img'];

        $imgName    = $_FILES['img']['name'];
        $imgSize    = $_FILES['img']['size'];
        $imgType    = $_FILES['img']['type'];
        $imgTmp     = $_FILES['img']['tmp_name'];

        // Validate Product Name
        if(empty($name)){
            $errors[] = "Product Name Is Required!";
        } elseif (minVal($name, 3) || maxVal($name, 50)) {
            $errors[] = "Product Name Must Be Between 3 and 50 Characters";
        }

        if($errors){
            setSession('errors', $errors);
            header("Location:../../products/edit.php?id=".$id);
            exit();
        } else {

            // If User Wants To Update Image
            if(!empty($imgName)) {

                $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

                $explodes   = explode('.', $imgName);
                $imgEXT     = strtolower(end($explodes));

                // Validate Product Image
                if(empty($imgName)) {
                    $errors[] = "Product Image Is Required";
                } elseif (!in_array($imgEXT, $allowedEXT)) {
                    $errors[] = "This Extension Is Not Allowed";
                } elseif ($imgSize > 5242880) {
                    $errors[] = "Image Size Should Be Less Than 5MB";
                }

                // Move New Image
                $img = time() . '_' . $imgName;
                move_uploaded_file($imgTmp, "../../uploads/images/products/".$img);
        
                // Delete Old Image
                unlink("../../uploads/images/products/".$product['img']);
            }

            $sql = "UPDATE `products` SET `name`='$name', `img`='$img', `category_id`='$category_id'  WHERE `id`='$id'";
            $result = mysqli_query($conn, $sql);
            if($result){
                setSession('success', "Product Updated Successfully");
                header("Location:../../products/index.php");
                exit();
            }
        }

    } else {
        header("Location:../../products/index.php");
    }
}

header("Location:../../products/index.php");