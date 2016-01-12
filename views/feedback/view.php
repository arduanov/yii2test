<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use vova07\imperavi\Widget;

$this->title = 'Feedback';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

        <div class="alert alert-success">
            Thank you for contacting us. We will respond to you as soon as possible.
        </div>

    <?php endif; ?>


    <div class="row">
        <div class="col-lg-5">
            <h3>Тема:</h3>
            <?= $feedback->subject ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <h3>Обращение:</h3>
            <?= $feedback->body ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-5">
            <h3>Файл:</h3>
            <?php print_r($feedback->fileData); ?>
        </div>
    </div>

</div>
