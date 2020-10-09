<?php
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 if ($ui) $name=$ui[1]; $norm1=$ui[17]; $norm2=$ui[18];

	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 $device=$uo[11];

	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Отчет об экономии энергоресурсов</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="600px">';
	 print '<tr><td class="m_separator">Количество </td><td class="menuitem">'.$ui[15].'</td></tr>';
	 print '<tr><td class="m_separator">Площадь здания </td><td class="menuitem">'.$ui[14].'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Экономия холодной воды</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align="center" class="m_separator">Назначение: оценка временной тенденции изменений в потреблении воды</td></tr>';
	 print '<tr><td align="center">Норматив расхода воды для детских садов со столовыми, работающими на сырье и прачечными, оборудованными автоматическими стиральными машинами - 105 летров на ребенка в сутки</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';

	 print '<tr><td align=center><table width="1000px">';
	 print '<tr><td class="m_separator">Период</td><td class="m_separator">Норматив (куб.м. в месяц)</td><td class="m_separator" colspan="2">Факт</td><td class="m_separator" colspan="2">Экономия к прошлому году</td><td class="m_separator" colspan="2">Экономия к нормативу</td><td class="m_separator">Тариф на водоснабжение и канализацию (руб.)</td><td class="m_separator">Стоимость экономии воды по отношению к нормативу</td><td class="m_separator">Стоимость экономии воды по отношению к прошлому году</td></tr>';
	 print '<tr><td class="m_separator"></td><td class="menuitem"></td><td class="menuitem" align="center">2010г.</td><td class="menuitem" align="center">2011г.</td><td class="menuitem" align="center">м3</td><td class="menuitem" align="center">%</td><td class="menuitem" align="center">м3</td><td class="menuitem" align="center">%</td><td class="menuitem" align="center"></td><td class="menuitem" align="center"></td></tr>';
	 $today=getdate();
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $dy=31;
		 if (!checkdate ($mon,31,$today["year"])) { $dy=30; }
		 if (!checkdate ($mon,30,$today["year"])) { $dy=29; }
		 if (!checkdate ($mon,29,$today["year"])) { $dy=28; }

		 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon);		
	         $stl=sprintf("%d-%02d",$today["year"],$mon);

		 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND prm=12 AND date='.$sts.' AND source=6 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $last=$ui[0];

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=12 AND date LIKE \'%'.$stl.'%\' AND source=6 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 $fakt=$ui[0];	
		 $norm=$norm_hvs*$dy*$nab;

		 if ($last>0) { $pr01=number_format(($last-$fakt)*100/$last,2); $ek01=$last-$fakt; } else { $pr01='-'; $ek01='-'; }
		 if ($norm>0) { $pr02=number_format(($norm-$fakt)*100/$norm,2); $ek02=$norm-$fakt; } else { $pr02='-'; $ek02='-'; }
		 $pr03='-';
//		 $snorm+=$norm_hvs*$dy*nab; 

		 $month=$mon; include ("time.inc");
		 print '<tr><td class="m_separator">'.$month.'</td><td class="simple_bold" align="center">'.number_format($norm_hvs*$dy*$nab,2).'</td>
			<td class="simple_bold" align="center">'.number_format($last,2).'</td><td class="simple_bold" align="center">'.number_format($fakt,2).'</td>
			<td class="simple_bold" align="center">'.$ek01.'</td><td align="center" class="simple_bold">'.$pr01.'</td>
			<td class="simple_bold" align="center">'.$ek02.'</td><td align="center" class="simple_bold">'.$pr02.'</td>
			<td class="simple_bold" align="center">'.$tarif_voda.'</td><td class="simple_bold" align="center">'.$tarif_voda*$ek01.'</td>
			<td class="simple_bold" align="center">'.number_format($tarif_voda*$ek02,2).'</td></tr>';
		 $slast+=$last; $sfakt+=$fakt; $snorm+=$norm; $sst1+=$ek01*$tarif_voda; $sst2+=$ek02*$tarif_voda;
		}
	 if ($slast>0 && $sfakt>0) { $itpr1=number_format(($slast-$sfakt)*100/$slast,2); $ek1=$slast-$sfakt; } else { $itpr1='-'; $ek1='-'; }
	 if ($sfakt>0 && $snorm>0) { $itpr2=number_format(($snorm-$sfakt)*100/$sfakt,2); $ek2=$snorm-$sfakt; } else { $itpr2='-'; $ek2='-'; } 
	 print '<tr align="center"><td class="m_separator">Итого</td><td class="m_separator">'.$snorm.'</td><td class="m_separator" align="center">'.$slast.'</td><td class="m_separator" align="center">'.number_format($sfakt,2).'</td><td class="m_separator" align="center">'.$ek1.'</td><td class="m_separator" align="center">'.$itpr1.'</td>
		<td class="m_separator" align="center">'.$ek2.'</td><td class="m_separator" align="center">'.$itpr2.'</td>
		<td class="m_separator" align="center">'.$tarif_voda.'</td><td class="m_separator" align="center">'.$sst1.'</td><td class="m_separator" align="center">'.$sst2.'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align="left" class="simple">[1] Постановление Главы администрации города Челябинска от 30 марта 1994г. N328 НОРМЫ РАСХОДА ВОДЫ ПОТРЕБИТЕЛЯМИ СОГЛАСНО СНИП 2.04-01.85</td></tr></table>';
	 print '<tr><td class="simple"><strong>Вывод:</strong><br>Потребление воды ниже установленных нормативов</td></tr>';

	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Экономия тепловой энергии</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align="center" class="m_separator">Назначение: оценка временной тенденции изменений в потреблении тепловой энергии</td></tr>';
	 print '<tr><td align="center">Расчетно-нормативная удельная тепловая характеристика здания 0.86 Вт/куб.м. (1ккал/ч 1.163 Вт)</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';

	 print '<tr><td align=center><table width="1000px">';
	 print '<tr><td class="m_separator">Период</td><td class="m_separator">Договорной уровень</td><td class="m_separator" colspan="2">Данные приборов учета</td><td class="m_separator" colspan="2">Экономия к прошлому году (%)</td><td class="m_separator" colspan="2">Экономия к договорному (%)</td><td class="m_separator">Тариф</td><td class="m_separator">Стоимость экономии к прошл. году (руб)</td><td class="m_separator">Стоимость экономии к дог. году (руб)</td></tr>';
	 print '<tr><td class="m_separator"></td><td class="menuitem"></td><td class="menuitem" align="center">2010г.</td><td class="menuitem" align="center">2011г.</td><td class="menuitem" align="center">м3</td><td class="menuitem" align="center">%</td><td class="menuitem" align="center">м3</td><td class="menuitem" align="center">%</td><td class="menuitem" align="center">руб</td><td class="menuitem" align="center">руб</td><td class="menuitem" align="center">руб</td></tr>';
	 $today=getdate(); $tarif=1034.53;
	 $snorm=$slast=$sfakt=0;
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon); $sts2=sprintf("%d%02d01000000",$today["year"],$mon);		
	         $stl=sprintf("%d-%02d",$today["year"],$mon);
		 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date='.$sts2.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $dog=$ui[0];

		 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND prm=13 AND date='.$sts.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $last=$ui[0];

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=13 AND date LIKE \'%'.$stl.'%\' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 $fakt=$ui[0];	

		 if ($last>0 && $fakt>0) { $slast+=$last; $sfakt+=$fakt; $pr01=number_format(($last-$fakt)*100/$last,2); $ek01=number_format(($last-$fakt),2); } else { $pr01='-'; $ek01='-'; }
		 if ($dog>0 && $fakt>0) { $snorm+=$dog; $pr02=number_format(($dog-$fakt)*100/$dog,2); $ek02=number_format(($dog-$fakt),2); } else { $pr02='-'; $ek02='-'; }

		 //if ($last>0) $pr01=number_format(($last-$fakt)*100/$last,2); else $pr01='-';
		 //if ($norm2>0) $pr02=number_format(($norm2-$fakt)*100/$norm2,2); else $pr02='-';
		 if ($last>0) $ek_rub1=$tarif*$ek01; else $ek_rub1='-';
		 if ($dog>0) $ek_rub2=$tarif*$ek02; else $ek_rub2='-';

		 $pr03='-';
		 //$snorm+=$dog; $slast+=$last; $sfakt+=$fakt;
		 $month=$mon; include ("time.inc");
		 print '<tr><td class="m_separator">'.$month.'</td><td class="simple_bold" align="center">'.$dog.'</td>
			<td class="simple_bold" align="center">'.number_format($last,2).'</td><td class="simple_bold" align="center">'.number_format($fakt,2).'</td>
			<td class="simple_bold" align="center">'.$ek01.'</td><td align="center" class="simple_bold">'.$pr01.'</td>
			<td class="simple_bold" align="center">'.$ek02.'</td><td align="center" class="simple_bold">'.$pr02.'</td>
			<td class="simple_bold" align="center">'.$tarif.'</td><td class="simple_bold" align="center">'.$ek_rub1.'</td><td class="simple_bold" align="center">'.$ek_rub2.'</td></tr>';
		}
	 if ($slast>0) 
		{
		 $total=$slast-$sfakt; $totalpr=($slast-$sfakt)*100/$slast;
		 $total2=$snorm-$sfakt; $totalpr2=($snorm-$sfakt)*100/$snorm;
		 $sumek1=$total*$tarif; $sumek2=$total2*$tarif;
		}
	 else { $total=$total2=$totalpr=$totalpr2=$sumek1=$sumek2='0'; }
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator">'.$snorm.'</td><td class="m_separator" align="center">'.number_format($slast,2).'</td><td class="m_separator" align="center">'.number_format($sfakt,2).'</td>
		<td class="m_separator" align="center">'.number_format($total,2).'</td>
		<td class="m_separator" align="center">'.number_format($totalpr,2).'</td>
		<td class="m_separator" align="center">'.number_format($total2,2).'</td>
		<td class="m_separator" align="center">'.number_format($totalpr2,2).'</td>
		<td class="m_separator" align="center">'.$tarif.'</td><td class="m_separator" align="center">'.number_format($sumek1,2).'</td><td class="m_separator" align="center">'.number_format($sumek2,2).'</td></tr>';
	 print '</table>';
	 print '<tr><td class="simple"><strong>Вывод:</strong><br>За 3 месяца (с марта по май включительно) по отношению к договорному уровню было сэкономлено '.number_format($sumek2,2).' рублей. <br>По отношению к прошлому году - '.number_format($sumek1,2).' рублей. Для более корректных оценок необходимо делать корректировку на среднемесячную температуру наружного воздуха.</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Отчет об экономии электрической энергии</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align="center" class="m_separator">Назначение: оценка временной тенденции изменений в потреблении электрической энергии</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center><table width="1000px">';
	 print '<tr><td class="m_separator">Период</td><td class="m_separator" colspan="2">Потребление, кВт*ч</td><td class="m_separator" colspan="2">Экономия к прошлому году (%)</td><td class="m_separator">Тариф, руб.</td><td class="m_separator">Стоимость экономии к прошлому году, руб.</td></tr>';
	 print '<tr><td class="m_separator"></td><td class="menuitem" align="center">2010г.</td><td class="menuitem" align="center">2011г.</td>
		<td class="menuitem" align="center">кВт*ч</td><td class="menuitem" align="center">%</td>
		<td class="menuitem" align="center"></td><td class="menuitem" align="center"></td></tr>';
	 print '<tr align="center"><td class="menuitem_bold">1</td><td class="menuitem_bold">2</td><td class="menuitem_bold">3</td><td class="menuitem_bold">4</td><td class="menuitem_bold">5</td><td class="menuitem_bold">6</td><td class="menuitem_bold">7</td></tr>';

	 $today=getdate(); $tarif=1.34;
	 $snorm=$slast=$sfakt=0;
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon); $sts2=sprintf("%d%02d01000000",$today["year"],$mon);		
	         $stl=sprintf("%d-%02d",$today["year"],$mon);
		 $query = 'SELECT SUM(value) FROM data WHERE type=4 AND prm=14 AND date='.$sts.' AND source=0 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $last=$ui[0];

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=14 AND date LIKE \'%'.$stl.'%\' AND source=0 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 $fakt=$ui[0];	

		 if ($last>0 && $fakt>0) { $slast+=$last; $sfakt+=$fakt; $pr01=number_format(($last-$fakt)*100/$last,2); $ek01=number_format(($last-$fakt),2); } else { $pr01='-'; $ek01='-'; }
		 if ($last>0) $ek_rub1=$tarif*$ek01; else $ek_rub1='-';

		 $pr03='-';
		 //$snorm+=$dog; $slast+=$last; $sfakt+=$fakt;
		 $month=$mon; include ("time.inc");
		 print '<tr><td class="m_separator">'.$month.'</td>
			<td class="simple_bold" align="center">'.number_format($last,2).'</td><td class="simple_bold" align="center">'.number_format($fakt,2).'</td>
			<td class="simple_bold" align="center">'.$ek01.'</td><td align="center" class="simple_bold">'.$pr01.'</td>
			<td class="simple_bold" align="center">'.$tarif.'</td><td class="simple_bold" align="center">'.$ek_rub1.'</td></tr>';
		}
	 if ($slast>0) 
		{
		 $total=$slast-$sfakt; $totalpr=($slast-$sfakt)*100/$slast; $sumek1=$total*$tarif;
		}
	 else { $total=$totalpr=$sumek1='0'; }
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator" align="center">'.number_format($slast,2).'</td><td class="m_separator" align="center">'.number_format($sfakt,2).'</td>
	<td class="m_separator" align="center">'.number_format($total,2).'</td>
	<td class="m_separator" align="center">'.number_format($totalpr,2).'</td>
	<td class="m_separator" align="center">'.$tarif.'</td><td class="m_separator" align="center">'.$sumek1.'</td></tr>';
	 print '</table>';

?>