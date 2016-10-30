<?php 
$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that the project works');
    $I->amOnPage('/');
    $I->see('WHERE WE WERE2');