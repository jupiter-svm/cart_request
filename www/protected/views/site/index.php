<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<br />

<?php

    if(count($this->getSetting()->mpage_topic)>0) {
        echo '<div id="mpage-topic">'.$this->getSetting()->mpage_topic.'</div>';
    }   

     if(count($time_period_active))
    {
?>
    <b>Доступны временные интервалы для формирования заявок:</b>
    <br />
    <br />
    <ul>

    <?php         
         foreach($time_period_active as $item) {
             echo '<li>'.$item.'</li>';
         }    
?>
    </ul>
<?php
    }
    else
    {
        echo '<b>На данный момент нет открытых временных периодов. Формирование заявок невозможно</b>';
    }
?>

