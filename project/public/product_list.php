<?php

require_once '../src/setup.php';
use App\Entity\Product;
use App\Hydrator\EntityHydrator;

$stmt = $dbh->prepare(
    'SELECT id, title, description, image_path FROM products'
);

$stmt->execute();
$productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$hydrator = new EntityHydrator();
$productsList = [];
foreach ($productsData as $individualItem) {
     $productInfo= $hydrator->hydrateProduct($individualItem);
     array_push($productsList, $productInfo);
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../src/beerlist.css">
    <title>Craft Beer Selection</title>
</head>
<body class="container">
<h1>Beer Selection</h1>
<div class="row my-4">
    <?php foreach ($productsList as $product): ?>
    <a class="col-4" href="productpage.php?productId=<?= $product->id; ?>">
        <div class="beer-pic">
            <img src="<?= '../' . $product->image_path; ?>">
            <div class="row">
                <h6><?= $product->title; ?></h6>
            </div>
        </div>
    </a>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</body>
</html>