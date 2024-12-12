<?php

namespace app\models\forms;

use yii\base\Model;
use yii\helpers\VarDumper;

class SearchForm extends Model
{


    public $search;

    public function rules()
    {
        return [
            [['search'], 'required'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'search' => 'Поиск паролей',
        ];
    }


}