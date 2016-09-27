<?php
use yii\helpers\Html;
/* @var $model app\models\PracticeTypes */

$this->title = 'Редактирование типа практики';
$this->params['breadcrumbs'][] = ['label' => 'Список типов практики', 'url' => ['list']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="practice-types-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
