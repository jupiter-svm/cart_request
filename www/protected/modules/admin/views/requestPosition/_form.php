<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'request-position-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Поля со <span class="required">*</span> обязательны</p>

	<?php echo $form->errorSummary($model); ?>
	
        <div class="row">
                <?php echo $form->labelEx($model,'Картридж'); ?>
                <?php echo $form->dropDownList($model,'id_cartridge', $cartridges); ?>
                <?php echo $form->error($model,'id_cartridge'); ?>
        </div>

        <div class="row">
                <?php echo $form->labelEx($model,'Адрес'); ?>
                <!-- Должно передаваться через контроллер. Оптимизировать в будущем -->
                <?php echo $form->dropDownList($model,'id_address', $addresses); ?> 
                <?php echo $form->error($model,'id_address'); ?>
        </div>  

        <div class="row">
                <?php echo $form->labelEx($model,'amount'); ?>
                <?php echo $form->textField($model,'amount',$model->amount); ?>
                <?php echo $form->error($model,'amount'); ?>
        </div>       

        <div class="row">
                <?php echo $form->labelEx($model,'comment'); ?>
                <?php echo $form->textArea($model,'comment',array('rows'=>6, 'cols'=>50)); ?>
                <?php echo $form->error($model,'comment'); ?>
        </div>

        <div class="row buttons">
                <?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
        </div>                

<?php $this->endWidget(); ?>

</div><!-- form -->