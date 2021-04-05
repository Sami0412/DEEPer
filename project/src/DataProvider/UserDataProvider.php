<?php


namespace App\DataProvider;


use App\Entity\User;
use App\Hydrator\UserHydrator;
Use PDO;

class UserDataProvider
{
    private PDO $dbh;
    private UserHydrator $userHydrator;

    public function __construct(PDO $dbh, UserHydrator $userHydrator)
    {
        $this->dbh = $dbh;
        $this->userHydrator = $userHydrator;
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