<?php

require_once 'db.php';      //gives us dbh connection handle

$newProductTitle = 'New Product';

$stmt = $dbh->prepare(
    'INSERT INTO product (title) VALUES (:title)'
);

$stmt->execute([
    'title' => $newProductTitle
]);

echo '# rows affected: ' . $stmt->rowCount();