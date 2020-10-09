<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Подгрузка текущих данных по объектам</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="refresh" content="5760,http://ce-chel.info:81/converti3.php">
<link rel="stylesheet" href="files/structure_collage_ektron2.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/niftyPrint.htm" media="print">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
<link rel="stylesheet" type="text/css" href="files/ektron2.css">
<style type="text/css"> #header_middle {     height: 54px; } </style>
<script language="javascript" type="text/javascript" src="files/ektron_003.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_002.js"></script>
<style type="text/css">
.normal { background-color: #ffffff }
.normalActive { background-color: #5d6d2f }
</style>
<script type="text/javascript" src="files/jquery.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_003.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_002.js"></script>
</head>

<body>
		
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody>
<tr><td valign="top">
<table cellpadding=2 cellspacing=2 bgcolor=#12cc7f align=center>
<tr bgcolor="#476a94"><td colspan=5 align=center><font color="white">Узел учета</font></td><td colspan=8 align=center><font color="white">Тепловая энергия</font></td><td colspan=2 align=center><font color="white">Вода</font></td><td colspan=2 align=center><font color="white">Энергия</font></td></tr>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Узел учета</font></td>
<td align="center"><font color="white">Адрес</font></td>
<td align="center"><font color="white">T</font></td>
<td align="center" width="120px"><font color="white">Данные</font></td>
<td align="center"><font color="white">Tпод</font></td>
<td align="center"><font color="white">Tобр</font></td>
<td align="center"><font color="white">Gпод</font></td>
<td align="center"><font color="white">Gобр</font></td>
<td align="center"><font color="white">Qпод</font></td>
<td align="center"><font color="white">Qпот</font></td>
<td align="center"><font color="white">Pпр</font></td>
<td align="center"><font color="white">Pобр</font></td>
<td align="center"><font color="white">Vхвс</font></td>
<td align="center"><font color="white">Pхвс</font></td>
<td align="center"><font color="white">Wакт</font></td>
<td align="center"><font color="white">Wреакт</font></td>
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
 $query = 'SELECT * FROM data WHERE type=0 AND value>0 AND value<100000 ORDER BY date DESC LIMIT 1000';
 //echo $query.'<br>';
 $y = mysql_query ($query,$i);
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{
	 for ($pp=0;$pp<$cnt;$pp++)
	 if ($dev[$pp]==$uy[4]) $device=$pp;
	 //echo $device;
	 if ($uy[8]==4 && $uy[6]==0 && !$tpod[$device]) $tpod[$device]=$uy[3];
	 if ($uy[8]==4 && $uy[6]==1 && !$tobr[$device]) $tobr[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==0 && !$vpod[$device]) $vpod[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==1 && !$vobr[$device]) $vobr[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==0 && !$qpod[$device]) $qpod[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==1 && !$qobr[$device]) $qobr[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==2 && !$qpot[$device]) $qpot[$device]=$uy[3];
	 if ($uy[8]==12 && $uy[6]==5 && !$vgvs[$device]) $vgvs[$device]=$uy[3];
	 if ($uy[8]==12 && $uy[6]==7 && !$vhvs[$device]) $vhvs[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==2 && !$phvs[$device]) $phvs[$device]=$uy[3];

	 if ($uy[8]==12 && $uy[6]==26 && !$nvhvs[$device]) $nvhvs[$device]=$uy[3];
	 if ($uy[8]==4 && $uy[6]==10 && !$tisp[$device]) $tisp[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==23 && !$nqpot[$device]) $nqpot[$device]=$uy[3];

	 //if ($uy[8]==16 && $uy[6]==0 && !$p1[$device]) $p1[$device]=$uy[3];
	 //if ($uy[8]==16 && $uy[6]==1 && !$p2[$device]) $p2[$device]=$uy[3];
	 if ($dat[$device]=='-') $dat[$device]=$dddat=substr($uy[2],0,16);
	 $uy = mysql_fetch_row ($y);
	}	 	 
 $query = 'SELECT * FROM data WHERE type=1 AND value>0 AND value<1000 ORDER BY date DESC LIMIT 300000';
 //echo $query.'<br>';
 $y = mysql_query ($query,$i);
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{
	 for ($pp=0;$pp<$cnt;$pp++)
	 if ($dev[$pp]==$uy[4]) $device=$pp;
	 if ($uy[8]==4 && $uy[6]==0 && !$tpod[$device]) $tpod[$device]=$uy[3];
	 if ($uy[8]==4 && $uy[6]==1 && !$tobr[$device]) $tobr[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==0 && !$vpod2[$device]) $vpod2[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==1 && !$vobr2[$device]) $vobr2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==0 && !$qpod2[$device]) $qpod2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==1 && !$qobr2[$device]) $qobr2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==2 && !$qpot2[$device]) $qpot2[$device]=$uy[3];
	 if ($uy[8]==12 && $uy[6]==5 && !$vgvs2[$device]) $vgvs2[$device]=$uy[3]; 
	 if ($uy[8]==12 && $uy[6]==7 && !$vhvs2[$device]) $vhvs2[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==2 && !$phvs2[$device]) $phvs2[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==0 && !$p1[$device]) $p1[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==1 && !$p2[$device]) $p2[$device]=$uy[3];
	 if ($dat[$device]=='-') $dat[$device]=$dddat=substr($uy[2],0,16);
	 $uy = mysql_fetch_row ($y);
	}	 	 

 $query = 'SELECT * FROM data WHERE type=2 AND value>0 AND value<1000 ORDER BY date DESC LIMIT 100000';
 $y = mysql_query ($query,$i);
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{
	 for ($pp=0;$pp<$cnt;$pp++)
	 if ($dev[$pp]==$uy[4]) $device=$pp;
	 if ($uy[8]==4 && $uy[6]==0 && !$tpod2[$device]) $tpod2[$device]=$uy[3];
	 if ($uy[8]==4 && $uy[6]==1 && !$tobr2[$device]) $tobr2[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==0 && !$vpod2[$device]) $vpod2[$device]=$uy[3];
	 if ($uy[8]==11 && $uy[6]==1 && !$vobr2[$device]) $vobr2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==0 && !$qpod2[$device]) $qpod2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==1 && !$qobr2[$device]) $qobr2[$device]=$uy[3];
	 if ($uy[8]==13 && $uy[6]==2 && !$qpot2[$device]) $qpot2[$device]=$uy[3];
	 if ($uy[8]==12 && $uy[6]==5 && !$vgvs2[$device]) $vgvs2[$device]=$uy[3];
	 if ($uy[8]==12 && $uy[6]==7 && !$vhvs2[$device]) $vhvs2[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==2 && !$phvs2[$device]) $phvs2[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==0 && !$p1[$device]) $p1[$device]=$uy[3];
	 if ($uy[8]==16 && $uy[6]==1 && !$p2[$device]) $p2[$device]=$uy[3];
	 if ($dat[$device]=='-') $dat[$device]=substr($uy[2],0,16);
	 $uy = mysql_fetch_row ($y);
	}	 	 


 $query = 'SELECT * FROM objects ORDER BY type';
 $e = mysql_query ($query,$i); $cnt=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $wakt=$wreakt=0;
	 $query = 'SELECT * FROM devices WHERE type=15 AND object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u)
	 while ($uo = mysql_fetch_row ($u))
		{
		 $query = 'SELECT * FROM channels WHERE prm=14 AND device='.$uo[11];
		 $y = mysql_query ($query,$i);
		 if ($y)
		 while ($uy = mysql_fetch_row ($y))
			{
			 $query = 'SELECT value,date FROM data2 WHERE type=0 AND channel='.$uy[0].' ORDER BY date DESC';
			 $y2 = mysql_query ($query,$i);
			 if ($y2) $uy2 = mysql_fetch_row ($y2);
			 $wakt+=$uy2[0];
			 $dat2[$cnt]=substr($uy2[1],0,16);

			 $query = 'SELECT value FROM data2 WHERE type=5 AND channel='.$uy[0].' ORDER BY date DESC';
			 $y2 = mysql_query ($query,$i);
			 if ($y2) $uy2 = mysql_fetch_row ($y2);
			 if ($y2) $wsum+=$uy2[0];

			 if ($dat[$cnt]=='-') $dat[$cnt]=$dat2[$cnt];

			 //echo 'dat= '.$uo[12].' '.$dat2[$cnt].'<br>';
		 	}	 
		 $query = 'SELECT * FROM channels WHERE prm=15 AND device='.$uo[11];
		 $y = mysql_query ($query,$i);
		 if ($y)
		 while ($uy = mysql_fetch_row ($y))
			{
			 $query = 'SELECT value FROM data2 WHERE type=0 AND channel='.$uy[0].' ORDER BY date DESC';
			 $y2 = mysql_query ($query,$i);
			 if ($y2) $uy2 = mysql_fetch_row ($y2);
			 $wreakt+=$uy2[0];
		 	}	 		 		 
		 $sts=$uo[12];
	 	 //echo $ui[1].' '.$uo[12].' '.$wakt.' '.$ui[118].' '.$ui[119].'<br>';
		}
 	 //echo $uo[12].' '.$wakt.'<br>';
	 if ($ui[117] || $ui[118])
		{
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 //echo $query.'<br>';
		 $u = mysql_query ($query,$i);
		 if ($u) $uo = mysql_fetch_row ($u);
		 $sts=$uo[12];
	 	 //echo $ui[1].' '.$uo[12].' '.$wakt.' '.$tpod[$cnt].' '.$dat[$cnt].'<br>';
		}
	 else $uo[4]=1;
 	 //echo $uo[12].' '.$wakt.'<br>';

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
		 if ($sts==0 || $sts==2) print '<td align="center" style="background-color:#dddddd" style="white-space:nowrap">'.$dat[$cnt].'</td>';
		 else 
			{
			  //if ($dat[$cnt][6]<8) $dat[$cnt]=$dddat;
			  print '<td align="center" style="white-space:nowrap">'.$dat[$cnt].'</td>';
			}
		}
	 else 	{
		 //echo 'ff='.$uo[12].'<br>';
		 if ($sts==0) print '<td align="center" style="background-color:#dddddd" style="white-space:nowrap">'.$dat2[$cnt].'</td>';
		 else print '<td align="center" style="white-space:nowrap">'.$dat2[$cnt].'</td>';
		}

	 if ($sts==1 || $sts==2 || $sts==0) 
		{
		 if ($ui[117])
			{
			 //print '<td align="center">'.$uo[1].'</td>';
			 if ($tpod[$cnt]) print '<td align="center">'.number_format($tpod[$cnt],1).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 if ($tobr[$cnt]) print '<td align="center">'.number_format($tobr[$cnt],1).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($vpod2[$cnt]>=0) print '<td align="center">'.number_format($vpod2[$cnt],3).'</td>';
			// else if ($vpod[$cnt]) print '<td align="center">'.number_format($vpod[$cnt]*12,5).'</td>';		
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($vobr2[$cnt]>=0) print '<td align="center">'.number_format($vobr2[$cnt],3).'</td>';
			// else if($vobr[$cnt]) print '<td align="center">'.number_format($vobr[$cnt]*12,5).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($qpod[$cnt]>=0) print '<td align="center">'.number_format($qpod[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 //if ($qobr[$cnt]>=0) print '<td align="center">'.number_format($qobr[$cnt],3).'</td>';
			 //else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($qpot[$cnt]>=0) print '<td align="center">'.number_format($qpot[$cnt],3).'</td>';
			 else if ($qpod[$cnt]>0) print '<td align="center" bgcolor="#eeeeee">'.number_format($qpod[$cnt]-$qobr[$cnt],3).'</td>';
			 else if ($qpot2[$cnt]) print '<td align="center">'.number_format($qpot2[$cnt],3).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
		
			 if ($p1[$cnt]>=0) print '<td align="center">'.number_format($p1[$cnt],2).'</td>';
			 else if ($p21[$cnt]) print '<td align="center">'.number_format($p21[$cnt],2).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';

			 if ($p1[$cnt]>=0) $par_p1=$p1[$cnt];
			 else if ($p21[$cnt]) $par_p1=$p21[$cnt];

			 if ($p2[$cnt]>=0) print '<td align="center">'.number_format($p2[$cnt],2).'</td>';
			 else if ($p22[$cnt]) print '<td align="center">'.number_format($p22[$cnt],2).'</td>';
			 else print '<td align="center" bgcolor="#eeeeee"></td>';
			 if ($p1[$cnt]>=0) $par_p2=$p2[$cnt];
			 else if ($p21[$cnt]) $par_p2=$p22[$cnt];
			}
		else	{
			 print '<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>';
			 print '<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>';
			}
		 if ($ui[118])
			{
			 if ($vhvs[$cnt]) print '<td align="center">'.number_format($vhvs[$cnt],4).'</td>';
			 else if ($vhvs2[$cnt] && $vhvs2[$cnt]<10) print '<td align="center">'.number_format($vhvs2[$cnt],4).'</td>';
			 else print '<td align="center">-</td>';

			 if ($vhvs[$cnt]) $par_vhvs=$vhvs[$cnt];
			 else if ($vhvs2[$cnt] && $vhvs2[$cnt]<10) $par_vhvs=$vhvs2[$cnt];

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

	 $query = 'UPDATE objects SET par_tpr=\''.$tpod[$cnt].'\', 
			par_tob=\''.$tobr[$cnt].'\', 
			par_gpod=\''.$vpod[$cnt].'\', 
			par_dobr=\''.$vobr[$cnt].'\', 
			par_qpod=\''.$qpod[$cnt].'\', 
			par_qpot=\''.$qpot[$cnt].'\', 
			par_ppr=\''.$par_p1.'\', 
			par_pob=\''.$par_p2.'\', 
			par_vhvs=\''.$par_vhvs.'\', 
			par_phvs=\''.$phvs[$cnt].'\', 
			par_wakt=\''.$wakt.'\', 
			par_wreakt=\''.$wreakt.'\',
			par_wsum=\''.$wsum.'\',
			par_nhvs=\''.$nvhvs[$cnt].'\',
			par_tisp=\''.$tisp[$cnt].'\',
			par_nqpot=\''.$nqpot[$cnt].'\',

			par_tpr2=\''.$tpod2[$cnt].'\', 
			par_tob2=\''.$tobr2[$cnt].'\', 
			par_vpod2=\''.$vpod2[$cnt].'\', 
			par_vobr2=\''.$vobr2[$cnt].'\', 
			par_qpod2=\''.$qpod2[$cnt].'\', 
			par_qobr2=\''.$qobr2[$cnt].'\', 
			par_qpot2=\''.$qpot2[$cnt].'\', 
			par_vhvs2=\''.$vhvs2[$cnt].'\', 
			par_phvs2=\''.$phvs2[$cnt].'\',
			par_ppr2=\''.$p1[$cnt].'\', 
			par_pob2=\''.$p2[$cnt].'\', 
			dates=\''.$dat[$cnt].'\',
			dates2=\''.$dat2[$cnt].'\' WHERE id='.$ui[0];
	 echo $query.'<br>';
	 $u = mysql_query ($query,$i);

	 print '</tr>';	 $cnt++;
	 $ui = mysql_fetch_row ($e);	 
	}
?>
</tbody></table>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
</div>
</body></html>
