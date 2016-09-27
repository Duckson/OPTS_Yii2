<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="margin-5">
    <div class="pull-right height-100">
        <a href="<?= Url::toRoute(['/practices/update/', 'id' => $model->id]) ?>" aria-label="Update">
            <span class="glyphicon glyphicon-pencil"></span>
        </a>
        <a href="<?= Url::toRoute(['/practices/delete/', 'id' => $model->id]) ?>" aria-label="Delete" data-confirm="Ya sure??">
            <span class="glyphicon glyphicon-trash"></span>
        </a>
    </div>
    <?= Html::encode($model->name) ?>
</div>