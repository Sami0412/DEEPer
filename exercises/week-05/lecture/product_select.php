<?php

require_once 'db.php';

$productId = 3; //Imagine this comes from form

$stmt = $dbh->prepare(
    'SELECT id, title from product WHERE id = :productId'
);
$stmt->execute([
    'productId' => $productId
]);

$product = $stmt->fetch(PDO::FETCH_ASSOC);

var_dump($product);

