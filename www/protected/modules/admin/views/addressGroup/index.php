<?php
/* @var $this AddressGroupController */
/* @var $model AddressGroup */


$this->menu=array(
	array('label'=>'Список адресов', 'url'=>array('/admin/address')),
	array('label'=>'Добавить группу', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#address-group-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление группами адресов</h1>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'address-group-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
                    'name'=>'id',
                    'value'=>'$data->id',
                    'headerHtmlOptions'=>array('width'=>55),
                ),
		'name'=>array(
                    'name'=>'id',
                    'value'=>'$data->name',
                    'headerHtmlOptions'=>array('width'=>350),
                ),
		'description',
		'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>'($data->deleted==0)?"Активна":"Удалена"',
                    'headerHtmlOptions'=>array('width'=>55),
                    'filter'=>array('0'=>'Активна','1'=>'Удалена')
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
