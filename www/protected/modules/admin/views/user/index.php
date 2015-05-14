<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Управление',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Создать пользователя', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#user-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление пользователями</h1>

<br />


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
		'short_name',		
		'surname',
                'name',
		'lastname',
		'departament',
		'staff_status',
		'role'=>array(
                    'name'=>'role',
                    'value'=>'$data->role==1?"Пользователь":"Админ"',
                    'filter'=>array("1"=>"Пользователь","2"=>"Админ")
                ),
		'ban'=>array(
                    'name'=>'ban',
                    'value'=>'$data->ban?"Не активен":"Активен"',
                    'filter'=>array("0"=>"Активен","1"=>"Не активен")
                ),
		'email'=>array(
                    'name'=>'email',
                    'type'=>'raw',
                    'value'=>'CHtml::mailto($data->email)'
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none')
		),
	),
)); ?>
