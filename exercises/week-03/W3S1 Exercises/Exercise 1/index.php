<?php
class Student {
    //constructor
    public function __construct($first_name, $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function say_name() {
        echo "My name is " . $this->first_name . " " . $this->last_name . ".\n";
    }
}

$alex = new Student("Alex", "Jones");
$alex->say_name();

class MathStudent extends Student {
    function sum_numbers($first_number, $second_number) {
        $sum = $first_number + $second_number;
        echo $this->first_name . " says that " . $first_number . " + " . $second_number . " is " . $sum;
    }
}

$eric = new MathStudent("Eric", "Chang");
$eric->say_name();
$eric->sum_numbers(3, 5);

class Car {
    public function __construct($brand, $year) {
        $this->brand = $brand;
        $this->year = $year;
    }
    public function print_details() {
        echo "This car is a " . $this->year . " " . $this->brand . ".";
    }
}
$car = new Car("Toyota", 2006);
$car->print_details();