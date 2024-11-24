<?php

use yii\bootstrap5\ActiveForm;
use app\modules\user\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\ProfileUpdateForm */

$this->title =  'Редактирование профиля';
$this->params['breadcrumbs'][] = ['label' =>  'Профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-update">


    <div class="user-form">

        <?php $form = ActiveForm::begin(['id' => 'profile-update-form']); ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton( 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'update-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>