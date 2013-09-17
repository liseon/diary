<?php
/* @var $this SiteController */
/* @var $model RegistrationForm */
/* @var $form CActiveForm */

$this->pageTitle=Yii::app()->name . ' - Регистрация';
$this->breadcrumbs=array(
	'Регистрация',
);
?>

<h1>Регистрация</h1>

<?php if(Yii::app()->user->hasFlash('registration')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('registration'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">Все поля обязательные!</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Ваш логин:'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ваш email:'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Пароль:'); ?>
		<?php echo $form->PasswordField($model,'password',array('type'=>'password')); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Подтвердите пароль:'); ?>
		<?php echo $form->PasswordField($model,'password_confirm',array('type'=>'password')); ?>
		<?php echo $form->error($model,'password_confirm'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Отправить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>