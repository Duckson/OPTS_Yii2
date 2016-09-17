<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список контрактов';
$this->params['breadcrumbs'][] = ['label' => 'Список контрактов', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
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
    <?=\yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
    ])
    ?>

</div>
