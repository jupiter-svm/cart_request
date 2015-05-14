<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'Управление',
);

//Если нет активных периодов, то нет смысла давать ссылку на создание заявки
if(count($time_period_no_active))
{
    $this->menu=array(
            array('label'=>'Создать заявку', 'url'=>array('create')),
    );
}
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#request-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление заявками</h1>
<br />


<?php echo CHtml::link('Расшеренный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 'time_period'=>$time_period, 'users'=>$users
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'request-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
                'id'=>array(
                    'name'=>'id',
                    'type'=>'raw',
                    'value'=>'CHtml::link($data->id, "/requestposition/index/id/$data->id")',
                    'headerHtmlOptions'=>array('width'=>50)
                ),
		'id_time_period'=>array(
                    'name'=>'id_time_period',
                    'value'=>'$data->time_period->description',
                    'filter'=>$time_period
                ),
		'date_creation'=>array(
                    'name'=>'date_creation',
                    'value'=>'date("j.m.Y H:i", $data->date_creation)',
                    'headerHtmlOptions'=>array('width'=>110)
                ),
		'comment',                                  //Сделать вывод только первых двухсот символов
                'status'=>array(
                  'name'=>'status',
                  'value'=>function($data) {
                                if($data->status=="opened") {
                                    return "Открыта";
                                } else if($data->status=="approved") {
                                    return "Одобрена";
                                } else if($data->status=="closed") {
                                    return "Закрыта";
                                }
                           },
                  'headerHtmlOptions'=>array('width'=>55),
                  'filter'=>array('opened'=>'Отктыра', 'approved'=>'Одобрена', 'closed'=>'Закрыта')
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none'),
                        'template'=>'{view}{update}{print}',
                        'buttons'=>array(
                                'print'=>array(
                                    'label'=>'Вид для печати',
                                    'url'=>'Yii::app()->createUrl("admin/print/request", array("id"=>$data->id))',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/print.png'
                            )
                        )         
		),
	),
)); ?>
