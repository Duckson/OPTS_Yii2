<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список компаний', 'url' => ['list']];
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
                'label' => 'Название',
                'value' => $model->name,
            ],
            [
                'label' => 'Телефон',
                'value' => $model->telephone,
            ],
            [
                'label' => 'Адрес',
                'value' => $model->address,
            ],
            [
                'label' => 'Представитель',
                'value' => $model->representative,
            ],
            [
                'label' => 'Описание',
                'value' => $model->description,
            ],

        ],
    ]) ?>

</div>
