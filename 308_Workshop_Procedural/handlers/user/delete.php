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
        $query = "SELECT * FROM `user` WHERE `id` = $id";
        $result = mysqli_query($conn, $query);
        $user   = mysqli_fetch_assoc($result);

        if(mysqli_num_rows($result) > 0) {

            // Check if This User Type Is Admin
            if($user['type'] == 'admin') {

                // Perform delete action
                $query = "DELETE FROM `user` WHERE `id` = $id";
                $result = mysqli_query($conn, $query);
                $affectedRows = mysqli_affected_rows($conn);
                mysqli_close($conn);

                // Check if the user deleted successfully
                if($result) {

                    setSession('success', "User Deleted Successfully. " . $affectedRows . " Rows Affected!");
                    redirect(URL . "views/user/all.php");

                } else {

                    setSession('errors', ["Error: " . mysqli_error($conn)]);
                    redirect(URL . "views/user/all.php");
                }
            } else {

                setSession('errors', ["You Can Delete Only Admins !"]);
                redirect(URL . "views/user/all.php");
            }
            } else {

                redirect(URL . "views/user/all.php");
            }

    } else {
        redirect(URL . "views/user/all.php");
    }

} else {
    redirect( URL . 'login.php');
}