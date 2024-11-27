<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */

$this->title = 'Create Passwords';
$this->params['breadcrumbs'][] = ['label' => 'Passwords', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passwords-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
