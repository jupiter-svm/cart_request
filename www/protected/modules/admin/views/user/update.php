<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->surname.' '.$model->name.' '.$model->lastname=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),	
        array('label'=>'Создать пользователя', 'url'=>array('create')),
);
?>

<h1>Обновление пользователя №<?php echo $model->id; ?></h1>
<br />
<h1><?php echo $model->surname.' '.$model->name.' '.$model->lastname; ?></h1>
<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>