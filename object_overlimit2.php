<?php
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 if ($_GET["month"]) $month=$mon=$_GET["month"];
	 else $month=$mon=5;
	 include ("time.inc");
 
	 if (!$limit_voda) $limit_voda=15;
	 if (!$tarif_voda) $tarif_voda=9.72;
	 if (!$tarif_kanal) $tarif_kanal=6.38;
	 print '<tr><td align="center" class="m_separator">����������</td><td align=center class="menuitem">������ ������� ���������� ������ �� �������������� ����������� ����</td></tr></table>';
	 print '<tr><td>
		<b>���������� ��������</b><br>
		����� - '.$limit_voda.' ���.� � �����<br>
		����� �� ���� '.$tarif_voda.'<br>
		����� �� ����������� '.$tarif_kanal.'<br>
		����� �� ���������� ������<br>
		�� ���� 38.88 ���. (�������������� ����������)<br>
		�� ����������� 12.76 ���. (����������� ����������)<br>
		���������� ��������� �������������� ����������� (����\ �����������) - 38,88\12,76
		</td></tr>';
	 print '<tr><td align=center class="m_separator">���������� ������ �� '.$prevmonth.' ���</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center><table width="800px">';
	 print '<tr><td class="m_separator">������</td><td class="m_separator">������������� �����</td><td class="m_separator">����������� ������</td><td class="m_separator">���������� ������</td></tr>';
	 //<td class="m_separator">����� �� ���������� ������ (���� / �����������)</td><td class="m_separator">���������� ������</td>
	 $tm=1; $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 for ($tn=1; $tn<=$dy; $tn++)
		{		
		 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
		 $date2=sprintf ("%d%02d%02d",$ye,$mn,$tn);
		 $dat2=sprintf ("%02d-%02d-%d",$tn,$mn,$ye);

		 $query = 'SELECT value FROM data WHERE type=2 AND prm=12 AND date=\''.$date1.'\' AND source=6 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);	
		 $fakt=$ui[0];	

		 $norm=$limit_voda;
		 if ($norm>0) $per=$fakt-$norm; else $per=0;
		 if ($per<0) $per=0;
		 $poteri=38.66*$per+12.76*$per;
		 $limit+=$norm; $sfakt+=$fakt; $sst1+=$per; $sst2+=$poteri;

		 $month=$mon; include ("time.inc");
		 //$dat.='&dt'.$mon.'='.$month;
		 //$req.='&da'.$mon.'='.$norm.'&db'.$mon.'='.$fakt;
		 //$req2.='&da'.$mon.'='.$poteri;

		 print '<tr><td class="m_separator">'.$dat2.'</td><td class="simple_bold" align="center">'.$norm.'</td>
			<td class="simple_bold" align="center">'.number_format($fakt,3).'</td><td class="simple_bold" align="center">'.number_format($per,3).'</td></tr>';
	       }
	 print '<tr><td class="m_separator">�����</td><td class="m_separator" align="center">'.number_format($limit,2).'</td><td class="m_separator" align="center">'.number_format($sfakt,2).'</td><td class="m_separator" align="center">'.$sst1.'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center class="psb">��������� �� ���������� ������ ���������� '.number_format($sst2,2).' ������</td></tr>';
	 print '<tr><td align=center><br><br></td></tr>';
	 print '<tr><td class="simple" colspan="2"><strong>������������:</strong><br>���������� ����������� ������ �������� ������������ �������</td></tr>';	                         
//	 print '<tr><td align=center><img src="charts/barplots31.php?type=1&'.$dat.$req.'"></td></tr>';
	 print '</table>';
?>