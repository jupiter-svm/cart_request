<?php
/* @var $this AddressGroupController */
/* @var $model AddressGroup */

$this->breadcrumbs=array(
	'Address Groups'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List AddressGroup', 'url'=>array('index')),
	array('label'=>'Manage AddressGroup', 'url'=>array('admin')),
);
?>

<h1>Create AddressGroup</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>