<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */

$this->breadcrumbs=array(
	'Позиции заявки'=>array('index'=>$model->id_request),
	'Управление',
);    
            

$this->menu=array(
    array('label'=>'Список заявок', 'url'=>array('index')),
    array('label'=>'Добавить картридж', 'url'=>array('create','id'=>$model->id_request))
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#request-position-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление позициями заявки №<?php echo $model->id_request; ?></h1>
<h3>Пользователь: <?php echo $model->request->user->surname.' '.$model->request->user->name.' '.$model->request->user->lastname; ?></h3>

<h4>Статус заявки:
    <b>
    <?php
        $req_status='';
        //Вывожу статус заявки
        switch($state)
        {
            case 'opened': echo '<span id="stat-opened">Открыта</span>'; break;
            case 'approved': echo '<span id="stat-approved">Одобрена</span>'; break;
            case 'closed': echo '<span id="stat-closed">Закрыта</span>'; break;
        }        
    ?>
    </b>
</h4>
<h4>
    Статус временного интервала:
    <b> 
    <?php 
        //Вывожу статус временного периода
        switch($active)
        {
            case 0: echo '<span id="stat-closed">Закрыт</span>'; break;
            case 1: echo '<span id="stat-opened">Открыт</span>'; break;
        }
    ?>
    </b>
</h4>


<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<br />
<br />

<?php 
           
      echo CHtml::form();
      echo CHtml::submitButton('Удалить', array('name'=>'delete'));           

      $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'request-position-grid',
        'selectableRows'=>2,
	'dataProvider'=>$model->search($id),
        'template'=>'{summary}{pager}{items}{pager}',
	'filter'=>$model,
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn',
                    'id'=>'id_cartridge'
                ),
		'id_cartridge'=>array(
                    'header'=>'Картридж',
                    'name'=>'id_cartridge',
                    'value'=>'$data->cartridge->name'
                ),                
                'amount'=>array(
                    'name'=>'amount',
                    'value'=>'$data->amount'
                ),
                'price'=>array(
                    'header'=>'Цена',
                    'name'=>'price',
                    'value'=>'$data->price',
                    'filter'=>false
                ),
                'id'=>array(
                    'header'=>'Стоимость',
                    'name'=>'price',
                    'value'=>'$data->amount*$data->price',
                    'filter'=>false
                ),
		'id_address'=>array(
                    'header'=>'Адрес',
                    'name'=>'id_address',
                    'value'=>'$data->address->address'
                ),
		'comment',
                'deleted'=>array(
                    'name'=>'deleted',
                    'value'=>'$data->deleted?"Удалён":"Активен"',
                    'filter'=>array('0'=>'Активен','1'=>'Удалён')
                ),
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none')
		),
	),
)); 
      
        
      echo CHtml::endForm();
?>

<?php 
    echo '<div id="request-pos-total">Итого по заявке: <b>'.$sum[0]['sum'].'</b>'
          .'<div>Общий лимит на период: <b>'.$limit[0]['limit'].'</b></div>'. '</div>'; 
?>
