<?php

/* @var $this yii\web\View */
/* @var $model mixed */
?>
<?php if ($model->isNewRecord): ?>

        <?= $this->render('@buttons/_submitButtonCancel') ?>
        <?= $this->render('@buttons/_submitButtonSave') ?>

<?php else: ?>

        <?= $this->render('@buttons/_submitButtonCancel') ?>
        <?= $this->render('@buttons/_submitButtonUpdate') ?>

<?php endif; ?>
