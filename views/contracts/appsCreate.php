<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $faculties=[] */
/* @var $contract_id=(int) */
/* @var $practices=[] */

$this->title = 'Создание приложения';
$this->params['breadcrumbs'][] = ['label' => 'Список контрактов', 'url' => ['/contracts/list']];
$this->params['breadcrumbs'][] = ['label' => 'Просмотр контракта', 'url' => ['/contracts/' . $contract_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apps-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_appsForm', [
        'model' => $model,
        'faculties' => $faculties,
        'practices' => $practices
    ]); ?>

</div>
