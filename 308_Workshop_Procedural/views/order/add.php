<?php
require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

$cart = getSession('cart');

if(existSession('logged')) {
?>

<div class="container">
    <h1 class="my-2 text-center">Make New Order</h1>

    <div class="mb-5">
        <a href="<?= URL . "views/order/all.php" ?>">
            <button class="btn btn-primary">All Orders</button>
        </a>
    </div>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <div class="row">

        <div class="buttons mb-5">

            <!-- Start Notes Form -->
            <form class="d-inline-block" method="POST" action="<?= URL . "handlers/order/store.php" ?>">
                <div class="mb-3">
                    <label for="notes" class="form-label">Any Notes ?</label>
                    <input type="text" name="notes" class="form-control" id="notes">
                </div>
                <button type="submit" class="btn btn-primary">Generate Order</button>
            </form>
            <!-- End Notes Form -->

            <a href="<?= URL . "handlers/cart/clear.php" ?>">
                <button class="btn btn-secondary">Clear Cart</button>
            </a>

        </div>
        
        <?php if(!empty($cart)){ ?>
        <!-- Start Cart Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Image</th>
                    <th scope="col">Offer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach($cart as $product) {
                ?>
                <tr>
                    <th scope="row"><?= $i++ ?></th>
                    <td><?= $product['name'] ?></td>
                    <td><?= $product['price'] . "LE" ?></td>
                    <td>
                        <img style="width: 90px;height: 90px; border-radius:50%;" src="<?= URL . "uploads/images/product/" . $product['image'] ?>">
                    </td>
                    <td><?= $product['offer']?></td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
        <!-- End Cart Table -->
        <?php 
        } else {
            echo "<h1 col-md-5>Your Cart Is Empty</h1>";
        } 
        ?>
    </div>
</div>

<?php 
require_once PATH . "views/inc/footer.php";

} else {
    redirect(URL . "login.php");
}
?>