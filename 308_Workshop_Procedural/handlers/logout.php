<?php

    require_once "../core/config.php";
    require_once "../core/functions.php";

    session_start();
    $_SESSION = array();
    session_destroy();
    session_unset();
    redirect(URL . "login.php");
    exit;