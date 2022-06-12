<?php

require_once "../../core/config.php";
require_once PATH . "core/db.php";
require_once PATH . "core/validations.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

// Check if the user login and his type is user
if(existSession('logged') && getSession('logged')['type'] == 'user') {

    if(!empty(getSession('cart'))) {

        $currentUserID = getSession('logged')['id'];

        // Notes Input
        $notes = validString($_POST['notes']);
        $notes = (isset($notes) && !empty($notes)) ? $notes : "";

        // Loop through the cart
        $noneRepeatedIDs    = [];
        $price              = 0;
        foreach(getSession('cart') as $product) {
            if(!in_array($product['id'], $noneRepeatedIDs)) {
                $noneRepeatedIDs[] = $product['id'];
                $price = $price + $product['price'];
            }
        }
        
        // Insert Order
        $query  = "INSERT INTO `order` (`ordered_by`, `notes`, `price_type`, `price`)
                    VALUES ('$currentUserID', '$notes', 'LE', '$price') ";
        $result = mysqli_query($conn, $query);
        
        if($result) {
            
            $lastOrderID = mysqli_insert_id($conn);

            $numItems = count($noneRepeatedIDs);
            $i = 0;

            // Start Multiple Query Insertion
            $query = "INSERT INTO `order_product` (`order_id`, `product_id`)
                        VALUES";
            foreach($noneRepeatedIDs as $productID) {
                // Insert Statement for Order_product Table
                $query .= "('$lastOrderID', '$productID'), ";

                // last index
                if(++$i === $numItems) {
                    $query .= "('$lastOrderID', '$productID'); ";
                }
            }

            if(mysqli_query($conn, $query)) {

                deleteSession('cart');
                setSession('success', 'Order Generated Successfully!');
                redirect( URL . 'views/order/all.php');
            }
        }

        
    } else {
?>
    <h1 class='my-5'>Pleas Fill Your Cart First</h1>
    <div>
        <a href="<?= URL . "views/product/all.php" ?>">
            <button class="btn btn-primary">All Products</button>
        </a>
    </div>
<?php
    }
}else {
    redirect(URL . 'login.php');
}