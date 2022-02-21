<?php

include_once '../../inc/connect.php';
include_once '../../inc/validation.php';
include_once '../../inc/session.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql    = "DELETE FROM `categories` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if($result){
        setSession('success', "Category Deleted Successfully");
        header("Location:../../categories/index.php");
        exit();
    }
}
header("Location:../../categories/index.php");