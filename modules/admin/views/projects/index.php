<?php

use app\models\Projects;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\ProjectsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Projects';
$this->params['breadcrumbs'][] = $this->title;

//\yii\bootstrap5\Modal::begin([
//    'id' => 'test',
//    'title' => 'Hello world',
//    'toggleButton' => ['label' => 'click me'],
//]);
//
//echo 'Say hello...';
//
//\yii\bootstrap5\Modal::end()
?>
<div class="projects-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Projects', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            return ['data-href' => $model->id, 'class' => 'project_table'];
        },
        'columns' => [
//            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title',
            'description',
            'price',
            'created_at:date',
            'data_result:date',
            [
                'label' => 'Пользователь',
                'attribute' => 'user_id',
                'value' => function ($data) {
                    return $data->nameUser;
                },
                'filter' => \yii\helpers\ArrayHelper::map(\app\models\Users::find()->asArray()->all(), 'id', 'username')
            ],
            'status',
//            [
//                'class' => \app\components\classes\CustomActionColumnClass::class,
//                'urlCreator' => function ($action, Projects $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                },
//            ],
            [
                'template' => '{view} {update} {delete}',
                'class' => 'yii\grid\ActionColumn',
                'header' => 'Действия',

                'buttons' => [

                    'view' => function ($url, $model, $key) {
                        return Html::a(
                            '<i class="bi bi-eye text-success"></i>',
//                           Url::to(['view', 'id' => $model->id]),
                            '#',
                            [
                                'class' => 'activity-view-link',
//                                'id' => 'activity-view-link',
                                'title' =>  'View',
//                                'data-toggle' => 'modal',
//                                'data-target' => '#activity-modal',
//                                'data-id' => $key,
//                                'data-pjax' => '0',
                            ]);
                    },

                    'update' => function ($url, $data, $id) {
                        /* @var $data Projects */
//                        if (Yii::$app->user->can('elements/comments/update')) {
                        return Html::a('<i class="bi bi-pencil text-warning"></i>', 'javascript:void(0);', [
                            'class' => 'text-warning',
                            'title' => Yii::t('app', 'Изменить элемент'),
                            'onclick' => '
                            
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to([
                                    'update',
                                    'id' => $data->id,
                                ]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                        ]);
//                        }
//                        return false;
                    },
                    'delete' => function ($url, $data, $id) {
                        /* @var $data Projects */
//                        if (Yii::$app->user->can('elements/comments/delete')) {
                        return Html::a('<i class="bi bi-trash text-danger"></i>', 'javascript:void(0);', [
                            'class' => 'text-danger',
                            'title' => Yii::t('app', 'Удалить элемент'),
                            'onclick' => '
                                                    $.pjax({
                                                        type: "GET",
                                                        url: "' . Url::to(['confirm-delete', 'id' => $data->id]) . '",
                                                        container: "#pjaxModalUniversal",
                                                        push: false,
                                                        timeout: 10000,
                                                        scrollTo: false
                                                    })'
                        ]);
//                        }
//                        return false;
                    },
                ],
            ],
        ],
    ]);
    Pjax::end();
    ?>


    <?php
    $script = <<< JS


          $('.activity-view-link').click(function(e){
          // $('#mainModal').on("change", function(e){
          const csrfToken = $('meta[name="csrf-token"]').attr("content");
            // const user_id = document.getElementById('user_id_adm').value;
          // получаем элемент
              var elementId = $(this).closest('tr').data('key');
              
                 var container = $('#modalContent');
                 container.html('Загрузка данных...');
                 
                 
                 $.get(      
                     "/admin/projects/view",
                            {
                                  // получаем элемент
                                id: elementId
                            },
                            function (data) {
                            $('#mainModal').modal('show');
                                $('#modalContent').html(data);
                                // $('#mainModal').modal();
                            }  
                        );
                 
             });
    
    JS;
    $this->registerJs($script);

//      $.ajax({
//                                         url: '/admin/product/check-user',
//                                         type: 'POST',
//                                         data: {
//                                             _csrf: csrfToken,
//                                         },
//                                         success: function (res) {
//                                             $('#user_info').html(res);
//                                         },
//                                         error: function () {
//                                             // alert('Error!');
//                                 }
//                             });
    ?>
</div>
