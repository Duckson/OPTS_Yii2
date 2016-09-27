<?php

namespace app\controllers;


use yii\web\Controller;
use app\models\StudentGroups;
use app\models\Students;

class AjaxController extends Controller {

    public function actionGetGroups($faculty){
        return  json_encode(StudentGroups::find()->where(['faculty_id' => $faculty])->asArray()->all());
    }

    public function actionGetStudents($group){
        return  json_encode(Students::find()->where(['group_id' => $group])->asArray()->all());
    }
}