<?php

/** @var \yii\web\View $this */
/** @var \yii\bootstrap5\ActiveForm $form */
/** @var \app\modules\profile\models\UserProfileEditModel $model */

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">Дополнительно</h4>
    </div>
    <div class="box-body">
        <!-- .change-password-block -->
        <div class="change-password-block">
            <button class="btn btn-link btn-sm"
                    @click.prevent="passwordChanger.activate()"
                    v-if="!passwordChanger || !passwordChanger.active">Сменить пароль
            </button>
            <template v-else>

                <div class="password-message"
                     :class="passwordChanger.message.type"
                     v-if="passwordChanger.message">{{passwordChanger.message.text}}</div>

                <!-- .password-input -->
                <div class="password-input">
                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Текущий пароль</label>
                        <input type="password"
                               v-model="passwordChanger.currentPassword"
                               class="form-control input-sm">
                    </div><!-- /.form-group -->

                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Новый пароль</label>
                        <input type="password"
                               v-model="passwordChanger.newPassword"
                               class="form-control input-sm"
                               title="Новый пароль">
                    </div><!-- /.form-group -->

                    <!-- .form-group -->
                    <div class="form-group">
                        <label>Повторите новый пароль</label>
                        <input type="password"
                               v-model="passwordChanger.newPasswordAgain"
                               class="form-control input-sm"
                               title="Повторите новый пароль">
                    </div><!-- /.form-group -->

                    <!-- .buttons-wrap -->
                    <div class="buttons-wrap">
                        <button class="btn btn-sm btn-primary"
                                @click.prevent="passwordChanger.requestUpdate()">Запросить смену пароля
                        </button>
                    </div><!-- /.buttons-wrap -->
                </div><!-- /.password-input -->
            </template>
        </div><!-- /.change-password-block -->
    </div>
</div>
