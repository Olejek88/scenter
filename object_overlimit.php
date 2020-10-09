<?php
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<tr><td align=center class="m_separator">Перерасход лимита за '.$today["year"].' год ['.$name.']</td></tr>';
	 if (!$limit_voda) $limit_voda=15;
	 if (!$tarif_voda) $tarif_voda=9.72;
	 if (!$tarif_kanal) $tarif_kanal=6.38;

	 print '<tr><td>
		<b>Договорные значения</b><br>
		Лимит - '.$limit_voda.' куб.м в сутки<br>
		Тариф на воду '.$tarif_voda.'<br>
		Тариф на канализацию '.$tarif_kanal.'<br>
		Тариф на превышение лимита<br>
		За воду 38.88 руб. (четырехкратное увеличение)<br>
		За канализацию 12.76 руб. (двухкратное увеличение)<br>
		Удорожание стоимости сверхлимитного потребления (вода\ канализация) - 38,88\12,76
		</td></tr>';

	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center><table width="800px">';
	 print '<tr><td class="m_separator">Период</td><td class="m_separator">Установленный лимит</td><td class="m_separator">Фактический расход</td><td class="m_separator">Перерасход лимита</td></tr>';
	 //<td class="m_separator">Тариф за превышение лимита (вода / канализация)</td><td class="m_separator">Финансовые потери</td>
	 $today=getdate();
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $dy=31;
		 if (!checkdate ($mon,31,$today["year"])) { $dy=30; }
		 if (!checkdate ($mon,30,$today["year"])) { $dy=29; }
		 if (!checkdate ($mon,29,$today["year"])) { $dy=28; }

		 $sts=sprintf("%d%02d01000000",$today["year"]-1,$mon);		
	         $stl=sprintf("%d-%02d",$today["year"],$mon);

		 $query = 'SELECT SUM(value) FROM data WHERE type=2 AND prm=12 AND date LIKE \'%'.$stl.'%\' AND source=6 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 $fakt=$ui[0];	
		 $norm=$limit_voda*$dy;
		 if ($norm>0) $per=$fakt-$norm; else $per=0;
		 if ($per<0) $per=0;
		 $poteri=38.88*$per+12.76*$per;
		 $limit+=$norm; $sfakt+=$fakt; $sst1+=$per; $sst2+=$poteri;

		 $month=$mon; include ("time.inc");
		 $dat.='&dt'.$mon.'='.$month;
		 $req.='&da'.$mon.'='.$norm.'&db'.$mon.'='.$fakt;
		 $req2.='&da'.$mon.'='.$poteri;

		 print '<tr><td class="m_separator"><a href="index.php?sel=object&menu=overlimit2&month='.$mon.'&id='.$_GET["id"].'">'.$month.'</a></td><td class="simple_bold" align="center">'.$norm.'</td>
			<td class="simple_bold" align="center">'.number_format($fakt,3).'</td><td class="simple_bold" align="center">'.number_format($per,3).'</td></tr>';
		 //<td class="simple_bold" align="center">38.88/12.76</td><td align="center" class="simple_bold">'.$poteri.'</td>
		}
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator" align="center">'.number_format($limit,2).'</td><td class="m_separator" align="center">'.number_format($sfakt,2).'</td><td class="m_separator" align="center">'.$sst1.'</td></tr>';
	 //<td class="m_separator" align="center">-</td><td class="m_separator" align="center">'.$sst2.'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center class="psb">Переплата за превышение лимита составляет '.number_format($sst2,2).' рублей</td></tr>';
	 print '<tr><td align=center><br><br></td></tr>';
	 print '<tr><td align=center><img src="charts/barplots31.php?type=1&'.$dat.$req.'"></td></tr>';
	 print '</table>';
?>