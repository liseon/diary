<?php
/* @var $this DoingsController */
/* @var $model Doings */

$this->breadcrumbs=array(
	'Doings'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Doings', 'url'=>array('index')),
	array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Create Doings</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>