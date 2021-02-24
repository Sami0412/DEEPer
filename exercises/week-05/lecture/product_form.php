<?php

require_once 'db.php';

$productAddedSuccess = false;

if (!empty($_POST)) {
    $newProductTitle = $_POST['title'];
    //stops empty row being submitted
    if (!empty($newProductTitle)) {
        $stmt = $dbh->prepare(
            'INSERT INTO product (title) VALUES (:title)'
        );

        $stmt->execute([
            'title' => $newProductTitle
        ]);

        if ($stmt->rowCount() > 0) {
            $productAddedSuccess=true;
        }
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
          integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh"
          crossorigin="anonymous"
    >
    <title>Product Form</title>
</head>
<body class="container pt-4">
<form action="" method="post">
    <?php if ($productAddedSuccess): ?>
    <p class="alert alert-success">Product added successfully</p>
    <?php endif; ?>
    <div class="form-group">
        <label for="productTitle">Title:</label>
        <input type="text" name="title" id="productTitle" class="form-control">
    </div>
    <button type="submit" class="btn btn-primary">Save product</button>

</form>
</body>
</html>
