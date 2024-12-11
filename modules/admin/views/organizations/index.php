<?php

use app\models\Organizations;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\search\OrganizationsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список организаций';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="organizations-index">

        <h3><?= Html::encode($this->title) ?></h3>

        <p>
            <?= Html::a('Добавить организацию', ['create'], ['class' => 'btn btn-outline-success']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

//            'id',
                'title',
                'description',
//                'created_at:datetime',
//            'updated_at',
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
                                $url, ['data-confirm' =>  'Вы уверены что хотите удалить Организацию - ' . $model->title . '?',
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


    </div>
<?php
$script = <<< JS
//функция запуск модального окна по клику кнопки btn-view-pass
// модальное лежит в layout/index
    $('button#btn-view-pass').click(function(){
        console.log('клик');
        var container = $('#modalContent');
       
        container.html('Загрузка данных...');
        
         var modal =  $('#mainModalSmall');
        modal.modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
        
        setTimeout(function(){
        modal.modal('hide')
        .find('#modalContent')
        .empty();
         }, 5000);
    });
  
JS;
$this->registerJs($script);
?>