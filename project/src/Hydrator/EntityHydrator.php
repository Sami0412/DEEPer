<?php

namespace App\Hydrator;

use App\Entity\CheckIn;
use App\Entity\Product;
use App\Entity\User;

class EntityHydrator
{
    private UserHydrator $userHydrator;
    private ProductHydrator $productHydrator;
    private CheckInHydrator $checkInHydrator;

    public function __construct()
    {
        $this->userHydrator = new UserHydrator();
        $this->productHydrator = new ProductHydrator();
        $this->checkInHydrator = new CheckInHydrator();
    }

    public function hydrateProduct(array $data): Product
    {
        return $this->productHydrator->hydrateProduct($data);
    }

    public function hydrateCheckIn(array $data): CheckIn
    {
        return $this->checkInHydrator->hydrateCheckIn($data);
    }

    public function hydrateProductWithCheckIns(array $data): Product
    {
        return $this->productHydrator->hydrateProductWithCheckIns($data);
    }

    public function hydrateUser(array $data): User
    {
        return $this->userHydrator->hydrateUser($data);
    }
}