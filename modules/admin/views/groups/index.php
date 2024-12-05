<?php

use app\models\Groups;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Группы пользователей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groups-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <p>
        <?= Html::a('Добавить группу', ['create'], ['class' => 'btn btn-outline-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'title',
            'description',
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function ($data) {
                    /** @var $data Groups */
                    return $data->getStatusNameGroup();
                },
            ],

            [
                'class' => \app\components\classes\CustomActionColumnClass::class,
                'template' => '{update}&nbsp; {delete}&nbsp;',
                'headerOptions' => ['style' => 'width:7%'],
                'contentOptions' => ['style' => 'padding:0px 0px 0px 30px;vertical-align: middle;'], //выравнивание
                'buttons' => [
//                    'view_password' => function ($url, $model, $key) {
//                        return Html::button('<i class="bi bi-shield-lock"></i>', [
//                            'value' => Url::to(['view-password', 'id' => $model->id]),
//                            'id' => 'btn-view-pass',
//                            'class' => 'btn btn-light',
//                            'data-pjax' => '0',
//                        ]);
//                    },
                    'delete' => function ($url, $model, $key) {
                        return Html::a('<i class="bi bi-trash text-danger"></i>',
                            $url, ['data-confirm' =>  'Вы уверены что хотите удалить Группу - ' . $model->title . '?',
                                'data-method' => 'post',
                                'data-pjax' => '1',
                            ]);
                    },
                ],
                'visibleButtons' => [
                    //  только админ
//                    'view_password' => Yii::$app->user->identity->isAdmin(),
//                    'update' => Yii::$app->user->identity->isAdmin(),
//                    'delete' => Yii::$app->user->identity->isAdmin(),
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
