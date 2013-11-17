<?php
/* @var $this DoingsController */
/* @var $dataProvider CActiveDataProvider */



$this->menu=array(
	array('label'=>'Список действий', 'url'=>array('Index')),
	array('label'=>'Новое действие', 'url'=>array('Create')),
	array('label'=>'Корзина', 'url'=>array('Basket')),
	array('label'=>'Отчеты', 'url'=>array('Reports')),
	// array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Действия</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
