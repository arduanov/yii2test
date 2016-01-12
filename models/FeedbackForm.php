<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\web\UploadedFile;
use yii\helpers\FileHelper;

/**
 * ContactForm is the model behind the contact form.
 */
class FeedbackForm extends Model
{
//    public $theme;
//    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    /**
     * @var UploadedFile
     */
    public $file;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['subject', 'body'], 'required'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
            ['subject', 'validateSubject'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, pdf',
                'checkExtensionByMimeType' => false, 'mimeTypes' => 'image/jpeg, image/png, image/gif, application/pdf'],

        ];
    }

    public function validateSubject($attribute, $params)
    {
        if (!in_array($this->$attribute, ['technical', 'support', 'other'])) {
            $this->addError($attribute, 'Theme incorrect.');
        }
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    public function upload()
    {
        $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);

        return [
            'name' => $this->file->baseName . '.' . $this->file->extension,
            'mime' => $this->file->extension,
            'size' => $this->file->size
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function send()
    {
        if ($this->validate()) {
            $feedback = new Feedback();
            $feedback->load($this->toArray());

            if ($feedback->save()) {
                return $feedback->id;
            }
            return false;
//            Yii::$app->mailer->compose()
//                ->setTo($email)
//                ->setFrom([$this->email => $this->theme])
//                ->setSubject($this->subject)
//                ->setTextBody($this->body)
//                ->send();
//
//            return true;
        }
        return false;
    }
}
