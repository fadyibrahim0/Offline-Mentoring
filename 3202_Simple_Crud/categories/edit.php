<?php

include_once '../inc/header.php'; 
include_once '../core/connect.php';
include_once '../core/session.php';

if(isset($_GET['id'])) {
    $id         = $_GET['id'];
    $sql        = "SELECT * FROM `categories` WHERE `id`='$id'";
    $result     = mysqli_query($conn, $sql);
    $category   = mysqli_fetch_assoc($result);
}

?>

    <div class="container">
        <h1 class="text-center my-5">Edit Category - <?= $category['name'] ?></h1>

        <!-- Displaying Error or Success Messages -->
        <?php include_once "../inc/messages.php"; ?>

        <!-- Start Categories Table -->
        <form method="POST" action="../handlers/categories/update.php">
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
    </div>
    <!-- End Categories Table -->

<?php include_once '../inc/footer.php'; ?>