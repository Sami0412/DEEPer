<?php

namespace App\Hydrator;

use App\Entity\CheckIn;

class CheckInHydrator
{
    public function hydrateCheckIn(array $data): CheckIn
    {
        $checkIn = new CheckIn();
        $checkIn->id = $data['id'] ?? null;
        $checkIn->product_id = $data['product_id'];
        $checkIn->name = $data['name'];
        $checkIn->rating = $data['rating'];
        $checkIn->review = $data['review'];
        $checkIn->posted = $data['submitted'] ?? null;

        return $checkIn;
    }
}
