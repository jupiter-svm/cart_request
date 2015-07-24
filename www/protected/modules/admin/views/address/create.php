<?php
/* @var $this AddressController */
/* @var $model Address */

$this->breadcrumbs=array(
	'Адреса'=>array('index'),
	'Добавить',
);

$this->menu=array(
	array('label'=>'Список адресов', 'url'=>array('index')),
);
?>

<h1>Создание адреса</h1>
<br />
<br />

<?php $this->renderPartial('_form', array('model'=>$model, 'users'=>$users, 'groups'=>$groups)); ?>