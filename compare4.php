<div id="main"  style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Сравнение объектов</div>
		<?php
		 $query = 'SELECT * FROM uprav';
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);  
		 while ($uy)
			{		
			 print '<div class="menuitem first"><a href="index.php?sel=compare2&type='.$uy[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$uy[1].'</a></div>';
			 $uy = mysql_fetch_row ($a);
			}
		?>
	</div>
	</div>
</div>
<div id="maincontent" style="width:1020px">
<?php
 $today=getdate();
 if ($_GET["year"]=='') $$today["year"]=$today["year"];
 else $today["year"]=$_GET["year"];
 if ($_GET["month"]=='') $today["mon"]=$today["mon"];
 else $today["mon"]=$_GET["month"];
 $ye=$today["year"];

 if ($today["mon"]>1) $month=$today["mon"]-1; else $month=1;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];

 if (!$tarif_teplo) $tarif_teplo=1154.63;
 $prevtype=1;
 print '<table border="0" cellpadding="2" cellspacing="2" style="width:1020px"><tbody>';
 if ($_GET["type"]) $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];
 else $query = 'SELECT * FROM objects ORDER BY type';

 $a = mysql_query ($query,$i); $ccn=0; $object=0; $cccn=1;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM uprav WHERE id='.$uy[2];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $uprav[$object]=$uy2[1];
	 $name[$object]=$uy[1];
	 $adr[$object]=$uy[3];

	 $query = 'SELECT nab,square,type FROM objects WHERE id='.$uy[0];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $sum1=$uy2[0]; $sum2[$object]=$uy2[1]; $type=$uy2[2];

	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $sts=sprintf("%d0101000000",$ye);
	 $fns=sprintf("%d1301000000",$ye);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$object]=$uw[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal0[$object]=$uw[0]; 

	 $sts=sprintf("%d%02d01000000",$ye,$today["mon"]);
	 $fns=sprintf("%d%02d01000000",$ye,$today["mon"]+1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal11[$object]=$uw[0];
	 //echo $query;

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal10[$object]=$uw[0]; 

	 $sts=sprintf("%d0101000000",$ye);
	 $fns=sprintf("%d1301000000",$ye);
	 $query = 'SELECT SUM(value) FROM data WHERE date='.$sts.' AND type=7 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $ddatal1[$object]=$uw[0];
	 $query = 'SELECT SUM(value) FROM data WHERE date='.$sts.' AND type=7 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $ddatal0[$object]=$uw[0]; 

	 $sts=sprintf("%d%02d01000000",$ye,$today["mon"]);
	 $fns=sprintf("%d%02d01000000",$ye,$today["mon"]+1);
	 $query = 'SELECT SUM(value) FROM data WHERE date='.$sts.' AND type=7 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $ddatal11[$object]=$uw[0];
	 $query = 'SELECT SUM(value) FROM data WHERE date='.$sts.' AND type=7 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $ddatal10[$object]=$uw[0]; 

	 if ($ddatal11[$object]) $ek1[$object]=$ddatal11[$object]-$datal11[$object];
	 if ($ddatal11[$object] && $datal11[$object]) $ek2[$object]=($ddatal11[$object]-$datal11[$object])*100/$ddatal11[$object];
	 if ($ddatal11[$object] && $datal11[$object]) $ek3[$object]=$ddatal1[$object]-$datal1[$object];

	 $tek1[$object]=$ek1[$object]*$tarif_teplo;
	 $tek2[$object]=$ek1[$object]*$tarif_teplo;
	 $tek3[$object]=$ek3[$object]*$tarif_teplo;
	 
	 $it1[$ccn]+=$datal11[$object];
	 $it2[$ccn]+=$datal1[$object];
	 $it3[$ccn]+=$ddatal11[$object];
	 $it4[$ccn]+=$ddatal1[$object];	  
	 $types[$object]=$type;
	 $count[$ccn]=$cccn;
	 if ($sum2[$object]) $ud[$object]=$ddatal1[$object]/$sum2[$object];	 
	 if ($sum2[$object]) $ud2[$object]=$datal11[$object]/$sum2[$object];	 
	 //echo $ud2[$ccn];

	 if ($prevtype!=$type) { $ccn++;  $prevtype=$type; $cccn=1; }
	 //echo $object.' ccn='.$ccn.' cccn='.$cccn.' pt='.$prevtype.' t='.$type.'<br>';
	 $object++; $cccn++;
	 $uy = mysql_fetch_row ($a); 
	}
 	
 print '<tr><td class="m_separator">Выбрать период: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ';  include("ch_mon2.php"); print '</td></tr>';

 if ($_GET["allmu"]=='1') {
 print '<tr><td align=center class="m_separator">Сравнительный анализ удельного потребления тепла бюджетными учереждениями, присоединенными к Ситуационному центру за '.$prevmonth.'</td></tr>';
 print '<tr><td><table width="100%" bgcolor="lightgray">';
 print '<tr align="center"><td class="m_separator">№ п/п</td><td class="m_separator">Категория подведомственного учереждения</td>
		<td class="m_separator">Наименование подведомственного бюджетного учреждения</td>
		<td class="m_separator">Адрес учреждения</td>
		<td class="m_separator">Площадь (кв.м.)</td>
		<td class="m_separator">Общий расход тепла за месяц (ГКал)</td>
		<td class="m_separator">Удельный расход тепла (ГКал)</td></tr>';
 $prevtype=8;
 for ($cn=0;$cn<$object;$cn++)            
	{
	 $sums=0;
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($cn+1,0).'</font></td>';
	 print '<td align="center" class="m_separator">'.$uprav[$types[$cn]].'</td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$cn].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$sum2[$cn].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($datal11[$cn],3).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ud2[$cn],5).'</font></td>';
	 print '</tr>';
	}
 print '<tr><td style="background-color:#ffffff" colspan="7"><b>Вывод:</b><br><br>Требуется проведение энергоаудита для выявления причин высокого теплопотребления.</td></tr>';
 print '</table></td></tr>';
}
 if ($_GET["allmu"]=='2') {
 print '<tr><td align=center class="m_separator">Сводный отчет об экономии тепловой энергии удельного потребления тепла бюджетными учереждениями, присоединенными к Ситуационному центру за '.$prevmonth.'</td></tr>';
 print '<tr><td><table width="100%" bgcolor="lightgray">';
 print '<tr align="center"><td class="m_separator">№ п/п</td><td class="m_separator">ГРБС</td>
		<td class="m_separator">Наименование подведомственного бюджетного учреждения</td>
		<td class="m_separator">Адрес учреждения</td>
		<td class="m_separator" colspan="2">Фактическое потребление (ГКал)</td>
		<td class="m_separator" colspan="2">Договорной уровень потребления (ГКал)</td>
		<td class="m_separator">Экономия по отношению к договорному уровню (ГКал)</td>
		<td class="m_separator">Экономия по отношению к договорному уровню (%)</td>
		<td class="m_separator" colspan="2">Стоимость экономии к договорному уровню (руб)</td></tr>';
 print '<tr align="center"><td class="m_separator"></td><td class="m_separator"></td><td class="m_separator"></td><td class="m_separator"></td>
		<td class="m_separator">Текущий месяц</td>
		<td class="m_separator">С начала года</td>
		<td class="m_separator">Текущий месяц</td>
		<td class="m_separator">С начала года</td>
		<td class="m_separator"></td>
		<td class="m_separator"></td>
		<td class="m_separator">Текущий месяц</td>
		<td class="m_separator">С начала года</td></tr>';

 $prevtype=8;
 for ($cn=0;$cn<$object;$cn++)            
	{
	 $sums=0;
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($cn+1,0).'</font></td>';
//	 if ($types[$cn]!=$prevtype) print '<td align="center" class="m_separator" rowspan="'.$count[$types[$cn]].'">'.$uprav[$types[$cn]].'</td>';
	 print '<td align="center" class="m_separator" rowspan="'.$count[$types[$cn]].'">'.$uprav[$types[$cn]].'</td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$cn].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($datal11[$cn],4).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($datal1[$cn],4).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ddatal11[$cn],4).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ddatal1[$cn],4).'</font></td>';
         print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ek1[$cn],2).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ek2[$cn],2).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($tek1[$cn],2).'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($tek2[$cn],2).'</font></td>';
	 print '</tr>';
	}
 print '<tr><td style="background-color:#ffffff" colspan="12"><b>Вывод:</b><br><br>Необходимо проверить правильность предоставленных данных.</td></tr>';
 
 print '</table></td></tr>';
}

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