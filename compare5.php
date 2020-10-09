<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $query = 'SELECT * FROM uprav';
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

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии тепловой энергии в '.$prevmonth.' бюджетными учереждениями , присоединенными к ситуационному центру</h1></td></tr></table>';
 print '<table width="1200px" cellspacing="1" bgcolor="#5D6D2f">';
 print '<tr class="m_separator">
	 <td class="m_separator" rowspan="2">№п/п</td>
	 <td class="m_separator" rowspan="2">ГРБС</td>
	 <td class="m_separator" rowspan="2">Наименование подведомственного бюджетного учереждения</td>
	 <td class="m_separator" rowspan="2">Адрес учереждения</td>
	 <td align="center" colspan="2" class="m_separator">Фактическое потребление, Гкал</td>
	 <td align="center" colspan="2" class="m_separator">Договорной уровень потрбления, Гкал</td>
	 <td align="center" rowspan="2" class="m_separator">Экономия по отношению к договорному уровню, Гкал</td>
	 <td align="center" rowspan="2" class="m_separator">Экономия по отношению к договорному уровню, %</td>
	 <td align="center" colspan="2" class="m_separator">Стоимость экономии к договорному уровню, руб</td></tr>
	 <tr><td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td>
	 <td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td>
	 <td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td></tr>';

 $today=getdate();
 $tarif=1154;
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
	 $ek=$ekr1=$ekr2=$ekpr=0;
	 if (!$object) $type=$types[$object];
	 if ($type!=$types[$object])
		{
		 if ($it2 && $it4) $it6=($it4-$it2)*100/$it4;

		 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
		 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
		 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
		 $it1=$it2=$it3=$it4=$it5=$it6=$it7=$it8=0;
		}

	 $sts=sprintf("%d0101000000",$today["year"]);
	 $fns=sprintf("%d1301000000",$today["year"]);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal2[$object]=$uw[0];
	
	 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND prm=13 AND date=20110101000000 AND source=0 AND device='.$device;
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 $dog1[$object]=$ui[0]/12;

	 //$query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date>='.$sts.' AND date<'.$fns.' AND source=2 AND device='.$device;
	 //$e = mysql_query ($query,$i);
	 //if ($e) $ui = mysql_fetch_row ($e);
	 //$dog2[$object]=$ui[0];
	 //if (!$dog2[$object]) $dog2[$object]=$today["mon"]*rand (50000,120000)/100;

	 if ($today["month"]>1)
		{
		 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]-1);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		}
	 else
		{
		 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]+1);
		}
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$object]=$uw[0];
	 $dog2[$object]=$ui[0]*$today["yday"]/365;
	 //if (!$dog1[$object]) $dog1[$object]=rand (50000,120000)/100;
	         
	 $it2+=$datal2[$object];
	 $it4+=$dog2[$object];
	 $it1+=$datal1[$object];
	 $it3+=$dog1[$object];
	 if ($datal1[$object] && $dog1[$object]) { $ek=$dog1[$object]-$datal1[$object]; $ekpr=($dog1[$object]-$datal1[$object])*100/$dog1[$object]; $ekr1=($dog1[$object]-$datal1[$object])*$tarif; $ekr2=($dog2[$object]-$datal2[$object])*$tarif; $it5+=$ek; $it7+=$ekr1; $it8+=$ekr2; }
	
	 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
	 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
	 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($dog1[$object],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($dog2[$object],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ekpr,3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ekr1,3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ekr2,3).'</td></tr>';
	 $type=$types[$object];
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}

 if ($it2 && $it4) $it6=($it4-$it2)*100/$it4;
 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
 $it1=$it2=$it3=$it4=$it5=$it6=$it7=$it8=0;
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