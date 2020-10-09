<?php
  print '<table><tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Оценка строгости соблюдения поставщиком договорных обязательств. Расчет возможных финансовых претензий</td></tr></table>';
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) //$ui = mysql_fetch_row ($e);
		 $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
	 if ($ui) $name=$ui[1];
	 $query = 'SELECT * FROM uprav WHERE id='.$ui2["uprav"];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 if ($uo) $uprav=$uo[1];
	 
	 print '<tr><td align=center class="m_separator">Перерывы в водоснабжении (количество часов)</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="1200px">';
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 for ($mon=1;$mon<=12;$mon++)
	 for ($day=1;$day<=31;$day++)
		$hours[$mon][$day]=0;

	 $query = 'SELECT * FROM data WHERE type=1 AND value=0 AND prm=16 AND date>=20110101000000 AND source=2 AND device='.$uo[11];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);	
	 while ($ui) 
		{
		 $mon=$ui[2][5]*10+$ui[2][6];
                 $day=$ui[2][8]*10+$ui[2][9];
		 //echo $mon.' '.$day.'<br>';
		 $hours[$mon][$day]++;
		 $ui = mysql_fetch_row ($e);
		}
	 for ($mon=0;$mon<=12;$mon++)
		{
		 print '<tr>';	$month=$mon;
		 include ("time.inc");
		 if ($mon==0) print '<td class="m_separator"></td>';
		 else print '<td class="m_separator">'.$month.'</td>';
		 for ($day=1;$day<=31;$day++)
			{
			 if ($mon==0) print '<td class="m_separator">'.$day.'</td>';
			 else if ($hours[$mon][$day]==0) print '<td class="simple" align="center">'.$hours[$mon][$day].'</td>';
			 else if ($hours[$mon][$day]>=24) print '<td class="simple" align="center">24</td>';
			 else print '<td class="menuitem_bold" align="center">'.$hours[$mon][$day].'</td>';
			 $smon[$mon]+=$hours[$mon][$day];
			}
		 if ($mon==0) print '<td class="m_separator">Всего</td>';
		 else print '<td class="m_separator">'.$smon[$mon].'</td>';
		 $syear+=$smon[$mon];
		 print '</tr>';
		}
	 print '<tr><td class="m_separator" colspan="2">Итого за год</td><td class="m_separator" colspan="5">'.$syear.'</td></tr>';	 		 
	 print '</table></td></tr>';
	 print '<tr><td height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Перерывы в теплоснабжении (количество часов)</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="1200px">';
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i); 
	 if ($y) $uo = mysql_fetch_row ($y);
	 for ($mon=1;$mon<=12;$mon++)
	 for ($day=1;$day<=31;$day++)
		$hours[$mon][$day]=0;

	 $query = 'SELECT * FROM data WHERE type=1 AND value=0 AND prm=13 AND date>=20110101000000 AND source=0 AND device='.$uo[11];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);	
	 while ($ui) 
		{
		 $mon=$ui[2][5]*10+$ui[2][6];
                 $day=$ui[2][8]*10+$ui[2][9];
		 //echo $mon.' '.$day.'<br>';
		 $hours[$mon][$day]++;
		 $ui = mysql_fetch_row ($e);
		}
	 for ($mon=0;$mon<=12;$mon++)
		{
		 print '<tr>';	$month=$mon;
		 include ("time.inc");		
		 if ($mon==0) print '<td class="m_separator"></td>';
		 else print '<td class="m_separator">'.$month.'</td>';
		 for ($day=1;$day<=31;$day++)
			{
			 if ($mon==0) print '<td class="m_separator">'.$day.'</td>';
			 else if ($hours[$mon][$day]==0) print '<td class="simple" align="center">'.$hours[$mon][$day].'</td>';
			 else if ($hours[$mon][$day]>=24) print '<td class="simple" align="center">24</td>';
			 else print '<td class="menuitem_bold" align="center">'.$hours[$mon][$day].'</td>';
			 $smon2[$mon]+=$hours[$mon][$day];
			}
		 if ($mon==0) print '<td class="m_separator">Всего</td>';
		 else print '<td class="m_separator">'.$smon2[$mon].'</td>';
		 $syear2+=$smon2[$mon];
		 print '</tr>';
		}	
	 print '<tr><td class="m_separator" colspan="2">Итого за год</td><td class="m_separator" colspan="5">'.$syear2.'</td></tr>';	 
	 print '</table></td></tr>';
	 print '<tr><td height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Перерывы в электроснабжении (количество часов)</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="1200px">';
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i); 
	 if ($y) $uo = mysql_fetch_row ($y);
	 for ($mon=1;$mon<=12;$mon++)
	 for ($day=1;$day<=31;$day++)
		$hours[$mon][$day]=0;

	 $query = 'SELECT * FROM data WHERE type=1 AND value=0 AND prm=14 AND date>=20110101000000 AND source=0 AND device='.$uo[11];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);	
	 while ($ui) 
		{
		 $mon=$ui[2][5]*10+$ui[2][6];
                 $day=$ui[2][8]*10+$ui[2][9];
		 //echo $mon.' '.$day.'<br>';
		 $hours[$mon][$day]++;
		 $ui = mysql_fetch_row ($e);
		}
	 for ($mon=0;$mon<=12;$mon++)
		{
		 print '<tr>';	$month=$mon;
		 include ("time.inc");		
		 if ($mon==0) print '<td class="m_separator"></td>';
		 else print '<td class="m_separator">'.$month.'</td>';
		 for ($day=1;$day<=31;$day++)
			{
			 if ($mon==0) print '<td class="m_separator">'.$day.'</td>';
			 else if ($hours[$mon][$day]==0) print '<td class="simple" align="center">'.$hours[$mon][$day].'</td>';
			 else if ($hours[$mon][$day]>=24) print '<td class="simple" align="center">24</td>';
			 else print '<td class="menuitem_bold" align="center">'.$hours[$mon][$day].'</td>';
			 $smon3[$mon]+=$hours[$mon][$day];
			}
		 if ($mon==0) print '<td class="m_separator">Всего</td>';
		 else print '<td class="m_separator">'.$smon3[$mon].'</td>';
		 $syear3+=$smon3[$mon];		 
		 print '</tr>';
		}	
	 print '<tr><td class="m_separator" colspan="2">Итого за год</td><td class="m_separator" colspan="5">'.$syear3.'</td></tr>';	 
	 print '</table></td></tr>';
	 print '<tr><td height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Сводная таблица перерывов в поставке энергоресурсов</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="300px">';
	 print '<tr><td align=center class="m_separator">Месяц</td><td align=center class="m_separator">Водоснабжение (час)</td>
		<td align=center class="m_separator">Теплоснабжение (час)</td><td align=center class="m_separator">Электроснабжение (час)</td></tr>';
	 for ($mon=1;$mon<=12;$mon++)
		{
		 print '<tr>';	
		 $month=$mon;
		 include ("time.inc");		
		 print '<td class="m_separator">'.$month.'</td>';
		 if ($mon>0)
			{
			 print '<td class="simple" align="center">'.$smon[$mon].'</td>';
			 print '<td class="simple" align="center">'.$smon2[$mon].'</td>';
			 print '<td class="simple" align="center">'.$smon3[$mon].'</td>';
			}
		 print '</tr>';
		}	
	 print '<tr align="center"><td class="m_separator">Итого за год</td><td class="m_separator" colspan="1">'.$syear.'</td>
		<td class="m_separator">'.$syear2.'</td><td class="m_separator">'.$syear3.'</td></tr>';	 
	 print '</table></td></tr>';

	 print '</table>';
?>      	