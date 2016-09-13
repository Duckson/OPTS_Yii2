<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */

$this->title = 'Редактирование компании ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Список компаний', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
