<?php

namespace app\modules\admin\controllers;

use app\models\extend\UserExtend;
use app\models\Organizations;
use app\models\OrganizationUser;
use app\models\Passwords;
use app\models\search\UserSearch;
use app\models\Users;
use yii\data\ActiveDataProvider;
use yii\filters\VerbFilter;
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
        $allUserSearch = new UserSearch();
        $dataProviderUserSearch = $allUserSearch->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'allUserSearch' => $allUserSearch,
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
        $query_pass = Passwords::find()
            ->where(['user_id' => $id]);
        $dataProviderPassword = new ActiveDataProvider([
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
            'dataProviderPassword' => $dataProviderPassword
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
            Yii::$app->getSession()->setFlash('success', 'Пользователь успешно добавлен');
                return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $modelUserForm,
        ]);
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
        $model = OrganizationUser::findOne($id);
        $model->delete();
        \Yii::$app->session->setFlash('success', "Успешно удалена организация");
        return $this->redirect(['view', 'id' => $model->user_id]);
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


//        if ($this->request->isPost && $modelUserForm->load($this->request->post()) && $modelUserForm->save()) {//
        if ($modelUserForm->load(Yii::$app->request->post())) {
            if ($modelUserForm->save()) {
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
        $this->findModel($id)->delete();

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
