<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\db\Command;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PI;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'index'],
                'rules' => [
		    [
			'allow' => true,
			'actions' => ['login'],
			'roles' => ['?'],
		    ],
                    [
			'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
	$db = Yii::$app->db;
	$unityid = Yii::$app->user->identity->username;
/*
	$cmd = "/usr/bin/whois -h whois.ncsu.edu username $unityid";
	exec("$cmd",$result);
*/
	$result = [];
	$ds = ldap_connect("ldap.ncsu.edu");
	if ($ds) {
	   $r = ldap_bind($ds);
	   $sr = ldap_search($ds, "ou=accounts,dc=ncsu,dc=edu", 
	        		  "uid=$unityid");
	   $result = ldap_get_entries($ds, $sr);
	   ldap_close($ds);
	}
	$sql = 'SELECT p.project_id, p.group_name FROM hpc_projects p, hpc_accounts a WHERE a.login = '."'".$unityid."'".' AND p.user_number = a.user_number ORDER BY p.project_id';

	$projects = $db->createCommand($sql)->queryAll();
	   	
        return $this->render('index', [
	       'result' => $result,
               'projects' => $projects]
	       );
    }

    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }
    	public function actionUser()
	{
		$model = new PI();
		$modelCanSave = false;

		if ($model->load(Yii::$app->request->post())
		   && $model->validate()) {
		      $modelCanSave = true;
		   }

		return $this->render('user', [
		       'model' => $model,
		       'modelCanSave' => $modelCanSave
		       ]);
	}

}
