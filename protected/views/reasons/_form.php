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

	<p class="note">Составьте Ваш список "причин" к ежедневным действиям!</p>
	<p>
		Причины могут быть 3-ех типов: <br>
		<ul>
			<li><b>Обязанности</b> <br>
			<font class="mini_text">Обязанности перед обществом, семьей, друзьями, работой. Все что Вы делаете под лозунгом "так надо".
			<br>
			Например, если действие "выгулять собаку" Вы делаете из необходимости, то отнесите его к этой категории. Если действие "выгулять собаку" для Вас отдых и вы с радостью этим занимаетесь, то отнесите данное действие к категории <b>Досуг</b>.</font><br>
			</li>
			<li><b>Досуг</b><br>
			<font class="mini_text">Данная категория должна объединять все те действия, которые Вы делаете ради развлечения, отдыха и получения удовольствия.
			<br>
			Например, если Вы катаетесь на велосипеде ради удовольствия, то отнестите данное дейстие к категории <b>Досуг</b>.<br> Если же Вы катаетесь на велосипеде с целью сборсить лишний вес, то такое действие уже относится к <b>Целям</b>.<br>
			</li>
			<li><b>Цель</b> <br>
			<font class="mini_text">Эта категория должна объединять все те действия, которые ведут Вас к заветной мечте.</font></li>
		</ul>
	</p>

	<?php echo $form->errorSummary($model); ?>


	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', Reasons::get_type() ); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->