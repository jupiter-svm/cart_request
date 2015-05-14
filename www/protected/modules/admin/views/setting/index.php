<?php
/* @var $this SettingsController */
/* @var $model Setting */
/* @var $form CActiveForm */
?>

<div class="form">
    
<?php if(Yii::app()->user->hasFlash('setting')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('setting'); ?>
</div>
    
<?php endif; ?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'settings-index-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>
        
	<div class="row">		
		<?php echo $form->checkBox($model,'show_header'); ?>
                <?php echo $form->labelEx($model,'show_header', array('class'=>'settings-checkbox')); ?>
		<?php echo $form->error($model,'show_header'); ?>
	</div>
        
        <br />
        
        <div class="row">
		<?php echo $form->labelEx($model,'site_name'); ?>
		<?php echo $form->textField($model,'site_name', array('size'=>'100')); ?>
		<?php echo $form->error($model,'site_name'); ?>
	</div>
        
         <br />
        
        <div class="row">
		<?php echo $form->labelEx($model,'mpage_topic'); ?>
		<?php echo $form->textArea($model,'mpage_topic', array('cols'=>'102', 'rows'=>'10')); ?>
		<?php echo $form->error($model,'mpage_topic'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->