<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	$model->surname.' '.$model->name.' '.$model->lastname,
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index')),
	array('label'=>'Добавить пользователя', 'url'=>array('create')),
	array('label'=>'Обновить пользователя', 'url'=>array('update', 'id'=>$model->id)),	
);
?>

<h1>Просмотр пользователя №<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'short_name',
		'password',		
		'surname',
                'name',
		'lastname',
		'departament',
		'staff_status',
		'role'=>array(
                    'name'=>'role',
                    'value'=>$model->role==1?"Пользователь":"Администратор"
                ),
		'ban'=>array(
                    'name'=>'ban',
                    'value'=>$model->ban?"Не активен":"Активен"
                ),
		'email'=>array(
                    'name'=>'email',
                    'type'=>'raw',
                    'value'=>CHtml::mailto($model->email)
                ),
		'created',
	),
)); ?>

<br />
<br />
<br />

<div id="user-view">Адреса пользователя</div>

<?php

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'addressGrid',
    'dataProvider' => $addresses,
    'columns' => array(  
        array(
            'name'=>'number',
            'header'=>'Н/П',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
             'headerHtmlOptions'=>array('width'=>40)
        ),
        'id'=>array(
            'name'=>'id',
            'type'=>'raw',
            'header'=>'ID адреса',
            'value'=>'CHtml::link($data["id"],'
                     . ' "/admin/address/view/id/$data[id]")',
            'headerHtmlOptions'=>array('width'=>60)
        ),  
        'address'=>array(
            'name'=>'address',
            'header'=>'Адрес',
            'value'=>$data['address']
        ),
        array(
                'class'=>'CButtonColumn',
                'template'=>'{view}{update}',
                'deleteButtonOptions'=>array('style'=>'display:none'),    
                'buttons'=>array(
                    'view'=>array(
                                    'label'=>'Обновить позицию',
                                    'url'=>'Yii::app()->createUrl("/admin/address/view/id/$data[id]")'
                                 ),
                    'update'=>array(
                        'label'=>'Редактировать запись',
                        'url'=>'Yii::app()->createUrl("/admin/address/update/id/$data[id]")'
                    )
                )
             ),
    ),
));
    
?>
