<?php

use yii\bootstrap4\Html;

/** @var \yii\web\View $this */
/** @var \app\modules\profile\models\UserProfileViewModel $model */
/** @var \app\modules\profile\controllers\ViewController $controller */
$controller = $this->context;
$module = $controller->module;
$urlHelper = $module->urlHelper;
$this->title = $model->getPageTitle();

?>

<!-- .user-profile-view-page -->
<div class="user-profile-view-page">
    <!-- .box -->
    <div class="box">

        <!-- .box-header -->
        <div class="box-header scroller with-border">
            <?php if ($model->isCurrentUserProfile()) : ?>
                <?= Html::a('<i class="bi bi-pencil"></i> Редактировать профиль',
                    $module->urlHelper->getEditProfileUrl($model->getUsers()->id),
                    ['class' => 'btn btn-success btn-sm']) ?>

                <?php
//                echo Html::a('<i class="fa fa-tasks"></i> Мои задачи',
//                    $module->tasksUrlHelper->getTaskIndexUrl(),
//                    ['class' => 'btn btn-default btn-sm']
//                )
                ?>

                <?php
//                echo Html::a('<i class="fa fa-calendar"></i> Мой календарь',
//                    $module->calendarUrlHelper->getMyCalendarUrl(),
//                    ['class' => 'btn btn-default btn-sm']
//                )
                ?>
            <?php else : ?>
                <?php
//                echo Html::a('<i class="fa fa-tasks"></i> <span class="jsMobileProfileTask">Задачи сотрудника</span>',
//                    $module->tasksUrlHelper->getTaskIndexUrl($model->getEmployee()->id),
//                    ['class' => 'btn btn-default btn-sm']
//                )
                ?>

                <?php
//                echo Html::a('<i class="fa fa-calendar"></i> <span class="jsMobileProfileCalendar">Календарь сотрудника</span>',
//                    $module->calendarUrlHelper->getCalendarIndexUrl($model->getEmployee()->id),
//                    ['class' => 'btn btn-default btn-sm']
//                )
                ?>

            <?php endif ?>

        </div><!-- /.box-header -->

        <!-- .box-body -->
        <div class="box-body">
            <!-- .profile-data-wrap -->
            <div class="profile-data-wrap">
                <!-- .profile-image-block -->
                <div class="profile-image-block">
                    <!-- .user-profile-image -->
                    <div class="user-profile-image">
                        <div class="image" style="background-image: url('<?= $model->getAvatarImageUrl() ?>')"></div>
                    </div><!-- /.user-profile-image -->
                </div><!-- /.profile-image-block -->

                <!-- .profile-text-block -->
                <div class="profile-text-block">
                    <!-- .user-profile-name -->
                    <div class="user-profile-name">
                        <h1 class="title"><?= $model->getUsers()->getFullName() ?></h1>
                        <p class="position">
                            <?php //echo $model->getEmployeePositionTitle()
                            ?>
                        </p>
                    </div><!-- /.user-profile-name -->

                    <?php if ($personals = $model->getUserPersonalInformation()) : ?>
                        <!-- .profile-values-section -->
                        <div class="profile-values-section">
                            <h5 class="section-title">Личная информация:</h5>
                            <!-- .section-body -->
                            <div class="section-body">
                                <?php foreach ($personals as $personal) : ?>
                                    <dl>
                                        <dt><?= $personal->getLabelHtml() ?>:</dt>
                                        <dd><?= $personal->getValueHtml() ?></dd>
                                    </dl>
                                <?php endforeach ?>
                            </div><!-- /.section-body -->
                        </div><!-- /.profile-values-section -->
                    <?php endif ?>


                </div><!-- /.profile-text-block -->
            </div><!-- /.profile-data-wrap -->
        </div><!-- /.box-body -->
    </div><!-- /.box -->
</div><!-- /.user-profile-view-page -->


