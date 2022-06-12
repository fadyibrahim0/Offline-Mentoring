<?php 

require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/db.php";
require_once PATH . "core/sessions.php";
require_once PATH . "core/functions.php";

// Check if the user login and is Admin or Super Admin
if(existSession('logged') && getSession('logged')['type'] != 'user') {
?>

<?php
// Get All Categories From The Database
$sql = "SELECT * FROM `category` ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free The Result, Then Close The Connection
mysqli_free_result($result);
mysqli_close($conn);
?>

<div class="container">
    <h1 class="my-2 text-center">All Categories</h1>

    <div class="mb-5">
        <a href="<?= URL . "views/category/add.php" ?>">
            <button class="btn btn-primary">Add New Category</button>
        </a>
    </div>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Related Products</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($categories as $category) {
            ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $category['name'] ?></td>
                <td><?= $category['description'] ?></td>
                <td>
                    <a href="<?= URL . "views/category/products.php?id=" . $category['id'] ?>">
                        <button class="btn btn-secondary">Products</button>
                    </a>
                </td>
                <td>
                    <a class="text-light" href="<?= URL . "/handlers/category/delete.php?id=" . $category['id']; ?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                    <a href="<?= URL . "/views/category/edit.php?id=" . $category['id']; ?>">
                        <button class="btn btn-info">Edit</button>
                    </a>
                </td>
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