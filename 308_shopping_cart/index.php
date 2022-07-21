<?php

require_once 'Cart.php';
require_once 'CartItem.php';
require_once 'Product.php';

$product1 = new Product(1, "First Product", 50, 10);
$product2 = new Product(2, "Second Product", 70, 30);
$product3 = new Product(55, "Third Product", 120, 5);

$cart = new Cart();

$cart->addToCart($product1, 1);
$cart->addToCart($product2, 3);
$cart->addToCart($product3, 5);

echo "<pre>";
// $cart->updateItem($product, 9);
// print_r($cart->getAllItems());
// $cart->checkAvailability($product, 20);
// print_r($cart->totalPrice());
print_r($cart->removeItem(55));
print_r($cart->getAllItems());