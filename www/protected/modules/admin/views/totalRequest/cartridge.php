<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

//Общее количество картриджей
$totalSumma='';

//Общая стоимость картриджей за период
$total_period_price=0;

foreach($cartPos as $item) {           
            $total_period_price=(int)$item['summ']+(int)$total_period_price;
            $totalSumma=(int)$totalSumma+(int)$item['amount'];
        }     
?>


<h1 id="total-request">Нахождение картриджа <b><?php echo $cartPos[0]['name']; ?></b> в заявках 
    <b><?php echo $cartPos[0]['description'] ?></b></h1>

<br />
<br />
<br />

<b><a href="/admin/totalrequest?idtimeperiod=<?php echo $id_time_period; ?>">Назад</a></b>

<?php   
    //Добавляю строку с итогами
    $cartPos[]=array('crp_comment'=>'Итого','amount'=>$totalSumma,
                     'summ'=>$total_period_price);    

    //Готовлю данные для передачи в CGridView
    $totalReqGrid=new CArrayDataProvider($cartPos,
            array('pagination'=>array(
                'pageSize'=>100
            )));

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'dataProvider' => $totalReqGrid,
    'columns' => array(       
        'id'=>array(
            'name'=>'id',
            'type'=>'raw',
            'header'=>'Заявка',
            'value'=>'CHtml::link($data["id"],'
                     . ' "/admin/requestposition/index/id/$data[id]")',
            'headerHtmlOptions'=>array('width'=>20)
        ),       
        'cr_comment'=>array(
            'name'=>'cr_comment',
            'header'=>'Комментарий к заявке',
            'value'=>$data->cr_comment,
            'headerHtmlOptions'=>array('width'=>250)
        ),        
        'crp_comment'=>array(
            'name'=>'crp_comment',
            'header'=>'Комментарий к позиции',
            'value'=>$data->crp_comment,
        ),
        'amount'=>array(
            'name'=>'amount',
            'header'=>'Количество',
            'value'=>$data->crp_comment,
        ),
        'price'=>array(
            'name'=>'price',
            'header'=>'Цена',
            'value'=>$data->price,
        ),
        'summ'=>array(
            'name'=>'summ',
            'header'=>'Стоимость',
            'value'=>$data->summ,
        ),
        'address'=>array(
            'name'=>'address',
            'header'=>'Адрес',
            'value'=>$data->address,
        ),
        'username'=>array(
            'name'=>'username',
            'header'=>'Имя пользователя',
            'value'=>$data->username,
        ),
    ),
));
?>
