<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'id'); ?>
		<?php echo $form->textField($model,'id'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Пользователь'); ?>
		<?php echo $form->dropDownList($model,'id_user', $users, array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Временной интервал'); ?>
		<?php echo $form->dropDownList($model,'id_time_period', $time_period, array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Дата создания'); ?>
		<?php echo $form->textField($model,'date_creation'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Удалена'); ?>
		<?php echo $form->dropDownList($model,'deleted', array('0'=>'Активна', '1'=>'Удалена'), array('empty'=>'')); ?>
	</div>
    
	<div class="row">
		<?php echo $form->label($model,'Статус'); ?>
		<?php echo $form->dropDownList($model,'status', array('opened'=>'Открыта', 'approved'=>'Одобрена', 'closed'=>'Закрыта'), array('empty'=>'')); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'Комментарий'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Поиск'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->