<?php 

require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/db.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

// Check if the user login and is Admin or Super Admin
if(existSession('logged')) {
?>

<?php

if(getSession('logged')['type'] == 'user') {

    // Get All Current User Orders From The Database
    $id = getSession('logged')['id'];
    $sql = "SELECT * FROM `order` WHERE `ordered_by` = '$id'";
} else {

    // Get All Orders From The Database
    $sql = "SELECT * FROM `order` ORDER BY `id` DESC";

    // Get All Orders From The Database
    $sql = "SELECT `order`.*, `user`.`name` AS `user_name`
            FROM `order`
            INNER JOIN `user` ON `order`.`ordered_by` = `user`.`id`
            ORDER BY `id` DESC";
}

$result = mysqli_query($conn, $sql);
$orders = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free The Result, Then Close The Connection
free_close($result, $conn);
?>

<div class="container">
    <h1 class="my-2 text-center">All Orders</h1>

    <?php if(getSession('logged')['type'] == 'user') { ?>
    <div class="mb-5">
        <a href="<?= URL . "views/order/add.php" ?>">
            <button class="btn btn-primary">Make New Order</button>
        </a>
    </div>
    <?php } ?>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Price</th>
                <th scope="col">Price Type</th>
                <th scope="col">Notes</th>
                <th scope="col">Involved Products</th>
                <?php if(getSession('logged')['type'] != 'user'): ?>
                <th scope="col">Ordered By</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($orders as $order) {
            ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $order['price'] ?></td>
                <td><?= $order['price_type'] ?></td>
                <td><?= $order['notes'] ?></td>
                <td>
                    <a href="#">
                        <button class="btn btn-secondary">Products</button>
                    </a>
                </td>
                <?php if(getSession('logged')['type'] != 'user'): ?>
                <td><?= $order['user_name'] ?></td>
                <?php endif; ?>
                
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