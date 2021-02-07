<?php

class User {
    public $name = "Joe Bloggs";    //default value assigned to name within template
}

$user = new User();     //copies User class template, and copies this to $user variable

echo $user->name . "<br>";  //Joe Bloggs

$user->name = "Jane Doe";    //change property value

echo $user->name . "<br>";  //Jane Doe - displays new name value

$user2 = new User();

echo $user2->name . "<br>";     //Joe Bloggs - fresh copy of User class

$user2->name = "Jeremy";

echo $user2->name;