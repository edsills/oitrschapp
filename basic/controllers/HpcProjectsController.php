<?php

namespace app\controllers;

use Yii;
use app\models\HpcProjects;
use app\models\HpcProjectsSearch;
use app\models\HpcUsers;
use app\models\HpcUsersSearch;
use app\models\HpcAccounts;
use app\models\HpcAccountssSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\db\Command;


/**
 * HpcProjectsController implements the CRUD actions for HpcProjects model.
 */
class HpcProjectsController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create', 'manage', 'update', 'delete'],
                'rules' => [
                    [
			'actions' => ['index','view','create','manage'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
		    [
			'actions' => ['update'],
			'allow' => true,
			'roles' => ['admin'],
		    ],
		    [
			'actions' => ['delete'],
			'allow'	  => true,
			'roles'	  => ['admin'],
		    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all HpcProjects models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new HpcProjectsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single HpcProjects model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new HpcProjects model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new HpcProjects();
	$usermodel = new HpcUsers();
	$acctmodel = new HpcAccounts();

        if ($model->load(Yii::$app->request->post()) && $usermodel->load(Yii::$app->request->post()) && $acctmodel->load(Yii::$app->request->post())) {
 	    $userisValid = $usermodel->validate();
	    if ($userisValid) {
	       $userisValid = $usermodel->save();
	    }
	    $projisValid = $model->validate();
	    if ($userisValid && $projisValid) {
	       $projisValid = $model->save();
	    } 
	    $acctisValid = $acctmodel->validate();
	    if ($userisValid && $projisValid && $acctisValid) {
	       $acctisValid = $acctmodel->save();
	    }

	    if ($acctisValid) {
	       return $this->redirect(['view', 'id' => $model->project_id]);
	    } else {
	      $result=[];
              return $this->render('create', [
                'model' => $model,
		'usermodel' => $usermodel,
		'acctmodel' => $acctmodel,
		'result' => $result,
              ]);
	    }
        } else {
	  $db = Yii::$app->db;
	  $unityid = Yii::$app->user->identity->username;

	  $result = [];
	  $acctresult = [];

	  $ds = ldap_connect("ldap.ncsu.edu");
	  if ($ds) {
	     $r = ldap_bind($ds);
	     $sr = ldap_search($ds, "ou=employees,ou=people,dc=ncsu,dc=edu","uid=$unityid");
	     $result = ldap_get_entries($ds, $sr);
	     $sr = ldap_search($ds, "ou=accounts,dc=ncsu,dc=edu","uid=$unityid");
	     $acctresult = ldap_get_entries($ds,$sr);
	     ldap_close($ds);
	  }

          if ($result) {
	     $usermodel->title = $result[0]['personaltitle'][0];
    	     $usermodel->firstname = $result[0]['ncsupreferredgivenname'][0];
    	     $usermodel->middleinitial = $result[0]['ncsupreferredmiddlename'][0];
    	     $usermodel->lastname = $result[0]['ncsupreferredsurname'][0];
	     $model->group_name = strtolower($usermodel->lastname);
    	     $usermodel->position = $result[0]['title'][0];
	     $usermodel->email = $result[0]['ncsuprimaryemail'][0];
	     $usermodel->phone = $result[0]['telephonenumber'][0];
	     $usermodel->department_id = $result[0]['departmentnumber'][0];
	}
	$acctmodel->login = $unityid;
	$acctmodel->machine_name = 'bc01';
	$acctmodel->status = 'R';
	$acctmodel->shell = 'tcsh';
	if ($acctresult) {
	   $acctmodel->user_id = $acctresult[0]['uidnumber'][0];	
	}

	$sql = 'SELECT MAX(user_number) FROM hpc_users';
	$maxval = $db->createCommand($sql)->queryScalar();
	$model->user_number = $maxval + 1;
	$usermodel->user_number = $model->user_number;
	$acctmodel->user_number = $model->user_number;

	$sql = 'SELECT MAX(project_id) FROM hpc_projects';
	$maxval = $db->createCommand($sql)->queryScalar();
	$model->project_id = $maxval + 1;
	$acctmodel->project_id = $model->project_id;

            return $this->render('create', [
                'model' => $model,
		'usermodel' => $usermodel,
		'acctmodel' => $acctmodel,
		'result' => $acctresult,
            ]);
        }
    }

    /**
     * Updates an existing HpcProjects model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->project_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing HpcProjects model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HpcProjects model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HpcProjects the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HpcProjects::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
