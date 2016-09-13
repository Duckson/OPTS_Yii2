<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Companies */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="companies-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true])->label('Название') ?>
    <?= $form->field($model, 'telephone')->textInput(['maxlength' => true])->label('Телефон') ?>
    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Адрес') ?>
    <?= $form->field($model, 'representative')->textInput(['maxlength' => true])->label('Представитель') ?>
    <?= $form->field($model, 'description')->textInput(['maxlength' => true])->label('Описание') ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
