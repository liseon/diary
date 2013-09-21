<?php
/* @var $this DoingsController */
/* @var $model Doings */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'doings-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Действия - это Ваша ежедневная деятельность. Постарайтесь выделить основные дела, которые Вы сегодня сделали и разнесите их по правильным категориям!</p>

	<?php echo $form->errorSummary($model); ?>
	
	<div class="row">
	<?php echo $form->labelEx($model,'public_time'); ?>
		<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
			'name' => 'public_time',
			'model' => $model,
			'attribute' => 'public_time',
			'language' => 'ru',
			'options' => array(
				'showAnim' => 'fold',
				),
			'htmlOptions' => array(
			'style' => 'height:20px;'
				),
		));?>
		<?php echo $form->error($model,'public_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'reason_id'); ?>
		<?php echo $form->dropDownList($model,'reason_id', Reasons::get_list()); ?>
		<?php echo $form->error($model,'reason_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'text'); ?>
		<?php echo $form->textField($model,'text',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'text'); ?>
	</div>



	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->