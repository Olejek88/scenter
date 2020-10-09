<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>
<html><head>
<title>Челябинский ситуационный центр энергосбережения</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="files/structure_collage_ektron2.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/niftyPrint.htm" media="print">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
<link type="text/css" rel="stylesheet" href="files/ektron2.css">
<script language="javascript" type="text/javascript" src="files/ektron_003.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_002.js"></script>
<style type="text/css">
.normal { background-color: #ffffff }
.normalActive { background-color: #5d6d2f }
</style>
</head>

<body><center>
</center>
<div id="main" style="width:1900px">

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
<td align="center"><font color="white">Qпот,ГКал</font></td>
<td align="center"><font color="white">Tисп,час</font></td>
<td align="center"><font color="white">Gпод,т.</font></td>
<td align="center"><font color="white">Gобр,т.</font></td>
<td align="center"><font color="white">Pпр,МПа</font></td>
<td align="center"><font color="white">Pобр,МПа</font></td>
<td align="center"><font color="white">Vхвс,м3</font></td>
</tr>
<?php
 $query = 'SELECT * FROM objects WHERE type<10';
 $e = mysql_query ($query,$i);  $cm=0; $cnt=1;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $vpot=$tisp=$vpod=$vobr=$ppod=$pobr=$qpot=$vgvs=$vhvs=$gpod=0;
	 $dat='-';
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

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

	 $query = 'SELECT * FROM data WHERE type=2 AND (prm=12 OR prm=14 OR prm=16) AND value>0 AND device='.$uo[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==12 && $uy[6]==21 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==12 && $uy[6]==22 && !$vobr) $vobr=$uy[3];

		 if ($uy[8]==12 && $uy[6]==26 && !$vhvs) $vhvs=$uy[3];
		 //if ($uy[8]==14 && $uy[6]==1 && !$vhvs) $vhvs=$uy[3];

		 if ($uy[8]==16 && $uy[6]==0 && !$ppod) $ppod=$uy[3];
		 if ($uy[8]==16 && $uy[6]==1 && !$pobr) $pobr=$uy[3];

		 if ($dat=='-') $dat=$uy[2];
		 $uy = mysql_fetch_row ($y);
		}	 
	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff" Onmouseover="this.className=\'normalActive\'; cursor:pointer" Onmouseout="this.className=\'normal\'" class="normal">';

	 print '<td align="center">'.$cnt.'</td>';
	 if ($uo[12]==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 if ($uo[12]==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 if ($uo[12]==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 if ($uo[12]==3) print '<td align="center"><img src="files/status4.gif"></td>';
	 print '<td align="left"><a href="index.php?sel=object_days2&device='.$uo[11].'&object='.$ui[0].'" style="font-decoration:none"><b>'.$ui[1].'</b></a></td>';
	 print '<td align="center">'.$dat.'</td>';
	 if ($uo[14])
		{
		 if ($qpot) print '<td align="center">'.number_format($qpot,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($tisp) print '<td align="center">'.number_format($tisp,1).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($vpod) print '<td align="center">'.number_format($vpod,0).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($vobr) print '<td align="center">'.number_format($vobr,0).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($ppod) print '<td align="center">'.number_format($ppod,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';
		 if ($pobr) print '<td align="center">'.number_format($pobr,3).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

		 if ($vhvs) print '<td align="center">'.number_format($vhvs,2).'</td>';
		 else print '<td align="center" bgcolor="#eeeeee"></td>';

	       }
	 else  print '<td></td><td></td><td></td><td></td><td></td><td></td>';
		print '</tr>';
	 $desc=substr($ui[1],0,20);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);
	 $desc=str_replace("МДОУ детский сад","МДОУ",$desc);
	 $desc=str_replace("Средняя Школа","СШ",$desc);
	 $desc=str_replace("Городская больница","ГБ",$desc);
  
	 //$vpod = str_replace(",", "", $vpod);
	 //$qpot = str_replace(",", "", $qpot);
	 //$tisp = str_replace(",", "", $tisp);

	 $dat1.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$vpod;
	 $dat2.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$qpot;
	 $dat3.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$ppod;
	 $dat4.='&nm'.$cm.'='.$desc.'&dt'.$cm.'='.$tisp;	 	 	 
	 $ui = mysql_fetch_row ($e);	 $cm++; $cnt++;
	}
?>
</tbody></table>
</tbody></table>
</td>
</tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>

</div>
</html>