<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'Управление',
);

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

<?php echo $test; ?>

<?php echo CHtml::link('Расшеренный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model, 'time_period'=>$time_period, 'users'=>$users
)); ?>
</div><!-- search-form -->

<br />
<br />

<?php
    echo CHtml::form();
    echo CHtml::dropDownList('statusval','0', array('0'=>'Открыта','1'=>'Одобрена','2'=>'Закрыта'));
    echo '&nbsp;';
    echo '&nbsp;';
    echo '&nbsp;';
    echo CHtml::submitButton('Обновить статус', array('name'=>'reqstatus'));
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'request-grid',
        'selectableRows'=>2,
	'dataProvider'=>$model->search(),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn',
                    'id'=>'id'
                ),
                'id'=>array(
                    'name'=>'id',
                    'type'=>'raw',
                    'value'=>'CHtml::link($data->id, "/admin/requestposition/index/id/$data->id")',
                    'headerHtmlOptions'=>array('width'=>40)
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
                'id_user'=>array(
                  'name'=>'id_user',
                  'type'=>'raw',
                  'value'=>'CHtml::link($data->user->surname." ".$data->user->name." ".$data->user->lastname, "/admin/user/view/id/".$data->user->id)',
                  'filter'=>$users
                ),
		'comment',                                  //Сделать вывод только первых двухсот символов
                array(
                    'name'=>'amount',
                    'value'=>'$data->getPositionsCount($data->id)',
                    'headerHtmlOptions'=>array('width'=>25),
                    'filter'=>false
                ),
                'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>'($data->deleted==0)?"Активна":"Удалена"',
                    'headerHtmlOptions'=>array('width'=>55),
                    'filter'=>array('0'=>'Активна','1'=>'Удалена')
                ),
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
                        'template'=>'{update}{view}{print}',
                        'buttons'=>array(
                                'print'=>array(
                                    'label'=>'Вид для печати',
                                    'url'=>'Yii::app()->createUrl("admin/print/request", array("id"=>$data->id))',
                                    'imageUrl'=>Yii::app()->request->baseUrl.'/images/print.png'
                            )
                        )                      
		),
	),
)); 

    echo CHtml::endForm();
?>
