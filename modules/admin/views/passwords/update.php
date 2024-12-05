<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */
/** @var app\models\Groups $groups */

$this->title = 'Редактирование пароля: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Список паролей', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="passwords-update">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
    ]) ?>

</div>
