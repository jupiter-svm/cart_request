<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

$this->breadcrumbs=array(
	'Список картриджей'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список картриджей', 'url'=>array('index')),
);
?>

<h1>Добавить картридж</h1>
<br />

<?php if(Yii::app()->user->hasFlash('cartridge_update')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('cartridge_update'); ?>
</div>
<?php endif; ?>

<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>