<?php
$reqq2='index.php?type='.$_GET["type"].'&sel=analys5&day='.$_GET["day"].'&raion='.$_POST["raion"].'&month='.$_GET["month"];

print '<form method="post" name="add" action="'.$reqq2.'">';

print '<select id="raion" name="raion" style="font-family:verdana; font-size:11px">';
print '<option value="0" >��� ������'; 	
print '<option value="1">�����������';
print '<option value="2">������������';
print '<option value="3">�����������';
print '<option value="4">���������';
print '<option value="5">���������';
print '<option value="6">�����������������';
print '<option value="7">����������������';
print '</select>';
print '<input name="add" value="�������" type="submit">';
print '</form>';
?>