<?php
 print  '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" colspan=2><h1>ќтчет об утечках теплоносител€ за '.$prevmonth.'</h1></td></tr></table>';
 print  '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td colspan=2><b>ƒоговорные значени€</b><br>ƒопустимый размер утечки 0.0143 м3.час<br>÷ена теплоносител€ '.$tarif_svoda.' руб. за тонну</td></tr>';
 print '<tr><td align="center" class="m_separator">Ќазначение</td><td align=center class="menuitem">–асчет финансовых потерь от чрезмерных утечек теплоносител€</td></tr></table>';

 print '<table width=600px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=left>
	<tr><td width=600 valign=top>
	<table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
	<tr><td class="m_separator" align=center><font style="font-weight:bold">дата</font></td>
	<td class="m_separator" align="center">расход теплоносител€ в под.трубе</td>
	<td class="m_separator" align="center">расход теплоносител€ в обр.трубе</td>
	<td class="m_separator" align="center">фактический размер утечки</td>
	<td class="m_separator" align="center">допустимый размер утечки</td>
	<td class="m_separator" align="center">сверхнормативные утечки</td></tr>';
// print '<td bgcolor="#5D6D2f" align="center">цена теплоносител€ (руб. за тонну)</td>
//	<td class="m_separator" align="center">увеличение платежа</td></tr>';
	 $today=getdate();

	 $x=0; $tm=$dy=31;
	     if (!checkdate ($mn,31,$ye)) { $dy=30; }
	     if (!checkdate ($mn,30,$ye)) { $dy=29; }
	     if (!checkdate ($mn,29,$ye)) { $dy=28; }
	     $tm=$dy;

	 for ($tn=0; $tn<$dy; $tn++)
	    {	 
	     $date11[$tn]=sprintf ("%d-%02d-%02d",$ye,$mn,$tm);
	     $dat[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
	     $tm--;
	    }
	
	 $query = 'SELECT * FROM data WHERE type=2 AND prm=11 AND device='.$uo[11].' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=$dy;
		 for ($tn=0; $tn<$dy; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;
			
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<$dy; $tn++) 
		{
		 if ($data2[$tn]!='-')
			{
			 $prev=($data2[$tn]-$data3[$tn])-0.0143*24;
			 if ($prev>0) $uvel=$prev*$tarif_voda; else $uvel=0;
			 $svoda1+=$data2[$tn]; $svoda2+=$data3[$tn];
			 $srazn+=($data2[$tn]-$data3[$tn]);
			 $sdop+=0.0143*24;
			 if ($prev>0) $sprev+=$prev; else $prev=0;
			 $sper+=$uvel;
	        	 print '<tr><td align=center class="m_separator">'.$date11[$tn].'</td>';
			 print '<td align=center class="simple">'.$data2[$tn].'</td>';
			 print '<td align=center class="simple">'.$data3[$tn].'</td>';
			 print '<td align=center class="simple">'.number_format($data2[$tn]-$data3[$tn],3).'</td>';
			 print '<td align=center class="simple">'.number_format(0.0143*24,2).'</td>';
			 print '<td align=center class="simple">'.number_format($prev,3).'</td>';
			 //print '<td align=center bgcolor=#fffff>'.$tarif_svoda.'</td>';
			 //print '<td align=center bgcolor=#ffffff>'.number_format($uvel,2).'</td>';
			 print '</tr>';
		       }
	       }
	 print '<tr><td class="m_separator" align="center"></td><td class="m_separator" align="center">'.$svoda1.'</td>
			<td class="m_separator" align="center">'.$svoda2.'</td>
			<td class="m_separator" align="center">'.$srazn.'</td>
			<td class="m_separator" align="center">'.$sdop.'</td>
			<td class="m_separator" align="center">'.$sprev.'</td>';
//	 print '<td class="m_separator" align="center">'.$tarif_svoda.'</td>';
//	 print '<td class="m_separator" align="center">'.$sper.'</td>';
	 print '</tr>';
	 print '</table></td>';

	 $desc=substr($ui[1],0,60);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 print '</td></tr><tr><td style="m_separator">ѕереплата за утечки за '.$prevmonth.' года составл€ет '.number_format($sper,2).' рубл€</td></tr>';
	 print '<tr><td class="simple" colspan="2"><strong>–екомендации:</strong><br>ќбследовать систему и устранить утечки</td></tr>';	                         

?>