<?php declare(strict_types=1);

namespace app\modules\profile\controllers;

use app\modules\profile\models\UserProfileEditModel;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;

class EditController extends BaseController
{
    /**
     * Render user profile edit page if current user allowed to
     * @param $id
     * @return string
     * @throws ForbiddenHttpException
     * @throws NotFoundHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public function actionIndex($id): string
    {
        $userId = \Yii::$app->user->identity->id;
        $user = $this->findUser($id);

        if (!$this->permissionService->isEmployeeCanEditEmployee($userId, $user)) {
            throw new ForbiddenHttpException('Вы не можете редактировать профиль этого сотрудника');
        }

        $model = \Yii::createObject(UserProfileEditModel::class, [$user]);
        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->noty->info('Данные сотрудника обновлены');
            $this->redirect($this->module->urlHelper->getViewProfileUrl($id));
            return '';
        }

        return $this->render('index', ['model' => $model]);
    }
}
