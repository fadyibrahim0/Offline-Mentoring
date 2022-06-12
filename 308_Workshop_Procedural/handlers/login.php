<?php

require_once "../core/config.php";
require_once PATH . "core/db.php";
require_once PATH . "core/validations.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";


if($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Inputs
    $email          = $_POST['email'];
    $password       = sha1($_POST['password']);

    $query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $result = mysqli_query($conn, $query);
    $user   = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result) > 0) {

        mysqli_free_result($result);

        setSession('logged', $user);
        redirect(URL . "index.php");

    } else {

        setSession('errors', ["Email or Password Is Not Correct!"]);
        redirect(URL . "login.php");
    }


} else {

    redirect(URL . "login.php");
}