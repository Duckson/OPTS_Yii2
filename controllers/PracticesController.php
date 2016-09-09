<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\PracticeTypes;
use yii\data\ActiveDataProvider;

class PracticesController extends Controller
{
    public $layout = "main";

    public function actionList()
    {
        $practicesProvider = new ActiveDataProvider([
            'query' => PracticeTypes::find(),
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
            ]
        ]);


        return $this->render('list', [
            'practicesProvider' => $practicesProvider,
        ]);
    }

    public function actionDelete($id){
        PracticeTypes::findOne($id)->delete();

        return $this->goBack();
    }


}
