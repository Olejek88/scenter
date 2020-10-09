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
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
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

<table border="0" cellpadding="1" cellspacing="2" bgcolor="#5D6D2f">
<tbody>
<tr><td align="center" class="m_separator">Объект</font></td>
<td align="center" class="m_separator">Канал</font></td>
<td align="center" class="m_separator">Тек метка</font></td>
<td align="center" class="m_separator">Час метка</font></td>
<td align="center" class="m_separator">День метка</font></td>
<td align="center" class="m_separator">Месяц метка</font></td>

<td align="center" class="m_separator">K час</font></td>
<td align="center" class="m_separator">K день</font></td>
<td align="center" class="m_separator">K нак</font></td>

<td align="center" class="m_separator">Сум час</font></td>
<td align="center" class="m_separator">Сум день</font></td>
<td align="center" class="m_separator">Сум мес</font></td>
</tr>

<?php
 $query='SELECT * FROM devices WHERE type=11 ORDER BY id';
 $e2 = mysql_query ($query,$i); 
 if ($e2)
 while ($uo = mysql_fetch_row ($e2))
	{
	 $query='SELECT * FROM objects WHERE id='.$uo[8];
	 $e3 = mysql_query ($query,$i); 
	 if ($e3) $ui = mysql_fetch_array($e3, MYSQL_ASSOC);
	 if ($ui) $name=$ui["name"];

         $query='SELECT * FROM channels WHERE (prm=4 AND pipe=0) AND device='.$uo[11];
	 //echo $query.'<br>'; 
	 $cnt=0;
	 $e3 = mysql_query ($query,$i); 
	 if ($e3) ;
	 while ($ui = mysql_fetch_array($e3, MYSQL_ASSOC))
		{
		 $kh=$sh=$kh2=$sh2=$kh3=$sh3=$ln=$ln2=0;
		 $query = 'SELECT SUM(value),COUNT(value) FROM data WHERE type=1 AND channel='.$ui["id"];		 
		 if ($a = mysql_query ($query,$i)) 			 
		 if ($uy = mysql_fetch_row ($a)) { $kh=$uy[1]; $sh=$uy[0]; }
		 $query = 'SELECT SUM(value),COUNT(value) FROM data WHERE type=2 AND channel='.$ui["id"];		 
		 if ($a = mysql_query ($query,$i)) 			 
		 if ($uy = mysql_fetch_row ($a)) { $kh2=$uy[1]; $sh2=$uy[0]; }
		 $query = 'SELECT SUM(value),COUNT(value) FROM data WHERE type=5 AND channel='.$ui["id"];		 
		 if ($a = mysql_query ($query,$i)) 			 
		 if ($uy = mysql_fetch_row ($a)) { $kh3=$uy[1]; $sh3=$uy[0]; }
		 $query = 'SELECT value FROM data2 WHERE type=5 AND channel='.$ui["id"].' ORDER BY date DESC';		 
		 if ($a = mysql_query ($query,$i)) 			 
		 if ($uy = mysql_fetch_row ($a)) { $ln=$uy[0];}
		 if ($uy = mysql_fetch_row ($a)) { $ln2=$uy[0];}
		 $ui["name"]=str_replace("Мощность электрической энергии","",$ui["name"]);
		 print '<tr bgcolor="#ffffff">';
		 print '<td class="m_separator">'.$name.'</td>';
		 print '<td class="m_separator">'.$ui["name"].'</td>';
		 print '<td class="simple">'.$ui["device"].'</td>';
	 	 print '<td class="simple">'.$ui["adr"].'</td>';
	 	 print '<td class="simple">'.$ui["addr1"].'</td>';
	 	 print '<td class="simple">'.$ui["pipe"].'</td>';
	 	 print '<td class="simple">'.$ui["lastcurrents"].'</td>';
	 	 print '<td class="simple">'.$ui["lasthours"].'</td>';
	 	 print '<td class="simple">'.$ui["lastdays"].'</td>';
	 	 print '<td class="simple">'.$ui["lastmonth"].'</td>';

	 	 print '<td class="simple">'.$kh.'</td>';
	 	 print '<td class="simple">'.$kh2.'</td>';
	 	 print '<td class="simple">'.$kh3.'</td>';

	 	 print '<td class="simple">'.number_format($sh,3).'</td>';
	 	 print '<td class="simple">'.number_format($sh2,3).'</td>';
	 	 print '<td class="simple">'.$ln.'('.$ln2.')</td>';
	 	 print '</tr>';	 
		}
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