<?php
class User {
    public $name;
}

$users = [
    [
        "name" => "Joe Bloggs",
        "age" => 20,
    ],
    [
        "name" => "Jane Doe",
        "age" => 25,
    ]
];

$userObjects = [];

foreach ($users as $user) {
    $instance = new User();
    $instance->name = $user["name"];
    $instance->age = $user["age"];

    $userObjects[] = $instance;
}

var_dump($userObjects);

//echo "Hello World!";
//
//$array = ["name1" => "Sami", "name2" => "John", "Cat"];
//var_dump($array);
//
//$array2 = ["Apple", "Carrot", "Banana"];
//var_dump($array2);
//
//print_r(array_merge($array, $array2));

//$message = "Hello world!";
?>
<!---->
<!--<!DOCTYPE html>-->
<!--<html>-->
<!--<head>-->
<!--    <title>PHP Example</title>-->
<!--</head>-->
<!--<body>-->
<!--<p>-->
<!--    --><?//= $message; ?>
<!--</p>-->
<!--</body>-->
<!--</html>-->

