<?php
/* @var $this CartridgeController */
/* @var $model Cartridge */

//Общее количество картриджей
$totalSumma='';

//Общая стоимость картриджей за период
$total_period_price=0;

foreach($total_request as $item) {           
            $total_period_price=(int)$item['total']+(int)$total_period_price;
            $totalSumma=(int)$totalSumma+(int)$item['summa'];
        }       
?>


<h1 id="total-request">Сводная заявка</h1>

<br />
<br />

<?php
    echo CHtml::form();
    echo '<div id="trequest-tperiod"><b>'
    . 'Временной интервал:</b></div>&nbsp;&nbsp;<div id="trequest-print"><a href=/admin/print/totalrequest/time_period/'.$time_period.'>На печать</a></div>';
    echo CHtml::dropDownList('time_period', $time_period, $time_periods, array('onchange'=>'this.form.submit()'));
    echo CHtml::endForm();    
?>

<?php     
    //Добавляю строку с итогами
    $total_request[]=array('id'=>'9999999','cart_name'=>'Итого','summa'=>$totalSumma,
                           'price'=>'','total'=>$total_period_price);    

    //Готовлю данные для передачи в CGridView
    $totalReqGrid=new CArrayDataProvider($total_request,
            array('pagination'=>array(
                'pageSize'=>100
            )));

    $this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'itemGrid',
    'dataProvider' => $totalReqGrid,
    'columns' => array(
        array(
            'name'=>'number',
            'header'=>'Н/П',
            'value'=>'$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions'=>array('width'=>40)
        ),
        'cart_name'=>array(
            'name'=>'cart_name',
            'type'=>'raw',
            'header'=>'Наименование картриджа',
            'value'=>'CHtml::link($data["cart_name"],'
                     . ' "/admin/totalrequest/cartridge/param/$data[id_cartridge]-$data[id_time_period]")'
        ),
        'summa'=>array(
            'name'=>'summa',
            'header'=>'Количество',
            'value'=>$data->summa,
            'headerHtmlOptions'=>array('width'=>70)
        ),
        'price'=>array(
            'name'=>'price',
            'header'=>'Цена',
            'value'=>$data->summa,
            'headerHtmlOptions'=>array('width'=>80)
        ),
        'total'=>array(
            'name'=>'total',
            'header'=>'Общая стоимость',
            'value'=>$data->total,
            'headerHtmlOptions'=>array('width'=>150)
        ),
    ),
));
?>
<br />
<br />
<div id="total-request-limit">
    Общий лимит по пользователям за период:
    <span>
        <?php
            echo $limit['0']['limit'];
        ?>
    </span>
</div>

<br />
<br />
