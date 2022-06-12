<?php 
include_once '../inc/header.php';
include_once '../core/session.php';
?>

<div class="container">
    <h1 class="text-center my-5">Add New Category</h1>

    <!-- Displaying Error or Success Messages -->
    <?php include_once "../inc/messages.php"; ?>

    <form method="POST" action="../handlers/categories/add.php">
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Category Description</label>
            <input type="text" name="description" class="form-control" id="description">
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Add</button>
    </form>
</div>

<?php include_once '../inc/footer.php' ?>