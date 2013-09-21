<?php
/* @var $this DoingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Действия',
);

$this->menu=array(
	array('label'=>'Список действий', 'url'=>array('index')),
	array('label'=>'Новое действие', 'url'=>array('create')),
	array('label'=>'Корзина', 'url'=>array('basket')),
	// array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Действия</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
