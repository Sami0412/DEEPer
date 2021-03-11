<?php

namespace App\Hydrator;

use App\Entity\CheckIn;
use App\Entity\Product;
use App\Entity\User;

class EntityHydrator
{
    public function hydrateProduct(array $data): Product
    {
        $product = new Product();
        $product->id = $data['id'];
        $product->title = $data['title'];
        $product->description = $data['description'];
        $product->abv = $data['abv'];
        $product->beerStyle = $data['beer_style'];
        $product->brewery = $data['brewery'];
        $product->image_path = $data['image_path'];
        $product->avg_rating = $data['avg_rating'];

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
            if ($checkinRow['user_name'] !== null) {
                $checkIn = $this->hydrateCheckIn($checkinRow);
                $product->addCheckin($checkIn);
            }
        }

        return $product;
    }

    public function hydrateUser(array $data): User
    {
        $user = new User();
        $user->id = $data['id'] ?? null;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = $data['password'];

        return $user;
    }
}