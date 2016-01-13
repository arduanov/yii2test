<?php

use tests\codeception\_pages\FeedbackPage;

/* @var $scenario Codeception\Scenario */

$I = new AcceptanceTester($scenario);
$I->wantTo('ensure that feedback form works');

$feedbackPage = FeedbackPage::openBy($I);
$I->see('Feedback', 'h1');

$I->amGoingTo('submit contact form with correct data');
$feedbackPage->submit([
    'subject' => 'other',
    'body' => 'test content',
    'verifyCode' => 'testme',
    'file' => 'test.jpg',
]);

$I->dontSeeElement('#contact-form');
$I->see('Thank you for contacting us. We will respond to you as soon as possible.');


$I->wantTo('ensure that feedback list works');
$I->amOnPage('/feedback/all');
$I->see('All Feedbacks', 'h1');
