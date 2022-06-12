<?php

require_once '../../core/config.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/validations.php';
require_once PATH . 'core/functions.php';

// Check if the user login and is Super Admin
if(existSession('logged') && getSession('logged')['type'] == 'super_admin') {

    if(isset($_POST['submit']) && $_SERVER['REQUEST_METHOD'] == "POST") {

        // Inputs
        $id     = $_POST['id'];
        $type   = validString($_POST['type']) ?? "";

        // Errors Arr
        $errors = [];


        // Validate User Type
        $allowedTypes = ['super_admin', 'admin', 'user'];
        if(!in_array($type, $allowedTypes)) {
            $errors[] = "This Type Is Not Allowed!!";
        }

        if($errors){

            setSession('errors', $errors);
            redirect(URL . 'views/user/edit.php?id='.$id);

        } else {
            $query = "UPDATE `user` 
                    SET `type` = '$type'
                    WHERE `id` = '$id'";
            $result = mysqli_query($conn, $query);
            $affectedRows = mysqli_affected_rows($conn);
            mysqli_close($conn);

            if($result){
                setSession('success', "User Type Updated Successfully. " . $affectedRows . " Rows Affected!");
                redirect(URL . "views/user/all.php");
            }
        }
    }
    redirect(URL . "views/user/all.php");

} else {
    redirect( URL . 'login.php');
}