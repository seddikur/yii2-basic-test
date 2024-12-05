<?php

use app\models\Service;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var Service $model */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Сервисы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-index">

    <h3><?= Html::encode($this->title) ?></h3>


    <div class="row">
        <div class="col-lg-3">
            <?= $this->render('_form_pjax', [
                'model' => $model,
            ]) ?>
        </div>
        <div class="col-lg-9">
            <?php Pjax::begin(['id' => 'service-index']) ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//                    'id',
                    'title',
                    [
                        'class' => \app\components\classes\CustomActionColumnClass::class,
                        'template' => '{update}&nbsp; {delete}&nbsp;',
                        'headerOptions' => ['style' => 'width:12%'],
                        'contentOptions' => ['style' => 'padding:0px 0px 0px 30px;vertical-align: middle;'], //выравнивание
                        'buttons' => [
                            'update' => function ($url, $model, $key) {
                                return Html::button('<i class="bi bi-pencil text-warning"></i>', [
                                    'value' => Url::to(['update', 'id' => $model->id]),
                                    'id' => 'btn-update',
                                    'class' => 'btn btn-light',
                                    'data-pjax' => '0'
                                ]);
                            },
                            'delete' => function ($url, $model, $key) {
                                return Html::a('<i class="bi bi-trash text-danger"></i>',
                                    $url, ['data-confirm' => 'Вы уверены что хотите удалить Сервис - ' . $model->title . '?',
                                        'data-method' => 'post',
                                        'data-pjax' => '1',
                                    ]);
                            },
                        ],
                        'visibleButtons' => [
                            //  только админ
                            'update' => Yii::$app->user->identity->isAdmin(),
                            'delete' => Yii::$app->user->identity->isAdmin(),
                        ]
                    ],
                ],
            ]); ?>
            <?php Pjax::end() ?>
        </div>

    </div>


</div>

<?php
$script = <<< JS
//функция вызова модального окна
    $('button#btn-update').click(function(){
        var container = $('#modalContent');
        container.html('Загрузка данных...');
        $('#mainModalSmall').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });
JS;
$this->registerJs($script);
?>