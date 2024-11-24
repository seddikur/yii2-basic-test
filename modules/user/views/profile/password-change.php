<?php

use yii\bootstrap5\ActiveForm;
use app\modules\user\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \app\modules\user\models\PasswordChangeForm */

$this->title = 'Смена пароля';
$this->params['breadcrumbs'][] = ['label' => 'Профиль', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile-password-change">


    <div class="user-form">

        <?php $form = ActiveForm::begin(['id' => 'password-change-form']); ?>

        <?= $form->field($model, 'currentPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPassword')->passwordInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'newPasswordRepeat')->passwordInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton( 'Сохранить', ['class' => 'btn btn-primary', 'name' => 'change-button']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>