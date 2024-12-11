<?php

namespace app\modules\admin\controllers;

use app\models\GroupUser;
use app\models\Passwords;
use app\models\Users;
use app\modules\admin\Admin;
use app\modules\admin\services\PasswordEncryption;
use yii\helpers\VarDumper;
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
     * Результаты поиска по каталогу товаров
     */
    public function actionSearch()
    {
        $result = '';
        $service = '';
        if (!empty(\Yii::$app->request->get('query'))) {


            $search = \Yii::$app->request->get('query');
            $password = \app\models\Passwords::findOne(['hash' => $search]);
            $user_group = GroupUser::findOne(['user_id' => \Yii::$app->user->id]);
            $password_group = \app\models\GroupPassword::findOne(['password_id' => $password->id]);

            if (\Yii::$app->user->identity->isAdmin()) {
                $result = $this->passwordEncryption->reverseEncryption($password['password']);

                $service = $password->service->title;
            } else {
                if ($user_group->group_id == $password_group->group_id) {
                    $result = $this->passwordEncryption->reverseEncryption($password['password']);
                    $service = $password->service->title;

                } else {
                    $result = null;
                }

            }
        }
//        VarDumper::dump($result['hash'],10,true);

        return $this->render(
            '_search',
            compact('result','service')
        );
    }

    /**
     * Страница поля со списком для поиска
     * @return string
     */
    public function actionAjaxSearch()
    {
        $this->layout = 'password';
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
            ->where(['id' => $id])
//            ->andWhere(['user_id'=>\Yii::$app->user->identity->id])
            ->one();
        $view_password = null;
        if ($model) {
            $view_password = $this->passwordEncryption->reverseEncryption($model->password);
            $service = $model->service->title;
        }

        return $this->renderAjax('view-password', compact('view_password', 'service'));
    }
}
