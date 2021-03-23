<?php

namespace App\Entity;

class CheckIn
{
    public ?int $id;
    public int $product_id;     //make sure properties exactly match column names in table!
    public string $name;
    public int $rating;
    public string $review;
    public ?string $posted;       //string because PDO cannot process mySQL datetime format
}
