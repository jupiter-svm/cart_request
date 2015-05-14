<?php
/* @var $this TimePeriodController */
/* @var $model TimePeriod */

$this->breadcrumbs=array(
	'Временные интервалы'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список интервалов', 'url'=>array('index')),
	array('label'=>'Добавить интервал', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#time-period-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление временными периодами</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 'time_period'=>$time_period
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'time-period-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'id'=>array(
                    'header'=>'Описание',
                    'name'=>'id',
                    'value'=>'$data->description',
                    'filter'=>$time_period
                ),
		'date_start',
		'date_end',
		'active'=>array(
                    'name'=>'active',
                    'value'=>'$data->active?"Активен":"Не активен"',
                    'filter'=>array('0'=>'Не активен', '1'=>'Активен'),
                    'headerHtmlOptions'=>array('width'=>70)
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none')
		),
	),
)); ?>
