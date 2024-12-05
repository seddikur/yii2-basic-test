<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Service $model */

$this->title = 'редактирование сервис: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Сервисы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="service-update">
    <?php $form = ActiveForm::begin(); // important ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= $this->render('@buttons/_submitButtonSave', ['model' => $model]) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>
