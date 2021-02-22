<?php

if (!isset($_GET['id'])) {
    die('Missing id in URL');
}

class Product
{
    public int $id;
    public string $title;
    /** @var CheckIn[] */       //type hint - knows to expect an array of checkins
    public array $checkins;
}

class CheckIn
{
    public int $id;
    public int $product_id;     //make sure properties exactly match column names in table!
    public string $name;
    public int $rating;
    public string $review;
    public string $posted;       //string because PDO cannot process mySQL datetime format
}

$dbh = new PDO('mysql:dbname=project;host=mysql', 'root', 'root');
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//product
$stmt= $dbh->prepare('SELECT * FROM product WHERE id = :id');
$stmt->execute([
    'id' => $_GET['id']     //This fetches id value and can be later used below as $product->id
]);

$product = $stmt->fetchObject(Product::class);

//Checkin
$stmt = $dbh->prepare('SELECT * FROM checkin WHERE product_id = :product_id');
$stmt->execute([
    'product_id' => $product->id
]);

$product->checkins = $stmt->fetchAll(PDO::FETCH_CLASS, CheckIn::class);

var_dump($product);