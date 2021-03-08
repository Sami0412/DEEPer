<?php

require_once '../src/setup.php';

if (!empty($_POST['title']) && !empty($_POST['description'])) {
    $formData = [
        'title' => strip_tags($_POST['title']),
        'description' => strip_tags($_POST['description'])
    ];

    $formProduct = new \App\Entity\Product();
    $formProduct->title = $formData['title'];
    $formProduct->description = $formData['description'];

    //Create product
    $product = $dbProvider->createProduct($formProduct);
    //$logger->info("Product created: " . $product->title);
    //Send user to newly created product page
    header('Location: productpage.php?productId=' . $product->id);
    exit;
}
//deal with empty submissiom
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php'?>
    <link rel="stylesheet" href="../src/beerlist.css">
    <title>Add New Beer</title>
</head>
<body>
<div class="container">
    <img class="banner" src="../uploads/Beer_banner.jpeg">
    <?php include 'template_parts/navigation.php'; ?>
    <h1>Add A Beer</h1>
    <div class="card p-4">
        <form method="post">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="title">Name of Beer</label>
                        <input class="form-control" name="title" id="title">
                    </div>
                    <div class="form-group">
                        <label for="beerStyle">Style of Beer</label>
                        <input class="form-control" name="beerStyle" id="beerStyle" placeholder="E.g. Stout, IPA etc">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="abv">Strength (% ABV)</label>
                        <input class="form-control" name="abv" id="abv" type="number">
                    </div>
                    <div class="form-group">
                        <label for="brewery">Brewery</label>
                        <input class="form-control" name="brewery" id="brewery">
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea class="form-control" name="description" id="description" placeholder="description" rows="10"></textarea>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


</div>
<?php include 'template_parts/footer_includes.php'?>
</body>
</html>
