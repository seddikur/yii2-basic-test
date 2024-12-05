<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Groups $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="groups-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">

        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card">
                <div class="card-body">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                    <?= $form->field($model, 'status')->dropDownList($model->statusList) ?>
                </div>
            </div>
        </div>


        <div class="form-group">
            <?= $this->render('@buttons/_submitButtonsStandard', ['model' => $model]) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
