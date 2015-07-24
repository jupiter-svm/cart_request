<?php
/* @var $this LimitsController */
/* @var $model Limits */

$this->menu=array(
	array('label'=>'Список лимитов', 'url'=>array('index')),
	array('label'=>'Создать лимит', 'url'=>array('create')),
	array('label'=>'Копировать лимиты', 'url'=>array('move')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#limits-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление лимитами</h1>

<br />
<br />

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 'user_filter'=>$user_filter, 'time_period'=>$time_period
)); ?>
</div><!-- search-form -->

<br />
<br />

<?php
    echo CHtml::form();
    echo CHtml::dropDownList('statusval','0', array('0'=>'Активен','1'=>'Удалён'));
    echo '&nbsp;';
    echo '&nbsp;';
    echo '&nbsp;';
    echo CHtml::submitButton('Обновить статус', array('name'=>'reqstatus'));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'limits-grid',
        'selectableRows'=>2,
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn',
                    'id'=>'id'
                ),
		'id_user'=>array(
                    'header'=>'Пользователь',
                    'name'=>'id_user',
                    'value'=>'$data->user->surname." ".$data->user->name." ".$data->user->lastname',
                    'filter'=>$user_filter
                ),
		'id_time_period'=>array(
                    'header'=>'Временной интервал',
                    'name'=>'id_time_period',
                    'value'=>'$data->time_period->description',
                    'filter'=>$time_period
                ),
		'limit'=>array(
                    'name'=>'limit',
                    'value'=>'$data->limit',
                    'headerHtmlOptions'=>array('width'=>60)
                ),
		'comment',
                'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>'$data->deleted?"Удалён":"Активен"',
                    'headerHtmlOptions'=>array('width'=>60),
                    'filter'=>array('0'=>'Активен', '1'=>'Удалён')
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none')
		),
	),
)); ?>
