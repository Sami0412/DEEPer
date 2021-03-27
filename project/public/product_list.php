<?php

use App\Hydrator\ProductHydrator;

require_once '../src/setup.php';

//Save search term to variable
$searchTerm = "";
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
}

//Display all products OR searched products from database on page:
$productsData = $productDbProvider->getProducts($searchTerm);

$hydrator = $container[ProductHydrator::class];
foreach ($productsData as $row) {
    $productsList[] = $hydrator->hydrateProduct($row);
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php' ?>
    <link rel="stylesheet" href="beerlist.css">
    <title>Craft Beer Selection</title>
</head>
<body class="container">
<img class="banner" src="../uploads/Beer_banner.jpeg">

<?php include 'template_parts/navigation.php'?>

<div class="intro">
    <p>Tired of the same old beers? Looking for something more exciting? Peruse our selection of craft ales from independent breweries and try something different!<br>
    Tried a new beer recently that you think deserves some attention? Search for it on our website and leave a review!<br>
    If your beer is not listed, you can add it to the site using the menu above!</p>
    <p class="tagline"> Say NO to boring lagers! It's time to <b>RAISE THE BEER</b>!</p>
    </div>
<h1>Beer Selection</h1>
<form method="post">
    <div class="form-group">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search" class="form-control" value="<?= $searchTerm ?>">
        <small class="form-text text-muted">Search for beer style, brewery, name etc</small>
    </div>
    <button type="submit" class="btn btn-primary">Search</button>
</form>

<?php
if (isset($productsList)) {
    echo count($productsList) . ' result' . (count($productsList) === 1 ? '' : 's') . ' found.';
}
?>

<div class="row my-4">
    <?php if (empty($productsData)): ?>
        <div class="noproducts col-12">
            <h3 class="ml-3">No products found</h3>
            <p>Can't find the beer you're looking for?</p>
            <p>Submit your own beer here: <a href="add_product.php">Add Beer</a></p>
            <hr>
            <a href="product_list.php">Back to beer list</a>
        </div>
    <?php else: foreach ($productsList as $product): ?>
    <a id="item" class="col-lg-4 col-md-6 col-sm-6 col-12" href="productpage.php?productId=<?= $product->id; ?>">
        <div class="beer-pic">
            <img src="<?= $product->image_path; ?>">
            <div class="row">
                <h6 class="col-12"><?= $product->title; ?></h6>
            </div>
        </div>
    </a>
    <?php endforeach; endif; ?>
</div>
<?php include 'template_parts/footer_includes.php'?>
</body>