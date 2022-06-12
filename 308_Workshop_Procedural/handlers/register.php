<?php

require_once "../core/config.php";
require_once PATH . "core/db.php";
require_once PATH . "core/validations.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $errors = [];

    // Sanitize Inputs
    $name           = validString($_POST['name']) ?? "";
    $email          = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ?? "";
    $password       = trim($_POST['password']);

    // Check If Email Is Already Exist
    $query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $errors[] = "Sorry This Email Is Already Exist";
        mysqli_free_result($result);
    }


    // If user wants to change the image (user actually uploads an image)
    $imageFlag = false;
    if(file_exists($_FILES['image']['tmp_name']) || is_uploaded_file($_FILES['image']['tmp_name'])) {

        // User Sent an Image
        $imageFlag = true;

        // User Image Data
        $imgName    = $_FILES['image']['name'];
        $imgSize    = $_FILES['image']['size'];
        $imgType    = $_FILES['image']['type'];
        $imgTmp     = $_FILES['image']['tmp_name'];

        // Allowed Image Extensions List
        $allowedEXT = ['jpeg', 'jpg', 'png', 'gif'];

        // Split To Get The Image Extension Alone
        $explodes   = explode('.', $imgName);
        $imgEXT     = strtolower(end($explodes));

        // Validate User Image
        if (!in_array($imgEXT, $allowedEXT)) {
            $errors[] = "This Extension Is Not Allowed";
        } elseif ($imgSize > 2097152) {
            $errors[] = "Image Size Should Be Less Than 2MB";
        }
    }

    // Validate Category Name
    if(empty($name)) {
        $errors[] = "Username Field Is Required !!";
    }
    if(minVal($name, 3) || maxVal($name, 50) ) {
        $errors[] = "Username Should Be Between 3 and 50 Characters";
    }

    //  Validate Category Email
    if(empty($email)) {
        $errors[] = "Email Field Is Required !!";
    }

    //  Validate Password
    if(empty($password)) {
        $errors[] = "Password Field Is Required !!";
    }

    // If there are no errors
    if(empty($errors)) {

        // Encrypt Password
        $password = sha1($password);

        if($imageFlag) {
            // The New Image
            $image = time() . '_' . $imgName;
            move_uploaded_file($imgTmp, "../uploads/images/user/".$image);

        } else {

            // The Default Image
            $image = "default.png";
        }
        
        // Insert Statement
        $sql    = "INSERT INTO `user` (`name`, `email`, `password`, `image`, `type`)
                VALUES ('$name', '$email', '$password', '$image', 'user')";

        $result = mysqli_query($conn, $sql);
        $affectedRows = mysqli_affected_rows($conn);

        // Close database connection to ignore database headache
        mysqli_close($conn);

        setSession('success', "You Have Been Registered Successfully!");
        redirect(URL . "login.php");

    } else {

        setSession('errors', $errors);
        redirect(URL . "register.php");
    }

} else {

    redirect(URL . "login.php");
}