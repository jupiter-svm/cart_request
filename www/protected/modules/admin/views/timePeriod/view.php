<?php
/* @var $this TimePeriodController */
/* @var $model TimePeriod */

$this->breadcrumbs=array(
	'Временные периоды'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список периодов', 'url'=>array('index')),
	array('label'=>'Добавить период', 'url'=>array('create')),
	array('label'=>'Обновить период', 'url'=>array('update', 'id'=>$model->id)),	
);
?>

<h1>Просмотр периода №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'description',
		'date_start',
		'date_end',
		'active'=>array(
                    'label'=>'Доступность',
                    'name'=>'active',
                    'value'=>$model->active?"Активен":"Не активен"
                ),
	),
)); ?>
