<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'short_name'); ?>
		<?php 
                    if(!$model->isNewRecord)                    
                    {
                        echo $form->textField($model,'short_name',array('size'=>25,'maxlength'=>255)); 
                    }
                    else
                    {
                        echo $form->textField($model,'short_name',array('size'=>25,'maxlength'=>255)); 
                    }
                ?>
		<?php echo $form->error($model,'short_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>25,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>	

	<div class="row">
		<?php echo $form->labelEx($model,'surname'); ?>
		<?php echo $form->textField($model,'surname',array('size'=>35,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'surname'); ?>
	</div>
        
        <div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>35,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'lastname'); ?>
		<?php echo $form->textField($model,'lastname',array('size'=>35,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'lastname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'departament'); ?>
		<?php echo $form->textArea($model,'departament',array('cols'=>56,'rows'=>2)); ?>
		<?php echo $form->error($model,'departament'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'staff_status'); ?>
		<?php echo $form->textField($model,'staff_status',array('size'=>75,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'staff_status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'role'); ?>
		<?php echo $form->dropDownList($model,'role',array("1"=>"Пользователь","2"=>"Администратор")); ?>
		<?php echo $form->error($model,'role'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ban'); ?>
		<?php echo $form->dropDownList($model,'ban', array("0"=>"Нет","1"=>"Да")); ?>
		<?php echo $form->error($model,'ban'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>40,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->