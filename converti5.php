<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<html><head>
<title>Конвертируем из базы "Энергоучет" в MySQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<meta http-equiv="Pragma" content="no-cashe">
<meta http-equiv="refresh" content="1660,http://ce-chel.info:81/converti5.php">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
</head>
<body>

<?php
$first=1;
$value=0;
$host='mau';
$username='mau';
$password='110726';
//$password='726110';
$maxcnt=250;
$dbh=odbc_connect ($host, $username, $password);
//echo $dbh;

print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94"><td align="center"><font color="white">id</font></td>
<td align="center"><font color="white">Название</font></td>
<td align="center"><font color="white">Серийник</font></td>
<td align="center"><font color="white">Объект</font></td>
<td align="center"><font color="white">Адрес</font></td>
<td align="center"><font color="white">Идентификатор</font></td>
<td align="center"><font color="white">Статус</font></td>
<td align="center"><font color="white">Установлен</font></td>
</tr>';

$query='SELECT * FROM devices WHERE type=15';
//echo $query.'<br>'; 
$e2 = mysql_query ($query,$i); 
if ($e2) $uo = mysql_fetch_row ($e2);
while ($uo)
{
 print '<tr bgcolor="#ffffff">';
 print '<td>'.$uo[0].'</td>';
 print '<td>'.$uo[1].'</td>';
 print '<td>'.$uo[6].'</td>';
 print '<td>'.$uo[8].'</td>';
 print '<td>'.$uo[10].'</td>';
 print '<td>'.$uo[11].'</td>';
 print '<td>'.$uo[12].'</td>';
 print '<td>'.$uo[14].'</td>';
 print '</tr>';
 $uo = mysql_fetch_row ($e2);
}
print '</table>'; 
print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
	<tr bgcolor="#476a94"><td align="center"><font color="white">id</font></td>
	<td align="center"><font color="white">Устройство</font></td>
	<td align="center"><font color="white">Название</font></td>
	<td align="center"><font color="white">Опрос</font></td>
	<td align="center"><font color="white">К-нт тр-р</font></td>
	<td align="center"><font color="white">Адрес</font></td>
	<td align="center"><font color="white">Канал акт.</font></td>
	<td align="center"><font color="white">Канал реакт.</font></td>
	<td align="center"><font color="white">Парам</font></td>
	<td align="center"><font color="white">Подпр</font></td>
	<td align="center"><font color="white">Тек метка</font></td>
	<td align="center"><font color="white">Час метка</font></td>
	<td align="center"><font color="white">День метка</font></td>
	<td align="center"><font color="white">Месяц метка</font></td></tr>';

$query='SELECT * FROM devices WHERE type=15';
//echo $query.'<br>'; 
$e2 = mysql_query ($query,$i); 
if ($e2)
while ($uo = mysql_fetch_row ($e2))
{
 $query='SELECT * FROM channels WHERE device='.$uo[11];
 $e3 = mysql_query ($query,$i); 
 if ($e3)
 while ($ui = mysql_fetch_array($e3, MYSQL_ASSOC))
	{
	 print '<tr bgcolor="#ffffff">';
	 print '<td>'.$uo[1].'</td>';
	 print '<td>'.$ui["name"].'</td>';
	 print '<td>'.$ui["device"].'</td>';
	 print '<td align="center">'.$ui["opr"].'</td>';
	 print '<td align="center">'.$ui["edizm"].'</td>';
	 print '<td align="center">'.$ui["adr"].'</td>';
	 print '<td align="center">'.$ui["addr1"].'</td>';
	 print '<td align="center">'.$ui["addr2"].'</td>';
	 print '<td align="center">'.$ui["prm"].'</td>';
	 print '<td align="center">'.$ui["pipe"].'</td>';
	 print '<td>'.$ui["lastcurrents"].'</td>';
	 print '<td>'.$ui["lasthours"].'</td>';
	 print '<td>'.$ui["lastdays"].'</td>';
	 print '<td>'.$ui["lastmonth"].'</td>';
	 print '</tr>';	 
       }
}

$today=getdate();
if ($today["hours"]>=15) $query='SELECT * FROM devices WHERE type=15 ORDER BY id';
else if ($today["hours"]%2) $query='SELECT * FROM devices WHERE type=15 AND ust=1 AND status=0 ORDER BY id';
else $query='SELECT * FROM devices WHERE type=15 AND ust=1 ORDER BY id';
//$query='SELECT * FROM devices WHERE type=15 ORDER BY id DESC';
echo $query;

$e2 = mysql_query ($query,$i); 
if ($e2)
while ($uo = mysql_fetch_row ($e2))
{
 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
	<tr bgcolor="#476a94"><td align="center"><font color="white">'.$uo[1].'</font></td></tr></table>
	<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
	<tr bgcolor="#476a94"><td align="center"><font color="white">id</font></td>
	<td align="center"><font color="white">Название</font></td>
	<td align="center"><font color="white">Опрос</font></td>
	<td align="center"><font color="white">К-нт тр-р</font></td>
	<td align="center"><font color="white">Адрес</font></td>
	<td align="center"><font color="white">Канал акт.</font></td>
	<td align="center"><font color="white">Канал реакт.</font></td>
	<td align="center"><font color="white">Параметр</font></td>
	<td align="center"><font color="white">Подпараметр</font></td>
	<td align="center"><font color="white">Тек метка</font></td>
	<td align="center"><font color="white">Час метка</font></td>
	<td align="center"><font color="white">День метка</font></td>
	<td align="center"><font color="white">Месяц метка</font></td></tr>';

 $query='SELECT * FROM channels WHERE device='.$uo[11];
 //echo $query.'<br>'; 
 $cnt=0;
 $e3 = mysql_query ($query,$i); 
 if ($e3) ;
 while ($ui = mysql_fetch_array($e3, MYSQL_ASSOC))
	{
	 print '<tr bgcolor="#ffffff">';
	 print '<td>'.$ui["name"].'</td>';
	 print '<td>'.$ui["device"].'</td>';
	 print '<td align="center">'.$ui["opr"].'</td>';
	 print '<td align="center">'.$ui["edizm"].'</td>';
	 print '<td align="center">'.$ui["adr"].'</td>';
	 print '<td align="center">'.$ui["addr1"].'</td>';
	 print '<td align="center">'.$ui["addr2"].'</td>';
	 print '<td align="center">'.$ui["prm"].'</td>';
	 print '<td align="center">'.$ui["pipe"].'</td>';
	 print '<td>'.$ui["lastcurrents"].'</td>';
	 print '<td>'.$ui["lasthours"].'</td>';
	 print '<td>'.$ui["lastdays"].'</td>';
	 print '<td>'.$ui["lastmonth"].'</td>';
	 print '</tr>';	 
	 //if ($ui["lasthours"]=='0000-00-00 00:00:00') $ui["lasthours"]='2000-01-01 00:00:00';
	 //if ($ui["lastdays"]=='0000-00-00 00:00:00') $ui["lastdays"]='2000-01-01 00:00:00';
	 //if ($ui["lastmonth"]=='0000-00-00 00:00:00') $ui["lastmonth"]='2000-01-01 00:00:00';
	 $device=$ui["device"];
	 // Nak
	 $dat=$ui["lastmonth"];
	 if ($ui["lastmonth"]=='0000-00-00 00:00:00') $query = 'SELECT * FROM NIs_On_Main_Stack WHERE MeasureDate>\'2011-01-01 00:00:00\' AND ID_Channel='.$ui["addr1"].' ORDER BY MeasureDate';
	 else $query = 'SELECT * FROM NIs_On_Main_Stack WHERE MeasureDate>\''.$dat.'\' AND ID_Channel='.$ui["addr1"].' ORDER BY MeasureDate';
	 $today=getdate();
	 echo '['.$today["hours"].':'.$today["minutes"].':'.$today["seconds"].'] '.$query.'<br>';
	 $res=odbc_exec($dbh,$query);
	 if (!$res) 
		{
		 $dbh=odbc_connect ($host, $username, $password);
		 continue;
		}

	 if ($ui["addr1"] && $res)
	 while ($row = odbc_fetch_array($res)) 
		{
		 $dat='20'.$row["MeasureDate"][2].$row["MeasureDate"][3].$row["MeasureDate"][5].$row["MeasureDate"][6].$row["MeasureDate"][8].$row["MeasureDate"][9].'230000';
		 $value=number_format($row["Value"],3,'.','');
		 $query='INSERT INTO data2(channel,date,type,value) VALUES ("'.$ui["id"].'","'.$dat.'","5","'.$value.'")'; 
		 $e = mysql_query ($query,$i); 
		 echo $query.'<br>';
		 $value=$row["Value"];
		}

	 $query='UPDATE channels SET lastmonth=\''.$dat.'\' WHERE id='.$ui["id"];
	 $e = mysql_query ($query,$i); 
	 $today=getdate();
	 echo '['.$today["hours"].':'.$today["minutes"].':'.$today["seconds"].'] '.$query.'<br>';

  	 // type=1
	 $dat=$ui["lasthours"];  $vval=0;
	 if ($ui["lasthours"]=='0000-00-00 00:00:00') { $ust=0; $query = 'SELECT * FROM PointMains WHERE DT>\'2011-01-01 00:00:00\' AND ID_PP='.$ui["adr"].' ORDER BY DT'; }
	 else { $ust=1; $query = 'SELECT * FROM PointMains WHERE DT>\''.$dat.'\' AND ID_PP='.$ui["adr"].' ORDER BY DT'; }
	 $res=odbc_exec($dbh,$query);
	 echo $query.' '.$res.'<br>';
	 $cnt=0; $value=0; $dat='20'.$ui["lasthours"][2].$ui["lasthours"][3].$ui["lasthours"][5].$ui["lasthours"][6].$ui["lasthours"][8].$ui["lasthours"][9].$ui["lasthours"][11].$ui["lasthours"][12].$ui["lasthours"][14].$ui["lasthours"][15].'00';
	 if ($ui["adr"] && $res)
	 while ($row = odbc_fetch_array($res)) 
		{
		 $dat='20'.$row["DT"][2].$row["DT"][3].$row["DT"][5].$row["DT"][6].$row["DT"][8].$row["DT"][9].$row["DT"][11].$row["DT"][12].$row["DT"][14].$row["DT"][15].'00';
		 $value=$vval=number_format($row["Val"],3,'.','');
		 $query='INSERT INTO data2(channel,date,type,value) VALUES ("'.$ui["id"].'","'.$dat.'","1","'.$value.'")'; 
		 mysql_query ($query,$i); 
		 echo $query.'<br>';
		 $query='UPDATE channels SET lastcurrents=\''.$dat.'\',lasthours=\''.$dat.'\' WHERE id='.$ui["id"];
		 $e = mysql_query ($query,$i); 
		 //echo $query.'<br>';
		 //$dat=$row["DT"]; $value=$row["Val"];
		 $cnt++; if ($cnt>$maxcnt) break;
		}

	 $query = 'SELECT * FROM data2 WHERE type=0 AND channel='.$ui["id"];
	 if ($a = mysql_query ($query,$i))
	 if ($cnt)
	 if ($uy = mysql_fetch_row ($a))
	    {
		$query = 'UPDATE data2 SET value=\''.$vval.'\',date=\''.$dat.'\' WHERE type=0 AND channel='.$ui["id"];			
		$e = mysql_query ($query,$i); 
		echo $query.'<br>';
		}
	 else
		{
		 $query = 'INSERT INTO data2 SET value=\''.$vval.'\',date=\''.$dat.'\',type=0,channel='.$ui["id"];
		 $e = mysql_query ($query,$i); 
		 echo $query.'<br>';
		}                   

	 $today=getdate();
	 $dath=sprintf("%d%02d%02d%02d0000",$today["year"],$today["mon"],$today["mday"],$today["hours"]);
	 $old=number_format($dath-$dat,0,'.','');
	 echo '['.$ui["id"].'] last one: '.$dat.' '.$dath.' '.number_format((int)$dath-(int)$dat,0).' | old='.$old.'<br>';
	 if ($old<50000) $sts=1;
	 if ($old>50000) $sts=2;
	 if ($old>100000) $sts=0;
	 $query='UPDATE devices SET status='.$sts.',date=date,ust='.$ust.' WHERE device='.$ui["device"];
	 $e = mysql_query ($query,$i);
	 echo $query.'<br>';  
	 $cnt++;	 
	}
}
//---------------------------------------------------------------------------------------
// days
/*
 $today=getdate();
 $ye=$today["year"];
 $mn=$today["mon"];
 $qnt=100;
 $dy=31;
 if (!checkdate ($mn,31,$ye)) { $dy=30; }
 if (!checkdate ($mn,30,$ye)) { $dy=29; }
 if (!checkdate ($mn,29,$ye)) { $dy=28; }
 $tm=$dy=$today["mday"];

 for ($tn=0; $tn<=$qnt; $tn++)
    {	 
     $date2[$tn]=sprintf ("%d-%02d-%02d",$ye,$mn,$tm);
     $date3[$tn]=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
     $data[$tn]=0;
     $tm--;
     if ($tm==0)
	{
	 $mn--;
	 if ($mn==0) { $mn=12; $ye--; }
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
	 $tm=$dy;
	}
    }
print '</table>';
print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
	<tr bgcolor="#476a94"><td align="center"><font color="white">'.$uo[1].'</font></td></tr></table>
	<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
	<tr bgcolor="#476a94"><td align="center"><font color="white">id</font></td>
	<td align="center"><font color="white">Название</font></td>
	<td align="center"><font color="white">Опрос</font></td>
	<td align="center"><font color="white">К-нт тр-р</font></td>
	<td align="center"><font color="white">Адрес</font></td>
	<td align="center"><font color="white">Канал акт.</font></td>
	<td align="center"><font color="white">Канал реакт.</font></td>
	<td align="center"><font color="white">Параметр</font></td>
	<td align="center"><font color="white">Подпараметр</font></td>
	<td align="center"><font color="white">Тек метка</font></td>
	<td align="center"><font color="white">Час метка</font></td>
	<td align="center"><font color="white">День метка</font></td>
	<td align="center"><font color="white">Месяц метка</font></td></tr>';
//---------------------------------------------------------------------------------------
$query='SELECT * FROM devices WHERE type=15';
$e2 = mysql_query ($query,$i); 
if ($e2)
while ($uo = mysql_fetch_row ($e2))
{
 $query='SELECT * FROM channels WHERE device='.$uo[11];
 echo $query.'<br>'; $cnt=0;
 $e3 = mysql_query ($query,$i); 
 if ($e3)
 while ($ui = mysql_fetch_array($e3, MYSQL_ASSOC))
	{
	 print '<tr bgcolor="#ffffff">';
	 print '<td>'.$ui["name"].'</td>';
	 print '<td>'.$ui["device"].'</td>';
	 print '<td align="center">'.$ui["opr"].'</td>';
	 print '<td align="center">'.$ui["edizm"].'</td>';
	 print '<td align="center">'.$ui["adr"].'</td>';
	 print '<td align="center">'.$ui["addr1"].'</td>';
	 print '<td align="center">'.$ui["addr2"].'</td>';
	 print '<td align="center">'.$ui["prm"].'</td>';
	 print '<td align="center">'.$ui["pipe"].'</td>';
	 print '<td>'.$ui["lastcurrents"].'</td>';
	 print '<td>'.$ui["lasthours"].'</td>';
	 print '<td>'.$ui["lastdays"].'</td>';
	 print '<td>'.$ui["lastmonth"].'</td>';
	 print '</tr>';	 	 
	 $device=$ui["device"];
	 $datt=$ui["lastdays"][0].$ui["lastdays"][1].$ui["lastdays"][2].$ui["lastdays"][3].$ui["lastdays"][5].$ui["lastdays"][6].$ui["lastdays"][8].$ui["lastdays"][9].'000000';

	 $query = 'SELECT * FROM data2 WHERE date>='.$datt.' AND type=1 AND channel='.$ui["id"].' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 echo $query.'<br>';
	 if ($a)
	 while ($uy = mysql_fetch_row ($a))
	      	{
		 $datt=$uy[2][0].$uy[2][1].$uy[2][2].$uy[2][3].$uy[2][5].$uy[2][6].'000000';
		 $x=$max+1;
		 for ($tn=0; $tn<=$max; $tn++) 
		 if ($datt==$date2[$tn]) $x=$tn;
		 $data[$x]+=$uy[3];			 
	      	}
	 $first=1;
	 for ($tn=0; $tn<=$max; $tn++) 
	 if ($data[$tn])
		{
		 $query = 'SELECT * FROM data2 WHERE date='.$date2[$tn].' AND type=2 AND channel='.$ui["id"];
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);			 
		 if ($uy)
		      {
			$query = 'UPDATE data2 SET value='.$data[$tn].' WHERE date='.$date2[$tn].' AND type=2 AND channel='.$ui["id"];			
			//$e = mysql_query ($query,$i); 
			echo $query.'<br>';
			}
		 else
			{
			 $query = 'INSERT INTO data2 SET value='.$data[$tn].',date='.$date2[$tn].',type=2,channel='.$ui["id"];
			 //$e = mysql_query ($query,$i); 
			 echo $query.'<br>';			
			 if ($first && $e)
				{
				 $query='UPDATE channels SET lastdays='.$dat.' WHERE id='.$ui["id"];
				 //$e = mysql_query ($query,$i); 
				 echo $query.'<br>';
				}
			}
		$first=0;
	       }	 
	}
}
//---------------------------------------------------------------------------------------
// month
 $today=getdate();
 $ye=$today["year"]; $qnt=6;
 $tm=$today["mon"];
 $cn=0;
 for ($tn=0; $tn<=$qnt; $tn++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     $date1[$cn]=sprintf ("%d%02d01000000",$today["year"],$tm);
     $dat[$cn]=sprintf ("%d-%02d-01 00:00:00",$today["year"],$tm);
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
    }
//---------------------------------------------------------------------------------------
$query='SELECT * FROM devices WHERE type=15';
$e2 = mysql_query ($query,$i); 
if ($e2)
while ($uo = mysql_fetch_row ($e2))
{
 $query='SELECT * FROM channels WHERE device='.$uo[11];
 echo $query.'<br>'; $cnt=0;
 $e = mysql_query ($query,$i); 
 if ($e) 
 while ($ui = mysql_fetch_array($e, MYSQL_ASSOC))
	{
	 print '<tr bgcolor="#ffffff">';
	 print '<td>'.$ui["name"].'</td>';
	 print '<td>'.$ui["device"].'</td>';
	 print '<td>'.$ui["opr"].'</td>';
	 print '<td>'.$ui["edizm"].'</td>';
	 print '<td>'.$ui["adr"].'</td>';
	 print '<td>'.$ui["addr1"].'</td>';
	 print '<td>'.$ui["addr2"].'</td>';
	 print '<td>'.$ui["prm"].'</td>';
	 print '<td>'.$ui["pipe"].'</td>';
	 print '<td>'.$ui["lasthours"].'</td>';
	 print '<td>'.$ui["lastdays"].'</td>';
	 print '<td>'.$ui["lastmonth"].'</td>';
	 print '</tr>';	 	 
	 $device=$ui["device"];
	 $datt=$ui["lastmonth"][0].$ui["lastmonth"][1].$ui["lastmonth"][2].$ui["lastmonth"][3].'01000000';

	 $query = 'SELECT * FROM data2 WHERE date>='.$datt.' AND type=1 AND channel='.$ui["id"].' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a)
	 while ($uy = mysql_fetch_row ($a))
	      	{
		 $datt=$uy[2][0].$uy[2][1].$uy[2][2].$uy[2][3].'01000000';
		 $x=$max+1;
		 for ($tn=0; $tn<=$max; $tn++) 
		 if ($datt==$date2[$tn]) $x=$tn;
		 $data[$x]+=$uy[3];			 
	      	}

	 for ($tn=0; $tn<=$max; $tn++) 
	 if ($data[$tn])
		{
		 $query = 'SELECT * FROM data2 WHERE date='.$date2[$tn].' AND type=4 AND channel='.$ui["id"];
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);			 
		 if ($uy)
		      {
			$query = 'UPDATE data2 SET value='.$data[$tn].' WHERE date='.$date2[$tn].' AND type=4 AND channel='.$ui["id"];			
			//$e = mysql_query ($query,$i); 
			echo $query.'<br>';
			}
		 else
			{
			 $query = 'INSERT INTO data2 SET value='.$data[$tn].',date='.$date2[$tn].',type=4,channel='.$ui["id"];
			 //$e = mysql_query ($query,$i); 
			 echo $query.'<br>';			
			}
	       }
	}
}*/
// Free the query result
//odbc_free_result($query);
print '</table>';	
?>
