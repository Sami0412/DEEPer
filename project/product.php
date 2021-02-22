
<?php

require_once 'setup.php';

$productId = $_GET['productId'];      //get from URL (will come from form)

$stmt = $dbh->prepare(
    'SELECT product.id, product.title, AVG(checkin.rating) AS average_rating
    FROM product
    LEFT JOIN checkin ON checkin.product_id = product.id
    WHERE product.id = :id
    GROUP BY product.id'
);

$stmt->execute([
    'id' => $productId
]);

$product = $stmt->fetchObject(Product::class);

$stmt = $dbh->prepare('SELECT * FROM checkin WHERE product_id = :productId');
$stmt->execute([
    'productId' => $product->id
]);

$checkins = $stmt->fetchAll(PDO::FETCH_CLASS, CheckIn::class);

$product->checkins = $checkins;
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>PRODUCT DETAIL</title>
</head>
<body>
<div class="container">
    <h1><?= $product->title ?></h1>
    <h2>Average Rating: <?= $product->average_rating ?></h2>
    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Rating</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($product->checkins as $checkin): ?>
            <tr>
                <td><?= $checkin->id ?></td>
                <td><?= $checkin->name ?></td>
                <td><?= $checkin->rating ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
