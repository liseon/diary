<?php
/* @var $this ReasonsController */
/* @var $data Reasons */
?>

<div class="view <? echo Reasons::get_type_style($data->type); ?>">

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>-->
	<b><?php echo CHtml::encode(Reasons::get_type($data->type)); ?></b>
	<br />

	<!--<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>-->
	<?php echo CHtml::link(CHtml::encode($data->name), array('update', 'id'=>$data->id)); ?>
	<br />


</div>