<?php

use app\models\forms\UserForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use kartik\grid\GridView;
use app\widgets\grid\RoleColumn;
use app\models\Users;
use yii\helpers\ArrayHelper;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h3><?= Html::encode($this->title) ?></h3>

    <?php
    //    d(Yii::$app->user);
    //$userId = Yii::$app->user->id; //id текущего пользователя
    //$userRole = Yii::$app->authManager->getRole('admin');
    //Yii::$app->authManager->assign($userRole, $userId);
    //    $user_to_login = Users::findOne(Yii::$app->user->id);
    //        \yii\helpers\VarDumper::dump( $user_to_login->isAdmin(), 10, true);
//    \yii\helpers\VarDumper::dump((\Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id)));
    if (\Yii::$app->authManager->getAssignment('admin', Yii::$app->user->id)): ?>
        <p>
            <?php echo Html::a('Добавить пользователя', ['create'], ['class' => 'btn btn-outline-success']) ?>
        </p>
    <?php endif; ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'username',
            'last_name',
            'first_name',
            'patronymic',
            'email:email',
            [
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function ($data) {
                    /** @var $data Users */
                    return $data->getStatusName();
                },
            ],
            [
                'format' => 'raw',
                'attribute' => 'group_id',
                'value' => function ($data) {
                    /** @var $data Users */
                    return $data->getGroupName();
                },
            ],
//            'updated_at:date',
            [
                'attribute' => 'role',
                'class' => RoleColumn::class,
                'filter' => ArrayHelper::map(Yii::$app->authManager->getRoles(), 'name', 'description'),
            ],
//            [
//                'class' => \app\components\classes\CustomActionColumnClass::class,
//                'urlCreator' => function ($action, UserForm $model, $id) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
//            ],
            'created_at:date',
            [
                'class' => \app\components\classes\CustomActionColumnClass::class,
                'headerOptions' => ['style' => 'width:10%'],
                'template' => '{login} {view} {update}  {delete}',
//                'urlCreator' => function ($action, $model) {
//                    if ($action === 'view') {
//                        return '/user/login_as_user?id=' . $model->id;
//                    }
//                    return '/user/delete?id=' . $model->id;
//                },
                'buttons' => [
                    'permit' => function ($url, $model) {
                        return Html::a('<i class="bi bi-person-check"></i>', Url::to(['/permit/user/view', 'id' => $model->id]), [
                            'title' => 'Change user role'
                        ]);
                    },
                    'login' => function ($url, $model, $key) {
                        $url = 'login_as_user?id=' . $model->id;
                        return Html::a('<i class="bi bi-box-arrow-in-right "></i>', $url);
                    },
                ],
                'visibleButtons' => [
//                    'view'   => function (Users $user) {
//                        // Нельзя войти под самим собой и под суперадмином
//                        return (int)$user->id !== 1 && (int)$user->id !== (int)Yii::$app->getUser()->getId();
//                    },
//                    'permit' => function (Users $model) {
//                        // @todo жесткая привязка к id, добавить константу SUPERADMIN
//                        return Yii::$app->getUser()->getId() === 1;
//                    },
                    'login' => function (Users $model) {
//                        return Yii::$app->user->identity->role == \app\models\Constants::ROLE_ADMIN;
                        return $model->isAdmin();
                    },
                    'update' => function (Users $model) {
//                    return Yii::$app->getUser()->getId() === 1;
                        return $model->isAdmin();
                    },

                    'delete' => function (Users $model) {
                        // Нельзя удалить admin и себя
                        if (Yii::$app->user->identity->id === $model->id) {
                            return false;
                        }
                        // Удалять может только админ
                        return $model->isAdmin();
                    },
                ]
            ],
        ],
    ]); ?>


</div>
