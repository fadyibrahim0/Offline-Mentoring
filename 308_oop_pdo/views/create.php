<?php include 'views/inc/header.php'; ?>



<h1>Add New Product</h1>

<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="<?php echo URL."store" ?>" method="post" class="p-3 border my-2 bg-primary">
                <div class="form-group">
                    <label for="name">Product Name</label>
                    <input type="text" name="name" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="price">Product Price</label>
                    <input type="text" name="price" id="price" class="form-control">
                </div>
                <div class="form-group">
                    <input type="submit" name="submit" value="save" class="form-control bg-success">
                </div>
            </form>
        </div>
    </div>
</div>



<?php include 'views/inc/footer.php'; ?>
