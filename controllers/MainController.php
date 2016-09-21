<?php

namespace app\controllers;

use app\models\ReportSearch;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class MainController extends Controller
{
    public $layout = "main";

    public function actionReport()
    {
        $searchModel = new ReportSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);


        return $this->render('report', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
        ]);
    }

}
