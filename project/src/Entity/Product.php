<?php

namespace App\Entity;

class Product
{
    public int $id;
    public string $title;
    public string $description;
    public string $image_path;
    public float $avg_rating;
    /** @var CheckIn[] */       //type hint - knows to expect an array of checkins
    public array $checkins;
}