<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model \app\models\Service */
/* @var $form yii\widgets\ActiveForm */
?>
<?php

$this->registerJs(
    '$("document").ready(function(){ 
		$("#new_service").on("pjax:end", function() {
			$.pjax.reload({container:"#service-index"});  //Перезагрузка GridView
		});
    });'
);
?>
<div class="new_service">
    <?php Pjax::begin(['id' => 'new_service', 'timeout' => false, 'enablePushState' => false]) ?>
    <?php $form = ActiveForm::begin(['options' => ['data-pjax' => true]]); // important ?>
    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
    <div class="form-group">
        <?= $this->render('@buttons/_submitButtonCreate', ['model' => $model]) ?>
    </div>
    <?php ActiveForm::end(); ?>
    <?php yii\widgets\Pjax::end() ?>

</div>