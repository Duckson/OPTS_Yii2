<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $dataProviderApps yii\data\ActiveDataProvider */
/* @var $searchModelApps app\models\ApplicationsSearch */

$this->title = 'Просмотр контракта';
$this->params['breadcrumbs'][] = ['label' => 'Список контрактов', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
$id = $model->id;
?>
<div class="companies-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить эту компанию?',
                'method' => 'get',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Компания',
                'value' => $model->getCompanies()->one()->name,
            ],
            [
                'label' => 'Дата подписания',
                'value' => $model->start_date,
            ],
            [
                'label' => 'Дата окончания',
                'value' => $model->end_date,
            ],
            [
                'label' => 'Описание',
                'value' => $model->description,
            ],

        ],
    ]) ?>

    <h1>Приложения к данному контракту</h1>
    <? if (!empty(Yii::$app->getSession()->getFlash('error'))): ?>
        <div class="error-summary"><?= Yii::$app->getSession()->getFlash('error'); ?></div>
    <? endif; ?>
    <p>
        <?= Html::a('Создать приложение к данному контракту', ['apps-create?contract_id=' . $model->id], ['class' => 'btn btn-success']) ?>
    </p>
    <?=\yii\grid\GridView::widget([
        'dataProvider' => $dataProviderApps,
        'filterModel' => $searchModelApps,
        'columns' => [
            'start_date',
            'end_date',
            [
                'attribute' => 'practice_type',
                'value' => 'practiceType.name',
                'enableSorting' => true,
                'label' => 'Тип практики',
            ],
            [
                'format' => 'raw',
                'attribute' => 'student_names',
                'value' => function($model, $key, $index, $column){
                    /* @var $model app\models\Applications */
                    /* @var $student app\models\Students */

                    $result = '<ul>';
                    foreach ($model->students as $student){
                        $result .= '<li>' . $student->name . '</li>';
                    }
                    $result .= '</ul>';

                    return $result;
                },
                'label' => 'Студенты',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{apps-edit} {apps-delete}',
                'buttons' => [
                    'apps-edit' => function ($url, $model) {
                        return '<a title="Редактировать" aria-label="Редактировать" href="' . $url . '&contract_id=' . $model->contract->id . '" >
                        <span class="glyphicon glyphicon-pencil"></span></a>';
                    },
                    'apps-delete' => function ($url) {
                        return '<a title="Удалить" aria-label="Удалить" data-confirm="Вы точно хотите удалить данную запись?"
                         href="' . $url . '" data-method="post" data-pjax="0"><span class="glyphicon glyphicon-trash"></span></a>';
                    },
                ],
            ],
        ],
    ])
    ?>

</div>
