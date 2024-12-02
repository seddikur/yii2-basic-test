<?php

use yii\bootstrap4\Html;

?>

<style>
    .search_box {
        position: relative;
    }

    .search_box input[type="text"] {
        display: block;
        width: 100%;
        height: 35px;
        line-height: 35px;
        padding: 0;
        margin: 0;
        border: 1px solid #138496;
        outline: none;
        overflow: hidden;
        border-radius: 4px;
        background-color: rgb(255, 255, 255);
        text-indent: 15px;
        font-size: 14px;
        color: #222;
    }
    .search_box input[type="submit"] {
        display: inline-block;
        width: 17px;
        height: 17px;
        padding: 0;
        margin: 0;
        border: 0;
        outline: 0;
        overflow: hidden;
        text-indent: -999px;
        /*background: url(https://snipp.ru/demo/127/search.png) 0 0 no-repeat;*/
        position: absolute;
        top: 9px;
        right: 16px;
    }
</style>
<!--<div class="search_box">-->
<!--    <form action="">-->
<!--        <input type="text" name="search" id="search" placeholder="Введите город">-->
<!--        <input type="submit">-->
<!---->
<!--    </form>-->
<!--    <div id="search_box-result"></div>-->
<!--</div>-->
<div class="search_box">
    <?php
    echo Html::beginForm();
    echo Html::input('text', 'search', '', [
        'placeholder' => 'Показать пароль по hash',
        'id' => 'search'
    ]);
    //    echo Html::submitButton('<i class="fas fa-search"></i>', ['class' => 'btn btn-sm btn-info']);
    echo Html::endForm();


    ?>
    <div id="search_box-result"></div>
</div>