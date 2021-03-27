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

<h1>Beer Not Found!</h1>
<div class="noproducts">
    <h3>Can't find the beer you're looking for?</h3>
    <p>Submit your own beer here: <a href="add_product.php">Add Beer</a></p>
    <hr>
    <a href="product_list.php">Back to beer list</a>
</div>


<?php include 'template_parts/footer_includes.php'?>
</body>