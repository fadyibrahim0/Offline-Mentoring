<?php

require_once "../../core/config.php";
require_once PATH . "core/db.php";
require_once PATH . "core/functions.php";
require_once PATH . "core/sessions.php";

// Check if the user login and is Admin or Super Admin
if(existSession('logged') && getSession('logged')['type'] != 'user') {

    if(isset($_GET['id'])) {

        $id = $_GET['id'];
        
        // Check if ID is exist
        $query = "SELECT * FROM `category` WHERE `id` = $id";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result) > 0) {
            
            // Perform delete action
            $query = "DELETE FROM `category` WHERE `id` = $id";
            $result = mysqli_query($conn, $query);
            $affectedRows = mysqli_affected_rows($conn);
            mysqli_close($conn);

            // Check if the category deleted successfully
            if($result) {

                setSession('success', "Category Deleted Successfully. " . $affectedRows . " Rows Affected!");
                redirect(URL . "views/category/all.php");

            } else {

                setSession('errors', ["Error: " . mysqli_error($conn)]);
                redirect(URL . "views/category/all.php");
            }
        } else {

            redirect(URL . "views/category/all.php");
        }

    } else {
        redirect(URL . "views/category/all.php");
    }
    
} else {
    redirect(URL . 'login.php');
}