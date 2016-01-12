<?php

namespace tests\codeception\_pages;

use yii\codeception\BasePage;

/**
 * Represents login page
 * @property \AcceptanceTester|\FunctionalTester $actor
 */
class FeedbackPage extends BasePage
{
    public $route = 'feedback';

    /**
     * @param string $username
     * @param string $password
     */
    public function login($username, $password)
    {
        $this->actor->fillField('input[name="LoginForm[username]"]', $username);
        $this->actor->fillField('input[name="LoginForm[password]"]', $password);
        $this->actor->click('login-button');
    }

    /**
     * @param array $contactData
     */
    public function submit(array $contactData)
    {
        $this->actor->selectOption('select[name="FeedbackForm[subject]"]', $contactData['subject']);
        $this->actor->fillField('textarea[name="FeedbackForm[body]"]', $contactData['body']);
        $this->actor->fillField('input[name="FeedbackForm[verifyCode]"]', $contactData['verifyCode']);
        $this->actor->attachFile('#feedbackform-file', $contactData['file']);
//        $this->actor->attachFile('input[@type="file"]', $contactData['file']);

//        foreach ($contactData as $field => $value) {
//            $inputType = $field === 'body' ? 'textarea' : 'input';
//            $this->actor->fillField($inputType . '[name="FeedbackForm[' . $field . ']"]', $value);
//        }
        $this->actor->click('contact-button');
    }
}
