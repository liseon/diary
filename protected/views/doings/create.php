<?php
/* @var $this DoingsController */
/* @var $model Doings */

$this->breadcrumbs=array(
	'Действия'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список действий', 'url'=>array('index')),
	array('label'=>'Новое действие', 'url'=>array('create')),
	array('label'=>'Корзина', 'url'=>array('basket')),
);
?>

<h1>Создать действие</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>