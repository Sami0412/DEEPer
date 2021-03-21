<?php

use App\Hydrator\EntityHydrator;

require_once '../src/setup.php';

//Save search term to variable
$searchTerm = "";
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
}

//Display all products OR searched products from database on page:
$productsData = $dbProvider->getProducts($searchTerm);

$hydrator = new EntityHydrator();
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

<div class="row my-4">
    <?php if (empty($productsData)): ?>
        <h6>No products found</h6>
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
</html>