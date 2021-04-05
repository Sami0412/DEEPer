<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('Search for a product');

$I->amOnPage('/product_list.php');
//Check page rendered
$I->see('Beer Selection', 'body.container h1');

$I->wait(2);

$I->fillField('search', 'stout');
$I->click('Search', 'body.container form');

$I->waitForText('1 result found');

$I->wait(5);