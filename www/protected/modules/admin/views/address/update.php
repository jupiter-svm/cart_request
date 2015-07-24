<?php
/* @var $this AddressController */
/* @var $model Address */

$this->menu=array(
	array('label'=>'Список адресов', 'url'=>array('index')),
	array('label'=>'Добавить адрес', 'url'=>array('create')),
	array('label'=>'Просмотр адреса', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление адреса <?php echo $model->id; ?></h1>
<br />
<br />

<?php $this->renderPartial('_form', array('model'=>$model, 'users'=>$users, 'groups'=>$groups)); ?>