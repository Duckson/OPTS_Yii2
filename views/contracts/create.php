<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contracts */

$this->title = 'Создание контракта';
$this->params['breadcrumbs'][] = ['label' => 'Список контрактов', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="companies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'companies' => $companies
    ]) ?>

</div>
