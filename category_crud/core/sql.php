<?php

function createDB($host, $user, $password, $database){

    
    $link = mysqli_connect($host, $user, $password);

    if(!$link){
        die("ERROR " . mysqli_connect_error());
    }

    if (!mysqli_select_db($link, $database)) {
        
        $sql1 = "CREATE DATABASE $database;";
    
        if(mysqli_query($link, $sql1)) {
    
            $link = mysqli_connect($host, $user, $password, $database);
            echo "Database Created Successfully";
            echo "<br/>";
    
            $sql2 = "CREATE TABLE `categories`(
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(50),
                `description` VARCHAR(255)
            );";
        
            if(mysqli_query($link, $sql2)) {
                echo "Categories Table Created Successfully";
                echo "<br/>";
            } else {
                echo "Error During Creating Categories Table " . mysqli_error($link);
            }
    
            $sql3 = "CREATE TABLE `products`(
                `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
                `name` VARCHAR(50),
                `img` VARCHAR(255),
                `category_id` INT,
                FOREIGN KEY (category_id) REFERENCES categories(id)
            );";
        
            if(mysqli_query($link, $sql3)) {
                echo "Products Table Created Successfully";
                echo "<br/>";
            } else {
                echo "Error During Creating Products Table " . mysqli_error($link);
            }
    
    
        } else {
            echo "Error During Creating Database " . mysqli_error($link);
        }
    
        mysqli_close($link);
    }
    
}