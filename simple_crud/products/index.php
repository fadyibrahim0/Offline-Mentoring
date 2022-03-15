<?php

include_once '../inc/header.php'; 
include_once '../core/connect.php';
include_once '../core/session.php';

$sql            = "SELECT products.*, categories.name AS cat_name, categories.id AS cat_id
                    FROM products
                    INNER JOIN categories ON categories.id = products.category_id";
$result         = mysqli_query($conn, $sql);
$products       = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

    <div class="container">
        <h1 class="text-center mt-5">All Products</h1>
        <a href="add.php">
            <button class="btn btn-primary my-5">Add Product</button>
        </a>

        <!-- Displaying Error or Success Messages -->
        <?php include_once "../inc/messages.php"; ?>

        <?php 
        if(mysqli_num_rows($result) >= 1){
        ?>
        <!-- Start Categories Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Image</th>
                    <th scope="col">Related Category</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                foreach($products as $product){
                ?>
                <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $product['name'] ?></td>
                    <td>
                        <img src="../uploads/images/products/<?=$product['img']?>" alt="Photo" style="width:80px;height:80px;border-radius:50%;">
                    </td>
                    <td>
                        <?=$product['cat_name']?>
                    </td>
                    <td>
                        <a class="mx-2 text-light" href="edit.php?id=<?=$product['id'];?>">
                            <button class="btn btn-info text-light">Edit</button>
                        </a>
                        <a href="../handlers/products/delete.php?id=<?=$product['id'];?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        } else {
            echo "<h2>There Are No Products To Show</h2>";
        }
        ?>
        
    </div>
    <!-- End Categories Table -->

<?php include_once '../inc/footer.php'; ?>