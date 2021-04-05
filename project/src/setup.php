<?php

use App\DataProvider\CheckInDataProvider;
use App\DataProvider\ProductDataProvider;
use App\DataProvider\UserDataProvider;

require_once '../vendor/autoload.php';

//Set up dotenv: Loads variables from .env (environment) file, to keep credentials etc out of main file
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once __DIR__ . DIRECTORY_SEPARATOR . 'dependencies.php';

$logger = $container[\Monolog\Logger::class];

$productDbProvider = $container[ProductDataProvider::class];
$checkInDbProvider = $container[CheckInDataProvider::class];
$userDbProvider = $container[UserDataProvider::class];

//Create $_SESSION superglobal
//session is a cookie (temp storage) stored on server
session_start();

if (isset($_SESSION['LoginId'])) {
    $loggedInUser = $userDbProvider->getUser($_SESSION['LoginId']);
}

