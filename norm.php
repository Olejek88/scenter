<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<?php
if ($_GET["reg"]==1)
{
$query = 'SELECT * FROM objects';
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);  
while ($uy)
    {	 
     for ($rr=1;$rr<=12;$rr++) 
	{
	 $id=$uy[0].'-'.$rr;
	 $dat[$rr]=$_POST[$id];
	 $query='UPDATE norm SET m'.$rr.'=\''.$dat[$rr].'\' WHERE id='.$uy[0];
	 //echo $query.'<br>';
	 mysql_query($query);
	}
     $uy = mysql_fetch_row ($a);  
    }
} 
?>

<table width=1190px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td valign=top>

<table width=1090 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
<tr><td bgcolor="#5D6D2f" align=center width="260"><font style="font-weight:bold; color:white">Учереждение</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Январь</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Февраль</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Март</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Апрель</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Май</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Июнь</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Июль</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Август</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Сентябрь</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Октябрь</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Ноябрь</font></td>
<td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Декабрь</font></td>
</tr>

<form method="post" name="add" action="index.php?sel=norm&amp;reg=1">
<?php
$today=getdate();

$query = 'SELECT * FROM objects';
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);  
$sum=$uy[0]; $type=$uy[2]; $cn=0;
while ($uy)
    {	 
     print '<tr><td bgcolor="#5D6D2f" align=center><font style="color:white">'.$uy[1].'</font></td>';
     $query = 'SELECT * FROM norm WHERE obj='.$uy[0];
     $y = mysql_query ($query,$i);
     if ($y) $uo = mysql_fetch_row ($y);
     if ($uo)
	{     
	 print '<td><input id="'.$uy[0].'-1" name="'.$uy[0].'-1" size="7" value="'.$uo[2].'"></td>';
	 print '<td><input id="'.$uy[0].'-2" name="'.$uy[0].'-2" size="7" value="'.$uo[3].'"></td>';
	 print '<td><input id="'.$uy[0].'-3" name="'.$uy[0].'-3" size="7" value="'.$uo[4].'"></td>';
	 print '<td><input id="'.$uy[0].'-4" name="'.$uy[0].'-4" size="7" value="'.$uo[5].'"></td>';
	 print '<td><input id="'.$uy[0].'-5" name="'.$uy[0].'-5" size="7" value="'.$uo[6].'"></td>';
	 print '<td><input id="'.$uy[0].'-6" name="'.$uy[0].'-6" size="7" value="'.$uo[7].'"></td>';
	 print '<td><input id="'.$uy[0].'-7" name="'.$uy[0].'-7" size="7" value="'.$uo[8].'"></td>';
	 print '<td><input id="'.$uy[0].'-8" name="'.$uy[0].'-8" size="7" value="'.$uo[9].'"></td>';
	 print '<td><input id="'.$uy[0].'-9" name="'.$uy[0].'-9" size="7" value="'.$uo[10].'"></td>';
	 print '<td><input id="'.$uy[0].'-10" name="'.$uy[0].'-10" size="7" value="'.$uo[11].'"></td>';
	 print '<td><input id="'.$uy[0].'-11" name="'.$uy[0].'-11" size="7" value="'.$uo[12].'"></td>';
	 print '<td><input id="'.$uy[0].'-12" name="'.$uy[0].'-12" size="7" value="'.$uo[13].'"></td>';
	 $uo = mysql_fetch_row ($y);
   	}
     print '</tr>';
     $uy = mysql_fetch_row ($a);  
    }
 print '<tr><td colspan=13><input name="add" value="Сохранить изменения" type="submit"></form></td></tr>';
?>

</table></td></tr>
</table>
</td></tr></table>
