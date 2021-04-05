<?php


namespace App\DataProvider;

use App\Entity\Product;
use App\Hydrator\ProductHydrator;
use PDO;

class ProductDataProvider
{
    private PDO $dbh;
    private ProductHydrator $productHydrator;

    public function __construct(PDO $dbh, ProductHydrator $productHydrator)
    {
        $this->dbh = $dbh;
        $this->productHydrator = $productHydrator;
    }

    public function getProducts(string $searchTerm): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, title, description, image_path, abv, beer_style, brewery,
            (
                SELECT AVG(IFNULL(checkins.rating, 0)) FROM checkins WHERE product_id = p.id
            ) AS avg_rating
            FROM products p WHERE title LIKE :searchTerm'
        );

        //Works even when no search term entered - passes %% into stmt which searches for everything
        $stmt->execute([
            'searchTerm' => '%' . $searchTerm . '%'
        ]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function getProduct(int $productId): ?Product
    {
        $stmt = $this->dbh->prepare(
            'SELECT
            p.id AS product_id, p.title, p.description, p.image_path, p.abv, p.beer_style, p.brewery,
            c.id, c.user_name AS name, c.rating, c.review, c.submitted,
            (
                SELECT AVG(IFNULL(checkins.rating, 0)) FROM checkins WHERE product_id = p.id
            ) AS avg_rating
            FROM products AS p
            LEFT JOIN checkins AS c ON c.product_id = p.id
            WHERE p.id = :id'
        );
        //Insert product id from URL & execute query
        $stmt->execute([
            'id' => $productId
        ]);
        //Retrieve array
        $productAndCheckInData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $this->productHydrator->hydrateProductWithCheckIns($productAndCheckInData);
    }


    public function getProductById(int $productId): string
    {
        $stmt = $this->dbh->prepare(
            'SELECT title FROM products
            WHERE id = :id'
        );

        $stmt->execute([
            'id' => $productId
        ]);

        return $stmt->fetchColumn();
    }


    public function createProduct(Product $product): Product
    {
        //Insert into database
        $stmt = $this->dbh->prepare(
            'INSERT INTO products(title, description, image_path, abv, beer_style, brewery)
            VALUES (:title, :description, :imagePath, :abv, :beerStyle, :brewery)'
        );

        $stmt->execute([
            'title' => $product->title,
            'description' => $product->description,
            'imagePath' => $product->image_path,
            'abv' => $product->abv,
            'beerStyle' => $product->beerStyle,
            'brewery' => $product->brewery
        ]);

        //Use built-in function lastInsertId to get the newly created ID for the new product
        $lastInsertId = $this->dbh->lastInsertId();
        //Pass new ID into getProduct to retrieve all DB info of new product
        $newProduct = $this->getProduct($lastInsertId);
        return $newProduct;
    }
}