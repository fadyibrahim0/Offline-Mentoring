<?php 
require_once "../../core/config.php";
require_once PATH . "views/inc/header.php";
require_once PATH . "core/db.php";
require_once PATH . "core/functions.php";
require_once PATH . "core/sessions.php";

if(existSession('logged') && getSession('logged')['type'] != 'user') {

?>

<?php
// Get All Categories From The Database
$sql = "SELECT * FROM `user` ORDER BY `id` DESC";
$result = mysqli_query($conn, $sql);
$users = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Free The Result, Then Close The Connection
free_close($result, $conn);
?>

<div class="container">
    <h1 class="my-2 text-center">All Users</h1>

    <!-- Displaying Messages -->
    <?php require_once PATH . "views/inc/messages.php" ?>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Image</th>
                <th scope="col">Type</th>
                <?php if(getSession('logged')['type'] == 'super_admin'): ?>
                <th scope="col">Actions</th>
                <?php endif; ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach($users as $user) {
            ?>
            <tr>
                <th scope="row"><?= $i++ ?></th>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>
                    <img style="width: 90px;height: 90px; border-radius:50%;" 
                        src="<?php echo URL . "uploads/images/user/" . ((empty($user['image'])) ? "default.png" : $user['image']); ?>" 
                        alt="Image" >
                </td>
                <td><?= $user['type'] ?></td>
                <?php if(getSession('logged')['type'] == 'super_admin'): ?>
                <td>
                    <a class="text-light" href="<?= URL . "/handlers/user/delete.php?id=" . $user['id']; ?>">
                        <button class="btn btn-danger">Delete</button>
                    </a>
                    <a href="<?= URL . "/views/user/edit.php?id=" . $user['id']; ?>">
                        <button class="btn btn-info">Change Type</button>
                    </a>
                </td>
                <?php endif; ?>
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