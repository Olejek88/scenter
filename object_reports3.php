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
	 if (!$tarif_teplo) $tarif_teplo=1154.63;
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Сравнительный анализ договорных величин и фактического потребления тепла</td></tr>';
	 print '<tr><td align="left" colspan="2">Тариф на тепловую энергию '.$tarif_teplo.' руб. с НДС</td></tr>';
	 print '<tr><td align=center><table width="500px">';
	 print '<tr><td class="m_separator">Период</td><td class="m_separator">Договорной уровень 2011г., ГКал</td>
		<td class="m_separator">Фактическое потребление 2011 г.,ГКал</td>
		<td class="m_separator" colspan="2">Экономия к договорному</td><td class="m_separator">Стоимость экономии к договорному уровню, руб.</td></tr>';
	 print '<tr><td class="m_separator"></td><td class="menuitem"></td><td class="menuitem" align="center"></td><td class="menuitem" align="center">ГКал</td><td class="menuitem" align="center">%</td><td class="menuitem" align="center"></td></tr>';
	 $today=getdate(); 
	 $snorm=$slast=$sfakt=0; $req=''; $cn=11;
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $dog=$fakt=0;
		 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon); $sts2=sprintf("%d%02d01000000",$today["year"],$mon);		
	         $stl=sprintf("%d-%02d",$today["year"],$mon);
		 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date='.$sts2.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 if ($ui) $dog=$ui[0];

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=13 AND date LIKE \'%'.$stl.'%\' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 if ($ui)$fakt=$ui[0];	

		 if ($dog>0 && $fakt>0) { $snorm+=$dog; $pr02=number_format(($dog-$fakt)*100/$dog,2); $ek02=number_format(($dog-$fakt),2); } else { $pr02='-'; $ek02='-'; }
		 if ($dog>0) $ek_rub2=$tarif_teplo*$ek02; else $ek_rub2='-';
		 $sfakt+=$fakt;
		 $pr03='-';
		 //$snorm+=$dog; $slast+=$last; $sfakt+=$fakt;
		 $month=$mon; include ("time.inc");
		 $req.='&dt'.$cn.'='.$month.'&pt'.$cn.'='.$dog.'&nt'.$cn.'='.$fakt;

		 print '<tr><td class="m_separator">'.$month.'</td><td class="simple_bold" align="center">'.$dog.'</td>
			<td class="simple_bold" align="center">'.number_format($fakt,2).'</td>
			<td class="simple_bold" align="center">'.$ek02.'</td><td align="center" class="simple_bold">'.$pr02.'</td>
			<td class="simple_bold" align="center">'.$ek_rub2.'</td></tr>';
		 $cn--;
		}
	 if ($slast>0) 
		{
		 $total2=$snorm-$sfakt; $totalpr2=($snorm-$sfakt)*100/$snorm;
		 $sumek2=$total2*$tarif_teplo;
		}
	 else { $total=$total2=$totalpr=$totalpr2=$sumek1=$sumek2='0'; }
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator">'.$snorm.'</td>
		<td class="m_separator" align="center">'.number_format($sfakt,2).'</td>
		<td class="m_separator" align="center">'.number_format($total2,2).'</td>
		<td class="m_separator" align="center">'.number_format($totalpr2,2).'</td>
		<td class="m_separator" align="center">'.number_format($sumek2,2).'</td></tr>';
	 print '</table></td>';
	 print '<td valign="top"><img src="charts/barplots19.php?cons=12&x=700&y=300&'.$req.'"><br>
		<b>Вывод:</b><br></td></tr></table>';
?>