<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>

<html><head>
<title>������������ �� ����� � MySQL</title>
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
<td align="center"><font color="white">��������</font></td>
<td align="center"><font color="white">����� � ����</font></td>
<td align="center"><font color="white">��������</font></td>
<td align="center"><font color="white">��������</font></td>
<td align="center"><font color="white">CRC</font></td>
<td align="center"><font color="white">������</font></td>
<td align="center"><font color="white">��� �������</font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white">�������</font></td>
<td align="center"><font color="white">�-�� �������</font></td>
<td align="center"><font color="white"></font></td>
<td align="center"><font color="white">��������</font></td>
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
	 if (strstr ($row_array[2],"�������� 16�")) $device=84606978;
	 if (strstr ($row_array[2],"������� ��� �301")) $device=84606979;
	 if (strstr ($row_array[2],"������� ��� �15")) $device=84606980;
	 if (strstr ($row_array[2],"������� ��� �263")) $device=84606981;
	 if (strstr ($row_array[2],"��������")) $device=84606982;
	 if (strstr ($row_array[2],"������� �3")) $device=84606983;
	 if (strstr ($row_array[2],"����� �106")) $device=84606984;
	 if (strstr ($row_array[2],"����������� �������� �1")) $device=84606985;

	 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
		<tr bgcolor="#476a94"><td colspan=25 align=center><font color="white"><b>'.$row_array[2].'</b></font></td></tr>
		<tr bgcolor="#476a94">
		<td align="center"><font color="white">Scode</font></td>
		<td align="center"><font color="white">������</font></td>
		<td align="center"><font color="white">��������</font></td>
		<td align="center"><font color="white">���</font></td>
		<td align="center"><font color="white">�����</font></td>
		<td align="center"><font color="white">N1</font></td>
		<td align="center"><font color="white">N2</font></td>
		<td align="center"><font color="white">N3</font></td>
		<td align="center"><font color="white">N4</font></td>
		<td align="center"><font color="white">N5</font></td>
		<td align="center"><font color="white">N6</font></td>
		<td align="center"><font color="white">N7</font></td>
		<td align="center"><font color="white">ITOG</font></td>
		<td align="center"><font color="white">PARH</font></td>
		<td align="center"><font color="white">�������� 2</font></td>
		<td align="center"><font color="white">������</font></td>
		<td align="center"><font color="white">�������</font></td>
		<td align="center"><font color="white">��.���.</font></td>
		<td align="center"><font color="white">��������</font></td>
		<td align="center"><font color="white">�����������</font></td>
		<td align="center"><font color="white">���������</font></td>
		<td align="center"><font color="white">����</font></td>
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
		 if (strstr ($row_array2[2],"����")) { $type=0; $prm=14; $source=0; }
         	 $stmt3 = 'select * from DETAIL_TBL where SCODE='.$row_array2[0].' ORDER BY SDATE DESC;'; 
	         $sth3 = ibase_query ($dbh, $stmt3);
	         if ($row_array3=ibase_fetch_row($sth3) && $type>=0)
			{
			 $query='UPDATE data SET value='.$row_array3[2].' WHERE type='.$type.' AND prm='.$prm.' AND source='.$source.' AND date="'.$row_array3[0].'"';
			 echo $query.'<br>';
			}
		 $type=-1;
		 if (strstr ($row_array2[2],"����") && !strstr ($row_array2[2],"��+")) 
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
		 if (strstr ($row_array2[2],"����") && !strstr ($row_array2[2],"��+")) 
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
		 if (strstr ($row_array2[2],"Q������") && !strstr ($row_array2[2],"��+")) 
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
		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"��� G��") || strstr ($row_array2[2],"G�����") || (strstr ($row_array2[2],"G�����") && !strstr ($row_array2[2],"++")))
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

		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���")) 
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
		 if (strstr ($row_array2[2],"Q������") || strstr ($row_array2[2],"���Q����"))
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

		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�") || strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"�Q����")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
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

		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
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
		 if (strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"V��� ���") || strstr ($row_array2[2],"V�� ���")  || strstr ($row_array2[2],"��� G��")) 
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
		 if (strstr ($row_array2[2],"V��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"P�����")) 
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
		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"G�����_") || strstr ($row_array2[2],"G�����") || (strstr ($row_array2[2],"��� G��") && !strstr ($row_array2[2],"++")))
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
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���")) 
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
		 if (strstr ($row_array2[2],"Q������") || strstr ($row_array2[2],"���Q����"))
//		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�"))
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
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

		 if (strstr ($row_array2[2],"V��� ���")) 
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
		 if (strstr ($row_array2[2],"V��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"P�����")) 
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
		 if (strstr ($row_array2[2],"V�� ���") || strstr ($row_array2[2],"��� G��")) 
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
		 if (strstr ($row_array2[2],"G�����") || strstr ($row_array2[2],"��� G��")) 
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
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���")) 
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
//		 if (strstr ($row_array2[2],"Q����_���"))
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"���Q����")) 
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
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
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
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
 		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"V�� ���")) 
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
		 if (strstr ($row_array2[2],"V�����")) 
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
		 if (strstr ($row_array2[2],"G������")) 
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
		 if (strstr ($row_array2[2],"V��� ���")) 
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
		 if (strstr ($row_array2[2],"V��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"P�����")) 
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
		 if (strstr ($row_array2[2],"V�� ���")) 
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
		 if (strstr ($row_array2[2],"��� G��")) 
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
		 if (strstr ($row_array2[2],"��� G���")) 
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
		 if (strstr ($row_array2[2],"���Q����")) 
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
		 if (strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"��� � Q�")) 
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
		 if (strstr ($row_array2[2],"��� Q��")) 
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
		 if (strstr ($row_array2[2],"��� Q���")) 
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
 		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"V�� ���")) 
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
		 if (strstr ($row_array2[2],"��� G��")) 
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
		 if (strstr ($row_array2[2],"��� ���")) 
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
		 if (strstr ($row_array2[2],"��� ����")) 
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
		 if (strstr ($row_array2[2],"P�����")) 
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
		 if (strstr ($row_array2[2],"V�� ���")) 
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
