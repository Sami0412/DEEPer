<?php

class Product {
    public $title;
}

if (!empty($_POST)) {
    $product = new Product;
    $product->title = $_POST["title"]; // hydrate product object with form submission

    $serialisedProduct = serialize($product);   //serialise object
    file_put_contents("my-product.txt", $serialisedProduct); //store serialised object in file

    $message = "Product created<br>";     //could use bootstrap alert

    $productFromFile = file_get_contents("my-product.txt"); //retrieve object from file
    //var_dump($productFromFile);       //print contents of retrieved object (still serialised)
    $unserialisedProduct = unserialize($productFromFile);

    $message .= $unserialisedProduct->title;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Create Product</title>
</head>
<body>
<h2>New Product</h2>
<?php if (isset($message)) : ?>
New Product: <?= $message ?>
<?php endif; ?>
<form action="" method="post">
    <div>
        <label for="title">Title:</label>
        <input type="text" name="title" id="title">
    </div>

    <button type="submit">Create Product</button>
</form>
</body>
</html>
