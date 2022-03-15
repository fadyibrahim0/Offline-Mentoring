<?php

include_once "sql.php";

$host = "localhost";
$user = "root";
$password = "";
$database = "202_crud_category";

// Automatically Create Our Database If Not Exist
createDB($host, $user, $password, $database);

$conn = mysqli_connect($host, $user, $password, $database);

if(!$conn) {
    die("Error Ocurred During Connection ". mysqli_connect_error());
}