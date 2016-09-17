<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Companies;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('Дата подписания') ?>
    <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::className(), [
        'language' => 'ru',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('Дата окончания') ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('Описание') ?>
    <?= $form->field($model, 'company_id')->dropDownList($companies, ['prompt'=>'Выберите компанию'])->label('Компания') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
