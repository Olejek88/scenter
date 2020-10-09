<?php
$reqq2='index.php?type='.$_GET["type"].'&sel=analys5&day='.$_GET["day"].'&raion='.$_POST["raion"].'&month='.$_GET["month"];

print '<form method="post" name="add" action="'.$reqq2.'">';

print '<select id="raion" name="raion" style="font-family:verdana; font-size:11px">';
print '<option value="0" >Все районы'; 	
print '<option value="1">Калининский';
print '<option value="2">Курчатовский';
print '<option value="3">Центральный';
print '<option value="4">Советский';
print '<option value="5">Ленинский';
print '<option value="6">Тракторозаводский';
print '<option value="7">Металлургический';
print '</select>';
print '<input name="add" value="вывести" type="submit">';
print '</form>';
?>