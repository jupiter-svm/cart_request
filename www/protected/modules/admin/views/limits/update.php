<?php
/* @var $this LimitsController */
/* @var $model Limits */

$this->breadcrumbs=array(
	'Лимиты'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'Список лимитов', 'url'=>array('index')),
	array('label'=>'Создать лимит', 'url'=>array('create')),
	array('label'=>'Просмотр лимита', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление лимитов <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model, 'user_filter'=>$user_filter, 'time_period'=>$time_period)); ?>