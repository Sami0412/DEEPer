<?php

require_once 'setup.php';

//Only runs on form submission (i.e when $_POST contains data)
if (!empty($_POST)) {

    //Hydrate class instance with form values received from axios POST
    $name = $_POST["userName"];
    $rating = $_POST["rating"];
    $review = $_POST["review"];

    $stmt = $dbh->prepare(
        'INSERT INTO checkins (user_name, rating, review) VALUES (:user_name, :rating, :review)'
    );

    $stmt->execute([
        'user_name' => $name,
        'rating' => $rating,
        'review' => $review
    ]);

    echo '<div id="successMsg" class="alert alert-success alert-dismissible fade show col-11 mt-3 ml-5" role="alert">';
    echo '<strong>Success!</strong> Your review has been saved.';
    echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    echo '<span aria-hidden="true">&times;</span></button></div>';

    //Return to main.js
    die();
}
