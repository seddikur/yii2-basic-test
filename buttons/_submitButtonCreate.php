<?php

use yii\bootstrap5\Html;

/* @var $this \yii\web\View */
/* @var $title string|null надпись на кнопке */
/* @var $icon string|null иконка на кнопке */

if (empty($title)) {
    $title = 'Добавить';
}
if (empty($icon)) {
    $icon = '<i class="bi bi-plus"></i> ';
}

?>
<?= Html::submitButton($icon.$title, [
    'class' => 'btn btn-outline-success'
]) ?>
