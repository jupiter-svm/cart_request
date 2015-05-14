<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */

$this->breadcrumbs=array(
	'Позиции заявки'=>array('index','id'=>$model->id_request),
	'Добавление',
);

$this->menu=array(
	array('label'=>'Список заявок', 'url'=>array('index','id'=>$model->id_request)),
);
?>

<h1>Добавить картридж в заявку №<?php echo $model->id_request ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model, 'active'=>$active,
                                          'state'=>$state, 'cartridges'=>$cartridges, 'addresses'=>$addresses)); ?>