<div id="main">
<div id="maincontent" style="width:820px">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr><td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody><tr><td valign="top">
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>

<form name="reda" method=post action="tobd.php">
<tr><td>Тип события</td><td>
<select class=log id="type" name="type" style="height:18">
<option value="0">Неизвестно
<option value="1">Монтаж/Установка
<option value="2">Демонтаж/Снятие
<option value="3">Замена
<option value="10">Обслуживание
</select></td></tr>
<?php
print '<tr><td>Объект</td><td><select class=log id="object" name="object" style="height:18">';
$query = 'SELECT * FROM objects ORDER BY name';
$e = mysql_query ($query,$i); 
if ($e) $ui = mysql_fetch_row ($e);
while ($ui)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1];
    $ui = mysql_fetch_row ($e);
   }
print '</select></td></tr>';
print '<tr><td>Значение</td><td><input name="value" size=10 class=log style="height:18px"></td></tr>';
print '<tr><td>Устройство</td><td><select class=log id="devices" name="devices" style="height:18">';
print '<option value="0">Не указывать';

$query = 'SELECT * FROM devices ORDER BY name';
$e = mysql_query ($query,$i); 
if ($e) $ui = mysql_fetch_row ($e);
while ($ui)
   {
    print '<option value="'; print $ui[0]; print '">'; print $ui[1].'('.$ui[11].')';
    $ui = mysql_fetch_row ($e);
   }
print '</select></td></tr>';
print '<tr><td><font class="down">Описание</font></td><td><textarea name="descr" cols="50" rows="3" class=log></textarea></td></tr>';
print '<tr><td><input alt="Add" name="Добавить" align=left type="submit"></td><td><input name="frm" size=1 style="height:1;width:1;visibility:hidden" value="1"></td></tr></form>';
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br><br><br><br><br><br>
</div>