<?php
require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

if(existSession('logged')) {
?>

<div class="container">
    <h1 class="my-2 text-center">Add New Category</h1>

    <div class="mb-5">
        <a href="<?= URL . "views/category/all.php" ?>">
            <button class="btn btn-primary">All Categories</button>
        </a>
    </div>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <form method="POST" action="<?= URL . "handlers/category/store.php" ?>">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Category Description</label>
            <input type="text" name="description" class="form-control" id="description">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php 
require_once PATH . "views/inc/footer.php";

} else {
    redirect(URL . "login.php");
}
?>