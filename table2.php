<div id="maincontent" style="width:100%; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>

<table border="0" cellpadding="0" cellspacing="0">
<tbody>
		
<tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody>
<tr><td valign="top">
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">N</font></td>
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Узел учета</font></td>
<td align="center"><font color="white">Дата сеанса связи</font></td>
<td align="center"><font color="white">Gпод,т.</font></td>
<td align="center"><font color="white">Gобр,т.</font></td>
<td align="center"><font color="white">Qпот,ГКал</font></td>
<td align="center"><font color="white">Pпр,МПа</font></td>
<td align="center"><font color="white">Pобр,МПа</font></td>
<td align="center"><font color="white">Gхвс,м3</font></td>
<td align="center"><font color="white">Tисп,час</font></td>
</tr>
<?php
 $dat1=$dat2=$dat3=$dat4=$dat5='';
 $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i); $cm=0; $cnt=1;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $vpot=$tisp=$vpod=$vobr=$ppod=$pobr=$qpot=$vgvs=$vhvs=0;
	 $dat='-';
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $query = 'SELECT * FROM data WHERE type=2 AND (prm=12 OR prm=14 OR prm=16) AND value>0 AND device='.$uo[11].' ORDER BY date DESC LIMIT 20000';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==12 && $uy[6]==21 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==12 && $uy[6]==22 && !$vobr) $vobr=$uy[3];

		 //if ($uy[8]==12 && $uy[6]==26 && !$vhvs) $vhvs=$uy[3];
		 if ($uy[8]==14 && $uy[6]==1 && !$vgvs) $vgvs=$uy[3];

		 if ($uy[8]==16 && $uy[6]==0 && !$ppod) $ppod=$uy[3];
		 if ($uy[8]==16 && $uy[6]==1 && !$pobr) $pobr=$uy[3];


		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 
	 $query = 'SELECT * FROM data WHERE type=0 AND value>0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==13 && $uy[6]==23 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==4 && $uy[6]==10 && !$tisp) $tisp=$uy[3];

		 if ($uy[8]==12 && $uy[6]==26 && !$vhvs) $vhvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==25 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==23 && !$gpod) $gpod=$uy[3];

		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}

	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff" Onmouseover="this.className=\'normalActive\'; cursor:pointer" Onmouseout="this.className=\'normal\'" class="normal">';
	 print '<td align="center"><b>'.$cnt.'</b></td>';
	 if ($uo[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 if ($uo[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 if ($uo[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 if ($uo[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';
	 print '<td align="left"><a href="index.php?sel=object_days2&device='.$uo[11].'&object='.$ui[0].'" style="font-decoration:none"><b>'.$ui[1].'</b></td>';
	 print '<td align="center">'.$dat.'</td>';
	 if ($uo[14])
		{
		 if ($vpod && $vpod<1000000) print '<td align="center">'.number_format($vpod,0).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vobr && $obr<1000000) print '<td align="center">'.number_format($vobr,0).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($qpot) print '<td align="center">'.number_format($qpot,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($ppod) print '<td align="center">'.number_format($ppod,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($pobr) print '<td align="center">'.number_format($pobr,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($vhvs && $vhvs<100000) print '<td align="center">'.number_format($vhvs,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($tisp>100000) $tisp=0; 
		 if ($vhvs>100000) $vhvs=0; 

		 if ($tisp && $tisp<100000) print '<td align="center">'.number_format($tisp,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

	       }
	 else  print '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';	 	 
	 print '</tr>';	 	 	 
	 //echo $cm.' '.$dat1.'<br>';
	 $desc=substr($ui[1],0,15);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  
	 //$vpod = str_replace(",", "", $vpod);
	 //$qpot = str_replace(",", "", $qpot);
	 //$tisp = str_replace(",", "", $tisp);

	 $dat1.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$vpod;
	 $dat2.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$qpot;
	 $dat3.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$ppod;
	 $dat4.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$tisp;
	 $dat5.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$vhvs;
	 $ui = mysql_fetch_row ($e); $cm++; $cnt++;
	}
?>
</tbody></table>
</tbody></table>
</td>
<td valign=top>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tr><td valign="top"><img src="charts/barplots18.php?cons=1<?php print $dat1; ?>"></td></tr>
<tr><td valign="top"><img src="charts/barplots18.php?cons=2<?php print $dat2; ?>"></td></tr>
<tr><td valign="top"><img src="charts/barplots18.php?cons=3<?php print $dat3; ?>"></td></tr>
<tr><td valign="top"><img src="charts/barplots18.php?cons=4<?php print $dat4; ?>"></td></tr>
<tr><td valign="top"><img src="charts/barplots18.php?cons=5<?php print $dat5; ?>"></td></tr>
</table>
</td>
</tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>

</div>