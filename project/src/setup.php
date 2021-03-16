<?php

use App\DataProvider\DatabaseProvider;

require_once '../vendor/autoload.php';

//Set up Whoops: displays errors
$whoops = new \Whoops\Run();
$whoops->pushHandler(
    new \Whoops\Handler\PrettyPageHandler()
);
$whoops->register();

//Set up dotenv: Loads variables from .env (environment) file, to keep credentials etc out of main file
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Set up Logger: Log things to a file and put meaningful info in separate file rather than vardumping to screen
$logger = new \Monolog\Logger('application');
$logger->pushHandler(
    new \Monolog\Handler\StreamHandler(
        'application.log',
        \Monolog\Logger::DEBUG
    )
);

$dbProvider = new DatabaseProvider();

//Create $_SESSION superglobal
//session is a cookie (temp storage) stored on server
session_start();

if (isset($_SESSION['LoginId'])) {
    $loggedInUser = $dbProvider->getUser($_SESSION['LoginId']);
}

