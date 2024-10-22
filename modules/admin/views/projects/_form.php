<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Projects $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="projects-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'price')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput()
//    $form->field($model, 'created_at')->widget(\kartik\date\DatePicker::classname(), [
//        'value' => date('d-M-Y', strtotime('+2 days')),
//        'pluginOptions' => [
//            'autoclose' => true,
//            'format' => 'yyyy-mm-dd',
//            'todayHighlight' => true
//        ]
//    ]);
    ?>

    <?= $form->field($model, 'data_result')->textInput() ?>

    <?= $form->field($model, 'user_id')->dropDownList(
        \yii\helpers\ArrayHelper::map(\app\models\Users::find()->asArray()->all(), 'id', 'username')
    ); ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
