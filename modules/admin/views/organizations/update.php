<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */

$this->title = 'Изменения в: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список организаций', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="organizations-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
