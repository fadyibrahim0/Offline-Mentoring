<?php

define("URL", "http://127.0.0.1/group308/oop-pdo/");

spl_autoload_register(function($class) {
    include_once 'classes/' . $class . '.php';
});

set_error_handler('Errors::ErrorHandler');
set_exception_handler('Errors::ExceptionHandler');

$product = new Product;

$url = explode("/", $_SERVER['REQUEST_URI']);
unset($url[0]);
$url = array_values($url);


if($url[2] == "index" || $url[2] == "") {
    $product->index();
}
if($url[2] == "create") {
    $product->create();
}
if($url[2] == "store") {
    $product->store();
}
if($url[2] == "edit") {
    $product->edit($url[3]);
}
if($url[2] == "update") {
    $product->update($url[3]);
}
if($url[2] == "delete") {
    $product->delete($url[3]);
}