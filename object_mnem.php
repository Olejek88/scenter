<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<html><head>
<title>Челябинский ситуационный центр : Мнемосхема узла учета</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/niftyPrint.htm" media="print">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">

<meta http-equiv="refresh" content="35,http://ce-chel.info:81/object_mnem.php?id=<?php print $_GET["id"]; ?>">

<img usemap="#menu" border=0 src="files/mnemo.jpg">

<style type="text/css">
div
{
	font-weight: bold;
	font-size: 11px;
	color: #003300;
	font-family: Verdana;
	font-family: Tahoma;
}
</style>
<?php
 $query = 'SELECT * FROM devices WHERE type=11 AND object='.$_GET["id"];
 $y = mysql_query ($query,$i);
 if ($y) $uo = mysql_fetch_row ($y);
 if ($uo) $device=$uo[11];

 $query = 'SELECT * FROM data WHERE (type=0 OR type=1) AND device='.$device.' ORDER BY date DESC';
 //echo $query;
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 if ($ui[8]==12 && $ui[6]==5 && !$vhv) $vhv=number_format($ui[3],2).' м3';
	 if ($ui[8]==12 && $ui[6]==7 && !$vgv) $vgv=number_format($ui[3],2).' м3';
	 if ($ui[8]==12 && $ui[6]==6 && !$vv) $vv=number_format($ui[3],2).' м3';
	 if ($ui[8]==4 && $ui[6]==10 && !$tisp) $tisp=number_format($ui[3],2).' час';
	 if ($ui[8]==12 && $ui[6]==25 && !$nhvs) $nhvs=number_format($ui[3],2).' м3';
	 if ($ui[8]==12 && $ui[6]==26 && !$ngvs) $ngvs=number_format($ui[3],2).' м3';
	 if ($ui[8]==11 && $ui[6]==0 && !$gpod) $gpod=number_format($ui[3],3).'';
	 if ($ui[8]==11 && $ui[6]==1 && !$gobr) $gobr=number_format($ui[3],3).'';
	 if ($ui[8]==16 && $ui[6]==0 && !$ppod) $ppod=number_format($ui[3],2).'';
	 if ($ui[8]==16 && $ui[6]==1 && !$pobr) $pobr=number_format($ui[3],2).'';
	 if ($ui[8]==4 && $ui[6]==0 && !$tpod) $tpod=number_format($ui[3],1).'';
	 if ($ui[8]==4 && $ui[6]==1 && !$tobr) $tobr=number_format($ui[3],1).'';
	 if ($ui[8]==13 && $ui[6]==0 && !$qpod) $qpod=number_format($ui[3],2).' ГКал';
	 if ($ui[8]==13 && $ui[6]==1 && !$qobr) $qobr=number_format($ui[3],2).' ГКал';
	 if ($ui[8]==13 && $ui[6]==2 && !$qpot) $qpot=number_format($ui[3],2).' ГКал';

	 if ($ui[8]==13 && $ui[6]==21 && !$nqpod) $nqpod=number_format($ui[3],2).' ГКал';
	 if ($ui[8]==13 && $ui[6]==22 && !$nqobr) $nqobr=number_format($ui[3],2).' ГКал';
	 if ($ui[8]==13 && $ui[6]==23 && !$nqpot) $nqpot=number_format($ui[3],2).' ГКал';

	 if ($ui[8]==12 && $ui[6]==21 && !$nvpod) $nvpod=number_format($ui[3],2).' м3';
	 if ($ui[8]==12 && $ui[6]==22 && !$nvobr) $nvobr=number_format($ui[3],2).' м3';
	 if ($ui[8]==12 && $ui[6]==26 && !$nvhvs) $nvhvs=number_format($ui[3],2).' м3';

	 $ui = mysql_fetch_row ($e);
	}

 print '<div id="g11" style="position:absolute;top:408;left:75;width:80;height:30">'.$tpod.'</div>'; 
 print '<div id="g13" style="position:absolute;top:428;left:75;width:80;height:30">'.$ppod.'</div>'; 
 print '<div id="g13" style="position:absolute;top:427;left:273;width:80;height:30">'.$gpod.'</div>'; 

 print '<div id="g13" style="position:absolute;top:510;left:160;width:80;height:30">'.$tobr.'</div>'; 
 print '<div id="g13" style="position:absolute;top:531;left:160;width:80;height:30">'.$pobr.'</div>'; 
 print '<div id="g13" style="position:absolute;top:552;left:160;width:80;height:30">'.$gobr.'</div>'; 

 print '<div id="g13" style="position:absolute;top:510;left:160;width:80;height:30">'.$tobr.'</div>'; 
?>