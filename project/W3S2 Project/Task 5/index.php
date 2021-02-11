<?php

//Create class object
class CheckIn {
    public $name;
    public $rating;
    public $review;
    public $timestamp;
}

//Only runs on form submission (i.e when $_POST contains data)
if (!empty($_POST)) {

    //Create instance of CheckIn class
    $checkInInstance = new CheckIn();

    //Hydrate class instance with form values received from axios POST
    $checkInInstance->name = $_POST["userName"];        //key names come from name attributes on form input fields
    $checkInInstance->rating = $_POST["rating"];
    $checkInInstance->review = $_POST["review"];
    $checkInInstance->timestamp = date("d-m-Y H:i");

    //If there are previous reviews, we want to add to the same file
    if (file_exists("checkins.txt")) {

        //Remove and unserialise array of existing checkin objects from file
        $checkInsFile = file_get_contents("checkins.txt");
        $unserialisedCheckIns = unserialize($checkInsFile);

        //Push new data into array
        array_push($unserialisedCheckIns, $checkInInstance);

        //Reserialise and save back to file
        $serialisedArray = serialize($unserialisedCheckIns);
        file_put_contents("checkins.txt", $serialisedArray);

        //If file doesn't exist yet (First review)
    } else {
        //Create array to put checkin objects into
        $checkInsArray = [];
        //add checkin data to array
        array_push($checkInsArray, $checkInInstance);
        //serialise array
        $serialisedArray = serialize($checkInsArray);
        //place serialised array into file (Creates the new file)
        file_put_contents("checkins.txt", $serialisedArray);
    }

    //Return to main.js
    die();
}

//1st GET request returns the following
if (file_exists('checkins.txt')) {
    //Unpack and unserialise checkins.txt to produce array of checkin objects
    $checkInsList = file_get_contents("checkins.txt");
    $unserialisedCheckInsList = array_reverse(unserialize($checkInsList)); //reverse to display newest first

//Loop through array of objects and produce HTML for each one
    foreach ($unserialisedCheckInsList as $previousCheckin) {
        echo "<div class='container border p-4 mb-4'>";
        echo "<div class='row'>";
        echo "<p class='col-2'><b>$previousCheckin->name</b></p><p class='col-10'><b>$previousCheckin->rating / 5</b></pclass>";
        echo "</div>";
        echo "<p>$previousCheckin->review</p>";
        echo "<p>$previousCheckin->timestamp</p>";
        echo "</div>";
    }
}

//Return to main.js