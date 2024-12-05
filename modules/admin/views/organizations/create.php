<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Organizations $model */

$this->title = 'Добавление новой организации';
$this->params['breadcrumbs'][] = ['label' => 'Список организаций', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="organizations-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
