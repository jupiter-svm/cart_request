<?php
/* @var $this UserController */
/* @var $model User */
?>

<h1>Восстановление пароля</h1>
<br />

<div class="form">

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>    
    
 
 <?php
    if(Yii::app()->user->hasFlash('error')) {      
 ?>
    <div class="flash-error">
	<?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
    <br />
 <?php
    }
 ?>
    
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>30,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>	

	<div class="row buttons">
		<?php echo CHtml::submitButton('Выслать'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

<br />
<br />

