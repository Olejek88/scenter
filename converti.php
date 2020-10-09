<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<html><head>
<title>Конвертируем из Искры в MySQL</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
</head>
<body>

<?php
 $first=1;
 $host='localhost:d:/iskra/ISKRA3.FDB';
// $host='ISKRA3.FDB';
 $username='SYSDBA';
 $password='masterkey';
 $dbh = ibase_connect ($host, $username, $password);
 $stmt = 'select rdb$relation_name from rdb$relations where rdb$view_blr is null and (rdb$system_flag is null or rdb$system_flag = 0);';
 $sth = ibase_query ($dbh, $stmt);
 while ($row_array=ibase_fetch_row($sth))
      for ($j=0; $j<ibase_num_fields($sth); $j++)
     	      {
     	       	  //echo $row_array[$j] . "<br>";
     	      }
 // DETAIL_TBL
 // FACTORYOBJECTS_TBL
 // OPARH_TBL 
 // ARHIVD_TBL
print '
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">Scode</font></td>
<td align="center"><font color="white">Subcode</font></td>
<td align="center"><font color="white">Название</font></td>
<td align="center"><font color="white">Номер в сети</font></td>
<td align="center"><font color="white">Скорость</font></td>
<td align="center"><font color="white">Протокол</font></td>
<td align="center"><font color="white">CRC</font></td>
<td align="center"><font color="white">Каналы</font></td>
<td align="center"><font color="white">Тип каналов</font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white">Телефон</font></td>
<td align="center"><font color="white">К-во звонков</font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white">Серийник</font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white"></font></td>
</tr>';

 $stmt = 'select * from CONTROL_TBL;'; 
 $sth = ibase_query ($dbh, $stmt);
 while ($row_array=ibase_fetch_row($sth))
	{
	 print '<tr bgcolor="#ffffff">';
	 for ($j=0; $j<ibase_num_fields($sth); $j++)
	      {
	     	print '<td>'.$row_array[$j].'</td>';
	      }
	 print '</tr>';
	 $query='DELETE FROM `scenter2`.`data` WHERE type>0';
	 $e = mysql_query ($query,$i);
	}
 print '</table>';	
// $stmt = 'select * from CONTROL_TBL where scode=8;'; 
 $stmt = 'select * from CONTROL_TBL;'; 
 $sth = ibase_query ($dbh, $stmt);
 while ($row_array=ibase_fetch_row($sth))
	{
	 if (strstr ($row_array[2],"Худякова 16а")) $device=84606978;
	 if (strstr ($row_array[2],"Детский сад №301")) $device=84606979;
	 if (strstr ($row_array[2],"Детский сад №15")) $device=84606980;
	 if (strstr ($row_array[2],"Детский сад №263")) $device=84606981;
	 if (strstr ($row_array[2],"Ровесник")) $device=84606982;
	 if (strstr ($row_array[2],"СДЮСШОР №3")) $device=84606983;
	 if (strstr ($row_array[2],"Школа №106")) $device=84606984;
	 if (strstr ($row_array[2],"клиническая больница №1")) $device=84606985;

	 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
		<tr bgcolor="#476a94"><td colspan=25 align=center><font color="white"><b>'.$row_array[2].'</b></font></td></tr>
		<tr bgcolor="#476a94">
		<td align="center"><font color="white">Scode</font></td>
		<td align="center"><font color="white">Девайс</font></td>
		<td align="center"><font color="white">Название</font></td>
		<td align="center"><font color="white">Тип</font></td>
		<td align="center"><font color="white">Адрес</font></td>
		<td align="center"><font color="white">N1</font></td>
		<td align="center"><font color="white">N2</font></td>
		<td align="center"><font color="white">N3</font></td>
		<td align="center"><font color="white">N4</font></td>
		<td align="center"><font color="white">N5</font></td>
		<td align="center"><font color="white">N6</font></td>
		<td align="center"><font color="white">N7</font></td>
		<td align="center"><font color="white">ITOG</font></td>
		<td align="center"><font color="white">PARH</font></td>
		<td align="center"><font color="white">Название 2</font></td>
		<td align="center"><font color="white">Нижнее</font></td>
		<td align="center"><font color="white">Верхнее</font></td>
		<td align="center"><font color="white">Ед.Изм.</font></td>
		<td align="center"><font color="white">Описание</font></td>
		<td align="center"><font color="white">Трассировка</font></td>
		<td align="center"><font color="white">Множитель</font></td>
		<td align="center"><font color="white">Цифр</font></td>
		<td align="center"><font color="white">RPTOP</font></td>
		<td align="center"><font color="white">RPBOT</font></td>
		<td align="center"><font color="white"></font></td></tr>';
         $stmt2 = 'select * from OPARH_TBL where SUBCODE='.$row_array[0].';'; 
         $sth2 = ibase_query ($dbh, $stmt2);
         while ($row_array2=ibase_fetch_row($sth2))
		{
		 print '<tr bgcolor="#ffffff">';
		 for ($j=0; $j<ibase_num_fields($sth2); $j++)
      			{ 
		     	print '<td>'.$row_array2[$j].'</td>';
		      }
		 print '</tr>';
		}
	 print '</table>';

         $stmt2 = 'select * from OPARH_TBL where SUBCODE='.$row_array[0].';'; 
         $sth2 = ibase_query ($dbh, $stmt2);
         while ($row_array2=ibase_fetch_row($sth2))
		{        
		 $type=-1;
		 echo $row_array2[2].'<br>';
		 if (strstr ($row_array2[2],"Эинт")) { $type=0; $prm=14; $source=0; }
         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' ORDER BY SDATE DESC;'; 
	         $sth3 = ibase_query ($dbh, $stmt3);
	         if ($row_array3=ibase_fetch_row($sth3) && $type>=0)
			{
			 $query='UPDATE data SET value='.$row_array3[2].' WHERE type='.$type.' AND prm='.$prm.' AND source='.$source.' AND date="'.$row_array3[0].'"';
			 echo $query.'<br>';
			}
		 $type=-1;
		 if (strstr ($row_array2[2],"Эчас") && !strstr ($row_array2[2],"ин+")) 
			{ 
			 $type=1; $prm=14; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;'; 
			 echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='SELECT * FROM data WHERE type='.$type.' AND prm='.$prm.' AND source='.$source.' AND date="'.$row_array3[0].'"';
				 echo $query.'<br>'; 
				 $e = mysql_query ($query,$i); 
				 if ($e) $ui = mysql_fetch_row ($e);
				 if (!$ui[0])
					{
					 //2010-11-09 14:00:00
					 //$datas=$row_array3[0][0].$row_array3[0][1].$row_array3[0][2].$row_array3[0][3].$row_array3[0][5].$row_array3[0][6].$row_array3[0][8].$row_array3[0][9].$row_array3[0][11].$row_array3[0][12].'0000';
					 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
					 $e = mysql_query ($query,$i);
					 echo $query.'<br>';
					}
				}
			}
		 if (strstr ($row_array2[2],"Эчас") && !strstr ($row_array2[2],"ин+")) 
			{ 
			 $type=1; $prm=14; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';  if (floatval($row_array3[2])>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}
		 if (strstr ($row_array2[2],"QпотМес") && !strstr ($row_array2[2],"ин+")) 
			{ 
			 $type=4; $prm=13; $source=2;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}		 
		 if (!strstr ($row_array[2],"ХВС"))
		 if (strstr ($row_array2[2],"Час Gпр") || strstr ($row_array2[2],"Gпрчас") || (strstr ($row_array2[2],"Gпрчас") && !strstr ($row_array2[2],"++")))
			{ 
			 $type=1; $prm=11; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}

		 if (strstr ($row_array2[2],"Gоб час") || strstr ($row_array2[2],"Час Gобр")) 
			{ 
			 $type=1; $prm=11; $source=1;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}                             
		 if (strstr ($row_array2[2],"QпотЧас") || strstr ($row_array2[2],"ЧасQпотр"))
			{ 
			 $type=1; $prm=13; $source=22;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}

		 if (strstr ($row_array2[2],"зQпЧас") || strstr ($row_array2[2],"Час З Qп") || strstr ($row_array2[2],"Час З Qп")) 
			{ 
			 $type=1; $prm=13; $source=2;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"tпрЧас") || strstr ($row_array2[2],"Час Тпр")) 
			{ 
			 $type=1; $prm=4; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"tобЧас") || strstr ($row_array2[2],"Час Тобр")) 
			{ 
			 $type=1; $prm=4; $source=1;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQпЧас")) 
			{ 
			 $type=1; $prm=13; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQоЧас") || strstr ($row_array2[2],"Час З Qо")) 
			{ 
			 $type=1; $prm=13; $source=1;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}

		 if (strstr ($row_array2[2],"оQпЧас") || strstr ($row_array2[2],"Час Qобр")) 
			{ 
			 $type=1; $prm=13; $source=10;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"оQоЧас") || strstr ($row_array2[2],"Час Qпр")) 
			{ 
			 $type=1; $prm=13; $source=11;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}                               
		 if (strstr ($row_array[2],"ХВС"))
		 if (strstr ($row_array2[2],"Vхвс час") || strstr ($row_array2[2],"Vпр час")  || strstr ($row_array2[2],"Час Gпр")) 
			{ 
			 $type=1; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vгвс час")) 
			{ 
			 $type=1; $prm=12; $source=5;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Час Рпр")) 
			{ 
			 $type=1; $prm=16; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Час Робр")) 
			{ 
			 $type=1; $prm=16; $source=1;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"PхвЧас")) 
			{ 
			 $type=1; $prm=16; $source=2;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (!strstr ($row_array[2],"ХВС"))
		 if (strstr ($row_array2[2],"Gпрсут_") || strstr ($row_array2[2],"Gпрсут") || (strstr ($row_array2[2],"Сут Gпр") && !strstr ($row_array2[2],"++")))
			{ 
			 $type=2; $prm=11; $source=0;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}
		 if (strstr ($row_array2[2],"Gоб сут") || strstr ($row_array2[2],"Сут Gобр")) 
			{ 
			 $type=2; $prm=11; $source=1;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}                             
		 if (strstr ($row_array2[2],"QпотСут") || strstr ($row_array2[2],"СутQпотр"))
//		 if (strstr ($row_array2[2],"зQпСут") || strstr ($row_array2[2],"Сут З Qп"))
			{ 
			 $type=2; $prm=13; $source=2;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}                             
		 if (strstr ($row_array2[2],"tпрСут") || strstr ($row_array2[2],"Сут Тпр")) 
			{ 
			 $type=2; $prm=4; $source=0;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($row_array3[2])>0)echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"tобСут") || strstr ($row_array2[2],"Сут Тобр")) 
			{ 
			 $type=2; $prm=4; $source=1;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
		 		 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 if (floatval($row_array3[2])>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQпСут") || strstr ($row_array2[2],"Сут З Qп")) 
			{ 
			 $type=2; $prm=13; $source=0;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($device==84606985 || $device==84606984) $value=$row_array3[2]*2.5; else $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQоСут") || strstr ($row_array2[2],"Сут З Qо")) 
			{ 
			 $type=2; $prm=13; $source=1;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}       
		 if (strstr ($row_array2[2],"оQпСут") || strstr ($row_array2[2],"Сут Qобр")) 
			{ 
			 $type=2; $prm=13; $source=10;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"оQоСут") || strstr ($row_array2[2],"Сут Qпр")) 
			{ 
			 $type=2; $prm=13; $source=11;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}       

		 if (strstr ($row_array2[2],"Vхвс сут")) 
			{ 
			 $type=2; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vгвс сут")) 
			{ 
			 $type=2; $prm=12; $source=5;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Сут Рпр")) 
			{ 
			 $type=1; $prm=16; $source=0;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Сут Робр")) 
			{ 
			 $type=1; $prm=16; $source=1;
	         	 $stmt3 = 'select * from ARHIVH_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"PхвСут")) 
			{ 
			 $type=2; $prm=16; $source=2;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}                                
		 if (strstr ($row_array2[2],"Vпр сут") || strstr ($row_array2[2],"Сут Gпр")) 
			{ 
			 $type=2; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVD_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 while ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; if (floatval($value)>0) echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}

		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (strstr ($row_array2[2],"Gпринт") || strstr ($row_array2[2],"инт Gпр")) 
			{ 
			 $type=0; $prm=11; $source=0;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; 
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; 
				 echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}
		 if (strstr ($row_array2[2],"Gоб инт") || strstr ($row_array2[2],"инт Gобр")) 
			{ 
			 $type=0; $prm=11; $source=1;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}
//		 if (strstr ($row_array2[2],"Qпотр_Арх"))
		 if (strstr ($row_array2[2],"зQпИнт") || strstr ($row_array2[2],"интQпотр")) 
			{ 
			 $type=0; $prm=13; $source=2;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($device==84606985 || $device==84606984) $value=$row_array3[2]*2.5; else $value=$row_array3[2];
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"tпрИнт") || strstr ($row_array2[2],"инт Тпр")) 
			{ 
			 $type=0; $prm=4; $source=0;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"tобИнт") || strstr ($row_array2[2],"инт Тобр")) 
			{ 
			 $type=0; $prm=4; $source=1;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQпИнт") || strstr ($row_array2[2],"Инт З Qп")) 
			{ 
			 $type=0; $prm=13; $source=0;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"зQоИнт") || strstr ($row_array2[2],"Инт З Qо")) 
			{ 
			 $type=0; $prm=13; $source=1;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"оQпИнт") || strstr ($row_array2[2],"инт Qпр")) 
			{ 
			 $type=0; $prm=13; $source=10;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"оQоИнт") || strstr ($row_array2[2],"инт Qобр")) 
			{ 
			 $type=0; $prm=13; $source=11;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
 		 if (!strstr ($row_array[2],"ХВС"))
		 if (strstr ($row_array2[2],"Vпр инт")) 
			{ 
			 $type=0; $prm=12; $source=0;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vобинт")) 
			{ 
			 $type=0; $prm=12; $source=1;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Gхвсинт")) 
			{ 
			 $type=0; $prm=12; $source=6;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vхвс инт")) 
			{ 
			 $type=0; $prm=12; $source=7;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vгвс инт")) 
			{ 
			 $type=0; $prm=12; $source=5;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 else $query='UPDATE data SET value="'.$row_array3[2].'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"инт Рпр")) 
			{ 
			 $type=0; $prm=16; $source=0;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"инт Робр")) 
			{ 
			 $type=0; $prm=16; $source=1;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"PхвИнт")) 
			{ 
			 $type=0; $prm=16; $source=2;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vпр инт")) 
			{ 
			 $type=0; $prm=12; $source=6;
	         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 if ($first) $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 else $query='UPDATE data SET value="'.$value.'" WHERE device="'.$device.'" AND prm="'.$prm.'" AND source="'.$source.'" AND type="'.$type.'"'; echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}			
			}
		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (strstr ($row_array2[2],"Мес Gпр")) 
			{ 
			 $type=4; $prm=11; $source=0;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; 
				 echo $query.'<br>';
				 $e = mysql_query ($query,$i);
				}
			}
		 if (strstr ($row_array2[2],"Мес Gобр")) 
			{ 
			 $type=4; $prm=11; $source=1;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}
			}
		 if (strstr ($row_array2[2],"МесQпотр")) 
			{ 
			 $type=4; $prm=13; $source=2;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Тпр")) 
			{ 
			 $type=4; $prm=4; $source=0;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Тобр")) 
			{ 
			 $type=4; $prm=4; $source=1;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес З Qп")) 
			{ 
			 $type=4; $prm=13; $source=0;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес З Qо")) 
			{ 
			 $type=4; $prm=13; $source=1;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Qпр")) 
			{ 
			 $type=4; $prm=13; $source=10;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Qобр")) 
			{ 
			 $type=4; $prm=13; $source=11;
	         	 $stmt3= 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}			
			}
 		 if (!strstr ($row_array[2],"ХВС"))
		 if (strstr ($row_array2[2],"Vпр инт")) 
			{ 
			 $type=4; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $value=$row_array3[2];
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Gпр")) 
			{ 
			 $type=4; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Рпр")) 
			{ 
			 $type=4; $prm=16; $source=0;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Мес Робр")) 
			{ 
			 $type=4; $prm=16; $source=1;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"PхвМес")) 
			{ 
			 $type=4; $prm=16; $source=2;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		 if (strstr ($row_array2[2],"Vпр мес")) 
			{ 
			 $type=4; $prm=12; $source=6;
	         	 $stmt3 = 'select * from ARHIVM_TBL where SCODE='.$row_array2[0].' order by SDATE desc;';  echo $stmt3.'<br>';
		         $sth3 = ibase_query ($dbh, $stmt3);
		         if ($type>=0)
			 if ($row_array3=ibase_fetch_row($sth3))
				{
				 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$source.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$value.'")';
				 $e = mysql_query ($query,$i);
				}			
			}
		}
	}

 ibase_close ($dbh);
?>
