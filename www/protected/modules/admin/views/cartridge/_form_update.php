<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cartridge-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>10000)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>
        
	<div class="row">
		<?php echo $form->labelEx($model->cartridge_price,'price'); ?>
		<?php echo $form->textField($model->cartridge_price,'price'); ?>
		<?php echo $form->error($model->cartridge_price,'price'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'deleted'); ?>
		<?php echo $form->dropDownList($model,'deleted', array('0'=>'Активен', '1'=>'Удалён')); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->