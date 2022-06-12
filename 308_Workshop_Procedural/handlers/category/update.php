<?php

require_once '../../core/config.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/validations.php';
require_once PATH . 'core/functions.php';

// Check if the user login and is Admin or Super Admin
if(existSession('logged') && getSession('logged')['type'] != 'user') {

if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

    // Inputs
    $id             = $_POST['id'];
    $name           = validString($_POST['name']) ?? "";
    $description    = validString($_POST['description']) ?? "";

    // Errors Arr
    $errors = [];


    // Validate Category Name
    if(empty($name)){
        $errors[] = "Category Name Is Required!";
    } elseif (minVal($name, 3) || maxVal($name, 50)) {
        $errors[] = "Category Name Must Be Between 3 and 50 Characters";
    }

    // Validate Category Description
    if(empty($description)){
        $errors[] = "Category Description Is Required!";
    } elseif (minVal($description, 3)) {
        $errors[] = "Category Description Can't Be Less Than 3 Characters";
    }

    if($errors){

        setSession('errors', $errors);
        redirect(URL . 'views/category/edit.php?id='.$id);

    } else {
        $query = "UPDATE `category` 
                SET `name` = '$name', `description` = '$description'
                WHERE `id` = '$id'";
        $result = mysqli_query($conn, $query);
        $affectedRows = mysqli_affected_rows($conn);
        mysqli_close($conn);

        if($result){
            setSession('success', "Category Updated Successfully. " . $affectedRows . " Rows Affected!");
            redirect(URL . "views/category/all.php");
        }
    }
}
redirect(URL . "views/category/all.php");

} else {
    redirect( URL . 'login.php');
}