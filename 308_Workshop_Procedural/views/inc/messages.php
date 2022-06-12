<?php include_once '../../core/sessions.php'; ?>

<?php
if(existSession('errors')) {
?>
<div class="alert alert-danger">
    <ul>
    <?php
    foreach(flashSession('errors') as $error) {
        echo "<li>".$error."</li>";
    }
    ?>
    </ul>
</div>
<?php
} elseif(existSession('success')) {
    echo "<div class='alert alert-success'>".flashSession('success')."</div>";
}
?>