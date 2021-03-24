<?php

//set up database connection (as well as libraries)
use App\Hydrator\EntityHydrator;

require_once 'setup.php';

//Google ReCAPTCHA setup - Disable for testing
$secretKey = $_ENV['secretKey'];
$responseKey = $_POST['g-recaptcha-response'];
$url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey";
$response = file_get_contents($url);
$response = json_decode($response);
if ($response->success) {
    //save data from POST to variables
    $checkInData = [
        'product_id' => filter_var($_POST['product_id'], FILTER_VALIDATE_INT),
        'name' => strip_tags($_POST['userName']),
        'rating' => filter_var($_POST['rating'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 1, 'max_range' => 5]]),
        'review' => strip_tags($_POST['review'])
    ];

    if (empty($checkInData['product_id'])) {
        header('Location: product-list.php');
        exit;
    }

    if (empty($checkInData['name']) || empty($checkInData['rating']) || empty($checkInData['review'])) {
        header('Location: productpage.php?productId=' . $checkInData['product_id'] . '&message=error');
    }

    $hydrator = $container[\App\Hydrator\CheckInHydrator::class];
    $checkIn = $hydrator->hydrateCheckIn($checkInData);

    $newCheckIn = $dbProvider->createCheckIn($checkIn);
    $productName = $dbProvider->getProductById($newCheckIn->product_id);

    $logger->info('Review added to ' . $productName);

    header('Location: ../public/productpage.php?productId='. $_POST['product_id'] . '&message=success');
} else {

    header('Location: ../public/productpage.php?productId='. $_POST['product_id'] . '&message=error');
}
