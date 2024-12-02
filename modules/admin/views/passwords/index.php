<?php

use app\models\Passwords;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Users;
use  kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var app\models\search\PasswordsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пароли';
$this->params['breadcrumbs'][] = $this->title;

//$user =  Yii::$app->getUser()->getId();
?>
<div class="passwords-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Новый пароль', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
//            'sault',
//            'password',
            'hash',
            [
                'format' => 'raw',
                'attribute' => 'user_id',
                /** @var \app\models\Users $data */
                'value' => function ($data) {
                    return $data->user->username;
                },
//                'filter' => Select2::widget([
//
//                    'data' => ArrayHelper::map(
//                        Users::find()
//                            ->asArray()
//                            ->all(),
//                        'id', 'username'),
//                    'model' => $searchModel,
//                    'attribute' => 'user_id',
//                    'options' => ['multiple' => true,]
//                ]),
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'user_id',
                    'data' => ArrayHelper::map(
                        Users::find()
                            ->asArray()
                            ->all(),
                        'id', 'username'),
                    'hideSearch' => true,
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'все'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false,
                    ]
                ]),
//                'options' => ['width' => '20%'],

            ],
            [
                'format' => 'raw',
                'attribute' => 'organization_id',
                /** @var \app\models\Organizations $data */
                'value' => function ($data) {
                    return $data->organization->title;
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'organization_id',
                    'data' => ArrayHelper::map(
                        \app\models\Organizations::find()
                            ->asArray()
                            ->all(),
                        'id', 'title'),
                    'hideSearch' => true,
                    'options' => [
                        'class' => 'form-control',
                        'placeholder' => 'все'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'multiple' => false,
                    ]
                ]),
            ],
            //'created_at',
            //'updated_at',
            //'ip',
            [
                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view}&nbsp;&nbsp;{permit}&nbsp;&nbsp;{delete}',
                'template' => '{view_password} {update}  {delete}',
                'buttons' => [
                    'view_password' => function ($url, $model, $key) {
                        return Html::button('<i class="bi bi-shield-lock"></i>', [
                            'value' => Url::to(['view-password', 'id' => $model->id]),
                            'id' => 'btn-view-pass',
                            'class' => 'btn btn-light',
                            'data-pjax' => '0',
                            'title'=>'Пароль'
                        ]);
                    },
                ],
                'visibleButtons' => [
                    //  только админ
                    'view_password' => Yii::$app->user->identity->isAdmin(),
                    'update' => Yii::$app->user->identity->isAdmin(),
                    'delete' => Yii::$app->user->identity->isAdmin(),
                ]
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>

</div>
<?php
$script = <<< JS
//функция запуск модального окна по клику кнопки btn-view-pass
// модальное лежит в layout/index
    $('button#btn-view-pass').click(function(){
        console.log('клик');
        
        
        var container = $('#modalContent');
        var modal =  $('#mainModalSmall');
        container.html('Загрузка данных...');
        // modal.modal('show')
        //     .find('#modalContent')
        //     .load($(this).attr('value'));
        
        //   if ($('#mainModalSmal').data('bs.modal').isShown) {
           if (modal.isShown) {
           modal.find('#modalContent')
                    .load($(this).attr('value'));
            //динамически устанавливайте заголовок для модального
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        } else {
            //если модальный режим не открыт, откройте его и загрузите содержимое
            modal.modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //динамически устанавливайте заголовок для модального
            document.getElementById('modalHeader').innerHTML = '<h4>' + $(this).attr('title') + '</h4>';
        }
        //скрыть через 5сек
          setTimeout(function(){
        modal.modal('hide')
        .find('#modalContent')
        .empty();
         }, 5000);
    });

JS;
$this->registerJs($script);
?>