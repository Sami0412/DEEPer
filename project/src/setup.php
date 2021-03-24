<?php

use App\DataProvider\DatabaseProvider;

require_once '../vendor/autoload.php';

//Set up dotenv: Loads variables from .env (environment) file, to keep credentials etc out of main file
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Set up Logger: Log things to a file and put meaningful info in separate file rather than vardumping to screen
$logger = new \Monolog\Logger('application');
//$logger->pushHandler(
//    new \Monolog\Handler\StreamHandler(
//        'application.log',
//        \Monolog\Logger::DEBUG
//    )
//);

$logger->pushHandler(
    new \Monolog\Handler\RotatingFileHandler(       //Rotates i.e. produces new log file each day with new timestamp
        dirname(__DIR__) . DIRECTORY_SEPARATOR . 'logs' . DIRECTORY_SEPARATOR . 'application.log',      //same as ../logs/application.log but safer as / & \ differ between Windows & Mac!
        5,
        \Monolog\Logger::WARNING
    )
);

$whoops = new \Whoops\Run();

//Check which environment we are in:
if (isset($_ENV['APP_ENV'])) {
    $logger->pushProcessor(function ($record) {
        $record['message'] = $_ENV['APP_ENV'] . ': ' . $record['message'];      //Prepending log message with 'Development: ' to show what environment log happened in
        return $record;
    });
    //Only in development environment not in production:
    if ($_ENV['APP_ENV'] === 'development') {
        $logger->pushHandler(
            new \Monolog\Handler\ChromePHPHandler()     //Allows Chrome extension ChromePHP to display logs in console
        );

        $prettyPageHandler = new \Whoops\Handler\PrettyPageHandler();    //Shows Whoops output
        $prettyPageHandler->setEditor('phpstorm');      //Allows clickable links from Whoops error page back into PhpStorm

        $whoops->prependHandler(
            $prettyPageHandler
        );
    }
}

//Create a log of error that includes the code, file etc
$whoops->prependHandler(
    function ($exception, $inspector, $run) use ($logger) {
        /** @var $exception \Exception */
        $logger->log(
            \Psr\Log\LogLevel::ERROR,
            $exception->getMessage(),
            [
                'code' => $exception->getCode(),
                'file' => $exception->getFile(),
                'line' => $exception->getLine(),
                'trace' => $exception->getTraceAsString(),
            ]
        );
    }
);
$whoops->register();

$dbProvider = new DatabaseProvider();

//Create $_SESSION superglobal
//session is a cookie (temp storage) stored on server
session_start();

if (isset($_SESSION['LoginId'])) {
    $loggedInUser = $dbProvider->getUser($_SESSION['LoginId']);
}

