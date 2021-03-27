<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('select a product and navigate to the product page');

$I->amOnPage('/product_list.php');
$I->see('Beer Selection', 'body.container h1');

$I->click('a[href="productpage.php?productId=1"]');

$I->waitForText('Thirst Class Imperial Stocky Oatmeal Stout');
$I->see('Recent Reviews', 'body.container h2');