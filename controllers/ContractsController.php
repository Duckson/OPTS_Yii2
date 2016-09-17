<?php

namespace app\controllers;

use Yii;
use yii\data\ActiveDataProvider;
use yii\db\Exception;
use yii\web\Controller;
use app\models\Contracts;
use app\models\Companies;
use app\models\Applications;
use app\models\ContractsSearch;
use yii\web\NotFoundHttpException;
use yii\helpers\ArrayHelper;


class ContractsController extends Controller
{
    public $layout = "main";

    protected function findModel($id)
    {
        if (($model = Contracts::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function getCompanies(){
        $companies = ArrayHelper::toArray(Companies::find()->orderBy('name')->all(),
            [
                'app\models\Companies' => [
                    'id' => 'id',
                    'name' => 'name'
                ]
            ]);
        return ArrayHelper::map($companies, 'id', 'name');
    }

    public function actionList()
    {
        $searchModel = new ContractsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $query = Applications::find()->where('contract_id=' . $id);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20
            ]
        ]);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionCreate()
    {
        $model = new Contracts();

        $companies = $this->getCompanies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'companies' => $companies,
            ]);
        }
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $companies = $this->getCompanies();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'companies' => $companies,
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
