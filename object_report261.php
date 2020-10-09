<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Отчет о выполнении ФЗ №261 "Об энергосбережении" по снижению потребления энергоресурсов бюджетными организациями</td></tr>';
  print '<tr><td align=center class="simple" colspan="2"></td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px" cellspacing="1" bgcolor="#5D6D2f">';
  print '<tr><td class="m_separator" colspan="4"></td><td class="m_separator" colspan="12" align="center">2010</td></tr>
	 <tr class="m_separator"><td class="m_separator"></td><td align="center" colspan="3" class="m_separator">Базовый уровень потребления 2009</td><td align="center" colspan="4" class="m_separator">вода, м3</td><td align="center" colspan="4" class="m_separator">тепло, ГКал</td><td align="center" colspan="4" class="m_separator">электроэнергия, кВт*ч</td></tr>
	 <tr class="m_separator"><td class="m_separator">месяц</td><td align="center" class="m_separator">вода, м3</td><td align="center" class="m_separator">тепло, ГКал</td><td align="center" class="m_separator">ЭЭ, кВт*ч</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Отклонение</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Отклонение</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Отклонение</td><td align="center" class="m_separator">% вып. ФЗ</td></tr>';

 $today=getdate();
 for ($mon=1;$mon<=12;$mon++)
	{
	 $dy=31;
	 if (!checkdate ($mon,31,$today["year"])) { $dy=30; }
	 if (!checkdate ($mon,30,$today["year"])) { $dy=29; }
	 if (!checkdate ($mon,29,$today["year"])) { $dy=28; }
	 $month=$mon; include ("time.inc");
	 $mont[$mon]=$month;

	 // 2009
	 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon);
	 $fns=sprintf("%d%02d01000000",$today["year"]-1,$mon+1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal2[$mon]=$uw[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$sts.' AND type=4 AND prm=13 AND source=2 AND value<2000 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$mon]=$uw[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$sts.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal0[$mon]=$uw[0]; 

	 // 2010
	 $sts=sprintf("%d%02d01000000",$today["year"],$mon);
	 $fns=sprintf("%d%02d01000000",$today["year"],$mon+1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal12[$mon]=$uw[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$sts.' AND type=4 AND prm=13 AND source=2 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal11[$mon]=$uw[0];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$sts.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal10[$mon]=$uw[0]; 

	 $norm[$mon]=$norm_hvs*$dy*$nab;
	 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date='.$sts.' AND source=2 AND device='.$device;
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 $dog[$mon]=$ui[0];
         
	 if ($norm[$mon]) $voda09[$mon]=$norm[$mon]-$norm[$mon]*0.03; else $voda09[$mon]=0;
	 if ($dog[$mon]) $teplo09[$mon]=$dog[$mon]-$dog[$mon]*0.03; else $teplo09[$mon]=0;
	 $ee09=0;

	 if ($norm[$mon]) $voda10[$mon]=$norm[$mon]-$norm[$mon]*0.06;
	 if ($dog[$mon]) $teplo10[$mon]=$dog[$mon]-$dog[$mon]*0.06;
	 $ee10=0;
	 $it1+=$norm[$mon];
	 $it2+=$dog[$mon];
	 if ($datal0[$mon]) $it4+=$voda09[$mon];
	 if ($datal1[$mon]) $it7+=$teplo09[$mon];
	 if ($datal2[$mon]) $it10+=$ee09[$mon];
	 $its1+=$norm[$mon];
	 $its2+=$dog[$mon];
	 if ($datal10[$mon]) $its4+=$voda10[$mon];
	 if ($datal11[$mon]) $its7+=$teplo10[$mon];
	 if ($datal12[$mon]) $its10+=$ee10[$mon];

	 if ($datal0[$mon] && $voda09[$mon]) 
		{ $ot_voda09[$mon]=$voda09[$mon]-$datal0[$mon]; $ot_voda_p09[$mon]=($voda09[$mon]-$datal0[$mon])*100/$voda09[$mon]; $it5+=$datal0[$mon];  }
	 if ($datal1[$mon] && $teplo09[$mon]) 
		{ $ot_teplo09[$mon]=$teplo09[$mon]-$datal1[$mon]; $ot_teplo_p09[$mon]=($teplo09[$mon]-$datal1[$mon])*100/$teplo09[$mon]; $it8+=$datal1[$mon];  }
	 if ($datal2[$mon] && $ee09[$mon]) 
		{ $ot_ee09[$mon]=$ee09[$mon]-$datal2[$mon]; $ot_ee_p09[$mon]=($ee09[$mon]-$datal2[$mon])*100/$ee09[$mon]; $it11+=$datal2[$mon];  }

	 if ($datal10[$mon] && $voda10[$mon]) 
		{ $ot_voda10[$mon]=$voda10[$mon]-$datal10[$mon]; $ot_voda_p10[$mon]=($voda10[$mon]-$datal10[$mon])*100/$voda10[$mon]; $its5+=$datal10[$mon];  }
	 if ($datal11[$mon] && $teplo10[$mon]) 
		{ $ot_teplo10[$mon]=$teplo10[$mon]-$datal11[$mon]; $ot_teplo_p10[$mon]=($teplo10[$mon]-$datal11[$mon])*100/$teplo10[$mon]; $its8+=$datal11[$mon];  }
	 if ($datal12[$mon] && $ee10[$mon]) 
		{ $ot_ee10[$mon]=$ee10[$mon]-$datal12[$mon]; $ot_ee_p10[$mon]=($ee10[$mon]-$datal12[$mon])*100/$ee10[$mon]; $its11+=$datal12[$mon];  }
	 
	 $ccn++;
	}
 for ($mon=1;$mon<=12;$mon++)
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$mont[$mon].'</font></td>';
	 print '<td align="center" class="simple">'.number_format($norm[$mon],2).'</td>';
	 print '<td align="center" class="simple">'.number_format($dog[$mon],3).'</td>';
	 print '<td align="center" class="simple"></td>';
	 print '<td align="center" class="simple">'.number_format($voda09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal0[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_voda09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_voda_p09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($teplo09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal1[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_teplo09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_teplo_p09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ee09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal2[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_ee09[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_ee_p09[$mon],3).'</td>';
	 print '</tr>';
	}
 if ($it4 && $it5) $it6=$it4-$it5;
 if ($it4 && $it5) $itp6=($it4-$it5)*100/$it4;
 if ($it7 && $it8) $it9=$it7-$it8;
 if ($it7 && $it8) $itp9=($it7-$it8)*100/$it7;
 if ($it10 && $it11) $it12=$it10-$it11;
 if ($it10 && $it11) $itp12=($it10-$it11)*100/$it10;

 if ($its4 && $its5) $itsp6=($its4-$its5)*100/$its4;
 if ($its4 && $its5) $its6=$its4-$its5;
 if ($its7 && $its8) $itsp9=($its7-$its8)*100/$its7;
 if ($its7 && $its8) $its9=$its7-$its8;
 if ($its10 && $its11) $itsp12=($its10-$its11)*100/$its10;
 if ($its10 && $its11) $its12=$its10-$its11;

 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">Итого</font></td>';
 print '<td align="center" class="simple">'.number_format($it1,2).'</td>';
 print '<td align="center" class="simple">'.number_format($it2,3).'</td>';
 print '<td align="center" class="simple"></td>';
 print '<td align="center" class="simple">'.number_format($it4,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it5,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it6,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itp6,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it7,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it8,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it9,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itp9,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it10,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it11,3).'</td>';
 print '<td align="center" class="simple">'.number_format($it12,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itp12,3).'</td>';

 print '</tr></table></td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px" cellspacing="1" bgcolor="#5D6D2f">';
  print '<tr><td class="m_separator" colspan="4"></td><td class="m_separator" colspan="12" align="center">2011</td></tr>
	 <tr class="m_separator"><td class="m_separator"></td><td align="center" colspan="3" class="m_separator">Базовый уровень потребления 2009</td><td align="center" colspan="4" class="m_separator">вода, м3</td><td align="center" colspan="4" class="m_separator">тепло, ГКал</td><td align="center" colspan="4" class="m_separator">электроэнергия, кВт*ч</td></tr>
	 <tr class="m_separator"><td class="m_separator">месяц</td><td align="center" class="m_separator">вода, м3</td><td align="center" class="m_separator">тепло, ГКал</td><td align="center" class="m_separator">ЭЭ, кВт*ч</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Факт откл</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Факт откл</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">Факт откл</td><td align="center" class="m_separator">% вып. ФЗ</td></tr>';
 for ($mon=1;$mon<=12;$mon++)
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$mont[$mon].'</font></td>';
	 print '<td align="center" class="simple">'.number_format($norm[$mon],2).'</td>';
	 print '<td align="center" class="simple">'.number_format($dog[$mon],3).'</td>';
	 print '<td align="center" class="simple"></td>';
	 print '<td align="center" class="simple">'.number_format($voda10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_voda10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_voda_p10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($teplo10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal11[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_teplo10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_teplo_p10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ee10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal12[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_ee10[$mon],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($ot_ee_p10[$mon],3).'</td>';
	 print '</tr>';
	}
 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">Итого</font></td>';
 print '<td align="center" class="simple">'.number_format($its1,2).'</td>';
 print '<td align="center" class="simple">'.number_format($its2,3).'</td>';
 print '<td align="center" class="simple"></td>';
 print '<td align="center" class="simple">'.number_format($its4,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its5,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its6,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itsp6,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its7,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its8,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its9,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itsp9,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its10,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its11,3).'</td>';
 print '<td align="center" class="simple">'.number_format($its12,3).'</td>';
 print '<td align="center" class="simple">'.number_format($itsp12,3).'</td>';

 print '</tr>';

 print '</table></td></tr>';
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
</div>