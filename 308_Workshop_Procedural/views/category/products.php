<?php

require_once '../../core/config.php';
require_once PATH . 'views/inc/header.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/functions.php';

if(existSession('logged')) {

    if(isset($_GET['id'])) {
        $id         = $_GET['id'];
        $sql        = "SELECT `product`.*, `category`.`name` AS `category_name`
                        FROM `product`
                        INNER JOIN `category` ON `product`.`category_id` = `category`.`id`
                        WHERE `category_id` = $id";
        $result     = mysqli_query($conn, $sql);
        $products   = mysqli_fetch_all($result, MYSQLI_ASSOC);
        mysqli_free_result($result);
        mysqli_close($conn);
    }

?>

    <div class="container">
        <h1 class="text-center my-5"><?= $products[0]['category_name'] ?> - Products</h1>

        <div class="buttons" >
            <div class="button" style="display: inline-block;">
                <a href="<?= URL . "views/category/all.php" ?>">
                    <button class="btn btn-primary">All Categories</button>
                </a>
            </div>

            <div class="mb-5 mx-5 button" style="display: inline-block;">
                <a href="<?= URL . "views/products/all.php" ?>">
                    <button class="btn btn-primary">All Products</button>
                </a>
            </div>
        </div>
        
        <!-- Start Table -->
        <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Price</th>
                <th scope="col">Wholesale Price</th>
                <th scope="col">Base Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Offer</th>
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
                <td><?= $product['price'] ?></td>
                <td><?= $product['wholesale_price'] ?></td>
                <td><?= $product['base_price'] ?></td>
                <td><?= $product['qty'] ?></td>
                <td><?= $product['offer'] ?></td>
            </tr>
            <?php
            }
            ?>
        </tbody>
    </table>
        <!-- End Table -->
    </div>

<?php
require_once PATH . 'views/inc/footer.php';

} else {
    redirect(URL . 'login.php');
}
?>