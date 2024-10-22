<?php

use app\models\Users;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php //echo Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'last_name',
            'first_name',
            'patronymic',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            [
                'label' => 'status',
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->getStatusName();
                },
            ],
            'created_at:date',
            'updated_at:date',
            //'verification_token',
            //'role',
            [
//                'class' => ActionColumn::className(),
                'class' => \app\components\classes\CustomActionColumnClass::class,
                'urlCreator' => function ($action, Users $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>


</div>
