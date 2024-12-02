<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\widgets\Pjax;
use app\models\OrganizationUser;
use app\models\Passwords;

/** @var yii\web\View $this */
/** @var \app\models\forms\UserForm $model */
/** @var OrganizationUser $dataProvider */
/** @var Passwords $dataProviderPassword */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
    <div class="user-view">

        <h3><?= Html::encode($this->title) ?></h3>

        <?php if (\Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id)): ?>
            <p>
                <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Вы действительно хотите удалить?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?php echo Html::button('Добавить организацию', [
                    'value' => Url::to(['create_org', 'id' => $model->id]),
                    'id' => 'btn-update-org',
                    'class' => 'btn btn-success',
                    'data-pjax' => '0'
                ]); ?>
            </p>
        <?php endif; ?>
        <div class="row">

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Пользователь в системе</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"> Логин:<?= $model->username; ?></li>
                            <li class="list-group-item">E-mail: <?= $model->email; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Личные данные пользователя</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Фамилия: <?= $model->last_name; ?></li>
                            <li class="list-group-item"> Имя: <?= $model->first_name; ?></li>
                            <li class="list-group-item"> Отчество: <?= $model->patronymic; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Информация о пользователе</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Статус: <?= $model->status; ?></li>
                            <li class="list-group-item"> Роль: <?= $model->role; ?></li>
                            <li class="list-group-item">Последний вход с IP: <?= $model->ip; ?></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Организации пользователя
                    </div>
                    <div class="card-body">
                        <?php Pjax::begin(); ?>
                        <?= \kartik\grid\GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                // ['class' => 'yii\grid\SerialColumn'],

                                [
                                    'attribute' => 'organization_id',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /** @var $model OrganizationUser */
                                        $html = HTML::a($model->organization->title, ['organizations/view', 'id' => $model->organization_id]);
                                        return $html;
                                    },
                                ],
                                [
                                    'class' => \yii\grid\ActionColumn::class,
                                    'template' => '{update}    {delete}',
                                    'urlCreator' => function ($action, OrganizationUser $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            return Html::button('<i class="bi bi-pencil text-warning"></i>', [
                                                'value' => Url::to(['update_org', 'id' => $model->id]),
                                                'id' => 'btn-update-org',
                                                'class' => 'btn btn-light',
                                                'data-pjax' => '0'
                                            ]);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="bi bi-trash text-danger"></i>', ['delete_org', 'id' => $model->id],
                                                ['data-confirm' => 'Удалить?', 'data-method' => 'post', 'data-pjax' => '1',]);
                                        },
                                    ]
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        Пароли пользователя
                    </div>
                    <div class="card-body">
                        <?php Pjax::begin(); ?>
                        <?= \kartik\grid\GridView::widget([
                            'dataProvider' => $dataProviderPassword,
                            'columns' => [
                                // ['class' => 'yii\grid\SerialColumn'],

                                [
                                    'attribute' => 'password',
                                    'format' => 'raw',
                                    'value' => function ($model) {
                                        /** @var $model Passwords */
//                                        $html = HTML::a($model->organization->title, ['organizations/view', 'id' => $model->organization_id]);
//                                        return $html;
                                        return $model->password;
                                    },
                                ],
                                [
                                    'class' => \yii\grid\ActionColumn::class,
                                    'template' => '{update}    {delete}',
                                    'urlCreator' => function ($action, Passwords $model, $key, $index, $column) {
                                        return Url::toRoute([$action, 'id' => $model->id]);
                                    },
                                    'buttons' => [
                                        'update' => function ($url, $model, $key) {
                                            return Html::button('<i class="bi bi-pencil text-warning"></i>', [
                                                'value' => Url::to(['update_org', 'id' => $model->id]),
                                                'id' => 'btn-update-org',
                                                'class' => 'btn btn-light',
                                                'data-pjax' => '0'
                                            ]);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="bi bi-trash text-danger"></i>', ['delete_org', 'id' => $model->id],
                                                ['data-confirm' => 'Удалить?', 'data-method' => 'post', 'data-pjax' => '1',]);
                                        },
                                    ]
                                ],
                            ],
                        ]); ?>
                        <?php Pjax::end(); ?>
                    </div>
                </div>
            </div>
        </div>


    </div>
<?php
$script = <<< JS
//функция запуск модального окна по клику кнопки btn-update-org
// модальное лежит в layout/index
    $('button#btn-update-org').click(function(){
    
        console.log('клик');
        var container = $('#modalContent');
        container.html('Загрузка данных...');
        $('#mainModal').modal('show')
            .find('#modalContent')
            .load($(this).attr('value'));
    });

JS;
$this->registerJs($script);
?>