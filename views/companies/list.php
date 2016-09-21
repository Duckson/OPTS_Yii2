<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CompaniesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Список компаний';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-list">

    <h2><?= Html::encode($this->title) ?></h2>

    <? if (!empty(Yii::$app->getSession()->getFlash('error'))): ?>
        <div class="error-summary"><?= Yii::$app->getSession()->getFlash('error'); ?></div>
    <? endif; ?>

    <p>
        <?= Html::a('Создать Компанию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Название',
            ],
            [
                'attribute' => 'telephone',
                'label' => 'Телефон',
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
