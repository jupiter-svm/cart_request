<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
	<div class="row">
		<?php echo $form->label($model,'id_request'); ?>
		<?php echo $form->textField($model,'id_request'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_cartridge'); ?>
		<?php echo $form->textField($model,'id_cartridge'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'id_address'); ?>
		<?php echo $form->textField($model,'id_address'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'amount'); ?>
		<?php echo $form->textField($model,'amount'); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->