<?php

//Makes all libraries available
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
        \Monolog\Logger::WARNING
    )
);

//set up db connection
try {
    $dbh = new PDO(
        "mysql:dbname=myproject;host=mysql",
        $_ENV['DBUSERNAME'],
        $_ENV['DBPASSWD']
    );

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Database connection failed");
}



