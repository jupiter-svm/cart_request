<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

$this->breadcrumbs=array(
	'Картриджи'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'Список картриджей', 'url'=>array('index')),	
	array('label'=>'Просмотр информации', 'url'=>array('view', 'id'=>$model->id)),
        array('label'=>'Добавить картридж', 'url'=>array('create')),
);
?>

<h1>Обновление картриджа №<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model)); ?>