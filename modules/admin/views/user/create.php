<?php

use \app\models\UserEntity;
use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\UserEntity */

$this->title = 'Новый пользователь';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

