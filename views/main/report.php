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
                'attribute' => 'login',
                'value' => 'login',
                'visible' => 0,
            ],
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
                'attribute' => 'has_app',
                'value' => function ($model, $key, $index, $column) {
                    /* @var $model app\models\Students */
                        if($model->getApplications()->exists()){
                            return '✓';
                        } else return 'X';
                },
                'enableSorting' => true,
                'label' => 'Проходит ли практику,',
            ],

        ],
    ]); ?>
</div>
