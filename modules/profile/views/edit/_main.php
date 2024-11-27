<?php

use kartik\date\DatePicker;

/** @var \yii\web\View $this */
/** @var \yii\bootstrap5\ActiveForm $form */
/** @var \app\modules\profile\models\UserProfileEditModel $model */

$avatarUrl = $model->getAvatarImageUrl();

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">Основная информация</h4>
    </div>
    <div class="box-body">

        <!-- .avatar-image-block -->
        <div class="avatar-image-block">

            <?php if ($avatarUrl) : ?>
                <!-- .user-avatar-image -->
                <div class="user-avatar-image">
                    <div class="image"
                         data-avatar-image
                         style="background-image: url('<?= $model->getAvatarImageUrl() ?>')"></div>
                    <!-- .image-actions -->
                    <div class="image-actions">
                        <button data-show-image-upload-field
                                class="btn btn-link btn-sm">Сменить фотографию
                        </button>
                    </div><!-- /.image-actions -->
                </div><!-- /.user-avatar-image -->
            <?php endif ?>

            <!-- .image-upload-field -->
            <div class="image-upload-field" <?= $avatarUrl ? 'style="display:none"' : '' ?>
                 data-image-upload-field>
                <?= $form->field($model->getUsers(), 'avatar')
                    ->fileInput()->label('Загрузка изображения профиля') ?>
            </div><!-- /.image-upload-field -->
        </div><!-- /.avatar-image-block -->
        <?= $form->field($model->getUsers(), 'last_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model->getUsers(), 'first_name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model->getUsers(), 'patronymic')->textInput(['maxlength' => true]) ?>
    </div>
</div>
