<?php

use yii\bootstrap5\Html;
use yii\helpers\Url;

/** @var \app\modules\admin\services\PasswordEncryption $view_password */
?>
<style>
    /* стили текстового поля */
    #inputText {
        padding: 6px 7px;
        font-size: 15px;
    }
</style>
<div class="row">

    <?php if ($view_password != null): ?>

        <div id="text1">
            <p class="text-center text-success ">
                <input class="form-control" id="inputText" type="text" value= <?= $view_password; ?>>
                <?php //$view_password; ?>
            </p>
        </div>

        <!--            <button click="navigator.clipboard.writeText('Текст')">Скопировать</button>-->
        <!--            <input value=--><? //= $view_password; ?><!-- id="text" type="hidden">-->
        <?= Html::button('copy', [
            'id' => 'copyText',
            'value' => $view_password,
//            'id' => 'userButton',
            'class' => 'btn btn-info',
            'data-pjax' => '0',
            'data-bs-original-title' => 'Copy',
//            'onclick' => "copytext('#text1')"
        ]); ?>
        <!--    <input value="Copy" type="button" onclick="document.getElementById('text').select(); document.execCommand('copy');">-->

    <?php else: ?>

        <p class="text-center text-danger">
            Пароль отсутствует
        </p>
    <?php endif; ?>

</div>

<?php
$js = <<<JS
/* сохраняем текстовое поле в переменную text */
var text = document.getElementById("inputText");

/* сохраняем кнопку в переменную btn */
var btn = document.getElementById("copyText");

/* вызываем функцию при нажатии на кнопку */
btn.onclick = function() {
  text.select();    
  document.execCommand("copy");
}

//функция копи
// $('button#btn-copy-pass').click(function(){
//    // let copyGfGText = document.getElementById("GfGInput");
//    ($(this).attr('value')).select();
//
//     document.execCommand("copy");
//     console.log($(this).attr('value'));
// });
// function copytext(el) {
//     var tmp = $("<textarea>");
//     $("body").append(tmp);
//        console.log(tmp);
//     tmp.val($(el).text()).select();
//     document.execCommand("copy");
//     console.log(tmp.val($(el).text()));
//     tmp.remove();
// }    


//цепляем событие на onclick кнопки
// var button = document.getElementById('userButton');
// button.addEventListener('click', function () {
//   //нашли наш контейнер
//   var ta = document.getElementById('cont'); 
//   //производим его выделение
//   var range = document.createRange();
//
//   range.selectNode(ta); 
//   window.getSelection().addRange(range); 
// 
//   //пытаемся скопировать текст в буфер обмена
//   try { 
//     document.execCommand('copy'); 
//   } catch(err) { 
//     console.log('Can`t copy, boss'); 
//   } 
//   //очистим выделение текста, чтобы пользователь "не парился"
//   window.getSelection().removeAllRanges();
// });

JS;
$this->registerJs($js);
?>

