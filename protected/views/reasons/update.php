<?php
/* @var $this ReasonsController */
/* @var $model Reasons */

$this->breadcrumbs=array(
	'Список причин'=>array('index'),
	'Редактировать',
);

$this->menu=array(
	array('label'=>'Список причин', 'url'=>array('index')),
	array('label'=>'Добавить причину', 'url'=>array('create')),
	// array('label'=>'View Reasons', 'url'=>array('view', 'id'=>$model->id)),
	// array('label'=>'Manage Reasons', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>