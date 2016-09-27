<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ListView;
use yii\widgets\ActiveForm;
/* @var $model app\models\PracticeTypes */

$this->title = 'Список типов практики';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-list">
    <h2><?= Html::encode($this->title) ?></h2>
        <? if (!empty(Yii::$app->getSession()->getFlash('error'))): ?>
            <div class="error-summary"><?= Yii::$app->getSession()->getFlash('error'); ?></div>
        <? endif; ?>
    <div class="practices-search">
        <?php
        $form = ActiveForm::begin([
            'method' => 'get',
            'action' => Url::to(['practices/list'])
        ]);
        ?>
        <div class="flex-row">
            <?= $form->field($searchModel, 'name')->label('Название') ?>

            <?= Html::submitButton('', ['class' => 'btn btn-success glyphicon glyphicon-search btn-submit']) ?>
            <a class="btn btn-default btn-reset" href="<?= Url::canonical() ?>"><span>Сброс</span></a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
    <p>
        <?= Html::a('Создать тип практики', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
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