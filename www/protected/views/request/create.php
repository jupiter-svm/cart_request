<?php
/* @var $this RequestController */
/* @var $model Request */

$this->breadcrumbs=array(
	'Заявки'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список заявок', 'url'=>array('index')),
);
?>

<h1>Создать заявку</h1>
<br />

<?php if(Yii::app()->user->hasFlash('request_update')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('request_update'); ?>
</div>
<?php endif; ?>

<?php

    if(count($time_period_active))
    {
        $this->renderPartial('_form_create', array('model'=>$model, 'time_period'=>$time_period)); 
    }
    else
    {
        echo '<br /><br /><br /><b>Приём заявок на данный момент не осуществляется</b>';
    }
?>