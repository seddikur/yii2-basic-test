<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organizations-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="card">
            <div class="card-body">
                <div class="col-4">
                    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-8">
                    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="form-group">
                    <?= $this->render('@buttons/_submitButtonsStandard', ['model' => $model]) ?>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
