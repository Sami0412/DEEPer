<?php

namespace App\DataProvider;

use App\Entity\Product;
use App\Entity\CheckIn;
use App\Hydrator\EntityHydrator;
use PDO;

class DatabaseProvider
{
    private PDO $dbh;

    public function __construct()
    {
        try {
            $this->dbh = new PDO(
                "mysql:dbname=myproject;host=mysql",
                $_ENV['DBUSERNAME'],
                $_ENV['DBPASSWD']
            );

            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            die("Database connection failed");
        }
    }

    public function getProducts(string $searchTerm): array
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, title, description, image_path,
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
            p.id AS product_id, p.title, p.description, p.image_path,
            c.id, c.user_name, c.rating, c.review, c.submitted,
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

        $hydrator = new EntityHydrator();
        return $hydrator->hydrateProductWithCheckIns($productAndCheckInData);
    }

    public function getCheckIn(): ?CheckIn
    {

    }

    public function createProduct(Product $product): Product
    {
        //Insert into database
        $stmt = $this->dbh->prepare(
            'INSERT INTO products(title, description)
            VALUES (:title, :description)'
        );

        $stmt->execute([
            'title' => $product->title,
            'description' => $product->description
        ]);

        //Use builtin function lastInsertId to get the newly created ID for the new product
        $lastInsertId = $this->dbh->lastInsertId();
        //Pass new ID into getProduct to retrieve all DB info of new product
        $newProduct = $this->getProduct($lastInsertId);
        return $newProduct;
    }
}
