<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Groups $model */

$this->title = 'Группы пользователей: ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Группы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="groups-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
