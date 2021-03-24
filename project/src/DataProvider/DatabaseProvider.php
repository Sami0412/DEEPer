<?php

namespace App\DataProvider;

use App\Entity\Product;
use App\Entity\CheckIn;
use App\Entity\User;
use App\Hydrator\CheckInHydrator;
use App\Hydrator\ProductHydrator;
use App\Hydrator\UserHydrator;
use PDO;

class DatabaseProvider
{
    private PDO $dbh;
    private CheckInHydrator $checkInHydrator;
    private ProductHydrator $productHydrator;
    private UserHydrator $userHydrator;

    public function __construct(PDO $dbh, CheckInHydrator $checkInHydrator, ProductHydrator $productHydrator, UserHydrator $userHydrator)
    {
        $this->dbh = $dbh;
        $this->checkInHydrator = $checkInHydrator;
        $this->productHydrator = $productHydrator;
        $this->userHydrator = $userHydrator;
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

    public function createCheckIn(CheckIn $checkIn): CheckIn
    {
        $stmt = $this->dbh->prepare(
            'INSERT INTO checkins (product_id, user_name, rating, review) 
            VALUES (:product_id, :name, :rating, :review)'
        );

        $stmt->execute([
            'product_id' => $checkIn->product_id,
            'name' => $checkIn->name,
            'rating' => $checkIn->rating,
            'review' => $checkIn->review,
        ]);

        $lastInsertId = $this->dbh->lastInsertId();
        $newCheckIn = $this->getCheckIn($lastInsertId);

        return $newCheckIn;
    }


    public function getCheckIn(int $checkInId): ?CheckIn
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, product_id, user_name AS name, rating, review, submitted
            FROM checkins
            WHERE id = :id'
        );

        $stmt->execute([
            'id' => $checkInId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($result)) {
            return null;
        }

        return $this->checkInHydrator->hydrateCheckIn($result);
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


    public function createUser(User $user): User
    {
        $stmt = $this->dbh->prepare('
            INSERT INTO users (username, email, password)
            VALUES (:username, :email, :password)'
        );

        $stmt->execute([
            'username' => $user->name,
            'email' => $user->email,
            'password' => $user->password
        ]);

        $lastInsertId = $this->dbh->lastInsertId();
        $newUser = $this->getUser($lastInsertId);

        return $newUser;
    }

    public function getUser(int $userId): ?User
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, username, email, password
            FROM users 
            WHERE id = :id'
        );

        $stmt->execute([
            'id' => $userId
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        return $this->userHydrator->hydrateUser($result);
    }

    public function getUserByEmail(string $email) :?User
    {
        $stmt = $this->dbh->prepare(
            'SELECT id, username, email, password
            FROM users 
            WHERE email = :email'
        );

        $stmt->execute([
            'email' => $email
        ]);

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if (empty($result)) {
            return null;
        }

        return $this->userHydrator->hydrateUser($result);
    }
}
