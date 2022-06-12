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

        // Sanitize Inputs
        $name           = validString($_POST['name']) ?? "";
        $description    = validString($_POST['description']) ?? "";

        // Validate Category Name
        if(empty($name)) {
            $errors[] = "Category Name Field Is Required !!";
        }
        if(minVal($name, 3) || maxVal($name, 50) ) {
            $errors[] = "Category Name Should Be Between 3 and 50 Characters";
        }

        //  Validate Category Description
        if(empty($description)) {
            $errors[] = "Category Description Field Is Required !!";
        }
        if(minVal($description, 3) || maxVal($description, 255)) {
            $errors[] = "Category Name Should Be Between 3 and 255 Characters";
        }

        // If there are no errors
        if(empty($errors)) {

            $sql    = "INSERT INTO `category` (`name`, `description`)
                    VALUES ('$name', '$description')";

            $result = mysqli_query($conn, $sql);
            $affectedRows = mysqli_affected_rows($conn);

            // Close database connection to ignore database headache
            mysqli_close($conn);

            setSession('success', "Category Inserted Successfully. $affectedRows Rows affected!");
            redirect(URL . "views/category/all.php");

        } else {

            setSession('errors', $errors);
            redirect(URL . "views/category/add.php");
        }

    } else {

        redirect(URL . "views/category/all.php");
    }
} else {
    redirect(URL . 'login.php');
}