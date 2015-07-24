<?php
/* @var $this AddressGroupController */
/* @var $model AddressGroup */

$this->menu=array(
	array('label'=>'Список групп', 'url'=>array('index')),
	array('label'=>'Создать группу', 'url'=>array('create')),
	array('label'=>'Обновить группу', 'url'=>array('update', 'id'=>$model->id)),	
);
?>

<h1>Просмотр адресной группы #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>($model->deleted==0)?"Активна":"Удалена"
                ),
	),
)); ?>
