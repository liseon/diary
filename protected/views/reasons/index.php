<?php
/* @var $this ReasonsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Список причин',
);

$this->menu=array(
	array('label'=>'Добавить причину', 'url'=>array('create')),
	// array('label'=>'Manage Reasons', 'url'=>array('admin')),
);
?>

<h1>Список причин</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
