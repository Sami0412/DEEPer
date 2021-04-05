<?php


namespace App\DataProvider;


use App\Entity\CheckIn;
use App\Hydrator\CheckInHydrator;
use PDO;


class CheckInDataProvider
{
    private PDO $dbh;
    private CheckInHydrator $checkInHydrator;

    public function __construct(PDO $dbh, CheckInHydrator $checkInHydrator)
    {
        $this->dbh = $dbh;
        $this->checkInHydrator = $checkInHydrator;
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
}