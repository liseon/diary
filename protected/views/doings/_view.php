<?php
/* @var $this DoingsController */
/* @var $data Doings */
?>

<div class="view <? echo Reasons::get_type_style($data->reason->type); ?>" id="Dloings_list_<?= $data->id; ?>">
    <div class="right_top">
        <?php echo CHtml::ajaxLink(
            'X',
            CController::createUrl('Doings/Delete2', array('id' => $data->id, 'ajax' => 1)),
            array('replace' => '#Dloings_list_' . $data->id),
            array('confirm' => 'Вы уверены, что хотите удалить эту запись?')
        ); ?>
    </div>


    <b><?php echo CHtml::encode($data->reason->name); ?></b>
    <br/>

    <!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('text')); ?>:</b> -->
    <?php echo CHtml::link(CHtml::encode($data->text), array('update', 'id' => $data->id)); ?>
    <br/>

    <!-- 	<b><?php echo CHtml::encode($data->getAttributeLabel('action_time')); ?>:</b> -->
    <?php echo CHtml::encode($data->action_time); ?>
    <br/>



</div>