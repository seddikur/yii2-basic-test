<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */
/** @var yii\widgets\ActiveForm $form */
/** @var app\models\Groups $groups */
?>

<div class="passwords-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'password_is_not_decrypted')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?php
                    echo $form->field($model, 'organization_id')->widget(Select2::class, [
                        'data' => \yii\helpers\ArrayHelper::map(\app\models\Organizations::find()->asArray()->all(), 'id', 'title'),
                        'language' => 'ru',
                        'options' => ['placeholder' => 'Выбери  ...'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ]); ?>
                    <?php
                    echo $form->field($model, 'service_id')->widget(Select2::class, [
                        'data' => \yii\helpers\ArrayHelper::map(\app\models\Service::find()->asArray()->all(), 'id', 'title'),
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

                    <?php
                    echo $form->field($model, 'group_id')->checkboxList(
                        $groups,
                        ['separator' => '<br>']
                    );

                    ?>

                </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= $this->render('@buttons/_submitButtonsStandard', ['model' => $model]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
