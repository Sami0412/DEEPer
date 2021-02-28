<?php

use App\Entity\Product;
use App\Entity\CheckIn;
//set up database connection (as well as libraries)
require_once 'setup.php';

//Only runs on form submission (i.e when $_POST contains data)
if (!empty($_POST)) {
    //Google ReCAPTCHA setup
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


$productId = $_GET['productId'];    //Will just insert this into URL for now

//Database connection set up in setup.php
$stmt = $dbh->prepare(
    'SELECT products.title, products.description, products.image_path, AVG(IFNULL(checkins.rating, 0)) AS avg_rating
    FROM products
    LEFT JOIN checkins ON checkins.product_id = products.id
    WHERE products.id = :id
    GROUP BY products.id'
);
//Insert product id from URL & execute query
$stmt->execute([
    'id' => $productId
]);
//Product class made available in setup.php by requiring the file product.php
$product = $stmt->fetchObject(Product::class);

//Display checkins against that product
$stmt = $dbh->prepare(
    'SELECT * FROM checkins WHERE product_id = :id'
);
$stmt->execute([
    'id' => $productId
]);
//Use fetchall to obtain an array of hydrated Entity (one for each row) and save array to variable
$checkIns = $stmt->fetchAll(PDO::FETCH_CLASS, CheckIn::class);
//Save array into the private checkins property of the product class using the addCheckin accessor function
//Can't just pass in the array, need to loop over
foreach ($checkIns as $checkIn) {
    $product->addCheckIn($checkIn);
}
