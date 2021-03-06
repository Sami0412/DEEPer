<?php

$result = "";

if (!empty($_GET)) {
    $a = $_GET["a"];
    $b = $_GET["b"];
    $operation = $_GET["operation"];
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


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="calc.css">
    <title>Document</title>
</head>
<body>
<div class="container">
    <div class="jumbotron">
        <h1 class="display-4 text-center">Calculator</h1>
        <form action="" method="get" id="myForm" >
            <div class="row text-center justify-content-around">
                <div class="form-group">
                    <label for="a">Enter value for a:</label>
                    <input type="number" name="a" id="a" class="form-control mt-2">
                </div>
                <div class="form-group">
                    <label for="b">Enter value for b:</label>
                    <input type="number" name="b" id="b" class="form-control">
                </div>
            </div>
            <div class="row text-center">
                <div class="form-group col-3 mx-auto">
                    <label for="operation" class="text-center">Operation:</label>
                    <select name="operation" id="operation" class="form-control">
                        <option name="add">Add</option>
                        <option name="subtract">Subtract</option>
                        <option name="multiply">Multiply</option>
                        <option name="divide">Divide</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <button type="submit" class="btn btn-info mx-auto mt-2 col-2">Calculate</button>
            </div>
            <div class="row text-center">
                <div class="form-group col-3 mx-auto mt-4">
                    <label for="result">Result:</label>
                    <input type="text" name="result" id="result" class="form-control" value="<?php echo $result; ?>" readonly>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</body>
</html>