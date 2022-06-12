<?php

// include_once '../../core/connect.php';
include_once '../../core/validation.php';
include_once '../../core/session.php';
include_once '../../core/Database.php';

use Core\DB;



if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $db = new DB();
    // $sql    = "DELETE FROM `categories` WHERE `id`='$id'";
    // $result = mysqli_query($conn, $sql);

    if($db->table('categories')->delete($id)){
        setSession('success', "Category Deleted Successfully");
        header("Location:../../categories/index.php");
        exit();
    }
}
header("Location:../../categories/index.php");