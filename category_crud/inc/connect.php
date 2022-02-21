<?php

$conn = mysqli_connect("localhost", "root", "", "crud");

if(!$conn) {
    die("Error Ocurred During Connection ". mysqli_connect_error());
}