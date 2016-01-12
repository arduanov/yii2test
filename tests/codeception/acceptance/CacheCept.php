<?php

use tests\codeception\_pages\HomePage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
HomePage::openBy($I);
$cached_date = trim($I->grabTextFrom('#date'));

$I->wantTo('ensure that cache works');
HomePage::openBy($I);
$I->see($cached_date, '#date');
sleep(1);

$I->wantTo('ensure that cache flush');
HomePage::openBy($I, ['flush-cache' => '']);
$I->dontSee($cached_date, '#date');
