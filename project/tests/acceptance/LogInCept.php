<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('log in');

$I->amOnPage('/product_list.php');
$I->see('Beer Selection', 'body.container h1');

$I->click('Log In');

$I->fillField('email', 'samiw0412@gmail.com');
$I->fillField('password', 'password');
$I->click('Log In', 'div.container form');

$I->waitForText('Hello, Samantha Williams');

