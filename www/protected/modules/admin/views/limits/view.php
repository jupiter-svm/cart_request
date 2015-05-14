<?php
/* @var $this LimitsController */
/* @var $model Limits */

$this->breadcrumbs=array(
	'Лимиты'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'Список лимитов', 'url'=>array('index')),
	array('label'=>'Создать лимит', 'url'=>array('create')),
	array('label'=>'Обновить лимит', 'url'=>array('update', 'id'=>$model->id))	
);
?>

<h1>Просмотр лимитов №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_user'=>array(
                    'label'=>'Пользователь',
                    'name'=>'id_user',
                    'value'=>$model->user->surname.' '.$model->user->name.' '.$model->user->lastname
                ),
		'id_time_period'=>array(
                    'label'=>'Временной период',
                    'name'=>'id_time_period',
                    'value'=>$model->time_period->description
                ),
		'limit',
		'comment',
                'deleted'=>array(
                    'label'=>'Доступность',
                    'name'=>'deleted',
                    'value'=>$model->deleted?"Удалено":"Активно"
                )
	),
)); ?>
