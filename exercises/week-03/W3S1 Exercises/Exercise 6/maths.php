<?php

$result = "";
//create class
class Calculation
{
    public $a;
    public $b;
    public $operation;
    public $timestamp;
}

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

//create class instance with form data (a,b,c,op)
    $calculation = new Calculation();
    $calculation->a = $a;
    $calculation->b = $b;
    $calculation->operation = $operation;
    $calculation->timestamp = time();

    $serialisedCalc = serialize($calculation);
    file_put_contents("$calculation->timestamp.txt", $serialisedCalc);


    exit();
}






//serialise instance and save into file with name of timestamp