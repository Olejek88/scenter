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
<td align="center"><font color="white">Адрес</font></td>
<td align="center"><font color="white">T</font></td>
<td align="center"><font color="white">Дата сеанса связи</font></td>
<td align="center"><font color="white">Прибор учета</font></td>
<td align="center"><font color="white">Площадь</font></td>
<td align="center"><font color="white">К.Аб.</font></td>
<td align="center"><font color="white">Tпод,С</font></td>
<td align="center"><font color="white">Tобр,С</font></td> 
<td align="center"><font color="white">оQпод,ГКал</font></td>
<td align="center"><font color="white">оQобр,ГКал</font></td>
<td align="center"><font color="white">Gпод,т.</font></td>
<td align="center"><font color="white">Qпот,ГКал</font></td>
<td align="center"><font color="white">Gхвс,м3</font></td>
<td align="center"><font color="white">Pхвс,м3</font></td>

<td align="center"><font color="white">Tисп,ч</font></td>
<td align="center"><font color="white">Q,пот</font></td>
<td align="center"><font color="white">Gхвс,пот</font></td>

<td align="center"><font color="white">W,сум</font></td>
<td align="center"><font color="white">W,акт</font></td>

<td align="center"><font color="white">Посл.час</font></td>
<td align="center"><font color="white">Час</font></td>
<td align="center"><font color="white">Посл.день</font></td>
<td align="center"><font color="white">День</font></td>
</tr>

<?php
 $query = 'SELECT * FROM objects ORDER BY type';
 $e = mysql_query ($query,$i); $cnt=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM devices WHERE type!=15 AND object='.$ui[0];
	 $u = mysql_query($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $dev[$cnt]=$uo[11];
	 $dat[$cnt]='-';	 
	 $tpod[$cnt]=$tobr[$cnt]=$vpod[$cnt]=$vobr[$cnt]=$qpod[$cnt]=$qobr[$cnt]=$qpot[$cnt]=$vgvs[$cnt]=$vhvs[$cnt]=$qpot[$cnt]=$p1[$cnt]=$p2[$cnt]=$phvs[$cnt]=0;
	 $tpod2[$cnt]=$tobr2[$cnt]=$vpod2[$cnt]=$vobr2[$cnt]=$qpod2[$cnt]=$qobr2[$cnt]=$qpot2[$cnt]=$vgvs2[$cnt]=$vhvs2[$cnt]=$qpot2[$cnt]=$p12[$cnt]=$p22[$cnt]=$phvs2[$cnt]=0;
	 $vhvs[$cnt]=$phvs[$cnt]=$phvs2[$cnt]=$vhvs2[$cnt]='';
	 $ui = mysql_fetch_row ($e); $cnt++;	 
	}

 $query = 'SELECT * FROM objects ORDER BY type';
 $e = mysql_query ($query,$i); $cnt=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 if ($ui[117] || $ui[118])
		{
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 $u = mysql_query ($query,$i);
		 if ($u) $uo = mysql_fetch_row ($u);
		 $sts=$uo[12];
	 	 //echo $ui[1].' '.$uo[12].' '.$wakt.' '.$tpod[$cnt].' '.$dat[$cnt].'<br>';
		}
	 else $uo[4]=1;

	 $tpod[$cnt]=$ui[123];
	 $tobr[$cnt]=$ui[124];
	 $vpod[$cnt]=$ui[125];
	 $vobr[$cnt]=$ui[126];
	 $qpod[$cnt]=$ui[127];
	 $qpot[$cnt]=$ui[128];
	 $p1[$cnt]=$ui[129];
	 $p2[$cnt]=$ui[130];
	 $vhvs[$cnt]=$ui[131];
	 $phvs[$cnt]=$ui[132];
	 $wakt=$ui[133];
	 $wreakt=$ui[134];
	 $dat[$cnt]=$ui[135];

	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff" Onmouseover="this.className=\'normalActive\'; cursor:pointer" Onmouseout="this.className=\'normal\'" class="normal">';
	 if ($sts==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 if ($sts==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 if ($sts==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 if ($sts==3) print '<td align="center"><img src="files/status4.gif"></td>';
	 print '<td align="left" style="white-space:nowrap"><a href="index.php?sel=object&id='.$ui[0].'" style="text-decoration:none"><b>'.$ui[1].'</b></a></td>';
	 print '<td align="left" style="white-space:nowrap"><a href="index.php?sel=object&id='.$ui[0].'" style="text-decoration:none"><b>'.$ui[3].'</b></a></td>';
	 if ($uo[4]==2) print '<td align="center"><img src="files/gsm.jpg"></td>';
	 if ($uo[4]==1) print '<td align="center"><img src="files/network.jpg"></td>';
	 if ($uo[4]==3) print '<td align="center"><img src="files/wireless.jpg"></td>';
	 if ($uo[4]==4) print '<td align="center"><img src="files/hand.jpg"></td>';
	 if ($uo[4]==0) print '<td align="center"></td>';

	 if ($ui[117] || $ui[118])
		{		 
		 if (($sts==0 || $sts==2) && $dat[$cnt]=='-') print '<td align="center" style="background-color:#dddddd" style="white-space:nowrap">'.$dat[$cnt].'</td>';
		 else 
			{
			  //if ($dat[$cnt][6]<8) $dat[$cnt]=$dddat;
			  print '<td align="center" style="white-space:nowrap">'.$dat[$cnt].'</td>';
			}
		}
	 else 	{
		 if ($sts==0) print '<td align="center" style="background-color:#dddddd" style="white-space:nowrap">'.$dat2[$cnt].'</td>';
		 else print '<td align="center" style="white-space:nowrap">'.$dat2[$cnt].'</td>';
		}

	 if ($sts==1 || $sts==2 || $sts==0) 
		{
		 if ($ui[117])
			{
			 if ($tpod[$cnt]) print '<td align="center">'.number_format($tpod[$cnt],1).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 if ($tobr[$cnt]) print '<td align="center">'.number_format($tobr[$cnt],1).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($vpod[$cnt]>=0) print '<td align="center">'.number_format($vpod[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 if ($vobr[$cnt]>=0) print '<td align="center">'.number_format($vobr[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($qpod[$cnt]>=0) print '<td align="center">'.number_format($qpod[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 if ($qpot[$cnt]>=0) print '<td align="center">'.number_format($qpot[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
		
			 if ($p1[$cnt]>=0) print '<td align="center">'.number_format($p1[$cnt],2).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($p2[$cnt]>=0) print '<td align="center">'.number_format($p2[$cnt],2).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			}
		else	{
			 print '<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>';
			 print '<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>';
			}
		 if ($ui[118])
			{
			 if ($vhvs[$cnt]) print '<td align="center">'.number_format($vhvs[$cnt],4).'</td>';
			 else print '<td align="center">-</td>';
			 if ($phvs[$cnt] && $phvs[$cnt]<10) print '<td align="center">'.number_format($phvs[$cnt],2).'</td>';
			 else print '<td align="center">-</td>';			
			}
		 else	{
			 print '<td align="center" bgcolor="#eeeeee"></td>';
			 print '<td align="center" bgcolor="#eeeeee"></td>';
			}
		 if ($ui[119]) 
			{
			 print '<td align="center">'.number_format($wakt,2).'</td>';
		 	 print '<td align="center">'.number_format($wreakt,2).'</td>';
			}
		 else	{
			 print '<td align="center" bgcolor="#eeeeee"></td>';
			 print '<td align="center" bgcolor="#eeeeee"></td>';
			}
		}
	 else  print '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	 print '</tr>';	 $cnt++;
	 $ui = mysql_fetch_row ($e);	 
	}
?>
</tbody></table>

<?php
 $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i); $cn=1;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $tpod=$tobr=$vpod=$vobr=$qpod=$qobr=$qpot=$vgvs=$vhvs=$nvhvs=$tisp=$nqpot=$phvs=$wsum=$wakt=0;
	 $dat='-';
	 $query = 'SELECT * FROM devices WHERE type=11 AND object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $query = 'SELECT * FROM data WHERE type=0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[8]==11 && $uy[6]==0 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==11 && $uy[6]==1 && !$vobr) $vobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==0 && !$qpod) $qpod=$uy[3];
		 if ($uy[8]==13 && $uy[6]==1 && !$qobr) $qobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==2 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==12 && $uy[6]==7 && !$vhvs) $vhvs=$uy[3];
		 if ($uy[8]==16 && $uy[6]==2 && !$phvs) $phvs=$uy[3];

		 if ($uy[8]==12 && $uy[6]==26 && !$nvhvs) $nvhvs=$uy[3];
		 if ($uy[8]==4 && $uy[6]==10 && !$tisp) $tisp=$uy[3];
		 if ($uy[8]==13 && $uy[6]==23 && !$nqpot) $nqpot=$uy[3];

		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 
	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=1 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 if ($uy) { $cnt_hour=$uy[0];  $max_hour=$uy[1]; }	 
	 $query = 'SELECT COUNT(id),MAX(date) FROM data WHERE type=2 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 if ($uy) { $cnt_day=$uy[0];  $max_day=$uy[1]; }	 

	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff" Onmouseover="this.className=\'normalActive\'; cursor:pointer" Onmouseout="this.className=\'normal\'" class="normal">';
	 print '<td align="left"><b>'.$cn.'</b></td>';
	 if ($uo[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 if ($uo[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 if ($uo[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 if ($uo[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';
	 print '<td align="left"><b>'.$ui[1].'</b></td>';
	 print '<td align="left"><b>'.$ui[3].'</b></td>';
	 if ($uo[4]==2) print '<td align="center"><img src="files/gsm.jpg"></td>';
	 if ($uo[4]==1) print '<td align="center"><img src="files/network.jpg"></td>';
	 if ($uo[4]==0) print '<td align="center"></td>';
	 if ($uo[4]==3) print '<td align="center"><img src="files/wireless.jpg"></td>';
	 if ($uo[4]==4) print '<td align="center"><img src="files/hand.jpg"></td>';
	 print '<td align="center">'.$dat.'</td>';
	 print '<td align="center">'.$uo[1].'</td>';
	 print '<td align="left">'.$ui[14].'</td>';
	 print '<td align="left">'.$ui[15].'</td>';

	 if ($uo[14])
		{
		 if ($tpod) print '<td align="center">'.number_format($tpod,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($tobr) print '<td align="center">'.number_format($tobr,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qpod) print '<td align="center">'.number_format($qpod,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qobr) print '<td align="center">'.number_format($qobr,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vpod) print '<td align="center">'.number_format($vpod,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($qpot) print '<td align="center">'.number_format($qpot,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($vhvs) print '<td align="center">'.number_format($vhvs,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($phvs) print '<td align="center">'.number_format($phvs,4).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($nvhvs) print '<td align="center">'.number_format($nvhvs,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($tisp) print '<td align="center">'.number_format($tisp,0).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($nqpot) print '<td align="center">'.number_format($nqpot,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($wsum) print '<td align="center">'.number_format($wsum,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($wakt) print '<td align="center">'.number_format($wakt,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
	       }
	 else  print '<td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td>';
	 print '<td align="left">'.$max_hour.'</td>';
	 print '<td align="left">'.$cnt_hour.'</td>';
	 print '<td align="left">'.$max_day.'</td>';
	 print '<td align="left">'.$cnt_day.'</td>';
	 print '</tr>';	 	 	 
	 $ui = mysql_fetch_row ($e);	 $cn++;
	}
?>
</tbody></table>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>

</div>