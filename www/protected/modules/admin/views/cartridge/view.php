<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

$this->breadcrumbs=array(
	'Картриджи'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'Список картриджей', 'url'=>array('index')),
        array('label'=>'Изменить информацию', 'url'=>array('update', 'id'=>$model->id)),
        array('label'=>'Добавить картридж', 'url'=>array('create')),
);
?>

<h1>Просмотри информации о картридже №<?php echo $model->id; ?></h1>

<br />
<br />
<br />

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'name',
                'price'=>array(
                    'name'=>'Цена',
                    'value'=>$model->cartridge_price->price
                ),
                'comment',
                'deleted'=>array(
                    'label'=>'Удалён',
                    'name'=>'deleted',
                    'value'=>($model->deleted==0)?"Активен":"Удалён"
                )
	),
)); ?>
