<?php

namespace app\modules\admin\controllers;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
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

//        if ($this->request->isPost) {
//            if ($modelUserForm->load($this->request->post()) && $modelUserForm->save()) {
//                return $this->redirect(['index']);
//            }
//        }
//        else {
//            $modelUserForm->loadDefaultValues();
//        }

        if ($modelUserForm->load(Yii::$app->request->post()) && $modelUserForm->save()) {
//        if ($modelUserForm->load(Yii::$app->request->post())) {
//            if($modelUserForm->save()){
                return $this->redirect(['index']);
//            }else{
//                VarDumper::dump($modelUserForm->errors);
//            }

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
