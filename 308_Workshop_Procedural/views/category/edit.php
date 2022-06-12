<?php

require_once '../../core/config.php';
require_once PATH . 'views/inc/header.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/functions.php';

if(existSession('logged')) {

    if(isset($_GET['id'])) {
        $id         = $_GET['id'];
        $sql        = "SELECT * FROM `category` WHERE `id`='$id'";
        $result     = mysqli_query($conn, $sql);
        $category   = mysqli_fetch_assoc($result);
    }

?>

    <div class="container">
        <h1 class="text-center my-5">Edit Category - <?= $category['name'] ?></h1>

        <div class="mb-5">
            <a href="<?= URL . "views/category/all.php" ?>">
                <button class="btn btn-primary">All Categories</button>
            </a>
        </div>

        <!-- Displaying Error or Success Messages -->
        <?php require_once PATH . "views/inc/messages.php"; ?>

        
        <!-- Start Categories Form -->
        <form method="POST" action=<?= URL . "handlers/category/update.php" ?>>
            <input type="hidden" name="id" value="<?= $category['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $category['name']?>">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Category Description</label>
                <input type="text" name="description" class="form-control" id="description" value="<?= $category['description']?>">
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Update</button>
        </form>
        <!-- End Categories Form -->
        
    </div>

<?php
require_once PATH . 'views/inc/footer.php';

} else {
    redirect(URL . 'login.php');
}
?>