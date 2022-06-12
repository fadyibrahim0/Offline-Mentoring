<?php
require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/db.php";
require_once PATH . "core/functions.php";
require_once PATH . "core/sessions.php";


if(existSession('logged') && getSession('logged')['type'] != 'user') {

    // Get all categories for select box
    $query = "SELECT `id`, `name` FROM `category`";
    $result = mysqli_query($conn, $query);
    $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<div class="container">
    <h1 class="my-2 text-center">Add New Product</h1>

    <div class="mb-5">
        <a href="<?= URL . "views/product/all.php" ?>">
            <button class="btn btn-primary">All Products</button>
        </a>
    </div>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <form method="POST" action="<?= URL . "handlers/product/store.php" ?>" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Product Price</label>
            <input type="number" name="price" class="form-control" id="price">
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Product Category</label>
            <select name="category_id" id="category_id" class="form-control">
            <?php
            foreach($categories as $category) {
            ?>
                <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
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
            <input type="number" name="wholesale_price" class="form-control" id="wholesale_price">
        </div>
        <div class="mb-3">
            <label for="base_price" class="form-label">Base Price</label>
            <input type="number" name="base_price" class="form-control" id="base_price">
        </div>
        <div class="mb-3">
            <label for="qty" class="form-label">Quantity</label>
            <input type="number" name="qty" class="form-control" id="qty">
        </div>
        <div class="mb-3">
            <label for="offer" class="form-label">Offer</label>
            <input type="number" name="offer" class="form-control" id="offer">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
require_once PATH . "views/inc/footer.php";

} else {
    redirect(URL . 'login.php');
}
?>