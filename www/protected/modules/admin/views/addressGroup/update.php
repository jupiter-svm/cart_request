<?php
/* @var $this AddressGroupController */
/* @var $model AddressGroup */


$this->menu=array(
	array('label'=>'Список групп', 'url'=>array('index')),
	array('label'=>'Создать группу', 'url'=>array('create')),
	array('label'=>'Просмотр группы', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<h1>Обновление адресной группы <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>