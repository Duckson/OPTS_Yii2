<?php

namespace app\controllers;

use app\models\Faculties;
use app\models\PracticeTypes;
use app\models\StudentAppLink;
use app\models\Students;
use Yii;
use yii\db\Exception;
use yii\web\Controller;
use app\models\Contracts;
use app\models\Companies;
use app\models\Applications;
use app\models\ApplicationsSearch;
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


    protected function getCompanies()
    {
        $companies = ArrayHelper::toArray(Companies::find()->orderBy('name')->all(),
            [
                'app\models\Companies' => [
                    'id' => 'id',
                    'name' => 'name'
                ]
            ]);
        return ArrayHelper::map($companies, 'id', 'name');
    }

    protected function getFaculties()
    {
        $faculties = ArrayHelper::toArray(Faculties::find()->orderBy('name')->all(),
            [
                'app\models\Faculties' => [
                    'id' => 'id',
                    'name' => 'name'
                ]
            ]);
        return ArrayHelper::map($faculties, 'id', 'name');
    }

    protected function getPractices()
    {
        $faculties = ArrayHelper::toArray(PracticeTypes::find()->orderBy('name')->all(),
            [
                'app\models\PracticeTypes' => [
                    'id' => 'id',
                    'name' => 'name'
                ]
            ]);
        return ArrayHelper::map($faculties, 'id', 'name');
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
        $searchModelApps = new ApplicationsSearch();
        $dataProviderApps = $searchModelApps->search(Yii::$app->request->queryParams, $id);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'dataProviderApps' => $dataProviderApps,
            'searchModelApps' => $searchModelApps,
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


    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash('error', 'Ошибка: не удалось удалить запись, возможно, что она уже где-то используется');
        }

        return $this->redirect(['list']);
    }

    public function actionAppsDelete($id)
    {
        try {
            $this->findApp($id)->delete();
        } catch (Exception $e) {
            Yii::$app->getSession()->setFlash('error', 'Ошибка: не удалось удалить запись, возможно, что она уже где-то используется');
        }

        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAppsCreate($contract_id)
    {
        $model = new Applications();
        $model->contract_id = $contract_id;

        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($post['students'] as $student) {
                $link = new StudentAppLink();
                $link->app_id = $model->id;
                $link->student_login = $student;
                $link->save();
            }

            return $this->redirect(['view', 'id' => $contract_id]);
        } else {
            $faculties = $this->getFaculties();
            $practices = $this->getPractices();

            return $this->render('appsCreate', [
                'model' => $model,
                'faculties' => $faculties,
                'contract_id' => $contract_id,
                'practices' => $practices
            ]);
        }
    }

    public function actionAppsEdit($id, $contract_id)
    {
        $model = $this->findApp($id);
        $model->contract_id = $contract_id;

        $post = Yii::$app->request->post();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            foreach ($post['students'] as $student) {
                $link = new StudentAppLink();
                $link->app_id = $model->id;
                $link->student_login = $student;
                $link->save();
            }

            return $this->redirect(['view', 'id' => $contract_id]);
        } else {
            $faculties = $this->getFaculties();
            $practices = $this->getPractices();
            $students = ArrayHelper::toArray(Students::find()->joinWith('applications')->joinWith('group')
                ->where(['applications.id' => $model->id])->asArray()->all(),
                [
                    'app\models\Students' => [
                        'id' => 'id',
                        'name' => 'name'
                    ],
                    'app\models\StudentGroups' => [
                        'group' => 'name'
                    ]
                ]);

            return $this->render('appsEdit', [
                'model' => $model,
                'faculties' => $faculties,
                'contract_id' => $contract_id,
                'practices' => $practices,
                'students' => $students
            ]);
        }
    }

    protected function findApp($id)
    {
        if (($model = Applications::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
