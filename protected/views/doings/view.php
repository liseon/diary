<?php
/* @var $this DoingsController */
/* @var $model Doings */

$this->breadcrumbs=array(
	'Doings'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Doings', 'url'=>array('index')),
	array('label'=>'Create Doings', 'url'=>array('create')),
	array('label'=>'Update Doings', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Doings', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>View Doings #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'reason_id',
		'text',
	),
)); ?>
