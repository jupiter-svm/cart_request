<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

$this->breadcrumbs=array(
	'Картриджи'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Обновить страницу', 'url'=>array('index')),
        array('label'=>'Добавить картридж', 'url'=>array('create'))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#cartridge-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление картриджами</h1>

<br />
<br />

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cartridge-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'name',
                'id'=>array(
                    'name'=>'id',
                    'header'=>'Цена',
                    'value'=>'$data->cartridge_price->price',
                    'htmlOptions'=>array('width'=>50)
                ),
                'comment', 
                'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>'($data->deleted==0)?"Активен":"Удалён"',
                    'htmlOptions'=>array('width'=>50),
                    'filter'=>array('0'=>'Активен', '1'=>'Удалён')
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none'),
		),
	),
)); ?>
