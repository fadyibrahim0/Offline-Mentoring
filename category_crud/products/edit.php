<?php

include_once '../inc/header.php'; 
include_once '../core/connect.php';
include_once '../core/session.php';

if(isset($_GET['id'])) {
    $id         = $_GET['id'];
    // $sql        = "SELECT * FROM `products` WHERE `id`='$id'";
    $sql           = "SELECT products.*, categories.name AS cat_name, categories.id AS cat_id
                        FROM products
                        INNER JOIN categories ON categories.id = products.category_id
                        WHERE products.id='$id'";
    $result     = mysqli_query($conn, $sql);
    $product   = mysqli_fetch_assoc($result);
}

?>

    <div class="container">
        <h1 class="text-center my-5">Edit Product - <?= $product['name'] ?></h1>

        <!-- Displaying Error or Success Messages -->
        <?php include_once "../inc/messages.php"; ?>

        <!-- Start Categories Table -->
        <form method="POST" action="../handlers/products/update.php" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $product['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $product['name']?>">
            </div>
            <div class="mb-3">
                <?php
                $sql        = "SELECT * FROM `categories`";
                $result     = mysqli_query($conn, $sql);
                $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
                ?>
                <label for="name" class="form-label">Category Name</label>
                <select class="form-control" name="category_id">
                    <?php
                    foreach($categories as $category){
                    ?>
                    <option <?php if($product['cat_id'] === $category['id']) {echo "selected";} ?> value="<?=$category['id']?>"><?=$category['name']?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="img" class="form-label">Product Image</label>
                <input type="file" name="img" class="form-control" id="img">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
    </div>
    <!-- End Categories Table -->

<?php include_once '../inc/footer.php'; ?>