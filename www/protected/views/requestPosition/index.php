<?php
/* @var $this RequestPositionController */
/* @var $model RequestPosition */

$this->breadcrumbs=array(
	'Позиции заявки'=>array('index'=>$model->id_request),
	'Управление',
);

    $menuArray=array(
	array('label'=>'Список позиций', 'url'=>array('index'=>$model->id_request)),	
    );
    
    if($active && ($state=='opened' || $state=='approved')) {
        $menuArray[]=array('label'=>'Добавить картридж', 'url'=>array('create','id'=>$model->id_request));
    }
            

$this->menu=$menuArray;

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

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
<br />
<br />

<?php 
      if($active && ($state=='opened' || $state=='approved')) {           
          echo CHtml::form();
          echo CHtml::submitButton('Удалить', array('name'=>'delete'));
      }        

      $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'request-position-grid',
        'selectableRows'=>2,
	'dataProvider'=>$model->search($id),
        'template'=>'{summary}{pager}{items}{pager}',
	//'filter'=>$model,
	'columns'=>array(
                array(
                    'class'=>'CCheckBoxColumn',
                    'id'=>'id_cartridge'
                ),
		'id_cartridge'=>array(
                    'name'=>'Картридж',
                    'value'=>'$data->cartridge->name'
                ),                
                'amount'=>array(
                    'name'=>'amount',
                    'value'=>'$data->amount'
                ),
                'price',
                'price'=>array(
                    'name'=>'Стоимость',
                    'value'=>'$data->amount*$data->price'
                ),
		'id_address'=>array(
                    'name'=>'Адрес',
                    'value'=>'$data->address->address'
                ),
		'comment',
		array(
			'class'=>'CButtonColumn',
                        'deleteButtonOptions'=>array('style'=>'display:none')
		),
	),
)); 
      
    if($status['status']) {         
        echo CHtml::endForm();
    }

?>

<?php 
    echo '<div id="request-pos-total">Итого по заявке: <b>'.$sum[0]['sum'].'</b>'
          .'<div>Общий лимит на период: <b>'.$limit[0]['limit'].'</b></div>'. '</div>'; 
?>
