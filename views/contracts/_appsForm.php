<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Companies;

/* @var $this yii\web\View */
/* @var $model app\models\Contracts */
/* @var $form yii\widgets\ActiveForm */
/* @var $faculties=[] */
/* @var $contract_id=(int) */
/* @var $practices=[] */
/* @var $students=[] */

$this->registerJsFile('js/student_select.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
?>

<div class="apps-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="col-sm-6">
        <?= $form->field($model, 'start_date')->widget(\yii\jui\DatePicker::className(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
        ])->label('Дата начала') ?>
        <?= $form->field($model, 'end_date')->widget(\yii\jui\DatePicker::className(), [
            'language' => 'ru',
            'dateFormat' => 'yyyy-MM-dd',
            'options' => ['class' => 'form-control']
        ])->label('Дата окончания') ?>
        <?= $form->field($model, 'practice_type_id')->dropDownList($practices, ['prompt'=>'Выберите тип практики'])->label('Тип практики') ?>
        <?= $form->field($model, 'contract_id')->hiddenInput()->label(false) ?>
    </div>
    <div class="col-sm-6 marg-bottom-20">
        <div class="marg-bottom-20">
            <span class="h3">Добавить студента</span>
        </div>
        <div class="flex-column">
            <div class="padding-none form-group col-sm-6">
                <select class="form-control" id="faculty-select">
                    <option value="0">Выберите факультет</option>
                    <? foreach ($faculties as $key=>$value): ?>
                        <option value="<?= $key ?>"><?= $value ?></option>
                    <? endforeach; ?>
                </select>
            </div>
            <div style="display: none" class="padding-none form-group col-sm-6"
                 id="group-select-div">
                <select class="form-control" id="group-select">
                    <option value="0">Выберите группу</option>
                </select>
            </div>
            <div style="display: none" class="flex-row" id="student-select-div">
                <div class="padding-none form-group col-sm-6">
                    <select class="form-control" id="student-select">
                        <option value="0">Выберите студента</option>
                    </select>
                </div>
                <span class="btn btn-primary" id="student-button">Добавить студента</span>
            </div>
            <br>
        </div>
        <div class="marg-bottom-20">
            <span class="h3">Список студентов</span>
        </div>
        <table id="students-table" class="table table-hover table-condensed table-bordered">
            <tr>
                <th>ФИО</th>
                <th>Группа</th>
                <th class="glyph_td"></th>
            </tr>

            <? if(!$model->isNewRecord): ?>
                <? foreach ($students as $student): ?>
                <tr id="student-tr-<?= $student['login'] ?>">
                    <td><?= $student['name'] ?></td>
                    <td><?= $student['group']['name'] ?></td>
                    <td>
                        <a>
                            <span class="glyphicon glyphicon-trash" onclick="deleteStudent(<?= $student['login'] ?>)"></span>
                        </a>
                    </td>
                    <input type="hidden" name="students[]" value="<?= $student['login'] ?>">
                </tr>
                <? endforeach; ?>
            <? endif; ?>
        </table>
    </div>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
