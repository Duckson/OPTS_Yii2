<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\db\Query;

class ReportSearch extends Students
{
    public $group_name;
    public $faculty_name;
    public $has_apps = Null;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['name', 'group_name', 'faculty_name', 'has_apps'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $sub_query = (new Query())->select('count(student_login) as count, student_login')->from('student_app_link')
            ->leftJoin('applications', 'student_app_link.app_id = applications.id')->where('applications.end_date > CURDATE()')
            ->groupBy('student_login');
        $query = Students::find()->joinWith('group')->joinWith('faculty')->joinWith('studentAppLinks')
            ->leftJoin(['has_apps' => $sub_query], 'has_apps.student_login=students.login');

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


        $dataProvider->sort->attributes['group_name'] = [
            'asc' => ['student_groups.name' => SORT_ASC],
            'desc' => ['student_groups.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['faculty_name'] = [
            'asc' => ['faculties.name' => SORT_ASC],
            'desc' => ['faculties.name' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['company_name'] = [
            'asc' => ['companies.name' => SORT_ASC],
            'desc' => ['companies.name' => SORT_DESC],
        ];
        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'students.name', $this->name])
            ->andFilterWhere(['like', 'student_groups.name', $this->group_name])
            ->andFilterWhere(['like', 'faculties.name', $this->faculty_name]);
        if (!empty($this->has_apps)) {
            if ($this->has_apps == '1') {
                $query->andWhere('has_apps.count>0');
            } elseif ($this->has_apps == '2') {
                $query->andFilterWhere('has_apps.count=0');
            }
        }

        return $dataProvider;
    }
}