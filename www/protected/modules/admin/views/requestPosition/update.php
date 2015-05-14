<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */

$this->breadcrumbs=array(
	'Позиции заявки'=>array('index','id'=>$model->id_request),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
    array('label'=>'Список позиций', 'url'=>array('index', 'id'=>$model->id_request)),            
    array('label'=>'Просмотр позиции', 'url'=>array('view', 'id'=>$model->id)),
    array('label'=>'Добавить картридж', 'url'=>array('create','id'=>$model->id_request))
);
?>

<h1>Обновление позиции  №<?php echo $model->id; ?> </h1>
<br />
<h3><?php echo 'Название картриджа: '.$model->cartridge->name ?></h3>
<br />

<?php $this->renderPartial('_form_update', array('model'=>$model, 'state'=>$status, 'active'=>$active)); ?>