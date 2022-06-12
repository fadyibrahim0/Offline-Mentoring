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
        $result = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` = $id");
        $image  = mysqli_fetch_assoc($result)['image'];
        if(mysqli_num_rows($result) > 0) {
            
            // Perform delete action
            $query = "DELETE FROM `product` WHERE `id` = $id";
            $result = mysqli_query($conn, $query);
            $affectedRows = mysqli_affected_rows($conn);
            mysqli_close($conn);

            // Remove This Product's Image
            if(file_exists( PATH . "uploads/images/product/" . $image )) {
                unlink( PATH . "uploads/images/product/" . $image );
            }
        
            // Check if the product deleted successfully
            if($result) {

                setSession('success', "Product Deleted Successfully. " . $affectedRows . " Rows Affected!");
                redirect(URL . "views/product/all.php");

            } else {

                setSession('errors', ["Error: " . mysqli_error($conn)]);
                redirect(URL . "views/product/all.php");
            }
        } else {

            redirect(URL . "views/product/all.php");
        }

    } else {
        redirect(URL . "views/product/all.php");
    }
    
} else {
    redirect( URL . 'login.php');
}