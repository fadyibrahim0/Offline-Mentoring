<?php  require_once "core/config.php"; ?>
<?php  require_once PATH . "views/inc/header.php"; ?>
<?php  require_once PATH . "core/db.php"; ?>
<?php  require_once PATH . "core/sessions.php"; ?>
<?php  require_once PATH . "core/functions.php"; ?>

<?php
// A way to get total records number from a database table
$sql            = "SELECT COUNT(*) AS `products_number` FROM `product`";
$result         = mysqli_query($conn, $sql);
$productsNum    = mysqli_fetch_object($result)->products_number;

// Another way to get total records number from a database table
$sql = "SELECT * FROM `user`";
$result = mysqli_query($conn, $sql);
$usersNum = mysqli_num_rows($result);

// The same second way with a little bit of shortage
$ordersNum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order`"));

// Orders Number for Current Login User
if(getSession('logged')['type'] == 'user') {
    $currentUserId = getSession('logged')['id'];
    $ordersNum = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE `ordered_by` = '$currentUserId'"));
}

// Free Result, Then Close Connection
free_close($result, $conn);
?>

<div class="container">
    <h1 class="mt-2 mb-5">Some Statistics</h1>
    <div class="row">

        <div class="col-md-4 text-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Number of Products</h5>
                    <h1><?= $productsNum ?></h1>
                    <p class="card-text"></p>
                    <a href="<?= URL . "views/product/all.php" ?>" class="btn btn-primary">Show All Products</a>
                </div>
            </div>
        </div>

        <?php
        if(getSession('logged')['type'] != 'user') {
        ?>
        <div class="col-md-4">
            <div class="card text-center" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Number of Users</h5>
                    <h1><?= $usersNum ?></h1>
                    <p class="card-text"></p>
                    <a href="<?= URL . "views/user/all.php" ?>" class="btn btn-primary">Show All Users</a>
                </div>
            </div>
        </div>
        <?php
        }
        ?>

        <div class="col-md-4 text-center">
            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Number of Orders</h5>
                    <h1><?= $ordersNum ?></h1>
                    <p class="card-text"></p>
                    <a href="<?= URL . "views/order/all.php" ?>" class="btn btn-primary">Show All Orders</a>
                </div>
            </div>
        </div>
        
    </div>
</div>

<?php require_once PATH . "views/inc/footer.php"; ?>