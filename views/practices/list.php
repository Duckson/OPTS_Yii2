<?php
use yii\grid\GridView;
?>

<div class="site-list">
    <h2>Список типов практики</h2>
    <?= GridView::widget([
        'dataProvider' => $practicesProvider,
        'columns' => [
            [
                'attribute' => 'name',
                'label' => 'Название'
            ],
            ['class' => 'yii\grid\ActionColumn',],
        ],
    ]) ?>
</div>