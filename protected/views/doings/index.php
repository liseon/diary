<?php
/* @var $this DoingsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Doings',
);

$this->menu=array(
	array('label'=>'Create Doings', 'url'=>array('create')),
	array('label'=>'Manage Doings', 'url'=>array('admin')),
);
?>

<h1>Doings</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
