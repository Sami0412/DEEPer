<?php

require_once 'setup.php';

/** @var \Monolog\Logger $logger */
$logger->warning('Warning messages may not need immediate attention');

$logger->alert('This is an alert - something more critical has happened');