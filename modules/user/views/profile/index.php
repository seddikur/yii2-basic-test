<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \app\models\Users */

$this->title ='Профиль';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-profile">
    <p>
        <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сменить пароль', ['password-change'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'username',
            'email',
        ],
    ]) ?>

</div>