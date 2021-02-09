<?php

$result = "";

if (!empty($_POST)) {

    $a = $_POST["a"];
    $b = $_POST["b"];
    $operation = $_POST["op"];
    $result = 0;
    if ($operation === "add") {
        $result = $a + $b;
    } elseif ($operation === "subtract") {
        $result = $a - $b;
    } elseif ($operation === "multiply") {
        $result = $a * $b;
    } elseif ($operation === "divide") {
        $result = $a / $b;
    } else {
        $result = "Please select a valid operator";
    }
    echo $result;

    exit();
}


