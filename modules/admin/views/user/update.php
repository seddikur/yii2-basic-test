<?php

use yii\helpers\Html;
use yii\helpers\VarDumper;

/** @var yii\web\View $this */
/** @var \app\models\UserForm $model */
//VarDumper::dump($model->id,10,true); die();
//$this->title = 'Update User Entity: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'User Entities', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-entity-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>