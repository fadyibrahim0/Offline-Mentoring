<?php 
require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/db.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

if(existSession('logged')) {

    // Get All Products From The Database
    $sql = "SELECT `product`.*, `category`.`name` AS `category_name`
            FROM `product`
            INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
            ORDER BY `id` DESC";
            
    $result = mysqli_query($conn, $sql);
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free The Result, Then Close The Connection
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<div class="container">
    <h1 class="my-2 text-center">All Products</h1>

    <?php if(getSession('logged')['type'] != 'user'): ?>
    <div class="mb-5">
        <a href="<?= URL . "views/product/add.php" ?>">
            <button class="btn btn-primary">Add New Product</button>
        </a>
    </div>
    <?php endif; ?>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Wholesale Price</th>
                <th scope="col">Base Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Offer</th>
                <th scope="col">Related Category</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($products as $product) {
            ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $product['name'] ?></td>
                <td><?= $product['price'] . "LE" ?></td>
                <td>
                    <img style="width: 90px;height: 90px; border-radius:50%;" src="<?= URL . "uploads/images/product/" . $product['image'] ?>">
                </td>
                <td><?= $product['wholesale_price'] . "LE" ?></td>
                <td><?= $product['base_price'] . "LE" ?></td>
                <td><?= $product['qty']?></td>
                <td><?= $product['offer']?></td>
                <td><?= $product['category_name']?></td>
                
                <td>
                <?php
                // Check if the user login and is Admin or Super Admin
                if(getSession('logged')['type'] != 'user') {
                ?>
                    <a class="text-light" href="<?= URL . "/handlers/product/delete.php?id=" . $product['id']; ?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                    <a href="<?= URL . "/views/product/edit.php?id=" . $product['id']; ?>">
                        <button class="btn btn-info">Edit</button>
                    </a>
                <?php
                } else {
                ?>
                    <a href="<?= URL . "/handlers/cart/add.php?id=" . $product['id']; ?>">
                        <button class="btn btn-info">Add To Cart</button>
                    </a>
                <?php
                }
                ?>
                </td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>

</div>

<?php
require_once PATH . "views/inc/footer.php";

} else {
    redirect(URL . 'login.php');
}
?>