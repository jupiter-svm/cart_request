<?php
/* @var $this TimePeriodController */
/* @var $model TimePeriod */
/* @var $form CActiveForm */
?>

<script type="text/javascript">
    $(function() {
       $('#TimePeriod_date_start').datepicker({           
             numberOfMonths: 3, 
             dateFormat: 'yy-mm-dd',
             onSelect: function(dateText, inst) {
                 this.value=this.value+' 00:00:00'
             }
       });
       $('#TimePeriod_date_end').datepicker({
           numberOfMonths: 3,
           dateFormat: 'yy-mm-dd',
           onSelect: function(dateText, inst) {
                 this.value=this.value+' 23:59:59'
             }
       });
    });
</script>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'time-period-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textField($model,'description',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_start'); ?>
		<?php echo $form->textField($model,'date_start'); ?>
		<?php echo $form->error($model,'date_start'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'date_end'); ?>
		<?php echo $form->textField($model,'date_end'); ?>
		<?php echo $form->error($model,'date_end'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'active'); ?>
		<?php echo $form->dropDownList($model,'active', array('0'=>'Не активен','1'=>'Активен')); ?>
		<?php echo $form->error($model,'active'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->