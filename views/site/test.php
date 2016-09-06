<?php
//  view\site\test.php
use yii\grid\GridView;
?>
<h2>Типы практики</h2>
<?= GridView::widget([
    'dataProvider' => $typesProvider,
]) ?>
<h2>Приложения</h2>
<?= GridView::widget([
    'dataProvider' => $appsProvider,
]) ?>
<h2>Компании</h2>
<?= GridView::widget([
    'dataProvider' => $companiesProvider,
]) ?>
<h2>Контракты</h2>
<?= GridView::widget([
    'dataProvider' => $contractsProvider,
]) ?>
<h2>Учебные планы</h2>
<?= GridView::widget([
    'dataProvider' => $curriculaProvider,
]) ?>
<h2>Кафедры</h2>
<?= GridView::widget([
    'dataProvider' => $departmentsProvider,
]) ?>
<h2>Факультеты</h2>
<?= GridView::widget([
    'dataProvider' => $facultiesProvider,
]) ?>
<h2>Студ. группы</h2>
<?= GridView::widget([
    'dataProvider' => $groupsProvider,
]) ?>
<h2>Студенты</h2>
<?= GridView::widget([
    'dataProvider' => $studentsProvider,
]) ?>
