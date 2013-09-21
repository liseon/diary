<?php
/* @var $this ReasonsController */
/* @var $model Reasons */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reasons-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Составьте Ваш список "причин" к ежедневным действиям!<br>
		Причины могут быть 3-ех типов: <br>
		<ul>
			<li>Обязанности (перед обществом, семьей, друзьями, работой)</li>
			<li>Досуг (Данная категория должна объединять все те действия, которые Вы делаете ради развлечения, отдыха и получения удовольствия)</li>
			<li>Цель (Эта категория должна объединять все те действия, которя ведут Вас к конкретной желаемой цели или мечте.)</li>
		</ul>
		</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'Тип:'); ?>
		<?php echo $form->dropDownList($model,'type', Reasons::get_type() ); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Название:'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->