<?php
if (!empty($_POST['title']) && !empty($_POST['description'])) {
    $formData = [
        'title' => strip_tags($_POST['title']),
        'description' => strip_tags($_POST['description'])
    ];

    $formProduct = new \App\Entity\Product();
    $formProduct->title = $formData['title'];
    $formProduct->description = $formData['description'];

    //Create product

    header('Location: productpage.php?productId=' . $product->id);
}
//deal with empty submissiom
?>

<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php'?>
    <title>Add New Beer</title>
</head>
<body>
<div class="container">
    <?php include 'template_parts/navigation.php'; ?>
    <div class="card p-4">
        <h1>Add A Beer</h1>
        <form method="post">
            <div class="col-md-6 col-sm-12">
                <label for="title">Name of Beer</label>
                <input class="form-control" name="title" id="title" placeholder="title">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" placeholder="description" rows="10"></textarea>
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


</div>
<?php include 'template_parts/footer_includes.php'?>
</body>
</html>
