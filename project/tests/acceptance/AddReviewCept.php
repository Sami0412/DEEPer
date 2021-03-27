<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('submit a review for a product');

//Log In
$I->amOnPage('/product_list.php');
$I->see('Beer Selection', 'body.container h1');
$I->click('Log In');
$I->see('Email address:');
$I->wait(1);
$I->fillField('#email', 'johntoal89@gmail.com');
$I->wait(1);
$I->fillField('password', 'password');
$I->wait(1);
$I->click('Log In', 'div.container form');

$I->waitForText('Hello, John Toal');

//Select product
$I->see('Beer Selection', 'body.container h1');
$I->click('a[href="productpage.php?productId=2"]');
$I->waitForText('Pomona Island Pull Up to the Bumper');
$I->see('Recent Reviews', 'body.container h2');

//Leave review ---------ReCaptcha must be disabled before testing
$I->click('Review');
$I->waitForText('Leave a Review');
$I->wait(3);
//$I->see('John Toal', '#userName');
$I->fillField('rating', '4');
$I->fillField('review', 'Acceptance test');
$I->click('Add Review');

$I->waitForText('Acceptance test');