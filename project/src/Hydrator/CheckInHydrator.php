<?php

namespace App\Hydrator;

use App\Entity\CheckIn;

class CheckInHydrator
{

    private CheckIn $checkIn;

    public function __construct(CheckIn $checkIn)
    {
        $this->checkIn = $checkIn;
    }

    public function hydrateCheckIn(array $data): CheckIn
    {
        $checkIn = clone $this->checkIn;
        $checkIn->id = $data['id'] ?? null;
        $checkIn->product_id = $data['product_id'];
        $checkIn->name = $data['name'];
        $checkIn->rating = $data['rating'];
        $checkIn->review = $data['review'];
        $checkIn->posted = $data['submitted'] ?? null;

        return $checkIn;
    }
}
