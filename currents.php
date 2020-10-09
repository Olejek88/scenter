<div id="maincontent" style="width:100%; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<?php		
 $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $tpod=$tobr=$vpod=$vobr=$qpod=$qobr=$qpot=$vgvs=$vhvs=0;
	 $dat='-';

	 $query = 'SELECT * FROM devices WHERE ust=1 AND object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 if (!$uo[0])
		{ 
		 $ui = mysql_fetch_row ($e);
		 continue;
		}
	 $query = 'SELECT * FROM data WHERE type=0 AND value>0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[8]==11 && $uy[6]==0 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==11 && $uy[6]==1 && !$vobr) $vobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==0 && !$qpod) $qpod=$uy[3]*1000;
		 if ($uy[8]==13 && $uy[6]==1 && !$qobr) $qobr=$uy[3]*1000;
		 if ($uy[8]==13 && $uy[6]==2 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==12 && $uy[6]==5 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==6 && !$vhvs) $vhvs=$uy[3];
		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 

	 print '<tr><td>
		<table border="0" cellpadding="0" cellspacing="5" width="100%">
		<tbody>
		<tr><td valign="top" width="100">
		<table cellpadding=1 cellspacing=1 bgcolor=#82cc7f align=center>';
		$query = 'SELECT * FROM data WHERE type=2 AND prm=4 AND source=0 AND date>20100911000000 AND value>0 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		$query = 'SELECT * FROM data WHERE type=2 AND prm=4 AND source=1 AND date>20100911000000 AND value>0 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur2 = mysql_fetch_row ($u);
		if (!$tpod) $tpod=$ur[3]; if (!$tpod) $tobr=$ur2[3];
		print '<tr><td align="center"><img src="charts/led.php?dat=Tvh1='.number_format($tpod,2).'C" width=180 height=30></td><td align="center"><img src="charts/led.php?n=3&dat=Tvh2='.number_format($tobr,2).'C" width=180 height=30></td></tr>';
		$query = 'SELECT * FROM data WHERE type=2 AND prm=11 AND source=0 AND value>0 AND date>20100911000000 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		$query = 'SELECT * FROM data WHERE type=2 AND prm=11 AND source=1 AND value>0 AND date>20100911000000 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur2 = mysql_fetch_row ($u);
		if (!$vpod) $vpod=$ur[3]; if (!$vpod) $vobr=$ur2[3];
		print '<tr><td align="center"><img src="charts/led.php?dat=Vpod='.number_format($vpod,3).'m3" width=180 height=30></td><td align="center"><img src="charts/led.php?n=3&dat=Vobr='.number_format($vobr,3).'m3" width=180 height=30></td></tr>';

		$query = 'SELECT * FROM data WHERE type=2 AND prm=11 AND source=6 AND value>0 AND date>20100911000000 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		$query = 'SELECT * FROM data WHERE type=2 AND prm=4 AND source=5 AND value>0 AND date>20100901000000 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur2 = mysql_fetch_row ($u);
		print '<tr><td align="center"><img src="charts/led.php?n=2&dat=Vgv='.number_format($ur[3],2).'m3" width=180 height=30></td><td align="center"><img src="charts/led.php?n=2&dat=Tgv='.number_format($ur2[3],2).'C" width=180 height=30></td></tr>';

		$query = 'SELECT * FROM data WHERE type=2 AND prm=11 AND source=5 AND value>0  ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		print '<tr><td align="center"><img src="charts/led.php?dat=Vhv='.number_format($ur[3],2).'m3" width=180 height=30></td><td align="center"></td></tr>';

		$query = 'SELECT * FROM data WHERE type=2 AND prm=12 AND source=0 AND value>0 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		$query = 'SELECT * FROM data WHERE type=2 AND prm=12 AND source=1 AND value>0 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur2 = mysql_fetch_row ($u);
		if (!$qpod) $qpod=$ur[3]; if (!$qobr) $qobr=$ur2[3];
		print '<tr><td align="center"><img src="charts/led.php?n=4&dat=Qpod='.number_format($qpod,3).'MK" width=180 height=30></td><td align="center"><img src="charts/led.php?n=4&dat=Qobr='.number_format($qobr,3).'MK" width=180 height=30></td></tr>';

		$query = 'SELECT * FROM data WHERE type=1 AND prm=13 AND source=0 AND value>0 ORDER BY RAND()';
		$u = mysql_query ($query,$i); if ($u) $ur = mysql_fetch_row ($u);
		if (!$qpot) $qpot=$ur[3];
		print '<tr><td align="center" colspan=2><img src="charts/led.php?n=1&dat=Qpot='.number_format($qpot,5).'GKkal" width=300 height=30></td></tr>';

	 print '</tbody></table></td>';
	 print '<td valign="top"><table border="0"><tbody><tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Узел учета</font></td></tr>';
	 print '<tr><td colspan=2><b>'.$ui[1].'</b></td></td></tr>';
	 print '<tr><td><b>Тип объекта:</b></td><td align="right"><span id="ajax_date">';
	  if ($ui[2]==0) print 'не определен';
	  if ($ui[2]==1) print 'Жилое здание';
	  if ($ui[2]==2) print 'Поставщик энергоресурсов';
	  if ($ui[2]==3) print 'Муниципальный объект';
	  if ($ui[2]==4) print 'Промышленный объект';
	 print '</span></td></tr>';
	 print '<tr><td><b>Контроллер:</b></td><td align="right"><span id="ajax_date">'.$uo[1].'</span></td></tr>
	  <tr><td><b>Интерфейс:</b></td><td align="right"><span id="ajax_amount">';
	  if ($uo[4]==0) print 'не определен';
	  if ($uo[4]==1) print 'Ethernet';
	  if ($uo[4]==2) print 'GPRS';
	  if ($uo[4]==3) print 'GSM';
	  if ($uo[4]==4) print 'Беспроводной';
	  print '</span></td></tr>
	  <tr><td><b>IP/Тел.нм:</b></td><td align="right"><span id="ajax_amount">'.$uo[13].'</span></td></tr>
	  <tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Нормативное потребление</font></td></tr>
	  <tr><td><b>Электроэнергия:</b></td><td align="right">4125</td></tr>
	  <tr><td><b>Вода:</b></td><td align="right">1230</td></tr>
	  <tr><td><b>Тепло:</b></td><td align="right">321</td></tr>
	  <tr><td><b>Газ:</b></td><td align="right">-</td></tr>
   	  </tbody></table>
	  </td>
	  <td valign="top">
	  <table border="0" width="200">
	  <tbody><tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Характеристика объекта</font></td></tr>
	  <tr><td><b>Количество этажей:</b></td><td align="right">5</td></tr>
	  <tr><td><b>Квартир:</b></td><td align="right">52</td></tr>
	  <tr><td><b>Жильцов:</b></td><td align="right">'.$ui[15].'</td></tr>
	  <tr><td><b>Стояков:</b></td><td align="right">29</td></tr>
	  <tr><td><b>Подъездов:</b></td><td align="right">3</td></tr>
	  <tr><td><b>Площадь:</b></td><td align="right">'.$ui[14].'</td></tr>
	  </table></td></tr></table></td>';
	 print '<td><table border="0" width="1100">
		<tr><td><img border=1 src="charts/trend.php?type=1&device='.$uo[11].'&object='.$uo[0].'" width="1100" height="100"></td></tr>
		<tr><td><img border=1 src="charts/trend.php?type=3&device='.$uo[11].'&&object='.$uo[0].'" width="1100" height="100"></td></tr>
	 </tbody></table></td></tr>';
	 $ui = mysql_fetch_row ($e);
	}
?>
</tbody></table></td>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>

</div>