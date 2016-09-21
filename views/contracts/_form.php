<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Companies;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
/* @var $companies=[] */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="contracts-flex-row">
    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ])->label('Дата подписания') ?>
    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
        'options' => ['class' => 'form-control']
    ])->label('Дата окончания') ?>
    <?= $form->field($model, 'company_id')->dropDownList($companies, ['prompt'=>'Выберите компанию'])->label('Компания') ?>
    </div>
    <?= $form->field($model, 'description')->textarea(['maxlength' => true])->label('Описание') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
