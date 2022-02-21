<?php

include_once '../inc/header.php'; 
include_once '../inc/connect.php';
include_once '../inc/session.php';

$sql    = "SELECT * FROM `categories`";
$result = mysqli_query($conn, $sql);
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

    <div class="container">
        <h1 class="text-center mt-5">All Categories</h1>
        <a href="add.php">
            <button class="btn btn-primary my-5">Add Category</button>
        </a>

        <!-- Displaying Error or Success Messages -->
        <?php include_once "../inc/messages.php"; ?>

        <!-- Start Categories Table -->
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $i = 1;
                foreach($categories as $category){
                ?>
                <tr>
                    <th><?= $i++; ?></th>
                    <td><?= $category['name'] ?></td>
                    <td><?= $category['description'] ?></td>
                    <td>
                        <a class="mx-2 text-light" href="edit.php?id=<?=$category['id'];?>">
                            <button class="btn btn-info">Edit</button>
                        </a>
                        <a href="../handlers/categories/delete.php?id=<?=$category['id'];?>">
                            <button class="btn btn-danger">Delete</button>
                        </a>
                    </td>
                </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- End Categories Table -->

<?php include_once '../inc/footer.php'; ?>