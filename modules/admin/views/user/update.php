<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/* @var $model \app\models\forms\UserForm */

$this->title = $model->first_name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование пользователя';
?>
<div class="user-entity-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>