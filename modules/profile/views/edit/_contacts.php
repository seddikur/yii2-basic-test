<?php

/** @var \yii\web\View $this */
/** @var \yii\bootstrap5\ActiveForm $form */
/** @var \app\modules\profile\models\UserProfileEditModel $model */

?>

<div class="box box-solid">
    <div class="box-header with-border">
        <h4 class="box-title">Контакты</h4>
    </div>
    <div class="box-body" v-if="contactManager">
        <!-- .contacts-list-wrap -->
        <div class="contacts-list-wrap">
            <div class="contact-item"
                 :class="{'not-saved': !contact.saved, 'with-error': contact.errorMessage.length}"
                 v-for="contact,i in contactManager.contacts">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <select v-model="contact.type"
                                    class="form-control"
                                    @change="contactManager.onContactChanged(contact)"
                                    title="Тип контакта">
                                <option v-for="type in contactManager.availableTypes"
                                        :value="type.id">{{type.title}}
                                </option>
                            </select>
                        </div
                    </div>
                </div>

                <div class="col-sm-8">
                    <div class="form-group" :class="{'has-error': contact.errorMessage.length}">
                        <input type="text"
                               class="form-control"
                               title="Значение"
                               @keyup="contactManager.onContactChanged(contact)"
                               v-model="contact.value">
                        <span class="error-message"
                              v-if="contact.errorMessage">{{contact.errorMessage}}</span>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <input type="text"
                       class="form-control"
                       v-model="contact.note"
                       @keyup="contactManager.onContactChanged(contact)"
                       title="Комментарий к контакту">
            </div>

            <div class="buttons-wrap">
                <button @click.prevent="contactManager.saveContact(contact)"
                        :disabled="!!contact.errorMessage"
                        v-if="!contact.saved"
                        title="Сохранить контакт"
                        class="btn btn-xs btn-default"><i class="fa fa-save"></i> Сохранить изменения
                </button>
                <button @click.prevent="contactManager.deleteContact(i)"
                        title="Удалить контакт"
                        class="btn btn-xs btn-danger"><i class="fa fa-trash"></i> Удалить
                </button>
            </div>

        </div>
    </div><!-- /.contacts-list-wrap -->
    <!-- .buttons-wrap -->
    <div class="buttons-wrap">
        <button @click.prevent="contactManager.addContact()"
                class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Добавить
        </button>
    </div><!-- /.buttons-wrap -->
</div>

<div class="overlay" v-if="!contactManager || !contactManager.active">
    <i class="fa fa-refresh fa-spin"></i>
</div>