<?php
/* @var $this RequestController */
/* @var $model Request */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
    
    <br />
    <br />

	<?php echo $form->errorSummary($model); ?>

        <div class="row">
		<?php echo $form->labelEx($model,'Пометить удалённой'); ?>
		<?php echo $form->dropDownList($model,'id_time_period', $time_period); ?>
		<?php echo $form->error($model,'id_time_period'); ?>
	</div>          
 
	<div class="row">
		<?php echo $form->labelEx($model,'Пометить удалённой'); ?>
		<?php echo $form->dropDownList($model,'deleted', array('0'=>'Доступна', '1'=>'Удалена')); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>     
    
	<div class="row">
		<?php echo $form->labelEx($model,'Изменить статус'); ?>
		<?php echo $form->dropDownList($model,'status', array('opened'=>'Открыта', 'approved'=>'Одобрена', 'closed'=>'Закрыта')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>  
    
        <div class="row">
		<?php echo $form->labelEx($model,'Ответственное лицо'); ?>
		<?php echo $form->textField($model,'person_in_charge', array('size'=>'40')); ?>
		<?php echo $form->error($model,'deleted'); ?>
	</div>    
    
	<div class="row">
		<?php echo $form->labelEx($model,'Комментарий'); ?>
		<?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'comment'); ?>
	</div>

        <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>


<?php $this->endWidget(); ?>

</div><!-- form -->