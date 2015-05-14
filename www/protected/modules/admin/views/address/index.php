<?php
/* @var $this AddressController */
/* @var $model Address */

$this->breadcrumbs=array(
	'Адреса'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список адресов', 'url'=>array('index')),
	array('label'=>'Добавить адрес', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#address-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление адресами</h1>

<br />

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'address-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'id_user'=>array(
                    'name'=>'id_user',
                    'value'=>'$data->user->surname." ".$data->user->name." ".$data->user->lastname',
                    'filter'=>$users
                ),
		'address',
		'active'=>array(
                    'name'=>'active',
                    'value'=>'$data->active==1?"Доступен":"Не доступен"',
                    'filter'=>array("0"=>"Не доступен","1"=>"Доступен"),
                    'headerHtmlOptions'=>array('width'=>60)
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
