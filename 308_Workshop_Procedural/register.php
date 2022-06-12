<?php 
require_once "views/inc/header.php"; 
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>


<div class="container">
    <div class="row">

        <h1 class="text-center my-5">Register Page</h1>

        <!-- Display Messages -->
        <?php
        if(isset($_SESSION['errors'])) {
        ?>
        <div class="alert alert-danger">
            <ul>
            <?php
            foreach($_SESSION['errors'] as $error) {
                echo "<li>".$error."</li>";
            }
            unset($_SESSION['errors']);
            ?>
            </ul>
        </div>
        <?php
        } elseif(isset($_SESSION['success'])) {
            echo "<div class='alert alert-success'>".$_SESSION['success']."</div>";
        }
        unset($_SESSION['success']);
        ?>

        <form class="col-md-8 m-auto" method="POST" action="handlers/register.php" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="name" class="form-label">Username</label>
                <input type="name" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" name="image" class="form-control" id="image">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="password">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<?php require_once "views/inc/footer.php"; ?>