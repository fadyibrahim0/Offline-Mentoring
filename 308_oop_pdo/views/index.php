<?php include 'views/inc/header.php'; ?>



<h1>Show All Products</h1>

<div class="container">
    <div class="row">
        <div class="col-12">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($data as $row): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['price']; ?></td>
                        <td>
                            <a href="<?php echo URL."edit/".$row['id']; ?>" class="btn btn-info">Edit</a>
                        </td>
                        <td>
                            <a href="<?php echo URL."delete/".$row['id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
          
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php include 'views/inc/footer.php'; ?>
