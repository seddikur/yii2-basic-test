<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Passwords $model */
/** @var app\models\Groups $groups */

$this->title = 'Новый пароль';
$this->params['breadcrumbs'][] = ['label' => 'Список паролей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="passwords-create">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'groups' => $groups,
    ]) ?>

</div>
