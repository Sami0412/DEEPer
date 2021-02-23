<?php

//set up database connection (as well as libraries)
require_once 'setup.php';

//Only runs on form submission (i.e when $_POST contains data)
if (!empty($_POST)) {

    $secretKey = $_ENV['secretKey'];
    $responseKey = $_POST['responseKey'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
    $response = file_get_contents($url);
    $response = json_decode($response);
    if ($response->success) {
        //save data from POST to variables
        $name = $_POST["userName"];
        $rating = $_POST["rating"];
        $review = $_POST["review"];

        //Prepare SQL statement with placeholders
        $stmt = $dbh->prepare(
            'INSERT INTO checkins (user_name, rating, review) VALUES (:user_name, :rating, :review)'
        );

        //Execute SQL query with placeholder values inserted
        $stmt->execute([
            'user_name' => $name,
            'rating' => $rating,
            'review' => $review
        ]);

        //return data to main.js, in this case a bootstrap success message
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong>Success!</strong> Your review has been saved.';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span></button></div>';

    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<strong>Verification failed</strong> Please try again.';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span></button></div>';
    }
    //Return to main.js
    die();
}

class CheckIn
{
    public string $user_name;
    public int $rating;
    public string $review;
    public string $submitted;
}

//create array of existing checkin classes
$stmt = $dbh->prepare(
    'SELECT user_name, rating, review, submitted FROM checkins'
);

$stmt->execute();

$checkIns = $stmt->fetchAll(PDO::FETCH_CLASS, CheckIn::class);
//Reverse array so newest checkin appears first
$checkIns = array_reverse($checkIns);

//iterate over array to produce a display div for each checkin
foreach ($checkIns as $checkIn) {
    echo "<div class='container border p-4 mb-4'>";
    echo "<div class='row'>";
    echo "<p class='col-2'><b>$checkIn->user_name</b></p><p class='col-10'><b>$checkIn->rating / 5</b></p>";
    echo "</div>";
    echo "<p>$checkIn->review</p>";
    echo "<p>$checkIn->submitted</p>";
    echo "</div>";
}