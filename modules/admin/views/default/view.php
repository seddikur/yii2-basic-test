<?php

use yii\helpers\Html;
use yii\helpers\Url;

/** @var $result */
/** @var $service */
?>
<style>
    /* стили текстового поля */
    #inputText {
        padding: 6px 7px;
        font-size: 15px;
    }
</style>



<div class="row">
    <?php if ($result != null): ?>

            <div id="text1">
                <?php if ($service): ?>
                    <p class="text-center text-primary ">Сервис: <?= $service; ?></p>
                <?php endif; ?>
                <input class="form-control" id="inputText" type="text" value= <?= $result; ?>>
                <?php //$view_password; ?>

            </div>

            <!--            <button click="navigator.clipboard.writeText('Текст')">Скопировать</button>-->
            <!--            <input value=--><? //= $view_password; ?><!-- id="text" type="hidden">-->
            <?= Html::button('copy', [
                'id' => 'copyText',
                'value' => $result,
//            'id' => 'userButton',
                'class' => 'btn btn-info',
//                'data-pjax' => '0',
//                'data-bs-original-title' => 'Copy',
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
console.log(text)
/* вызываем функцию при нажатии на кнопку */
btn.onclick = function() {
    console.log(text)
  text.select();    
  document.execCommand("copy");
}


JS;
$this->registerJs($js, \yii\web\View::POS_END);// !!! обязательно POS_END
?>

