<?php

use yii\bootstrap5\Html;

/* @var $this \yii\web\View */
/* @var $title string|null надпись на кнопке */

if (empty($title)) {
    $title = 'Изменить';
}
?>
<?= Html::submitButton('<i class="bi bi-floppy"></i> '.$title, [
    'id' => 'btnSubmit',
    'class' => 'btn btn-outline-success'
]) ?>
