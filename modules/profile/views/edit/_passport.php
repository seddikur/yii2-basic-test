<?php

use kartik\date\DatePicker;
use yii\widgets\MaskedInput;

/** @var \yii\web\View $this */
/** @var \yii\bootstrap5\ActiveForm $form */
/** @var \app\modules\profile\models\UserProfileEditModel $model */

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">Паспорт и иные документы</h4>
    </div>
    <div class="box-body">

        <!-- .splitter -->
        <div class="splitter">
            <div class="label">Паспорт</div>
        </div><!-- /.splitter -->

        <?= $form->field($model->getUsers(), 'passport')->widget(MaskedInput::class, [
            'mask' => '9999 999999',
            'clientOptions' => ['placeholder' => ' '],
        ])->textInput(['placeholder' => 'Например: 0311 123456']) ?>

        <?= $form->field($model->getUsers(), 'passport_issuance_date')->widget(DatePicker::class, [
            'pluginOptions' => [
                'format' => 'dd.mm.yyyy',
                'endDate' => '-1d'
            ],
            'options' => ['placeholder' => 'ДД.ММ.ГГГГ']
        ]); ?>

        <?= $form->field($model->getUsers(), 'passport_subdivision_code')->widget(MaskedInput::class, [
            'mask' => '999-999',
            'clientOptions' => ['placeholder' => ' '],
        ])->textInput(['placeholder' => 'Например: 220-034']) ?>

        <?= $form->field($model->getUsers(), 'passport_issuance_who')
            ->textInput(['placeholder' => 'Например: УВД г. Москвы']) ?>

        <?= $form->field($model->getUsers(), 'passport_birth_place')
            ->textInput(['placeholder' => 'Например: г. Уфа, респ. Башкортостан']) ?>

        <?= $form->field($model->getUsers(), 'passport_registered_address')
            ->textInput(['placeholder' => 'Например: г. Пермь, ул. Мира, д. 2, кв. 11'])?>

        <!-- .splitter -->
        <div class="splitter">
            <div class="label">ИНН</div>
        </div><!-- /.splitter -->


        <?= $form->field($model->getUsers(), 'inn')->widget(MaskedInput::class, [
            'mask' => '999999999999',
        ])->textInput(['placeholder' => 'Например: 123456789123']) ?>

    </div>
</div>
