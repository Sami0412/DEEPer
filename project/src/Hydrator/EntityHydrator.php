<?php

namespace App\Hydrator;

use App\Entity\CheckIn;
use App\Entity\Product;

class EntityHydrator
{
    public function hydrateProduct(array $data): Product
    {
        $product = new Product();
        $product->id = $data['id'];
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->image_path = $data['image_path'];

        return $product;
    }

    public function hydrateCheckIn(array $data): CheckIn
    {
        $checkIn = new CheckIn();
        $checkIn->id = $data['id'];
        $checkIn->product_id = $data['product_id'];
        $checkIn->name = $data['user_name'];
        $checkIn->rating = $data['rating'];
        $checkIn->review = $data['review'];
        $checkIn->posted = $data['submitted'];

        return $checkIn;
    }

    public function hydrateProductWithCheckIns(array $data): Product
    {
        $product = new Product();
        $product->id = $data[0]['product_id'];
        $product->title = $data[0]['title'];
        $product->description = $data[0]['description'];
        $product->image_path = $data[0]['image_path'];
        $product->avg_rating = $data[0]['avg_rating'];

        foreach ($data as $checkinRow) {
            $checkIn = new CheckIn();
            $checkIn->id = $checkinRow['id'];
            $checkIn->product_id = $checkinRow['product_id'];
            $checkIn->name = $checkinRow['user_name'];
            $checkIn->rating = $checkinRow['rating'];
            $checkIn->review = $checkinRow['review'];
            $checkIn->posted = $checkinRow['submitted'];

            $product->addCheckin($checkIn);
        }

        return $product;
    }
}