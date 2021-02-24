<?php

require_once 'setup.php';

$stmt = $dbh->prepare('SELECT id, title FROM product');

$stmt->execute();

$products = $stmt->fetchAll(PDO::FETCH_CLASS, Product::class);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Product Lsit</title>
</head>
<body>
<div class="container">
    <h1>Products</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Title</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><a href="product.php?productId=<?= $product->id ?>"><?= $product->id ?></a></td>
                <td><?= $product->title ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>

