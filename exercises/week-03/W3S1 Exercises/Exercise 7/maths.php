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

//Following block only runs if values have been submitted in form
//Values are taken from input fields by JS, packed into FormData object, and POSTED to PHP file
if (!empty($_POST)) {
    //Create PHP variables containing values from axios POST
    $a = $_POST["a"];
    $b = $_POST["b"];
    $operation = $_POST["op"];

    //Hydrate instance of class with values from axios POST
    $calculation = new Calculation();
    $calculation->a = $a;
    $calculation->b = $b;
    $calculation->operation = $operation;
    $calculation->timestamp = date("d-m-Y H:i");

    //Serialise and store instance object into txt file
    $serialisedCalc = serialize($calculation);
    file_put_contents(time() . ".txt", $serialisedCalc);

    //Calculate value of result
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

    //Echo value to be sent back to JS
    echo $result;
    //Return to main.js
    die();
}
?>

<!--The following is fetched back with 1st GET req in main.js-->

<!--Render head of table-->
<table class="table table-striped">
    <thead>
        <tr>
            <th scope="col">Timestamp</th>
            <th scope="col">First Value</th>
            <th scope="col">Operator</th>
            <th scope="col">Second Value</th>
        </tr>
    </thead>
    <tbody>

<?php

//Unpack previous calculations from text file
// NOTE: global .txt files will not be saved into an array if you assign to variable
//Loop through glob(*.txt) directly
foreach (glob("*.txt") as $previousCalc) {

    //unpack $ unserialise data in each file
    $fileContents = file_get_contents($previousCalc);
    $unserialisedCalc = unserialize($fileContents);

    //Render table row with object variables
    echo "<tr>";
    echo "<th scope='row'>$unserialisedCalc->timestamp</th>";
    echo "<td>$unserialisedCalc->a</td>";
    echo "<td>$unserialisedCalc->operation</td>";
    echo "<td>$unserialisedCalc->b</td>";
    echo "</tr>";
//Back to main.js
}
