<?php

require_once 'db.php';

//Retrieve data from a form for example, and save to variables
$productId = 3;
$productTitle = 'Edited Product Title';

$stmt = $dbh->prepare(
    'UPDATE product set title = :title WHERE id = :id'
);

$stmt->execute([
    'id' => $productId,
    'title' => $productTitle
]);

echo "# Rows affected: " . $stmt->rowCount();
