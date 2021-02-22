<?php

$username = 'root';
$password = 'root';             //These should really come from .env file

try {
    $dbh = new PDO(
        'mysql:dbname=lecture;host=mysql',
        $username,
        $password
    );

    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die('Unable to establish database connection');
}