<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use vova07\imperavi\Widget;
use yii\widgets\ListView;

$this->title = 'All Feedbacks';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    echo ListView::widget([
        'dataProvider' => $dataProvider,
        'itemView' => '_feedback',
    ]);
    ?>
</div>
