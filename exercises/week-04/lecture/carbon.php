<?php

require_once 'setup.php';

use Carbon\Carbon;

$birthday = Carbon::createFromDate(1989, 12, 4);

$age = $birthday->age;

echo 'Age: ' . $age . '<br>';
echo 'Birthday: ' . $birthday->format('d/M/Y');

$rightNow = Carbon::now();
$midnightToday = Carbon::today();

$difference = $rightNow->diff($midnightToday);

var_dump($difference);
