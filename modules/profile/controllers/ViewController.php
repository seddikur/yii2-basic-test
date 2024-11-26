<?php

namespace app\modules\profile\controllers;

use app\modules\profile\models\UserProfileViewModel;


class ViewController extends BaseController
{
    /**
     * Renders user profile view page
     * @param int $id
     * @return string
     * @throws \yii\web\NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex(int $id = null): string
    {
        $viewerId = \Yii::$app->user->identity->id;
        $targetUsersId = $id ?: $viewerId;
        $targetUsers = $this->findUser($targetUsersId);

        $model = \Yii::createObject(UserProfileViewModel::class, [$viewerId, $targetUsers]);
        return $this->render('index', ['model' => $model,]);
    }
}
