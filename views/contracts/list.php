<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ContractsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список Контрактов';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-list">

    <h2><?= Html::encode($this->title) ?></h2>

    <? if (!empty(Yii::$app->getSession()->getFlash('error'))): ?>
        <div class="error-summary"><?= Yii::$app->getSession()->getFlash('error'); ?></div>
    <? endif; ?>

    <p>
        <?= Html::a('Создать Контракт', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'company_name',
                'value' => 'companies.name',
                'enableSorting' => true,
                'label' => 'Компания',
            ],
            [
                'attribute' => 'start_date',
                'label' => 'Дата подписания',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
