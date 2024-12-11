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

            <div class="col col-lg-4">
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
                    'data-pjax' => '0',
                    'data-bs-original-title' => 'Copy',
//            'onclick' => "copytext('#text1')"
                ]); ?>
                <!--    <input value="Copy" type="button" onclick="document.getElementById('text').select(); document.execCommand('copy');">-->
            </div>


    <?php else: ?>

        <p class="text-center text-danger">
            Пароль отсутствует
        </p>
    <?php endif; ?>

</div>
