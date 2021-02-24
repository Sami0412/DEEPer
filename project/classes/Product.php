<?php

class Product
{
    public int $id;
    public string $title;
    public float $average_rating;
    /** @var CheckIn[] */       //type hint - knows to expect an array of checkins
    public array $checkins;
}