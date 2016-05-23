<?php

namespace app\controllers;

use Yii;
use app\models\HpcAccounts;
use app\models\HpcAccountsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HpcAccountsController implements the CRUD actions for HpcAccounts model.
 */
class HpcAccountsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HpcAccounts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HpcAccountsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HpcAccounts model.
     * @param string $login
     * @param string $machine_name
     * @return mixed
     */
    public function actionView($login, $machine_name)
    {
        return $this->render('view', [
            'model' => $this->findModel($login, $machine_name),
        ]);
    }

    /**
     * Creates a new HpcAccounts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HpcAccounts();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'login' => $model->login, 'machine_name' => $model->machine_name]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing HpcAccounts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $login
     * @param string $machine_name
     * @return mixed
     */
    public function actionUpdate($login, $machine_name)
    {
        $model = $this->findModel($login, $machine_name);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'login' => $model->login, 'machine_name' => $model->machine_name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HpcAccounts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $login
     * @param string $machine_name
     * @return mixed
     */
    public function actionDelete($login, $machine_name)
    {
        $this->findModel($login, $machine_name)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HpcAccounts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $login
     * @param string $machine_name
     * @return HpcAccounts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($login, $machine_name)
    {
        if (($model = HpcAccounts::findOne(['login' => $login, 'machine_name' => $machine_name])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
