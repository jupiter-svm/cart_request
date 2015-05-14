<?php
/* @var $this TimePeriodController */
/* @var $model TimePeriod */

$this->breadcrumbs=array(
	'Временные периоды'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновить',
);

$this->menu=array(
	array('label'=>'Список периодов', 'url'=>array('index')),
	array('label'=>'Добавить период', 'url'=>array('create')),
	array('label'=>'Просмотр периода', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление временного периода №<?php echo $model->id; ?></h1>
<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>