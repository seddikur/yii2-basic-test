<?php

namespace app\modules\admin\controllers;

use app\models\Constants;
use app\models\Passwords;
use app\models\search\PasswordsSearch;
use app\modules\admin\Admin;
use app\modules\profile\services\UserProfileRepository;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\modules\admin\services\PasswordEncryption;

/**
 * PasswordsController implements the CRUD actions for Passwords model.
 */
class PasswordsController extends Controller
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
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view', 'update', 'create', 'view-password'],
                            'allow' => true,
//                            'roles' => [Constants::ROLE_ADMIN]

                            'matchCallback' => function () {
                                // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                                return \Yii::$app->user->identity->role == Constants::ROLE_ADMIN;
                            },
                            'denyCallback' => function () {
                                // Если пользователь не подпадает под все условия, то завершаем работы и выдаем своё сообщение.
                                die('Эта страница доступна только администратору!');
                            },
                        ],

                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Passwords models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PasswordsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Passwords model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Модальное окно просмотре пароля
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionViewPassword($id)
    {
        $model = $this->findModel($id);
        $view_password = null;
        if ($model) {
            $view_password = $this->passwordEncryption->reverseEncryption($model->password);
        }
        return $this->renderAjax('view-password', compact('view_password'));
    }

    /**
     * Creates a new Passwords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Passwords();
//        VarDumper::dump($this->passwordEncryption->decryptingPassword(), 10,true);
//        VarDumper::dump($this->passwordEncryption->reverseEncryption(), 10,true);

        if ($this->request->isPost) {
            $model->sault = \Yii::$app->user->identity->auth_key;
            $model->password = $this->passwordEncryption->decryptingPassword($this->request->post()['Passwords']['password_is_not_decrypted']);
            $model->hash = bin2hex($this->passwordEncryption->randomPseudoBytes());

            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
            if (!$model->save()) {
                echo "MODEL NOT SAVED";
                print_r($model->getAttributes());
                print_r($model->getErrors());
                exit;
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Passwords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Passwords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Passwords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Passwords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Passwords::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
