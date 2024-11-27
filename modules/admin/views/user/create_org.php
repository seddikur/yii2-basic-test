<?php

use yii\bootstrap4\Html;

/* @var $this yii\web\View */
/* @var $model \app\models\Users */
/* @var $organization \app\models\Organizations */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Организацию', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-web-create">

    <h3><?php //Html::encode($this->title) ?></h3>

    <?= $this->render('_form_org', [
        'model' => $model,
        'organization' => $organization,
    ]) ?>

</div>