<?php
/* @var $this AddressController */
/* @var $model Address */

$this->breadcrumbs=array(
	'Адреса'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список адресов', 'url'=>array('index')),
	array('label'=>'Добавить адрес', 'url'=>array('create')),
	array('label'=>'Обновить адрес', 'url'=>array('update', 'id'=>$model->id)),	
);
?>

<h1>Просмотр адреса №<?php echo $model->id; ?></h1>
<br />


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user'=>array(
                    'name'=>'id_user',
                    'value'=>$model->user->surname.' '.$model->user->name.' '.$model->user->lastname
                ),
		'address',
		'active'=>array(
                    'name'=>'active',
                    'value'=>$model->active==1?"Доступно":"Не доступно"
                ),
	),
)); ?>
