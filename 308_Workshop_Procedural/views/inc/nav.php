<?php 

// Nav URL
$projPath   = "/group308/workshop/";
define("N_URL", "http://" . $_SERVER['SERVER_NAME'] . ":" . $_SERVER['SERVER_PORT'] . $projPath );

$currentURL = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">308_Workshop</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <?php
                if(isset($_SESSION['logged'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link <?= (!(strpos($currentURL, 'category/') ||
                                                strpos($currentURL, 'product/')||
                                                strpos($currentURL, 'user/') ||
                                                strpos($currentURL, 'order/'))) ? "active" : ""; ?>"
                            href="<?= N_URL ?>">Home</a>
                    </li>
                    
                    <!-- Normal User Can't Access Categories -->
                    <?php if($_SESSION['logged']['type'] !== 'user') { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($currentURL, 'category/')) ? "active" : ""; ?>" href="<?= N_URL . 'views/category/all.php' ?>">Categories</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($currentURL, 'user/')) ? "active" : ""; ?>" href="<?= N_URL . 'views/user/all.php' ?>">Users</a>
                    </li>
                    <?php } ?>
                    
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($currentURL, 'product/')) ? "active" : ""; ?>" href="<?= N_URL . 'views/product/all.php' ?>">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= (strpos($currentURL, 'order/')) ? "active" : ""; ?>" href="<?= N_URL . 'views/order/all.php' ?>">Orders</a>
                    </li>
                </ul>
                <ul class="navbar-nav mx-5 mb-2 mb-lg-0 justify-content-right">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><?= $_SESSION['logged']['name'] ?></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= N_URL . 'handlers/logout.php' ?>">Logout</a>
                    </li>
                </ul>
                <?php
                } else {
                ?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= N_URL . "login.php" ?>">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= N_URL . "register.php" ?>">Register</a>
                    </li>
                <?php
                }
                ?>
                </ul>
            </div>
        </div>
    </nav>