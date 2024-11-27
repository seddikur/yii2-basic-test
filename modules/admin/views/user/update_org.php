<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\Users */
/* @var $organization \app\models\Organizations */

$this->title = 'Редактирование: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Event Webs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';

?>
<div class="event-web-update">

    <h1><?php //= Html::encode($this->title) ?></h1>

    <?= $this->render('_form_org', [
        'model' => $model,
        'organization' => $organization,
    ]) ?>

</div>
