<?php

include_once '../../core/helpers.php';
include_once '../../core/connect.php';
include_once '../../core/validation.php';
include_once '../../core/session.php';


if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    // Errors Array
    $errors = [];

    // Product Name
    $name           = validString($_POST['name']) ?? "";
    $category_id    = $_POST['category_id'];

    // Product Image
    $imgName    = $_FILES['img']['name'];
    $imgSize    = $_FILES['img']['size'];
    $imgType    = $_FILES['img']['type'];
    $imgTmp     = $_FILES['img']['tmp_name'];

    $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

    $explodes   = explode('.', $imgName);
    $imgEXT     = strtolower(end($explodes));


    // Validate Product Name
    if(empty($name)){
        $errors[] = "Product Name Is Required!";
    } elseif (minVal($name, 3) || maxVal($name, 50)) {
        $errors[] = "Product Name Must Be Between 3 and 50 Characters";
    }

    // Validate Product Image
    if(empty($imgName)) {
        $errors[] = "Product Image Is Required";
    } elseif (!in_array($imgEXT, $allowedEXT)) {
        $errors[] = "This Extension Is Not Allowed";
    } elseif ($imgSize > 5242880) {
        $errors[] = "Image Size Should Be Less Than 5MB";
    }

    if($errors){
        setSession('errors', $errors);
        header("Location:../../products/add.php");
        exit();
    } else {

        $img = time() . '_' . $imgName;
        move_uploaded_file($imgTmp, "../../uploads/images/products/".$img);

        $sql = "INSERT INTO `products` (`name`, `img`, `category_id`)
                VALUES ('$name', '$img', '$category_id')";
        $result = mysqli_query($conn, $sql);
        if($result){
            setSession('success', "Product Inserted Successfully");
            header("Location:../../products/index.php");
            exit();
        }
    }
} else {
    header("Location:../../products/index.php");
}