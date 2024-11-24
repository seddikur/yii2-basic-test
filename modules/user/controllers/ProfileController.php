<?php

namespace app\modules\user\controllers;

use app\modules\user\models\PasswordChangeForm;
use app\modules\user\models\ProfileUpdateForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\Users;

/**
 * Default controller for the `admin` module
 */
class ProfileController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [
            'model' => $this->findModel(),
        ]);
    }


    public function actionUpdate()
    {
        $user = $this->findModel();
        $model = new ProfileUpdateForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->update()) {
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionPasswordChange()
    {
        $user = $this->findModel();
        $model = new PasswordChangeForm($user);

        if ($model->load(Yii::$app->request->post()) && $model->changePassword()) {
            Yii::$app->getSession()->setFlash('success', 'FLASH_PASSWORD_CHANGE_SUCCESS');
            return $this->redirect(['index']);
        } else {
            return $this->render('password-change', [
                'model' => $model,
            ]);
        }
    }

    /**
     * @return Users the loaded model
     */
    private function findModel()
    {
        return Users::findOne(Yii::$app->user->identity->getId());
    }
}
