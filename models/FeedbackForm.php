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
            [['verifyCode'], 'captcha', 'captchaAction' => 'feedback/captcha'],
            ['subject', 'validateSubject'],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, gif, pdf',
                'checkExtensionByMimeType' => false, 'mimeTypes' => 'image/jpeg, image/png, image/gif, application/pdf'],

        ];
    }

    public function validateSubject($attribute, $params)
    {
        if (!in_array($this->$attribute, ['technical', 'support', 'other'])) {
            $this->addError($attribute, 'Subject incorrect.');
        }
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'subject' => 'Тема',
            'body' => 'Обращение',
            'file' => 'Файл',
            'verifyCode' => 'Код',
        ];
    }

    public function upload()
    {
        $this->file->saveAs('uploads/' . $this->file->baseName . '.' . $this->file->extension);

        return [
            'name' => $this->file->baseName . '.' . $this->file->extension,
            'mime' => $this->file->type,
            'size' => $this->file->size
        ];
    }
}
