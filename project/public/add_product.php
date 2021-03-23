<?php

use App\Hydrator\EntityHydrator;

require_once '../src/setup.php';

//On submission:
if (!empty($_POST)) {
    //Save data to array to pass to hydrator
    $formData = [
        'title' => strip_tags($_POST['title']),
        'description' => strip_tags($_POST['description']),
        'abv' => filter_var($_POST['abv'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION),
        'beer_style' => strip_tags($_POST['beerStyle']),
        'brewery' => strip_tags($_POST['brewery'])
    ];

    //Use hydrator to create new product instance, using POST data array
    $hydrator = new EntityHydrator();
    $newProduct = $hydrator->hydrateProduct($formData);

    //Save uploaded file to required file path
    if (!empty($_FILES)) {
        $image = $_FILES['image'];      //$_FILES['image'] contains array of name, type, tmp_name, error and size

        //Deal with upload error
        if ($image['error'] !== UPLOAD_ERR_OK) {
            $responseMsg = '<div class="alert alert-warning" role="alert">An error has occurred, please try again</div>';
        } else {
            //Create image path
            $targetPath = '../uploads/' . $image['name'];
            //Replace temporary file path with newly created path
            if (!move_uploaded_file(
                $image['tmp_name'],
                $targetPath
            )) {
                //Error handling
                throw new RuntimeException('Failed to move file');
            }
            //Assign new imagep path to new product instance
            $newProduct->image_path = $targetPath;
        }

        //Create product by passing new product instance to dbprovider function
        $product = $dbProvider->createProduct($newProduct);
        $logger->info("Product created: " . $product->title);
        //Send user to newly created product page
        header('Location: productpage.php?productId=' . $product->id);
        exit;
    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <?php include 'template_parts/header_includes.php'?>
    <link rel="stylesheet" href="beerlist.css">
    <title>Add New Beer</title>
</head>
<body>
<div class="container">
    <img class="banner" src="../uploads/Beer_banner.jpeg">
    <?php include 'template_parts/navigation.php'; ?>
    <h1>Add A Beer</h1>
    <div class="card p-4">
        <form method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="title">Name of Beer</label>
                        <input class="form-control" name="title" id="title" required>
                    </div>
                    <div class="form-group">
                        <label for="beerStyle">Style of Beer</label>
                        <input class="form-control" name="beerStyle" id="beerStyle" placeholder="E.g. Stout, IPA etc" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="abv">Strength (% ABV)</label>
                        <input class="form-control" name="abv" id="abv" type="number" step="0.1" required>
                    </div>
                    <div class="form-group">
                        <label for="brewery">Brewery</label>
                        <input class="form-control" name="brewery" id="brewery" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" name="description" id="description" placeholder="description" rows="10" required></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="image">Upload image:</label>
                        <input class="form-control-file" type="file" name="image" id="image" required>
                    </div>
                </div>
            </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            <?php if (isset($responseMsg)){
                echo $responseMsg;
            }?>
            </div>
        </form>
    </div>


</div>
<?php include 'template_parts/footer_includes.php'?>
</body>
</html>
