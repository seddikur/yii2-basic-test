<?php


//use UserProfileEditAsset;
use app\modules\profile\Module;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

/** @var \yii\web\View $this */
/** @var \app\modules\profile\models\UserProfileEditModel $model */

/** @var \app\modules\profile\controllers\EditController $controller */
$controller = $this->context;
/** @var Module $module */
$module = $controller->module;
/** @var \app\modules\profile\helpers\UserProfileUrlHelper $urlHelper */
$urlHelper = $module->urlHelper;
$this->title = 'Редактирование моего профиля';

//UserProfileEditAsset::register($this);

?>

<!-- .user-profile-edit-page -->
<div class="user-profile-edit-page" data-employee-profile-edit="<?= $model->getUsers()->id ?>">
    <?php $form = ActiveForm::begin([
        'id' => 'user-profile-edit-form',
        'options' => [
            'enctype' => 'multipart/form-data',
            'class' => 'form-group form-group-sm'
        ],
    ]) ?>
    <!-- .box -->
    <div class="box">
        <!-- .box-header -->
        <div class="box-header scroller with-border">
            <?= Html::a('<i class="fa fa-chevron-left"></i>',
                $urlHelper->getViewProfileUrl($model->getUsers()->id),
                ['class' => 'btn btn-default btn-sm']) ?>
            <?= Html::submitButton(
                '<i class="fa fa-save"></i> <span class="hidden-sm hidden-xs">Сохранить</span>',
                ['class' => 'btn btn-primary btn-sm']) ?>
        </div><!-- /.box-header -->
    </div><!-- /.box -->

    <!-- .row -->
    <div class="row">
        <div class="col-sm-6 col-md-4">
            <?php echo $this->render('_main', ['form' => $form, 'model' => $model]) ?>
            <?php echo $this->render('_extra', ['form' => $form, 'model' => $model]) ?>
        </div>
        <div class="col-sm-6 col-md-4">
            <?php // $this->render('_passport', ['form' => $form, 'model' => $model]) ?>
        </div>
        <div class="col-sm-6 col-md-4">
            <?php // $this->render('_contacts', ['form' => $form, 'model' => $model]) ?>
        </div>
    </div><!-- /.row -->

    <?php ActiveForm::end() ?>
</div><!-- /.user-profile-edit-page -->
