<?php

namespace app\modules\admin\controllers;

use app\models\Constants;
use app\models\extend\UserExtend;
use app\models\GroupPassword;
use app\models\GroupUser;
use app\models\Organizations;
use app\models\OrganizationUser;
use app\models\Passwords;
use app\models\search\UserSearch;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use Yii;
use app\models\forms\UserForm;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
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
                            'actions' => ['index','view','update', 'create', 'delete'],
                            'allow' => true,
//                            'roles' => [Constants::ROLE_ADMIN]

                            'matchCallback' => function () {
                                // Если пользователь имеет полномочия администратора, то правило доступа сработает.
                                return Yii::$app->user->identity->role == Constants::ROLE_ADMIN;
                            },
                            'denyCallback'  => function () {
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
     * Lists all User models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProviderUserSearch = $searchModel->search( $this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProviderUserSearch,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $query = OrganizationUser::find()
            ->where(['user_id' => $id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ]
        ]);
        $query_pass = GroupPassword::find()
            ->where(['user_id' => $id]);
        $dataProviderGroupPassword = new ActiveDataProvider([
            'query' => $query_pass,
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ]
        ]);
        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
            'dataProviderGroupPassword' => $dataProviderGroupPassword
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $modelUserForm = new UserForm();
        $modelUserForm->scenario = 'create-user';

        if ($modelUserForm->load(Yii::$app->request->post()) && $modelUserForm->save()) {
//            $group_user = new  GroupUser();
//            $group_user ->group_id = $modelUserForm->group_id;
//            $group_user ->user_id = $modelUserForm->id;
//            $group_user->save();
            $values = [];
            foreach ($modelUserForm->group_id as $group_id) {
                $values[] = [$modelUserForm->id, $group_id];
            }
            //записываем массив в таблицу GroupUser
            if (! empty($values)) $modelUserForm->getDb()->createCommand()->batchInsert(GroupUser::tableName(), ['user_id', 'group_id'], $values)->execute();
            Yii::$app->getSession()->setFlash('success', 'Пользователь '.$modelUserForm->getFullName().' успешно добавлен');
                return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $modelUserForm,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelUserForm = UserForm::findOne($id);
        $group_user = GroupUser::findAll(['user_id' => $id]);
//        $modelUserForm->group_id =$group_user;
        $modelUserForm->group_id =ArrayHelper::getColumn($group_user, 'group_id',);

//        if ($this->request->isPost && $modelUserForm->load($this->request->post()) && $modelUserForm->save()) {//
        if ($modelUserForm->load(Yii::$app->request->post())) {
            if ($modelUserForm->save()) {
                GroupUser::deleteAll(['user_id' => $id]);
//                $group_user = new  GroupUser();
//                $group_user ->group_id = $modelUserForm->group_id;
//                $group_user ->user_id = $id;
//                $group_user->save();
                $values = [];
                foreach ($modelUserForm->group_id as $group_id) {
                    $values[] = [$id, $group_id];
                }
                //записываем массив в таблицу GroupUser
                if (! empty($values))  \Yii::$app->db->createCommand()->batchInsert(GroupUser::tableName(), ['user_id', 'group_id'], $values)->execute();

//                if (! empty($values)) $modelUserForm->getDb()->createCommand()->batchInsert(GroupUser::tableName(), ['user_id', 'group_id'], $values)->execute();
                \Yii::$app->session->setFlash('success', 'Данные пользователя '.$modelUserForm->first_name.' успешно изменены!');
                return $this->redirect(['index']);
            } else {
                VarDumper::dump($modelUserForm->errors);
            }
        }
        return $this->render('update', [
            'model' => $modelUserForm,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        OrganizationUser::deleteAll(['user_id' => $id]);
        GroupUser::deleteAll(['user_id' => $id]);
        $this->findModel($id)->delete();
        \Yii::$app->session->setFlash('danger', 'Пользователь удален!');
        return $this->redirect(['index']);
    }

    /**
     * Залогинеться под др пользователем
     * @param $id
     * @return false|void
     */
    public function actionLogin_as_user($id)
    {
        $user_to_login = UserExtend::findOne($id);
        if (!$user_to_login->isAdmin()){
            $this->redirect('index');
        }
        if (Yii::$app->user->login($user_to_login, true ? 3600 * 24 * 30 : 0)) {
            $this->redirect('index');
        } else {
            echo "Насяльника, я не смогла авторизоватися";
        }
    }

    /**
     * @param $event_id
     * @return string|\yii\web\Response
     */
    public function actionCreate_org($id)
    {
        $model = new OrganizationUser();
        $model->user_id = $id;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', "Успешно добавлена организация");
            return $this->redirect(['view', 'id' => $model->user_id]);
        }
        return $this->renderAjax('create_org', [
            'model' => $model,
            'organization' => Organizations::find()->asArray()->all(),
        ]);
    }

    /**
     * @param $id
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate_org($id)
    {
        $model = OrganizationUser::findOne($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            \Yii::$app->session->setFlash('success', "Успешно изменена организация");
            return $this->redirect(['view', 'id' => $model->user_id]);
        }

        return $this->renderAjax('update_org', [
            'model' => $model,
            'organization' => Organizations::find()->asArray()->all(),
        ]);
    }

    public function actionDelete_org($id)
    {
        Passwords::deleteAll(['user_id' => $id]);
        $model = OrganizationUser::findOne($id);
        $model->delete();
        \Yii::$app->session->setFlash('danger', 'Организация удалена!');
        return $this->redirect(['view', 'id' => $model->user_id]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Users the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Users::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


}
