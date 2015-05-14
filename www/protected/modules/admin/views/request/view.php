<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'#'.$model->id,
);

$this->menu=array(
	array('label'=>'Список заявок', 'url'=>array('index')),
	array('label'=>'Создать заявку', 'url'=>array('create')),
	array('label'=>'Обновить заявку', 'url'=>array('update', 'id'=>$model->id)),	
);
?>
  
<h1>Просмотр заявки #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(	
                'id',
		'id_user'=>array(
                    'name'=>'id_user',
                    'value'=>$model->user->surname.' '.$model->user->name.' '.$model->user->lastname
                ),
		'id_time_period'=>array(
                    'name'=>'id_time_period',
                    'value'=>$model->time_period->description
                ),
                'person_in_charge',
		'date_creation'=>array(
                    'name'=>'date_creation',
                    'value'=>date("j.m.Y H:i", $model->date_creation)
                ),
                'deleted'=>array(
                    'label'=>'Статус',
                    'name'=>'deleted',
                    'value'=>($model->deleted==0)?"Активна":"Удалена"
                ),
                'status'=>array(
                    'label'=>'Состояние',
                    'name'=>'status',
                    'value'=>function($model) {
                                if($model->status=="opened") {
                                    return "Открыта";
                                } else if($model->status=="approved") {
                                    return "Одобрена";
                                } else if($model->status=="closed") {
                                    return "Закрыта";
                                }
                           }
                ),
		'comment',
	),
)); ?>
