<?php
    $this->menu=array(
                array('label'=>'Список лимитов', 'url'=>array('index')),
                array('label'=>'Создать лимит', 'url'=>array('create')),
                array('label'=>'Копировать лимиты', 'url'=>array('move')),
            );
?>

<h1>Копирование лимитов</h1>

<?php if(Yii::app()->user->hasFlash('equal')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('equal'); ?>
</div>
<?php endif; ?>

<br />

<?php if(Yii::app()->user->hasFlash('notempty')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('notempty'); ?>
</div>
<?php endif; ?>

<br />


<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<br />

<?php if(Yii::app()->user->hasFlash('nosuccess')): ?>
<div class="flash-error">
    <?php echo Yii::app()->user->getFlash('nosuccess'); ?>
</div>
<?php endif; ?>

<br />


<?php
    echo CHtml::form();
    echo 'ИЗ: ';
    echo CHtml::dropDownList('from','0', $time_period);
    echo '&nbsp;';
    echo '&nbsp;---->';
    echo '&nbsp;';
    echo 'В: ';
    echo CHtml::dropDownList('to','0', $time_period);
    echo '&nbsp;';
    echo '&nbsp;';
    echo '&nbsp;';
    echo CHtml::submitButton('Копировать лимиты', array('name'=>'reqstatus'));
?>