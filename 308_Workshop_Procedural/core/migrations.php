<?php require_once "db.php" ?>

<?php

$results = [];

$category_table = "CREATE TABLE `category` (
    `id` INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50)
);";

$user_table = "CREATE TABLE `user`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `type` ENUM('admin', 'super_admin', 'user'),
    `name` VARCHAR(255),
    `email` VARCHAR(255) UNIQUE,
    `password` VARCHAR(255),
    `image` VARCHAR(255)
);";

$product_table = "CREATE TABLE `product` (
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `name` VARCHAR(50),
    `price` INT,
    `wholesale_price` INT,
    `qty` INT,
    `offer` INT,
    `base_price` INT,
    `category_id` INT NOT NULL,
    `image` VARCHAR(255),
    FOREIGN KEY(`category_id`) REFERENCES `category`(`id`)
);";

$order_table = "CREATE TABLE `order`(
    `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    `ordered_by` INT NOT NULL,
    `notes` VARCHAR(255),
    `price_type` ENUM('LE', 'USD', 'SAR'),
    `price` INT,
    `product_id` INT NOT NULL,
    FOREIGN KEY(`ordered_by`) REFERENCES `user`(`id`)
);";

$order_product_table = "CREATE TABLE `order_product`(
    `order_id` INT NOT NULL,
    `product_id` INT NOT NULL,
    FOREIGN KEY (`order_id`) REFERENCES `order`(`id`),
    FOREIGN KEY (`product_id`) REFERENCES `product`(`id`)
);";




$tables = ["Category"       => $category_table, 
            "User"          => $user_table, 
            "Product"       => $product_table, 
            "Order"         => $order_table,
            "Order_Product" => $order_product_table];


foreach($tables as $name => $statement){
    $query = mysqli_query($conn, $statement);

    if(!$query)
        $results[] = "Table $name : Creation failed (".mysqli_error($conn).")";
    else
        $results[] = "Table $name : Creation done";
}


foreach($results as $msg) {
    echo "$msg <br>";
}

mysqli_close($conn);