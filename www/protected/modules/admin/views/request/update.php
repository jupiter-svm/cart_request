<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'#'.$model->id=>array('view','id'=>$model->id),
	'Обновление',
);

$this->menu=array(
	array('label'=>'Список заявок', 'url'=>array('index')),
	array('label'=>'Просмотр заявки', 'url'=>array('view', 'id'=>$model->id)),
);
?>

<script>
  $(function() {
    $("#Request_id_time_period").datepicker();
  });
</script>

<h1>Обновление заявки №<?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form_update', array('model'=>$model, 'time_period'=>$time_period)); ?>