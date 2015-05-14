<?php
/* @var $this LimitsController */
/* @var $model Limits */

$this->breadcrumbs=array(
	'Лимиты'=>array('index'),
	'Создать',
);

$this->menu=array(
	array('label'=>'Список лимитов', 'url'=>array('index')),
);
?>

<h1>Создать лимит</h1>

<?php if(Yii::app()->user->hasFlash('limit_create')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('limit_create'); ?>
</div>
<?php endif; ?>

<?php $this->renderPartial('_form', array('model'=>$model, 'user_filter'=>$user_filter, 'time_period'=>$time_period)); ?>