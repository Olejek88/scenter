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
	 $tpod=$tobr=$vpods=$vobrs=$qpods=$qobrs=$qpots=$vgvs=$vhvs=0;
	 $tpod2=$tobr2=$vpods2=$vobrs2=$qpods2=$qobrs2=$qpots2=$vgvs2=$vhvs2=0;
	 $tpod3=$tobr3=$vpods3=$vobrs3=$qpods3=$qobrs3=$qpots3=$vgvs3=$vhvs3=0;

	 $dat='-';

	 $query = 'SELECT * FROM devices WHERE ust=1 AND object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 if (!$uo[0])
		{ 
		 $ui = mysql_fetch_row ($e);
		 continue;
		}	
	 $query = 'SELECT * FROM data WHERE (type=0 OR type=1 OR type=2) AND value>0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[1]==0 && $uy[8]==4 && $uy[6]==0 && !$tpod3) $tpod3=$uy[3];
		 if ($uy[1]==0 && $uy[8]==4 && $uy[6]==1 && !$tobr3) $tobr3=$uy[3];
		 if ($uy[1]==2 && $uy[8]==12 && $uy[6]==21 && !$vpods3) $vpods3=$uy[3];
		 if ($uy[1]==2 && $uy[8]==12 && $uy[6]==22 && !$vobrs3) $vobrs3=$uy[3];
		 if ($uy[1]==2 && $uy[8]==12 && $uy[6]==23 && !$vpots3) $vpots3=$uy[3];

		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==21 && !$qpods3) $qpods3=$uy[3];
		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==22 && !$qobrs3) $qobrs3=$uy[3];
		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==23 && !$qpots3) $qpots3=$uy[3];

		 if ($uy[8]==12 && $uy[6]==25 && !$vgvs3) $vgvs3=$uy[3];
		 if ($uy[8]==12 && $uy[6]==26 && !$vhvs3) $vhvs3=$uy[3];

		 if ($uy[1]==1 && $uy[8]==4 && $uy[6]==0 && !$tpod2) $tpod2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==4 && $uy[6]==1 && !$tobr2) $tobr2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==11 && $uy[6]==0 && !$vpods2) $vpods2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==11 && $uy[6]==1 && !$vobrs2) $vobrs2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==11 && $uy[6]==2 && !$vpots2) $vpots2=$uy[3];

		 if ($uy[1]==1 && $uy[8]==13 && $uy[6]==0 && !$qpods2) $qpods2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==13 && $uy[6]==1 && !$qobrs2) $qobrs2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==13 && $uy[6]==2 && !$qpots2) $qpots2=$uy[3];

		 if ($uy[1]==1 && $uy[8]==12 && $uy[6]==5 && !$vgvs2) $vgvs2=$uy[3];
		 if ($uy[1]==1 && $uy[8]==12 && $uy[6]==6 && !$vhvs2) $vhvs2=$uy[3];

		 if ($uy[1]==2 && $uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[1]==2 && $uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[1]==2 && $uy[8]==11 && $uy[6]==0 && !$vpods) $vpods=$uy[3];
		 if ($uy[1]==2 && $uy[8]==11 && $uy[6]==1 && !$vobrs) $vobrs=$uy[3];
		 if ($uy[1]==2 && $uy[8]==11 && $uy[6]==2 && !$vpots) $vpots=$uy[3];

		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==0 && !$qpods) $qpods=$uy[3];
		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==1 && !$qobrs) $qobrs=$uy[3];
		 if ($uy[1]==2 && $uy[8]==13 && $uy[6]==2 && !$qpots) $qpots=$uy[3];

		 if ($uy[1]==2 && $uy[8]==12 && $uy[6]==5 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[1]==2 && $uy[8]==12 && $uy[6]==6 && !$vhvs) $vhvs=$uy[3];


		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 

	 print '<tr><td>
		<table border="0" cellpadding="0" cellspacing="5" width="100%">
		<tbody>
		<tr>
		<td valign="top" width="100">
		<table cellpadding=1 cellspacing=1 bgcolor=#82cc7f align=center>';
		print '<tr><td align="center"><img src="charts/led.php?n=1&dat=Tvh1='.number_format($tpod,2).'C" width=250 height=50></td><td align="center"><img src="charts/led.php?n=1&dat=Tvh2='.number_format($tobr,2).'C" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Vpod='.number_format($vpods,3).'m3" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Vobr='.number_format($vobrs,3).'m3" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Qpod='.number_format($qpods,3).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Qobr='.number_format($qobrs,3).'GK" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?n=2&dat=Qpot='.number_format($qpots,2).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=2&dat=Vhvs='.number_format($vhvs,2).'m3" width=250 height=50></td></tr>';
		print '</tbody></table></td><td>
		<table cellpadding=1 cellspacing=1 bgcolor=#82cc7f align=center>';
		print '<tr><td align="center"><img src="charts/led.php?n=1&dat=Tvh1='.number_format($tpod2,2).'C" width=250 height=50></td><td align="center"><img src="charts/led.php?n=1&dat=Tvh2='.number_format($tobr2,2).'C" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Vpod='.number_format($vpods2,3).'m3" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Vobr='.number_format($vobrs2,3).'m3" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Qpod='.number_format($qpods2,3).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Qobr='.number_format($qobrs2,3).'GK" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?n=2&dat=Qpot='.number_format($qpots2,2).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=2&dat=Vhvs='.number_format($vhvs2,2).'m3" width=250 height=50></td></tr>';
		print '</tbody></table></td><td>
		<table cellpadding=1 cellspacing=1 bgcolor=#82cc7f align=center>';
		print '<tr><td align="center"><img src="charts/led.php?n=1&dat=Tvh1='.number_format($tpod3,2).'C" width=250 height=50></td><td align="center"><img src="charts/led.php?n=1&dat=Tvh2='.number_format($tobr3,2).'C" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Vpod='.number_format($vpods3,3).'m3" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Vobr='.number_format($vobrs3,3).'m3" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?dat=Qpod='.number_format($qpods3,3).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=3&dat=Qobr='.number_format($qobrs3,3).'GK" width=250 height=50></td></tr>';
		print '<tr><td align="center"><img src="charts/led.php?n=2&dat=Qpot='.number_format($qpots3,2).'GK" width=250 height=50></td><td align="center"><img src="charts/led.php?n=2&dat=Vhvs='.number_format($vhvs3,2).'m3" width=250 height=50></td></tr>';
		print '</tbody></table>
		</td>';

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
	  </td></tr></tbody></table>';
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