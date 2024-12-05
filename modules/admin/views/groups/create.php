<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Groups $model */

$this->title = 'Новая группа пользователей';
$this->params['breadcrumbs'][] = ['label' => 'Группы пользователей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
