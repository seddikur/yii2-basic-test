<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="passwords-form">

    <?php $form = ActiveForm::begin(); ?>


    <?= $form->field($model, 'password_is_not_decrypted')->textInput(['maxlength' => true]) ?>


    <?= $form->field($model, 'user_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Users::find()->asArray()->all(), 'id', 'username')
    ); ?>

    <?= $form->field($model, 'organization_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Organizations::find()->asArray()->all(), 'id', 'title')
    ); ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
