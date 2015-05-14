<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Пользователи'=>array('index'),
	'Создание',
);

$this->menu=array(
	array('label'=>'Список пользователей', 'url'=>array('index'))
);
?>

<h1>Создание пользователя</h1>

<?php if(Yii::app()->user->hasFlash('user_create')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('user_create'); ?>
</div>
<?php endif; ?>

<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>