<?php
/* @var $this ReasonsController */
/* @var $model Reasons */

$this->breadcrumbs=array(
	'Список причин'=>array('index'),
	'Создать причину',
);

$this->menu=array(
	array('label'=>'Список причин', 'url'=>array('index')),
	// array('label'=>'Manage Reasons', 'url'=>array('admin')),
);
?>

<h1>Создать причину</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>