<?php
    $filePath = 'data.json';

    if(file_exists($filePath)) {

        $students = json_decode(file_get_contents($filePath), true);

    } else {
        $students = [];
        file_put_contents($filePath, json_encode($students));
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        h1 {
            text-align: center;
        }
        .container {
            padding: 20px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        table {
            width: 800px;
            text-align: center;
            margin: auto;
            font-size: 40px;
        }

        th, td {
            padding: 5px;
        }
    </style>
</head>
<body>
    <h1>All Students Table</h1>

    <div class="container">
        <a href="pages/add.php">
            <button>Add New Student</button>
        </a>
        
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach($students as $id => $student) {
                ?>
                <tr>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $student['name'] ?></td>
                    <td><?php echo $student['age'] ?></td>
                    <td>
                        <a href="pages/edit.php?<?= $id ?>">Edit</a>
                        <a href="logic/destroy.php?<?= $id ?>">Delete</a>
                    </td>
                </tr>
                <?php
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>
<?php

// $filePath = 'data.json';

// $arr = [
//     ['name' => 'ahmed', 'age' => 20],
//     ['name' => 'omar', 'age' => 15],
// ];

// file_put_contents($filePath, json_encode($arr));



function dd($data) {
    echo "<pre>";
        print_r($data);
    echo "</pre>";
    die;
}