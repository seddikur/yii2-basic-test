<?php

namespace app\modules\admin\controllers;

use app\models\Passwords;
use app\models\Users;
use app\modules\admin\Admin;
use app\modules\admin\services\PasswordEncryption;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /** @var PasswordEncryption */
    protected $passwordEncryption;

    public function __construct(
        string             $id,
        Admin              $module,
        PasswordEncryption $passwordEncryption,
        array              $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->passwordEncryption = $passwordEncryption;
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Страница поля со списком для поиска
     * @return string
     */
    public function actionAjaxSearch()
    {

        return $this->render('ajax-search');
    }

    /**
     * Модальное окно просмотре пароля
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewPassword($id)
    {
        $model = Passwords::find()
            ->where(['id'=>$id])
//            ->andWhere(['user_id'=>\Yii::$app->user->identity->id])
            ->one();
        $view_password = null;
        if ($model){
            $view_password = $this->passwordEncryption->reverseEncryption($model->password);
            $service = $model->service->title;
        }

        return $this->renderAjax('view-password', compact('view_password', 'service'));
    }
}
