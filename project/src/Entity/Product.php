<?php

namespace App\Entity;

class Product
{
    public int $id;
    public string $title;
    public string $description;
    public string $image_path;
    public ?float $avg_rating;      //? allows null value
    /** @var CheckIn[] */       //type hint - knows to expect an array of checkins
    //private array can only be accessed via public accessor functions
    private array $checkIns = [];
    //Accessor function 'setter'
    public function addCheckin(CheckIn $checkIn): void
    {
        //add new checkin to checkins array, only if it is instance of CheckIn as hinted in function brackets
        $this->checkIns[] = $checkIn;
    }
    //Accessor function 'getter'
    public function getCheckIns(): array
    {
        //Return array of all checkins
        return $this->checkIns;
    }
}