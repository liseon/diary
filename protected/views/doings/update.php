<?php
/* @var $this DoingsController */
/* @var $model Doings */

$this->breadcrumbs=array(
	'Doings'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Doings', 'url'=>array('index')),
	array('label'=>'Create Doings', 'url'=>array('create')),
	array('label'=>'View Doings', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Update Doings <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>