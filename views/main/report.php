<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReportSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Отчёт';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="report">

    <h2><?= Html::encode($this->title) ?></h2>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'value' => 'name',
                'label' => 'ФИО',
            ],
            [
                'attribute' => 'group_name',
                'value' => 'group.name',
                'enableSorting' => true,
                'label' => 'Группа',
            ],
            [
                'attribute' => 'faculty_name',
                'value' => 'faculty.name',
                'enableSorting' => true,
                'label' => 'Факультет',
            ],
            [
                'attribute' => 'has_apps',
                'value' => function ($model, $key, $index, $column) {
                    /* @var $model app\models\Students */
                    return $model->getHasApps();
                },
                'enableSorting' => true,
                'label' => 'Проходит ли практику,',
                'filter' => ["1" => "Да", "2" => "Нет"],
            ],
            [
                'format' => 'raw',
                'attribute' => 'companies_name',
                'value' => function ($model, $key, $index, $column) {
                    /* @var $model app\models\Students */
                    /* @var $companies app\models\Companies */

                    $result = '<ul>';
                    foreach ($model->companies as $company) {
                        $result .= '<li>' . $company->name . '</li>';
                    }
                    $result .= '</ul>';

                    return $result;
                },
                'enableSorting' => true,
                'label' => 'Компания',
            ],

        ],
    ]); ?>
</div>
