<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap5\Modal;

/** @var \app\models\forms\SearchForm $model */

$this->title = 'Поиск пароля по hash';
//$this->params['breadcrumbs'][] = $this->title;
?>


    <div class="row">
        <div class="col-lg-3">
            <?php $form = ActiveForm::begin(['id' => 'search-form']); ?>
            <?= $form->field($model, 'search')->textInput(['autofocus' => true]) ?>
            <div class="form-group">
                <?php
                echo Html::submitButton('Поиск', ['class' => 'btn btn-success search'])
                //        echo Html::a('Поиск',
                //            '/admin/default/index',
                //            [
                //                'data-confirm' =>  'Вы уверены что хотите удалить Группу - ' . $model->title . '?',
                //                'class' => 'btn btn-success search',
                //                'data-method' => 'post',
                //                'data-pjax' => '1',
                //            ]);

                ?>
                <?php
                //   echo Html::button('Поиск', [
                //        'value' => \Yii::$app->request->get(),
                //       'href' => \yii\helpers\Url::to(['index']),
                //        'id' => 'btn-search',
                //        'method' => 'POST',
                //        'class' => 'btn btn-light',
                //        'data-pjax' => '0'
                //    ]);
                ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>


<?php
$script = <<< JS
//функция вызова модального окна
//     $('button#btn-search').click(function(){
//                console.log($(this).attr('value'));
//         var container = $('#modalContent');
//         container.html('Загрузка данных...');
// 
//         $('#mainModalSmall').modal('show')
//             .find('#modalContent')
//             .load($(this).attr('value'));
//     });


// $(function(){
//     // changed id to class
//     // $('.btn-search').click(function (){
//     $('.search').click(function (){
//         
//         $.get($(this).attr('href'), function(data) {
//             // console.log(document.getElementById("search-form"));
//           $('#modal').modal('show')
//           .find('#modalContent')
//           .html(data)
//           // .load($(this).attr('value'));
//        });
//        return false;
//     });
// }); 

 $('form').on('beforeSubmit', function(){
     const csrfToken = $('meta[name="csrf-token"]').attr("content");
      const search = document.getElementById('searchform-search').value;
     console.log(search)
       var data = $(this).serialize();
       
        $.ajax({
            url: '/admin/default/index',
            type: 'POST',
             data: {
            _csrf : csrfToken,
            search
          },
            success: function(res){
                $('#mainModalSmall').modal('show')
                .find('#modalContent')
                .html(res)
            },
            error: function(){
                alert('Пароль не найден или нет доступа!');
            }
        });
        return false;
    });



JS;
$this->registerJs($script);
?>