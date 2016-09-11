<?php
use yii\helpers\Html;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;

$this->title = 'Типы Практик';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-list">
    <h2>Список типов практики</h2>
    <div>
        <? if (!empty(Yii::$app->getSession()->getFlash('error'))): ?>
            <span class="error-summary"><?= Yii::$app->getSession()->getFlash('error'); ?></span><br>
        <? endif; ?>
    </div>
    <div class="practices-search">
        <?php
        $form = ActiveForm::begin();
        $form->method = 'get';
        ?>
        <div class="flex-row">
            <?= $form->field($searchModel, 'name')->label('Название') ?>

            <?= Html::submitButton('', ['class' => 'btn btn-success glyphicon glyphicon-search btn-submit']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <?= ListView::widget([
        'dataProvider' => $practicesProvider,
        'itemView' => '_list',
        'itemOptions' => [
            'tag' => 'div',
            'class' => 'practices-list-item',
        ],
        'options' => [
            'tag' => 'div',
            'class' => 'list-wrapper',
            'id' => 'list-wrapper',
        ],
    ]) ?>
</div>