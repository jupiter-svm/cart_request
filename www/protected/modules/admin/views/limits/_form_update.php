<?php
/* @var $this LimitsController */
/* @var $model Limits */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'limits-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Пользователь'); ?>
		<?php echo $form->dropDownList($model,'id_user', $user_filter); ?>
		<?php echo $form->error($model,'id_user'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Временной интервал'); ?>
		<?php echo $form->dropDownList($model,'id_time_period', $time_period); ?>
		<?php echo $form->error($model,'id_time_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'limit'); ?>
		<?php echo $form->textField($model,'limit'); ?>
		<?php echo $form->error($model,'limit'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->dropDownList($model,'deleted', array('0'=>'Активен', '1'=>'Удалён')); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>1000)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->