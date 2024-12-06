<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\extend\UserExtend;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var UserExtend $model */
/** @var yii\widgets\ActiveForm $form */

?>

<div class="user-entity-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-4">
            <div class="card">
                <div class="card-body">

                    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>
                    <?php
                    echo $form->field($model, 'group_id')->widget(Select2::class, [
                        'data' => \yii\helpers\ArrayHelper::map(\app\models\Groups::find()->asArray()->all(), 'id', 'title'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выбери  ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
                    <?php if(Yii::$app->user->identity->role == \app\models\Constants::ROLE_ADMIN):?>
                    <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>
                    <?= $form->field($model, 'role')->dropDownList(ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description')) ?>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php if(Yii::$app->user->identity->id == $model->id || Yii::$app->user->identity->role == \app\models\Constants::ROLE_ADMIN):?>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
                    <?= $form->field($model, 'password_confirm')->passwordInput(['maxlength' => true]) ?>
                    <?php if($model->scenario !='create-user'):?>
                    <small class="text-body-secondary">* если оставить пустыми, пароль останеться без изменений</small>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <?php endif;?>
        <div class="form-group">
            <?php // \app\widgets\grid\Submit::widget() ?>
            <?= $this->render('@buttons/_submitButtonsStandard', ['model' => $model]) ?>
        </div>
    </div>


    <?php ActiveForm::end(); ?>

</div>
