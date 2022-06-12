<?php

require_once '../../core/config.php';
require_once PATH . 'views/inc/header.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/functions.php';

if(existSession('logged') && existSession('logged')['type'] != 'user') {

    if(isset($_GET['id'])) {

        $product_id = $_GET['id'];

        // Get The Specific Product
        $sql        = "SELECT * FROM `product` WHERE `id`='$product_id'";
        $result     = mysqli_query($conn, $sql);
        $product    = mysqli_fetch_assoc($result);

        // Get All Categories (for select box)
        $query      = "SELECT * FROM `category`";
        $result     = mysqli_query($conn, $query);
        $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

        free_close($result, $conn);
    }

?>

    <div class="container">
        
        <h1 class="text-center my-5">Edit Product - <?= $product['name'] ?></h1>

        <div class="mb-5">
            <a href="<?= URL . "views/product/all.php" ?>">
                <button class="btn btn-primary">All Products</button>
            </a>
        </div>

        <!-- Displaying Error or Success Messages -->
        <?php require_once PATH . "views/inc/messages.php"; ?>

        <!-- Start Product Form -->
        <form method="POST" action="<?= URL . "handlers/product/update.php" ?>" enctype="multipart/form-data">

            <!-- Hidden Input For Product ID -->
            <input name="product_id" type="hidden" value="<?= $product['id'] ?>">

            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $product['name']?>">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Product Price</label>
                <input type="number" name="price" class="form-control" id="price" value="<?= $product['price']?>">
            </div>
            <div class="mb-3">
                <label for="category_id" class="form-label">Product Category</label>
                <select name="category_id" id="category_id" class="form-control">
                <?php
                foreach($categories as $category) {
                ?>
                    <option <?= ($product['id'] == $category['id']) ? "selected" : ""; ?> value="<?= $category['id'] ?>">
                        <?= $category['name'] ?>
                    </option>
                <?php
                }
                ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Product Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="wholesale_price" class="form-label">Wholesale Price</label>
                <input type="number" name="wholesale_price" class="form-control" id="wholesale_price" value="<?= $product['wholesale_price']?>">
            </div>
            <div class="mb-3">
                <label for="base_price" class="form-label">Base Price</label>
                <input type="number" name="base_price" class="form-control" id="base_price" value="<?= $product['base_price']?>">
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" name="qty" class="form-control" id="qty" value="<?= $product['qty']?>">
            </div>
            <div class="mb-3">
                <label for="offer" class="form-label">Offer</label>
                <input type="number" name="offer" class="form-control" id="offer" value="<?= $product['offer']?>">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        <!-- End Product Form -->

    </div>

<?php
require_once PATH . 'views/inc/footer.php';

} else {
    redirect(URL . 'login.php');
}
?>