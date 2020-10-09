<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 //if ($mn>1) $mn--;
 $month=$mn;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];
 $tarif_svoda=18.56;

 $query = 'SELECT * FROM uprav';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{		
	 $nametype[$uy[0]]=$uy[1];
	 $query = 'SELECT COUNT(id) FROM objects WHERE uteplo>0 AND type='.$uy[0];
	 $a2 = mysql_query ($query,$i);
	 $uo = mysql_fetch_row ($a2);
	 $count[$uy[0]]=$uo[0];

	 $uy = mysql_fetch_row ($a);
	}
 if ($_GET["type"]=='')
      {
 	print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Удельное потрбление тепла организациями, присоединенными к ситуационному центру по состоянию на </h1></td></tr></table>';	
	 print '<table><tr><td class="m_separator">Выбрать период: '; include("ch_mon4.php"); print '</td><td class="m_separator"><a href="index.php?sel=analys4&year='.$_GET["year"].'&month='.$_GET["month"].'&type=1">Таблицы</a></td><td class="m_separator"><a href="index.php?sel=analys4&year='.$_GET["year"].'&month='.$_GET["month"].'&type=2">Графики</a></td></tr></table>';
	}
 if ($_GET["type"]!='2')
	{
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" class="m_separator">Назначение</td><td align="center" class="menuitem">Построение рейтинга тепловой эффективность зданий и эффективности использования горячей воды</td></tr></table>';
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td class="simple_bold">Категорийность необходимости проведения мероприяти по энергосбережению: увеличение удельного расхода тепла на 1кв.м. по отношению к среднему потреблению до 25% - 1 категория, 25-50% - 2 категория, свыше 50% - 3 категория</td></tr>';
	 print '<table width="1600px" cellspacing="1" border="0"><tr><td>';
	 print '<table width="1000px" cellspacing="1" bgcolor="#5D6D2f">';
	 print '<tr class="m_separator">
	 <td class="m_separator" align="center">№п/п</td>
	 <td class="m_separator" align="center">ГРБС</td>
	 <td class="m_separator" align="center">Наименование подведомственного бюджетного учереждения</td>
	 <td class="m_separator" align="center">Адрес учереждения</td>
	 <td class="m_separator" align="center">Площадь (кв.м.)(</td>
	 <td class="m_separator" align="center">Общий расход тепла (ГКал)</td>
	 <td class="m_separator" align="center">Удельный расход тепла (ГКал/м2)</td>
	 <td class="m_separator" align="center">Категория необходимости проведения мероприятий</td></tr>
	 <tr><td class="menuitem" align="center">1</td><td class="menuitem" align="center">2</td><td class="menuitem" align="center">3</td><td class="menuitem" align="center">4</td><td class="menuitem" align="center">5</td><td class="menuitem" align="center">6</td><td class="menuitem" align="center">7</td><td class="menuitem" align="center">8</td></tr>';
	}
 $today=getdate();
 $tarif_electr=1.19;
 $tarif=1159;
 $query = 'SELECT * FROM objects WHERE uteplo>0 ORDER BY type';
 $a = mysql_query ($query,$i); $ccn=1; $object=0; $itt=0;
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
	 $square[$object]=$uy[14];
	 if ($type!=$types[$object])
		{
		 if ($itt>0) $avg[$type]=$it0/$itt;
		 //echo $avg[$type];
		 $it0=$itt=0;
		}	
	 $sts=sprintf("%d%02d01000000",$today["year"],$mn);
	 $fns=sprintf("%d%02d01000000",$today["year"],$mn+1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND device='.$uo[11];
	 //echo $query;
	 $w = mysql_query ($query,$i); if ($w) $uw = mysql_fetch_row ($w); 
	 $datal11[$object]=$uw[0];
	 $query = 'SELECT value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND device='.$uo[11];
	 //echo $query;
	 $w = mysql_query ($query,$i); if ($w) $uw = mysql_fetch_row ($w); 
	 $datal_11[$object]=$uw[0];

	 if ($datal11[$object]<0) $datal11[$object]=0;
       	 if ($square[$object]) { $ud[$object]=$datal11[$object]/$square[$object]; $it0+=$ud[$object]; $itt++; }
	 else $ud[$object]=0;

	 $type=$types[$object];
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}
 $max_obj=$object; $type=0; $img=''; $ddd=''; $cnc=0;
 for ($object=0; $object<$max_obj; $object++)
	{
	 $name[$object]=str_replace ("\"","",$name[$object]);
	 if (!$object) $type=$types[$object];
	 if ($type!=$types[$object])
		{
		 if ($_GET["type"]!='2')
	 		{
			 print '<tr><td align="center" class="m_separator" colspan="6">Средняя величина удельного потребления тепла на 1кв.м по ГРБС</td>';
			 print '<td align="center" class="m_separator">'.number_format($avg[$type],5).'</td>';
			 print '<td align="center" class="m_separator"></td>';
			}
		 $img.='<tr><td><img src="charts/barplots30.php?'.$ddd.'"></td></tr>';
		 $it0=$itt=0; $ddd=''; $cnc=0;
		}
	 $kat=0;                                                                                       
	 if ($ud[$object]>$avg[$type]*1.5) $kat=3;
	 else if ($ud[$object]>$avg[$type]*1.25) $kat=2;
	 else if ($ud[$object]>$avg[$type]) $kat=1;
	 if ($_GET["type"]!='2')
		{
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
	  	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
		 if ($square[$object]%100==0) print '<td align="center" class="simple" style="background-color:gray">'.$square[$object].'</td>';
		 else print '<td align="center" class="simple">'.$square[$object].'</td>';
		 print '<td align="center" class="simple">'.number_format($datal11[$object],5).'</td>';
		 print '<td align="center" class="simple">'.number_format($ud[$object],5).'</td>';
		 print '<td align="center" class="simple">'.$kat.'</td>';
		 print '</tr>';	 
		}
	 $type=$types[$object];
	 if ($datal11[$object]>0) { $ddd.='name'.$cnc.'='.$name[$object].'&da'.$cnc.'='.$ud[$object].'&'; $cnc++; }
	 $ccn++; 
	 $uy = mysql_fetch_row ($a); 
	}

 if ($_GET["type"]!='2')
	{
	 print '<tr><td align="center" class="m_separator" colspan="6">Средняя величина удельного потребления тепла на 1кв.м по ГРБС</td>';
	 print '<td align="center" class="m_separator">'.number_format($avg[$type],2).'</td>';
	 print '<td align="center" class="m_separator"></td>';
	}
 print '</table></td>';
?>
<td valign="top"> 
<table width="800px" cellspacing="1" bgcolor="#ffffff">
<?php
 if ($_GET["type"]=='2' || $_GET["type"]=='') print $img;	
?>
</table>

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