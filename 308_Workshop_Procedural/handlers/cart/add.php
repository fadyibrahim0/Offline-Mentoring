<?php

require_once '../../core/config.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/functions.php';

if($_SERVER['REQUEST_METHOD'] == 'GET' && existSession('logged') && getSession('logged')['type'] == 'user') {

    $id = $_GET['id'];

    // Check If This Product Is Exist
    $result = mysqli_query($conn, "SELECT * FROM `product` WHERE `id` = '$id'");
    if(mysqli_num_rows($result) > 0) {

        $product = mysqli_fetch_assoc($result);
        free_close($result, $conn);

        // IF There's enough quantity to buy this product
        if($product['qty'] > 0) {

            if(existSession('cart')) {
                addOnSession('cart', $product);
            } else {
                setSession('cart', [$product]);
            }

            setSession('success', "Product Added To Cart Successfully!");
            redirect( URL . "views/product/all.php");
            
        } else {
            setSession('error', ["Sorry There Isn't Enough Quantity To Buy This Product"]);
            redirect( URL . 'views/product/all.php');
        }
    }
} else {
    redirect( URL . 'login.php');
}