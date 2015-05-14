<?php
/* @var $this LimitsController */
/* @var $model Limits */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>	

	<div class="row">
		<?php echo $form->label($model,'Пользователь'); ?>
		<?php echo $form->dropDownList($model,'id_user', $user_filter, array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Временной инртервал'); ?>
		<?php echo $form->textField($model,'id_time_period'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'limit'); ?>
		<?php echo $form->textField($model,'limit'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'comment'); ?>
		<?php echo $form->textField($model,'comment',array('size'=>60,'maxlength'=>1000)); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'deleted'); ?>
		<?php echo $form->dropDownList($model,'deleted',array('0'=>'Активен', '1'=>'Удалён'), array('empty'=>'')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->