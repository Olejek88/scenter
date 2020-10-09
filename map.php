<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Челябинский ситуационный центр</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
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

<body><center>
<div id="header_ek">
</div>
</center>
<div id="main" style="width:99%">
<?php
if ($_GET["raion"]=='') print '<img src="pict/main.jpg" align=left>';
if ($_GET["raion"]=='1') print '<img src="pict/kalininsk.jpg" align=left>';
if ($_GET["raion"]=='2') print '<img src="pict/kurchat.jpg" align=left>';
if ($_GET["raion"]=='3') print '<img src="pict/centr.jpg" align=left>';
if ($_GET["raion"]=='4') print '<img src="pict/sovet.jpg" align=left>';
if ($_GET["raion"]=='5') print '<img src="pict/lenin.jpg" align=left>';
if ($_GET["raion"]=='6') print '<img src="pict/traktor.jpg" align=left>';
if ($_GET["raion"]=='7') print '<img src="pict/metall.jpg" align=left>';
?>
<div id="maincontent" style="border-width: 2px;  border-style: solid;  border-color: #5d6d2f;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>

<table border="0" cellpadding="0" cellspacing="0">
<tbody>
<tr><td>
<table border="0" cellpadding="2" cellspacing="0">
<tbody><tr><td>
<ul id="navigation"> 
<?php
print '<li><a href="map.php" '; if ($_GET["raion"]=='') print 'class="sel"'; print '><span>Все районы</span></a></li>';
print '<li><a href="map.php?raion=1" '; if ($_GET["raion"]=='1') print 'class="sel"'; print '><span>Калининский</span></a></li>';
print '<li><a href="map.php?raion=2" '; if ($_GET["raion"]=='2') print 'class="sel"'; print '><span>Курчатовский</span></a></li>';
print '<li><a href="map.php?raion=3" '; if ($_GET["raion"]=='3') print 'class="sel"'; print '><span>Центральный</span></a></li>';
print '<li><a href="map.php?raion=4" '; if ($_GET["raion"]=='4') print 'class="sel"'; print '><span>Советский</span></a></li>';
print '<li><a href="map.php?raion=5" '; if ($_GET["raion"]=='5') print 'class="sel"'; print '><span>Ленинский</span></a></li>';
print '<li><a href="map.php?raion=6" '; if ($_GET["raion"]=='6') print 'class="sel"'; print '><span>Тракторозаводский</span></a></li>';
print '<li><a href="map.php?raion=7" '; if ($_GET["raion"]=='7') print 'class="sel"'; print '><span>Металлургический</span></a></li>';
?>
</ul>
<div id="border"></div>
</td></tr>
</tbody></table>
</td></tr>
<tr><td>
<table border="0" cellpadding="2" cellspacing="0">
<tbody><tr><td>
<ul id="navigation"> 
<?php
print '<li><a href="map.php" '; if ($_GET["type"]=='') print 'class="sel"'; print '><span>Все типы</span></a></li>';
print '<li><a href="map.php?type=1" '; if ($_GET["type"]=='1') print 'class="sel"'; print '><span>Поликлиники</span></a></li>';
print '<li><a href="map.php?type=2" '; if ($_GET["type"]=='2') print 'class="sel"'; print '><span>Больницы</span></a></li>';
print '<li><a href="map.php?type=3" '; if ($_GET["type"]=='3') print 'class="sel"'; print '><span>МДОУ</span></a></li>';
print '<li><a href="map.php?type=4" '; if ($_GET["type"]=='4') print 'class="sel"'; print '><span>Школы</span></a></li>';
print '<li><a href="map.php?type=5" '; if ($_GET["type"]=='5') print 'class="sel"'; print '><span>СДЮШОР</span></a></li>'; 
print '<li><a href="map.php?type=12" '; if ($_GET["type"]=='12') print 'class="sel"'; print '><span>УВД</span></a></li>'; 
print '<li><a href="map.php?type=15" '; if ($_GET["type"]=='15') print 'class="sel"'; print '><span>Упр.делам молодежи</span></a></li>'; 
?>
</ul>
<div id="border"></div>
</td></tr>
</tbody></table>
</td></tr>
		
<tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody>
<tr><td valign="top">
<table cellpadding=2 cellspacing=2 bgcolor=#12cc7f align=center>
<tr bgcolor="#476a94"><td colspan=4 align=center><font color="white">Узел учета</font></td><td colspan=8 align=center><font color="white">Тепловая энергия</font></td><td colspan=2 align=center><font color="white">Вода</font></td><td colspan=2 align=center><font color="white">Энергия</font></td></tr>
<tr bgcolor="#476a94">
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
 if ($_GET["type"]=='' && $_GET["raion"]=='') $query = 'SELECT * FROM objects ORDER BY type';
 else if ($_GET["type"]!='') $query = 'SELECT * FROM objects WHERE nlevels=0 AND type='.$_GET["type"].' ORDER BY type';
 else if ($_GET["raion"]!='') $query = 'SELECT * FROM objects WHERE nentr='.$_GET["raion"].' ORDER BY type';

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

 if ($_GET["type"]=='' && $_GET["raion"]=='') $query = 'SELECT * FROM objects ORDER BY type';
 else if ($_GET["type"]!='') $query = 'SELECT * FROM objects WHERE nlevels=0 AND type='.$_GET["type"].' ORDER BY type';
 else if ($_GET["raion"]!='') $query = 'SELECT * FROM objects WHERE  nentr='.$_GET["raion"].' ORDER BY type';
// echo $query;
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
	 //if ($sts==0) print '<td align="center"><img src="files/status2.gif"></td>';
	 //if ($sts==1) print '<td align="center"><img src="files/status1.gif"></td>';
	 //if ($sts==2) print '<td align="center"><img src="files/status3.gif"></td>';
	 //if ($sts==3) print '<td align="center"><img src="files/status4.gif"></td>';
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
<table cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<?php
 $query = 'SELECT COUNT(id) FROM channels WHERE prm=4 AND pipe=0 AND lasthours>20110601000000'; 
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnts_1=$uy[0];	
 $query = 'SELECT COUNT(id) FROM channels WHERE prm=12 AND pipe=6 AND lasthours>20110601000000';
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnts_2=$uy[0];	
 $query = 'SELECT COUNT(id) FROM channels WHERE prm=14 AND pipe=0 AND lasthours>20110601000000';
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnts_3=$uy[0];	

 $query = 'SELECT COUNT(id) FROM objects WHERE uteplo>0'; 
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnt_1=$uy[0];	
 $query = 'SELECT COUNT(id) FROM objects WHERE uvoda>0';
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnt_2=$uy[0];	
 $query = 'SELECT COUNT(id) FROM objects WHERE uelec>0';
 if ($y = mysql_query ($query,$i)) $uy = mysql_fetch_row ($y);
 if ($uy) $cnt_3=$uy[0];	
?>
<tr>
<td valign=top><table>
<tr bgcolor="#476a94">
<td align="center"><font color="white">Тип энергоресурса</font></td>
<td align="center"><font color="white">Количество</font></td>
</tr>
<tr><td align="left">Тепловая энергия</td><td align="center"><?php print $cnt_1.'/'.$cnts_1; ?></td></tr>
<tr><td align="left">Вода</td><td align="center"><?php print $cnt_2.'/'.$cnts_2; ?></td></tr>
<tr><td align="left">Электроэнергия</td><td align="center"><?php print $cnt_3.'/'.$cnts_3; ?></td></tr>
</table>
</td>
<td valign=top><table>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Комментарий</font></td>
</tr>
<tr><td align="center"><img src="files/status1.gif"></td>
<td align="center"><font">Узел отвечает</font></td></tr>
<tr><td align="center"><img src="files/status2.gif"></td>
<td align="center"><font>Узел не отвечает</font></td></tr>
<tr><td align="center"><img src="files/status4.gif"></td>
<td align="center"><font>Узел учета в процессе подключения</font></td></tr>
<tr><td align="center"><img src="files/status3.gif"></td>
<td align="center"><font>Получены предупреждения по узлу учета</font></td></tr>
</table>
</td><td  valign=top>
<table cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">S</font></td>
<td align="center"><font color="white">Комментарий</font></td>
</tr>
<tr><td align="center"><img src="files/gsm.jpg"></td>
<td align="center"><font">Прибор подключен через сеть GSM/GPRS</font></td></tr>
<tr><td align="center"><img src="files/network.jpg"></td>
<td align="center"><font>Сеть Ethernet</font></td></tr>
<tr><td align="center"><img src="files/wireless.jpg"></td>
<td align="center"><font>Беспрводная сеть</font></td></tr>
<tr><td align="center"><img src="files/hand.jpg"></td>
<td align="center"><font>Ввод данных из других источников</font></td></tr>
</table></td></tr></table>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
</div>

<div style="position: absolute; top:0; left:0;">
 <?php
 if ($_GET["type"]=='') $query = 'SELECT * FROM WHERE nlevels=0 objects';
 else $query = 'SELECT * FROM objects WHERE nlevels=0 AND type='.$_GET["type"];
 if ($_GET["raion"]=='') $query = 'SELECT * FROM objects WHERE nlevels=0';
 else $query = 'SELECT * FROM objects WHERE nlevels=0 AND nentr='.$_GET["raion"];


 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 if ($_GET["raion"]=='') { $x=$ui[4]; $y=$ui[5]; }
	 else  { $x=$ui[7]; $y=$ui[8]-15; }

	 print '<style type="text/css"> 
		   #rightcol'.$ui[0].' {
		    position: absolute;
		    left: '.$x.'px;
		    top: '.$y.'px;
		    width: 30px; }
		   #inf'.$ui[0].' {
		    position: absolute;
		    left: 0px;
		    top: 600px;
		    width: 350px; 
		    visibility:hidden;
		    z-index: 10;
	 	    border-width: 2px;  border-style: dashed;  border-color: #5d6d2f;
			}
		   #infs'.$ui[0].' {
		    position: absolute;
		    left: 170px;
		    top: 110px; }
		</style>';
	 if ($uo[12]==1 || $uo[12]==2 || $ui[135]!='-') print '<div id="rightcol'.$ui[0].'" Onmouseout="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'hidden\'" Onmouseover="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'visible\'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/green_flag2.gif"></a></div>';
	 else print '<div id="rightcol'.$ui[0].'" Onmouseout="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'hidden\'" Onmouseover="document.getElementById(\'inf'.$ui[0].'\').style.visibility=\'visible\'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/red_flag2.gif"></a></div>';
	 $ui = mysql_fetch_row ($e);
	}
?>
<?php
 if ($_GET["type"]=='') $query = 'SELECT * FROM objects WHERE nlevels=0';
 else $query = 'SELECT * FROM objects WHERE nlevels=0 AND type='.$_GET["type"];
 if ($_GET["raion"]=='') $query = 'SELECT * FROM objects WHERE nlevels=0';
 else $query = 'SELECT * FROM objects WHERE nlevels=0 AND nentr='.$_GET["raion"];

 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 print '<div id="inf'.$ui[0].'">';
	 print '<img src="pict/'.$ui[0].'_resize.jpg">'; 
	 if ($uo[12]<2) print '<div id="infs'.$ui[0].'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/green_flag.gif"></a></div>';
	 print '<div id="infs'.$ui[0].'"><a href="index.php?sel=object&id='.$ui[0].'"><img border=0 src="pict/red_flag.gif"></a></div>';
	 print '</div>';
	 $ui = mysql_fetch_row ($e);
	}
?>
</div>
<div id="footer">
<div id="innerFooter"
</div></div>
</body></html>
