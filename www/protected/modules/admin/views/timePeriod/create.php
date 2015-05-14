<?php
/* @var $this TimePeriodController */
/* @var $model TimePeriod */

$this->breadcrumbs=array(
	'Временные интервалы'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список периодов', 'url'=>array('index')),
);
?>

<h1>Создать временной интервал</h1>
<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>