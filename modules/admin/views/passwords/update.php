<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */

$this->title = 'Редактирование пароля: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Пароли', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="passwords-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
