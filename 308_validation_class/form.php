<?php require_once "Validation.php"; ?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {

    $validationRules = [
        'name'      => ["required", "string", "max:50", "min:4"],
        'email'     => ["required", "email"],
        'password'  => ["required", "string",],
        'phone'     => ["required", "number",],
        'type'      => ["required", "in:'user', 'admin', 'super_admin'",],
    ];
    $validationObj = new Validation($validationRules);
    $validationObj->validate();
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Test Form</title>

        <!-- CSS only -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>

        <div class="container">
            <h1 class="text-center my-5">Test Form</h1>
            <div class="row">

                <!-- Display Something -->
                <?php
                if(isset($validationObj)) {
                    if($validationObj->check()) {
                        echo "<div class='alert alert-success'>There're no errors</div>";
                    } else {
                        echo "<div class='alert alert-danger'>";
                        foreach($validationObj->getErrors() as $error) {
                        echo "
                            <ul>
                                <li>$error</li>
                            </ul>";
                        }
                        echo "</div>";
                    }
                }
                ?>

                <form method="POST" class="col-md-6 my-5 m-auto">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" name="email" class="form-control" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone">
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" id="type">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>

        <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
</html>