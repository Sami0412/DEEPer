<?php

//set up database connection (as well as libraries)
use App\Hydrator\EntityHydrator;

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
        $checkInData = [
            'product_id' => $_POST['product_id'],
            'name' => strip_tags($_POST["userName"]),
            'rating' => filter_var($_POST["rating"], FILTER_VALIDATE_INT),
            'review' => strip_tags($_POST["review"]),
            'submitted' => date("Y-m-d H:i:s")
        ];

        $hydrator = new EntityHydrator();
        $checkIn = $hydrator->hydrateCheckIn($checkInData);

        $newCheckIn = $dbProvider->createCheckIn($checkIn);

        $logger->info('Review added to ' . $product->title);

        //return data to main.js, in this case a bootstrap success message
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo '<strong>Success!</strong> Your review has been saved.';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span></button></div>';

    } else {
        $logger->notice('Google ReCaptcha verification failed');
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo '<strong>Verification failed</strong> Please try again.';
        echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
        echo '<span aria-hidden="true">&times;</span></button></div>';
    }
    //Return to main.js
    die();
}

$productId = $_GET['productId'];
$product = $dbProvider->getProduct($productId);
