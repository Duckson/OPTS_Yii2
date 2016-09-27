<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

class ContractsSearch extends Contracts
{
    public $company_name;

    public function rules()
    {
        // only fields in rules() are searchable
        return [
            [['company_name', 'start_date'], 'safe'],
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Contracts::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        $dataProvider->sort->attributes['company_name'] =  [
            'asc'=>['companies.name' => SORT_ASC],
            'desc'=>['companies.name' => SORT_DESC],
        ];

        // load the search form data and validate
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // adjust the query by adding the filters
        $query->andFilterWhere(['like', 'companies.name', $this->company_name])
            ->andFilterWhere(['like', 'contracts.start_date', $this->start_date]);

        return $dataProvider;
    }
}