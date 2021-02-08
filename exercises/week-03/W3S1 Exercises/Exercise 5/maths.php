<?php

$result = "";

if (!empty($_POST)) {

    $a = $_POST["a"];
    $b = $_POST["b"];
    $operation = $_POST["operation"];
    $result = 0;
    if ($operation == "Add") {
        $result = $a + $b;
    } elseif ($operation == "Subtract") {
        $result = $a - $b;
    } elseif ($operation == "Multiply") {
        $result = $a * $b;
    } elseif ($operation == "Divide") {
        $result = $a / $b;
    } else {
        $result = "Please select a valid operator";
    }
    echo $result;
}


