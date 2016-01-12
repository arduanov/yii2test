<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class Feedback extends ActiveRecord
{
    public function getFileData()
    {
        return json_decode($this->file, true);
    }

    public function setFileData($data)
    {
        $this->file = json_encode($data);
    }

}
