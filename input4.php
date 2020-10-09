<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 if ($mn>1) $mn--;
 $month=$mn;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];
 $tarif_svoda=18.56;

 $query = 'SELECT * FROM uprav ORDER BY id';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{		
	 $nametype[$uy[0]]=$uy[1];
	 $query = 'SELECT COUNT(id) FROM objects WHERE type='.$uy[0];
	 $a2 = mysql_query ($query,$i);
	 $uo = mysql_fetch_row ($a2);
	 $count[$uy[0]]=$uo[0];

	 $uy = mysql_fetch_row ($a);
	}
 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Ввод данных о нормативном потреблении воды</h1></td></tr></table>';
 print '<form method="post" name="add2" action="tobd2.php">';
 print '<table width="1000px"><tr><td><b>Год</b></td><td><input id="year" name="year" value='.$today["year"].'></td></tr></table>'; 

 print '<table width="1000px" cellspacing="1" bgcolor="#5D6D2f">';
 print '<tr class="m_separator">
	 <td class="m_separator" align="center" rowspan="2">№п/п</td>
	 <td class="m_separator" align="center" rowspan="2">ГРБС</td>
	 <td class="m_separator" align="center" rowspan="2">Наименование подведомственного бюджетного учереждения</td>
	 <td class="m_separator" align="center" rowspan="2">Адрес учереждения</td>';
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $month=$mon; include ("time.inc");
		 print '<td class="m_separator" rowspan="2">'.$month.'</td>';
		}
	 print '<td class="m_separator" align="center" rowspan="2">К-во человек</td>';
	 print '</tr><tr></tr>';

 $today=getdate();

 $query='SELECT * FROM data WHERE type="4" AND prm="11" AND source="15"';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);	
 while ($ui) 
	{
	 $query = 'SELECT * FROM devices WHERE device='.$ui[4];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $mon=$ui[2][5]*10+$ui[2][6];
	 $value[$uo[0]][$mon]=$ui[3];
	 $ui = mysql_fetch_row ($e);
	}

 $query = 'SELECT * FROM objects ORDER BY type';
 $a = mysql_query ($query,$i); $ccn=1; $object=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $device=$uo[11];
	 $types[$object]=$uy[2];
	 $name[$object]=$uy[1];
	 $adr[$object]=$uy[3];
	 if (!$object) $type=$types[$object];
	 $kvo=$uy[15];
		
	 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
	 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

	 $today=getdate();
	 for ($mon=1;$mon<=12;$mon++)
		{
		 print '<td align="center" class="simple"><input name="'.$uo[11].'-'.$mon.'" id="'.$uo[11].'-'.$mon.'" size="8" value="'.$value[$uo[0]][$mon].'"></td>';
		}
	 print '<td align="center" class="simple"><input name="'.$uy[0].'-kvo" id="'.$uo[11].'-kvo" size="8" value="'.$uy[15].'"></td>';
	 print '</tr>';
	 $type=$types[$object];
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}
 print '<input name="add" value="Сохранить изменения" type="submit"></form>';
 print '</table></td></tr>';
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>

<tr><td>
<table>
</table>
</td></tr>
</tbody></table>
</div>