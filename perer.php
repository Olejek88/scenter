<?php
  print '<table><tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Определение и расчет возможности выставить поставщику в соотвествии с договором финансовых претензий за причиненный ущерб</td></tr></table>';
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<tr><td align=center class="m_separator">Отчет о перерывах в энергоснабжении за '.$prevmonth.'</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="1200px">';

	 $query = 'SELECT * FROM objects';
	 $e = mysql_query ($query,$i); $obj=0;
	 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
	 while ($ui2)
		{
		 if ($ui) $name=$ui[1];
		 $query = 'SELECT * FROM uprav WHERE id='.$ui2["type"];
		 $e2 = mysql_query ($query,$i);
		 if ($e2) $uo = mysql_fetch_row ($e2);
		 if ($uo) $uprav=$uo[1];
	 
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 $y = mysql_query ($query,$i);
		 if ($y) $uo = mysql_fetch_row ($y);

		 for ($mon=1;$mon<=12;$mon++)
		 for ($day=1;$day<=31;$day++)
			$hours[$obj][$mon][$day]=0;
		 $dev[$obj]=$uo[11];
		 $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC); $obj++;
		}
	 $objects=$obj;

	 $query = 'SELECT * FROM data WHERE type=1 AND value=0 AND (prm=16 OR prm=13) AND date>=20110101000000 AND source=2';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);	
	 while ($ui) 
		{
		 for ($obj=0;$obj<$objects;$obj++)
			if ($dev[$obj]=$ui[4])
				{
				 $mon=$ui[2][5]*10+$ui[2][6];
		                 $day=$ui[2][8]*10+$ui[2][9];
				 //echo $mon.' '.$day.'<br>';
				 if ($ui[8]==16) { $hours[$obj][$mon][$day]++; $smon[$obj]++; }
				 if ($ui[8]==13) { $hours2[$obj][$mon][$day]++; $smon2[$obj]++; }
				}
		 $ui = mysql_fetch_row ($e);
		}               
	 for ($obj=0;$obj<$objects;$obj++)
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $dy=31;
		 if (!checkdate ($mn,31,$ye)) { $dy=30; }
		 if (!checkdate ($mn,30,$ye)) { $dy=29; }
		 if (!checkdate ($mn,29,$ye)) { $dy=28; }
		 for ($day=1;$day<=$dy;$day++)
			{
			 $day=$
			 $hour[$obj][$day]
			}

	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 print '<tr><td class="m_separator">Дата</td>';
	 for ($day=1;$day<=$dy;$day++)
		 print '<td class="m_separator">'.$day.'</td>';
	 print '<td class="m_separator">Всего за месяц</td></tr>';
	 print '<tr><td class="m_separator">Вода</td>';
	 for ($day=1;$day<=$dy;$day++)
		if ($hours[$mn][$day]>=24) print '<td class="simple" align="center">24</td>';
		else print '<td class="menuitem_bold" align="center">'.$hours[$mn][$day].'</td>';
	 print '<td class="m_separator">'.$smon[$mn].'</td></tr>';
	 print '<tr><td class="m_separator">Тепло</td>';
	 for ($day=1;$day<=$dy;$day++)
		if ($hours2[$mn][$day]>=24) print '<td class="simple" align="center">24</td>';
		else print '<td class="menuitem_bold" align="center">'.$hours2[$mn][$day].'</td>';
	 print '<td class="m_separator">'.$smon2[$mn].'</td></tr>';
	 print '<tr><td class="m_separator">Э/энергия</td>';
	 for ($day=1;$day<=$dy;$day++)                  
		if ($hours3[$mn][$day]>=24) print '<td class="simple" align="center">24</td>';
		else print '<td class="menuitem_bold" align="center">'.$hours3[$mn][$day].'</td>';
	 print '<td class="m_separator">'.$smon3[$mn].'</td></tr>';
	 print '</table></td></tr>';
	 print '</table>';
  print '<table>';
  if (!$smon[$mn] && !$smon2[$mn] && !$smon3[$mn]) print '<tr><td class="simple"><strong>Вывод:</strong><br>Перерывов не зафиксировано</td></tr>';
  else print '<tr><td class="simple"><strong>Вывод:</strong><br>Зафиксированы перерывы в энергоснабжении</td></tr>';
  print '<tr><td class="simple"><strong>Допустимая продолжительность перерыва подачи холодной воды:</strong><br>8 часов суммарно в течении 1 месяца, 4 часа единовременно<br> За каждый час превышения допустимой продолжительности перерыва подачи холодной воды, исчисленной суммарно за расчетный период, в котором размер платы за коммунальную услугу за такой расчетный период снижается на 0.15% размера платы за такой расчетный период.</td></tr>';
  print '<tr><td class="simple"><strong>Перерывы в теплоснабжении:</strong><br>В случаях перерывов в теплоснабжении "Потребителя" по вине "Поставщика услуг", а также подачи тепловой энергии несоответствующего качества зафиксированного метрологически освидетельствованными приборами и при налиии двухстороннего акта, "Поставщик услуг" возмещает "Потребителю" причиненный реальный ущерб.</td></tr>';
  print '</table>';
?>      	