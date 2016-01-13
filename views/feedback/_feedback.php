<?php
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

?>
<div class="post">
    <h2><?= Html::encode($model->subject) ?></h2>
    <div>
        <?= HtmlPurifier::process($model->body) ?>
    </div>

    <?= Html::a($model->fileData['name'], '/uploads/' . $model->fileData['name']) ?>
    <?= $model->fileData['mime'] ?>, <?= Yii::$app->formatter->asShortSize($model->fileData['size']) ?>

</div>