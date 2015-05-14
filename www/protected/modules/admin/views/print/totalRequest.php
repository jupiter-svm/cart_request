<?php
/* @var $this PrintController */
/* @var $model RequestPosition */

//Общее количество картриджей
$totalSumma='';

//Общая стоимость картриджей за период
$total_period_price=0;

foreach($total_request as $item) {           
            $total_period_price=(int)$item['total']+(int)$total_period_price;
            $totalSumma=(int)$totalSumma+(int)$item['summa'];
        }      
?>

<div id="report-body">
    <div id="report-header"><?php echo $tperiod_name['description']; ?></div>
    <br />
   

    <table id="total-table">
        <thead>
            <tr>
                <th>Н/П</th>
                <th>Наименование картриджа</th>
                <th>Количество</th>
                <th>Цена</th>
                <th>Общая стоимость</th>                
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="2" class="total-table-footer"><b>Итого: </b></td>
                <td><b><?php  echo $totalSumma; ?></b></td>
                <td></td>
                <td><b><?php  echo $total_period_price ?></b></td>
            </tr>
        </tfoot>       
        
        <?php       
            $item_number=1;
        
            foreach($total_request as $item) {
                echo '<tr id="table-total-row">';                
                
                    echo '<td>';
                    echo $item_number;
                    echo '</td>';
                    
                    echo '<td  class="trequest-print-name-header">';
                    echo $item['cart_name'];
                    echo '</td>';                   

                    echo '<td>';
                    echo $item['summa'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['price'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['total'];
                    echo '</td>';

                echo '</tr>'; 
                
                $item_number++;
            }       
        ?>
    </table>
    
    <br />

