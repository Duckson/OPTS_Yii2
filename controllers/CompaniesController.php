<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Controller;
use app\models\Companies;
use app\models\CompaniesSearch;
use yii\web\NotFoundHttpException;


class CompaniesController extends Controller
{
    public $layout = "main";

    protected function findModel($id)
    {
        if (($model = Companies::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList()
    {
        $searchModel = new CompaniesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionCreate()
    {
        $model = new Companies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionDelete($id){
        try {
            $this->findModel($id)->delete();
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash('error', 'Ошибка: не удалось удалить запись, возможно, что она уже где-то используется');
        }

        return $this->redirect(['list']);
    }


}
