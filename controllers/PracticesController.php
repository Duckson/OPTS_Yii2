<?php

namespace app\controllers;

use Yii;
use yii\db\Exception;
use yii\web\Controller;
use app\models\PracticeTypes;
use app\models\PracticeTypesSearch;
use yii\web\NotFoundHttpException;

class PracticesController extends Controller
{
    public $layout = "main";

    protected function findModel($id)
    {
        if (($model = PracticeTypes::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList()
    {
        $searchModel = new PracticeTypesSearch();
        $practicesProvider = $searchModel->search(Yii::$app->request->get());


        return $this->render('list', [
            'practicesProvider' => $practicesProvider,
            'searchModel' => $searchModel,
        ]);
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
