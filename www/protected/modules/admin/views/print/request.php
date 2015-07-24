<?php
/* @var $this PrintController */
/* @var $model RequestPosition */
?>

<div id="report-body">
    <div id="report-header">Заявка на приобретение  материалов</div>
    <br />
    <br />
    
    <div class="left-column">Наименование подразделения</div>
    <div class="right-column"><?php echo $departament; ?></div>
    <br />
    
    <div class="left-column">Руководитель подразделения</div>
    <div class="right-column">
        <div id="signature">______________________ (подпись)</div>
        <div id="signature-desc">
            <?php if(!isset($username)){ ?>
            <span class="sigdecor">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <?php
                }
                else
                {
                    echo "<span class='report-bold'>".$username."</span>";
                }
                ?>
            &nbsp;(расшифровка подписи)</div>
    </div>
    <br />
    
    <div class="left-column">Назначение</div>
    <div class="right-column">Картриджи</div>
    <br />
    
    <div class="left-column">Период</div>
    <div class="right-column"><span class="report-bold" id="rep-time-period"><?php echo $time_period ?></span></div>
    <?php
        if(isset($group_name))
        {
            echo "<br />";
            echo "<div id='print_group_center'>".$group_name."</div>";
        }
    ?>
    <br />
    <br />

    <table id="total-table">
        <thead>
            <tr>
                <th>Код статьи бюджета затрат</th>
                <th>Наименование статьи</th>
                <th>Код статьи бюджета ДДС</th>
                <th>Код статьи ДДС в ОМС</th>
                <th>Код ЦФО</th>
                <th>Наименование ЦФО</th>
                <th>ФЦО</th>
                <th>Код МВЗ</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5" class="total-table-footer"><b>Итого: </b></td>
                <td><b><?php  echo $sum[0]['sum'] ?></b></td>
                <td></td>
                <td></td>
            </tr>
        </tfoot>
        <tr>
            <td>E 30199</td>
            <td>Прочие материалы</td>
            <td>P 30199</td>
            <td>P 31ZCO</td>
            <td>OO4</td>
            <td>БИТ</td>
            <td>OO9</td>
            <td>152У</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td> № п/п</td>
            <td>Наименование номенклатурной позиции</td>
            <td>Ед. изм.</td>
            <td>Кол-во</td>
            <td>Цена</td>
            <td>Сумма</td>
            <td>Адрес</td>
            <td>Структурное подразделение</td>
        </tr>
        <tr>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>8</td>
        </tr>
        <?php       
            $item_number=1;
        
            foreach($request as $item) {
                echo '<tr id="table-total-row">';                
                
                    echo '<td>';
                    echo $item_number;
                    echo '</td>';
                    
                    echo '<td>';
                    echo $item['name'];
                    echo '</td>';
                    
                    echo '<td>';
                    echo 'шт.';
                    echo '</td>';

                    echo '<td>';
                    echo $item['amount'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['price'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['summ'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['address'];
                    echo '</td>';

                    echo '<td>';
                    echo $item['comment'];
                    echo '</td>';
                echo '</tr>'; 
                
                $item_number++;
            }       
        ?>
    </table>
    
    <br />
    
    <div class="left-column">Материально-ответственное лицо</div>
    <div class="right-column">
        <div id="signature">______________________ (подпись)</div>
        <div id="signature-desc">
            <?php if(!isset($person)){ ?>
            <span class="sigdecor">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </span>
            <?php
                }
                else
                {
                    echo "<span class='report-bold'>".$person."</span>";
                }
                ?>
            &nbsp;&nbsp;(расшифровка подписи)</div>
    </div>
    
    <br />
    
    <div class="left-column agreement">согласованно:</div>
    
    <br />
    <br />
    
    <div class="left-column">Руководитель (ответственный за статью)</div>
    <div class="right-column">
        <div id="signature">______________________ (подпись)</div>
        <div id="signature-desc">            
            <span class="report-bold">Архипов А.С.</span>
          (расшифровка подписи)
        </div>
    </div>
    
    <br />
    
    <div class="left-column">Уполномоченный руководитель</div>
    <div class="right-column">
        <div id="signature">______________________ (подпись)</div>
        <div id="signature-desc">            
            <span class="report-bold">Васильев В.А.</span>
          (расшифровка подписи)
        </div>
    </div>
    
    <br />
    <br />
    <br />
    
    <div class="left-column">Примечание:</div>
    
    <br />
    <br />
    
    <div class="left-column">
         Ежеквартальная заявка на прибретение расходных материалов
         предоставляется в ГТИИТ и ПП
    </div>
    
</div>

