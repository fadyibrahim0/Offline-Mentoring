<?php

// new student data
$name = "ali";
$age = 22;

// handle adding new element to the array
$lastKey = array_key_last($students);
$nextKey = ++$lastKey;
$students[$nextKey]['name'] = $name;
$students[$nextKey]['age']  = $age;

// Finally store the data to the file
file_put_contents($filePath, json_encode($students));