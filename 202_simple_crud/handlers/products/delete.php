<?php

include_once '../../core/connect.php';
include_once '../../core/validation.php';
include_once '../../core/session.php';
include_once '../../core/helpers.php';

if(isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql    = "SELECT * FROM `products` WHERE `id`='$id'";
    $result = mysqli_query($conn, $sql);

    if(mysqli_num_rows($result) >= 1){
        $product    = mysqli_fetch_assoc($result);

        // Delete Product From Database
        $sql        = "DELETE FROM `products` WHERE `id`='$id'";
        $result     = mysqli_query($conn, $sql);

        // Delete Product Photo From Uploads Directory
        unlink("../../uploads/images/products/".$product['img']);

        if($result){
            setSession('success', "Product Deleted Successfully");
            header("Location:../../products/index.php");
            exit();
        }
    } else {
        header("Location:../../products/index.php");
    }
}
header("Location:../../products/index.php");