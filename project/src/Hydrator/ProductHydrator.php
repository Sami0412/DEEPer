<?php

namespace App\Hydrator;

use App\Entity\Product;

class ProductHydrator
{
    private Product $product;
    private CheckInHydrator $checkInHydrator;

    public function __construct(Product $product, CheckInHydrator $checkInHydrator)
    {
        $this->product = $product;
        $this->checkInHydrator = $checkInHydrator;
    }

    public function hydrateProduct(array $data): Product
    {
        $product = clone $this->product;
        $product->id = $data['id'] ?? null;
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->abv = $data['abv'];
        $product->beerStyle = $data['beer_style'];
        $product->brewery = $data['brewery'];
        $product->image_path = $data['image_path'] ?? null;
        $product->avg_rating = $data['avg_rating'] ?? null;

        return $product;
    }

    public function hydrateProductWithCheckIns(array $data): Product
    {
        //Array passed into hydrateProductWithCheckins() contains ALL product &
        //checkin data from SQL query so need to pick out relevant data to pass into
        //hydrateProduct()
        $productData = [
            'id' => $data[0]['product_id'],
            'title' => $data[0]['title'],
            'description' => $data[0]['description'],
            'abv' => $data[0]['abv'],
            'beer_style' => $data[0]['beer_style'],
            'brewery' => $data[0]['brewery'],
            'image_path' => $data[0]['image_path'],
            'avg_rating' => $data[0]['avg_rating']
        ];
        $product = $this->hydrateProduct($productData);

        foreach ($data as $checkinRow) {
            if ($checkinRow['name'] !== null) {
                $checkIn = $this->checkInHydrator->hydrateCheckIn($checkinRow);
                $product->addCheckin($checkIn);
            }
        }

        return $product;
    }
}