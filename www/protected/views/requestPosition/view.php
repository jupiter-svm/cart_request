<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */

$this->breadcrumbs=array(
	'Позиции заявки'=>array('index','id'=>$model->id_request),
	$model->id,
);


$menuArray=array(
            array('label'=>'Список позиций', 'url'=>array('index', 'id'=>$model->id_request)),            
    );

if($active && $state=='opened') {
    $menuArray[]=array('label'=>'Добавить картридж', 'url'=>array('create','id'=>$model->id_request));
    $menuArray[]=array('label'=>'Обновить позицию', 'url'=>array('update', 'id'=>$model->id));
}

$this->menu=$menuArray;

?>

<h1>Просмотр позиции №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id_request'=>array(
                    'name'=>'ID заявки',
                    'type'=>'raw',
                    'value'=>CHtml::link($model->id_request, "/request/$model->id_request"),
                ),
		'id_cartridge'=>array(
                    'name'=>'Картридж',
                    'value'=>$model->cartridge->name
                ),
                'amount'=>array(
                    'name'=>'amount',
                    'value'=>$model->amount
                ),
                'price',
		'id_address'=>array(
                    'name'=>'Адрес',
                    'value'=>$model->address->address
                ),
		'comment',
	),
)); ?>
