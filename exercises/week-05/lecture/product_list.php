<?php

require_once 'db.php';

$stmt = $dbh->prepare(
    'SELECT id, title FROM product WHERE id > 2'
);

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

var_dump($products);