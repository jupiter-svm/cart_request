<div id="print_center">
<?php
/* @var $this RequestController */
/* @var $model Request */

//Делаю возможность печати всей накладной вне зависимости от групп адресов
echo '<a href="/admin/print/request/id/'. $id.'" target=_blank>Общий список</a>&nbsp&nbsp&nbsp&nbsp';

foreach($groups as $item)
    echo '<a href="/admin/print/request/id/'.$id.'-'.$item['groups'].'" target=_blank>'.$item['name'].'</a>&nbsp&nbsp&nbsp&nbsp';
?>
</div>