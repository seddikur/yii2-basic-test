<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\widgets\ActiveForm */
/* @var $model \app\models\Users */
/* @var $organization \app\models\Organizations */
?>

<div class="event-web-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php  echo $form->field($model, 'organization_id')->dropDownList(
        \yii\helpers\ArrayHelper::map($organization, 'id', 'title')
    ); ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>