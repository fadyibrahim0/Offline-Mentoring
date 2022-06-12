<?php require_once "views/inc/header.php"; ?>

<?php 

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if(isset($_SESSION['logged'])) {
    header("Location: index.php");
    exit;
}
?>

<div class="container">

    <div class="row">
        <h1 class="text-center my-5">Login Page</h1>

        <!-- Display Messages -->
        <?php
        if(isset($_SESSION['errors'])) {
        ?>
        <div class="alert alert-danger col-md-8 m-auto">
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
            echo "<div class='alert alert-success col-md-8 m-auto'>".$_SESSION['success']."</div>";
        }
        unset($_SESSION['success']);
        ?>

        <form class="col-md-8 my-3 m-auto" method="POST" action="handlers/login.php">
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