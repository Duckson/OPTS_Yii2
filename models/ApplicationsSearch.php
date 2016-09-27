<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ApplicationsSearch extends Applications
{
    public $practice_type;
    public $student_names;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['start_date', 'end_date', 'practice_type', 'student_names'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $id)
    {
        $query = Applications::find()->joinWith('practiceType')->joinWith('students')->andWhere(['applications.contract_id' => $id]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $dataProvider->sort->attributes['practice_type'] =  [
            'asc'=>['practice_types.name' => SORT_ASC],
            'desc'=>['practice_types.name' => SORT_DESC],
        ];

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'applications.start_date', $this->start_date])
            ->andFilterWhere(['like', 'applications.end_date', $this->end_date])
            ->andFilterWhere(['like', 'practice_types.name', $this->practice_type])
            ->andFilterWhere(['like', 'students.name', $this->student_names]);

        return $dataProvider;
    }
}