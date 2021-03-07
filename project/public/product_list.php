<?php

use App\Hydrator\EntityHydrator;

require_once '../src/setup.php';

//Save search term to variable
$searchTerm = "";
if (isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
}

//Display all products OR searched products from database on page:
$stmt = $dbh->prepare(
    'SELECT id, title, description, image_path FROM products WHERE title LIKE :searchTerm'
);

//Works even when no search term entered - passes %% into stmt which searches for everything
$stmt->execute([
        'searchTerm' => '%' . $searchTerm . '%'
]);
$productsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

$hydrator = new EntityHydrator();
foreach ($productsData as $row) {
    $productsList[] = $hydrator->hydrateProduct($row);
}
?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php' ?>
    <link rel="stylesheet" href="../src/beerlist.css">
    <title>Craft Beer Selection</title>
</head>
<body class="container">
<img class="banner" src="../uploads/Beer_banner.jpeg">

<?php include 'template_parts/navigation.php'?>

<div class="intro">
    <p class="">Tired of the same old beers? Looking for something more exciting? Peruse our selection of craft ales from independent breweries and try something different!<br>
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
    <a class="col-lg-4 col-md-6 col-sm-6 col-12" href="productpage.php?productId=<?= $product->id; ?>">
        <div class="beer-pic">
            <img src="<?= '../' . $product->image_path; ?>">
            <div class="row">
                <h6 class="col-12"><?= $product->title; ?></h6>
            </div>
        </div>
    </a>
    <?php endforeach; endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js" integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js" integrity="sha512-bZS47S7sPOxkjU/4Bt0zrhEtWx0y0CRkhEp8IckzK+ltifIIE9EMIMTuT/mEzoIMewUINruDBIR/jJnbguonqQ==" crossorigin="anonymous"></script>
</body>
</html>