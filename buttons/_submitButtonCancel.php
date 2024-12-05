<?php

use yii\bootstrap5\Html;

/* @var $this \yii\web\View */
/* @var $title string|null надпись на кнопке */
/* @var $icon string|null иконка на кнопке */

if (empty($title)) {
    $title = 'Отмена';
}
if (empty($icon)) {
    $icon = '<i class="bi bi-chevron-left"></i> ';
}

?>

<?= Html::a($icon.$title, ['index'], [
    'class' => 'btn btn-outline-primary'
]) ?>
