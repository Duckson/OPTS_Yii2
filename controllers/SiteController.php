<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Applications;
use app\models\Companies;
use app\models\Contracts;
use app\models\Curricula;
use app\models\Departments;
use app\models\Faculties;
use app\models\StudentGroups;
use app\models\Students;
use app\models\PracticeTypes;

class SiteController extends Controller
{
    public $layout = "main";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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

    /**
     * @inheritdoc
     */
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

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        $typesProvider = new ActiveDataProvider([
            'query' => PracticeTypes::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $appsProvider = new ActiveDataProvider([
            'query' => Applications::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $companiesProvider = new ActiveDataProvider([
            'query' => Companies::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $contractsProvider = new ActiveDataProvider([
            'query' => Contracts::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $curriculaProvider = new ActiveDataProvider([
            'query' => Curricula::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $departmentsProvider = new ActiveDataProvider([
            'query' => Departments::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $facultiesProvider = new ActiveDataProvider([
            'query' => Faculties::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $groupsProvider = new ActiveDataProvider([
            'query' => StudentGroups::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $studentsProvider = new ActiveDataProvider([
            'query' => Students::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $this->render('test', [
            'typesProvider' => $typesProvider,
            'appsProvider' => $appsProvider,
            'companiesProvider' => $companiesProvider,
            'contractsProvider' => $contractsProvider,
            'curriculaProvider' => $curriculaProvider,
            'departmentsProvider' => $departmentsProvider,
            'facultiesProvider' => $facultiesProvider,
            'groupsProvider' => $groupsProvider,
            'studentsProvider' => $studentsProvider
        ]);
    }


    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
