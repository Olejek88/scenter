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
 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Ввод данных о нормативном потреблении тепловой энергии и воды</h1></td></tr></table>';
 print '<form method="post" name="add" action="tobd.php">';
 print '<table width="1000px"><tr><td><b>Год</b></td><td><input id="year" name="year" value='.$today["year"].'></td></tr></table>'; 

 print '<table width="1000px" cellspacing="1" bgcolor="#5D6D2f">';
 print '<tr class="m_separator">
	 <td class="m_separator" align="center" rowspan="2">№п/п</td>
	 <td class="m_separator" align="center" rowspan="2">ГРБС</td>
	 <td class="m_separator" align="center" rowspan="2">Наименование подведомственного бюджетного учереждения</td>
	 <td class="m_separator" align="center" rowspan="2">Адрес учереждения</td>
	 <td class="m_separator" align="center" rowspan="2">Откл.</td>';
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $month=$mon; include ("time.inc");
		 print '<td class="m_separator" rowspan="2">'.$month.'</td>';
		}
	 print '<td class="m_separator" align="center" rowspan="2">K потерь %</td>';
	 print '<td class="m_separator" align="center" rowspan="2">Тариф руб</td>';
	 print '<td class="m_separator" align="center" rowspan="2">Площадь, м3</td>';
	 print '</tr><tr></tr>';

 $today=getdate();

 $query='SELECT * FROM data WHERE type="4" AND prm="13" AND source="12"';
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
	 $square=$uy[14];
		
	 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
	 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
	 print '<td align="center" class="simple"><input type="checkbox" name="'.$uy[0].'-vkl" id="'.$uo[11].'-vkl" ';
	 if ($uy[10]) print 'checked';
	 print '></td>';
	 $today=getdate();
	 for ($mon=1;$mon<=12;$mon++)
		{
		 print '<td align="center" class="simple"><input name="'.$uo[11].'-'.$mon.'" id="'.$uo[11].'-'.$mon.'" size="8" value="'.$value[$uo[0]][$mon].'"></td>';
		}
	 print '<td align="center" class="simple"><input name="'.$uy[0].'-k" id="'.$uo[11].'-k" size="8" value="'.$uy[120].'"></td>';
	 print '<td align="center" class="simple"><input name="'.$uy[0].'-tarif" id="'.$uo[11].'-tarif" size="8" value="'.$uy[121].'"></td>';
	 print '<td align="center" class="simple"><input name="'.$uy[0].'-square" id="'.$uo[11].'-square" size="8" value="'.$uy[14].'"></td>';
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