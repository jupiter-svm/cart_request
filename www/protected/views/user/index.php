<?php
/* @var $this UserController */

$this->breadcrumbs=array(
	'Обновление учётных данных',
);
?>
<h1>Обновление информации о пользователе <?php Yii::app()->user->name ?></h1>

<p>

<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'user-index-form',
// Please note: When you enable ajax validation, make sure the corresponding
// controller action is handling ajax validation correctly.
// See class documentation of CActiveForm for details on this,
// you need to use the performAjaxValidation()-method described there.
'enableAjaxValidation'=>false,
)); ?>

<p class="note">Поля со <span class="required">*</span> обязательны</p>

<?php echo $form->errorSummary($model); ?>

<div class="row">
    <?php echo $form->labelEx($model,'short_name'); ?>
    <?php echo $form->textField($model,'short_name', array('readonly'=>'true')); ?>
    <?php echo $form->error($model,'short_name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'password'); ?>
    <?php echo $form->passwordField($model,'password'); ?>
    <?php echo $form->error($model,'password'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'name'); ?>
    <?php echo $form->textField($model,'name', array('size'=>'30')); ?>
    <?php echo $form->error($model,'name'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'surname'); ?>
    <?php echo $form->textField($model,'surname', array('size'=>'30')); ?>
    <?php echo $form->error($model,'surname'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'lastname'); ?>
    <?php echo $form->textField($model,'lastname', array('size'=>'30')); ?>
    <?php echo $form->error($model,'lastname'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'departament'); ?>
    <?php echo $form->textField($model,'departament', array('size'=>'50')); ?>
    <?php echo $form->error($model,'departament'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'staff_status'); ?>
    <?php echo $form->textField($model,'staff_status', array('size'=>'50')); ?>
    <?php echo $form->error($model,'staff_status'); ?>
</div>

<div class="row">
    <?php echo $form->labelEx($model,'email'); ?>
    <?php echo $form->textField($model,'email', array('size'=>'40')); ?>
    <?php echo $form->error($model,'email'); ?>
</div>

<div class="row buttons">
    <?php echo CHtml::submitButton('Обновить'); ?>
</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
    
</p>
