<?php

namespace app\components\classes;

use yii\grid\ActionColumn;

/**
 * Переопределены иконки GridView
 * Использование:
 * 'class' => \backend\components\classes\CustomActionColumnClass::className(),
 * 'urlCreator' => function ($action, \common\models\EventWebId $model, $key, $index, $column) {
 * return Url::toRoute([$action, 'id' => $model->id]);
 * }
 */
class CustomActionColumnClass extends ActionColumn
{

    public $icons = [
        'eye-open' => '<i class="bi bi-eye text-success"></i>',
        'pencil' => '<i class="bi bi-pencil text-warning"></i>',
        'trash' => '<i class="bi bi-trash text-danger"></i>'
    ];

}