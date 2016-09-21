<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ReportSearch extends Students
{
    public $group_name;
    public $faculty_name;
    public $has_app = NULL;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['name', 'group_name', 'faculty_name'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Students::find()->joinWith('group')->joinWith('faculty')->joinWith('studentAppLinks');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'name' => SORT_ASC,
                ],
            ]
        ]);

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'students.name', $this->name])
            ->andFilterWhere(['like', 'student_groups.name', $this->group_name])
            ->andFilterWhere(['like', 'faculties.name', $this->faculty_name]);
        if(!empty($this->has_app)){
            if($this->has_app == 1){
                $query->andFilterWhere(['EXISTS', (StudentAppLink::find()->where(['student_login' => $this->login]))]);
            } else {
                $query->andFilterWhere(['NOT EXISTS', (StudentAppLink::find()->where(['student_login' => $this->login]))]);
            }
        }

        return $dataProvider;
    }
}