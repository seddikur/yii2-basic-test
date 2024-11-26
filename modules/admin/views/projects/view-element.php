<?php

use yii\bootstrap5\Modal;
use yii\helpers\Html;
use yii\widgets\DetailView;


/** @var app\models\Projects $model */

Modal::begin([
    'id' => 'mainModal',
//    'header' => '<h4 class="modal-title">View Image</h4>',
//    'footer' => '<a href="#" class="btn btn-primary" data-dismiss="modal">Close</a>',



//    'id' => 'universal-modal',
//    'size' => 'modal-md',
//    'title' => 'Hello world',
////    'header' => '<h2 class="text-center m-t-sm m-b-sm">'.Yii::t('app', 'Просмотр элемента').'</h2>',
//    'clientOptions' => ['show' => true],
//    'options' => [
//        ''
//    ],
]);

echo DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description',
            'price',
            'created_at',
            'data_result',
            'user_id',
            'status',
        ],
    ]);

Modal::end();
