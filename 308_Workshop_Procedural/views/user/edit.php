<?php

require_once '../../core/config.php';
require_once PATH . 'views/inc/header.php';
require_once PATH . 'core/db.php';
require_once PATH . 'core/sessions.php';
require_once PATH . 'core/functions.php';

if(existSession('logged') && getSession('logged')['type'] == 'super_admin') {

    if(isset($_GET['id'])) {
        $id         = $_GET['id'];
        $sql        = "SELECT * FROM `user` WHERE `id`='$id'";
        $result     = mysqli_query($conn, $sql);
        $user   = mysqli_fetch_assoc($result);
    }

?>

    <div class="container">
        
        <h1 class="text-center my-5">Edit User - <?= $user['name'] ?></h1>

        <div class="mb-5">
            <a href="<?= URL . "views/user/all.php" ?>">
                <button class="btn btn-primary">All Users</button>
            </a>
        </div>

        <!-- Displaying Error or Success Messages -->
        <?php require_once PATH . "views/inc/messages.php"; ?>

        <!-- Start Categories Form -->
        <form method="POST" action=<?= URL . "handlers/user/update.php" ?>>
            <input type="hidden" name="id" value="<?= $user['id'] ?>">
            <div class="mb-3">
                <label for="name" class="form-label">User Name</label>
                <input type="text" name="name" class="form-control" id="name" value="<?= $user['name']?>" readonly>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">User Email</label>
                <input type="text" name="email" class="form-control" id="email" value="<?= $user['email']?>" readonly>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">User Type</label>
                <select name="type" id="type" class="form-control">
                    <option <?= ($user['type'] == "super_admin") ? "selected" : "" ?> value="super_admin">Super Admin</option>
                    <option <?= ($user['type'] == "admin") ? "selected" : "" ?> value="admin">Admin</option>
                    <option <?= ($user['type'] == "user") ? "selected" : "" ?> value="user">User</option>
                </select>
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