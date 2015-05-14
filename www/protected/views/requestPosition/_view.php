<?php
/* @var $this RequestPositionController */
/* @var $data RequestPosition */
?>

<div class="view">
	
	<b><?php echo CHtml::encode($data->getAttributeLabel('id_request')); ?>:</b>
	<?php echo CHtml::encode($data->id_request); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_cartridge')); ?>:</b>
	<?php echo CHtml::encode($data->id_cartridge); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('id_address')); ?>:</b>
	<?php echo CHtml::encode($data->id_address); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('amount')); ?>:</b>
	<?php echo CHtml::encode($data->amount); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comment')); ?>:</b>
	<?php echo CHtml::encode($data->comment); ?>
	<br />


</div>