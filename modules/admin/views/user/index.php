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

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php echo Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'username',
            'last_name',
            'first_name',
            'patronymic',
//            'auth_key',
//            'password_hash',
//            'password_reset_token',
            'email:email',
            [
                'label' => 'status',
                'format' => 'raw',
                'attribute' => 'status',
                'value' => function ($data) {
                    return $data->getStatusName();
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
                'class' => 'yii\grid\ActionColumn',
//                'template' => '{view}&nbsp;&nbsp;{permit}&nbsp;&nbsp;{delete}',
                'template' => '{view} {update} {delete}',
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
                ],
//                'visibleButtons' => [
//                    'view'   => function (Users $user) {
//                        // Нельзя войти под самим собой и под суперадмином
//                        return (int)$user->id !== 1 && (int)$user->id !== (int)Yii::$app->getUser()->getId();
//                    },
//                    'permit' => function (Users $model) {
//                        // @todo жесткая привязка к id, добавить константу SUPERADMIN
//                        return Yii::$app->getUser()->getId() === 1;
//                    },
//                    'delete' => function (Users $model) {
//                        // Нельзя удалить суперадмина и себя
//                        // @todo жесткая привязка к id
//                        if ((int)$model->id === 1 || Yii::$app->getUser()->getId() === $model->id) {
//                            return false;
//                        }
//                        // Удалять может только суперадмин
//                        return Yii::$app->getUser()->getId() === 1;
//                    },
//                ]
            ],
        ],
    ]); ?>


</div>