<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('See a list of products');

$I->amOnPage('/product_list.php');
$I->see('Beer Selection', 'body.container h1');

$I->wait(5);