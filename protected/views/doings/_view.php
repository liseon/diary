<?php
/* @var $this DoingsController */
/* @var $data Doings */
?>

<div class="view <? echo Reasons::get_type_style($data->reason->type); ?>" id="Dloings_list_<?=$data->id;?>">


<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('reason_id')); ?>:</b> -->
	<?php echo CHtml::encode($data->reason_id); ?>
	<br />

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b> -->
	<?php echo CHtml::link(CHtml::encode($data->text), array('update', 'id'=>$data->id)); ?>
	<br />

<!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('public_time')); ?>:</b> -->
	<?php echo CHtml::encode($data->public_time); ?>
	<br />

	<?php echo CHtml::ajaxLink('Del', CController::createUrl('doings/delete2', array('id'=>$data->id,'ajax'=>1)), array('replace'=>'#Dloings_list_'. $data->id )); ?>

</div>