<?php 
include_once '../inc/header.php';
include_once '../core/connect.php';
include_once '../core/session.php';
?>

<div class="container">
    <h1 class="text-center my-5">Add New Product</h1>

    <!-- Displaying Error or Success Messages -->
    <?php include_once "../inc/messages.php"; ?>

    <form method="POST" action="../handlers/products/add.php" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" name="name" class="form-control" id="name">
        </div>
        <div class="mb-3">
            <label for="img" class="form-label">Product Image</label>
            <input type="file" name="img" class="form-control" id="img">
        </div>
        <div class="mb-3">
            <?php
            $sql        = "SELECT * FROM `categories`";
            $result     = mysqli_query($conn, $sql);
            $categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <label>Category Name</label>
            <select class="form-control" name="category_id">
                <option selected>...</option>
                <?php
                foreach($categories as $category){
                ?>
                <option value="<?=$category['id']?>"><?=$category['name']?></option>
                <?php
                }
                ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Add</button>
    </form>
</div>

<?php include_once '../inc/footer.php' ?>