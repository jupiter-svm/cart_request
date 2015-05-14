<?php
/* @var $this SiteController */

?>
<h1>Порядок работы с системой</h1>
<br />
<br />

<ol id="info-list">
    <li><a href="#enter">Вход в систему</a></li>
    <li><a href="#main">Главная страница</a></li>
    <li><a href="#user">Изменение пароля и данных учётной записи</a></li>
    <li>
        <a href="#req-create">Создание заявки на картриджи</a>
        <ul>
            <li><a href="#req-create-main">Заполнение сведений о заявке</a></li>
            <li><a href="#adding-position">Переход к списку картриджей</a></li>
            <li><a href="#adding-position-main">Переход к форме добавления картриджа</a></li>
            <li><a href="#adding-position-create">Форма добавления картриджа</a></li>
            <li><a href="#alter-position">Изменение позиции</a></li>
        </ul>
    </li>    
</ol>

<br />
<br />

<p>
    <a name="enter"></a>
    <p class="info-paragraph">1. Здесь необходимо ввести логин и пароль, который был выдан Вам</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/enter.png" alt="" />
</p> 
<hr class="info-separator" />
<br />

<p>
    <a name="main"></a>
    <p class="info-paragraph">2. На главной странице выводится информация о том, открыты ли временные периоды для формирования заявок</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/main.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="user"></a>
    <p class="info-paragraph">3. В начале первого сеанса работы с системой необходимо сменить пароль и поправиль
        или добавить данные об учётной записи</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/user.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="req-create"></a>
    <p class="info-paragraph">4. Если есть открытые периоды для создания заявок, то будет доступна возможность
    создания заявки</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/req-create.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="req-create-main"></a>
    <p class="info-paragraph">4.1. Необходимо выбрать подходящий период времени, желательно добавить ответственное лицо
    и если это необходимо, то можно добавить комментарии к заявке</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/req-create-main.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="adding-position"></a>
    <p class="info-paragraph">4.2. Для перехода к просмотру позиций заявки и добавления картриджей необходимо
    кликнуть мышкой по ID заявки в таблице заявок</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/adding-position.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="adding-position-main"></a>
    <p class="info-paragraph">4.3. Для перехода к просмотру позиций заявки и добавления картриджей необходимо
    кликнуть мышкой по ID заявки в таблице заявок</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/adding-position-main.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="adding-position-create"></a>
    <p class="info-paragraph">4.4. Необходимо выбрать картридж из списка, адрес, указать количество картриджей
    и, если требуется, комментарий к позиции</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/adding-position-main.png" alt="" />
</p>
<hr class="info-separator" />
<br />

<p>
    <a name="alter-position"></a>
    <p class="info-paragraph">4.5. Для того, чтобы внести изменения в данные позиции, нужно в таблице справа
    щёлкнуть на изображение карандаша</p>
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/instruction/alter-position.png" alt="" />
</p>
<hr class="info-separator" />
<br />

