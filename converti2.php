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
<meta http-equiv="Pragma" content="no-cashe">
<meta http-equiv="refresh" content="1760,http://ce-chel.info:81/converti2.php">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
</head>
<body>

<?php
 $first=1;
// $host='localhost:c:/WebServers/home/ce-zlat.info/www/ISKRA3.FDB';
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
 $query='DELETE FROM `scenter2`.`data` WHERE type=0';
 //echo $query.'<br>';
 $e = mysql_query ($query,$i);

 // DETAIL_TBL
 // FACTORYOBJECTS_TBL
 // OPARH_TBL 
 // ARHIVD_TBL
function GetTimestamp($i,$dbh,$device,$prm,$pipe,$type,$param)
{
 $query='SELECT * FROM channels WHERE prm='.$prm.' AND pipe='.$pipe.' AND device='.$device;
 echo $query.'<br>'; 
 $e = mysql_query ($query,$i); 
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui)
 	{
	 echo $ui[11].' '.$ui[12].' '.$ui[13].' '.$ui[14].'<br>';
	 if ($type==0) $dat=$ui[11][5].$ui[11][6].'/'.$ui[11][8].$ui[11][9].'/'.$ui[11][2].$ui[11][3].' '.$ui[11][11].$ui[11][12].':'.$ui[11][14].$ui[11][15];
	 if ($type==1) $dat=$ui[12][5].$ui[12][6].'/'.$ui[12][8].$ui[12][9].'/'.$ui[12][2].$ui[12][3].' '.$ui[12][11].$ui[12][12].':'.$ui[12][14].$ui[12][15];
	 if ($type==2) $dat=$ui[13][5].$ui[13][6].'/'.$ui[13][8].$ui[13][9].'/'.$ui[13][2].$ui[13][3].' '.$ui[13][11].$ui[13][12].':'.$ui[13][14].$ui[13][15];
	 if ($type==4) $dat=$ui[14][5].$ui[14][6].'/'.$ui[14][8].$ui[14][9].'/'.$ui[14][2].$ui[14][3].' '.$ui[14][11].$ui[14][12].':'.$ui[14][14].$ui[14][15];
	} 
 if (($dat[1]=='0' && $dat[0]=='0' && $dat[3]=='0' && $dat[4]=='0') || $dat=='') $dat='01/01/11 00:00';
 if ($type==0) $stmt3 = 'select * from DETAIL_TBL where SCODE='.$param.' order by SDATE desc;';  
 if ($type==1) $stmt3 = 'select * from ARHIVH_TBL where SDATE>\''.$dat.'\' AND SCODE='.$param.' order by SDATE desc;';  
 if ($type==2) $stmt3 = 'select * from ARHIVD_TBL where SDATE>\''.$dat.'\' AND SCODE='.$param.' order by SDATE desc;';  
 if ($type==4) $stmt3 = 'select * from ARHIVM_TBL where SDATE>\''.$dat.'\' AND SCODE='.$param.' order by SDATE desc;';  
 echo $stmt3.'<br>';
 $sth3 = ibase_query ($dbh, $stmt3); $cnt=0;
 if ($type>=0)
 while ($row_array3=ibase_fetch_row($sth3))
	{
	 if ($cnt==0)
		{		
		 //2010-09-21 03:00:00		 
		 $dat=$row_array3[0][0].$row_array3[0][1].$row_array3[0][2].$row_array3[0][3].$row_array3[0][5].$row_array3[0][6].$row_array3[0][8].$row_array3[0][9].$row_array3[0][11].$row_array3[0][12].$row_array3[0][14].$row_array3[0][15].$row_array3[0][17].$row_array3[0][18];
		 //$query='UPDATE channels SET lasthours='.$row_array3[0].' AND pipe='.$pipe.' AND prm='.$prm.' AND device='.$device;
		 if ($type==0) $query='UPDATE channels SET lastcurrents='.$dat.' WHERE pipe='.$pipe.' AND prm='.$prm.' AND device='.$device;
		 if ($type==1) $query='UPDATE channels SET lastcurrents=lastcurrents,lasthours='.$dat.' WHERE pipe='.$pipe.' AND prm='.$prm.' AND device='.$device;
		 if ($type==2) $query='UPDATE channels SET lastcurrents=lastcurrents,lastdays='.$dat.' WHERE pipe='.$pipe.' AND prm='.$prm.' AND device='.$device;
		 if ($type==4) $query='UPDATE channels SET lastcurrents=lastcurrents,lastmonth='.$dat.' WHERE pipe='.$pipe.' AND prm='.$prm.' AND device='.$device;
		 echo $query.'<br>'; 
		 $e = mysql_query ($query,$i); 
		}
	 $query='INSERT INTO data(prm,source,device,date,type,value) VALUES ("'.$prm.'","'.$pipe.'","'.$device.'","'.$row_array3[0].'","'.$type.'","'.$row_array3[2].'")'; 
	 $e = mysql_query ($query,$i); 
	 echo $query.'<br>';
	 $cnt++;
	 if ($type==0 && $cnt>0) break;
	}			
 return $date;
} 
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
	 //$query='DELETE FROM `scenter`.`data` WHERE type>0 AND device<84606980';
	}

 print '</table>';	
 print '<table>';	

/* $stmt = 'select * from OCONTROL_TBL;'; 
 $sth = ibase_query ($dbh, $stmt);
 while ($row_array=ibase_fetch_row($sth))
	{
	 print '<tr bgcolor="#ffffff">';
	 for ($j=0; $j<ibase_num_fields($sth); $j++)
	      {
	     	print '<td>'.$row_array[$j].'</td>';
	      }
	 print '</tr>';
	}
 print '</table>';*/	

// $stmt = 'select * from CONTROL_TBL where scode=8;'; 
 $stmt = 'select * from CONTROL_TBL;'; 
 $sth = ibase_query ($dbh, $stmt);
 while ($row_array=ibase_fetch_row($sth))
	{	 
	 $device=0;
	/* if (strstr ($row_array[2],"�������� 16�")) $device=84606978;
	 if (strstr ($row_array[2],"������� ��� �301")) $device=84606979;
	 if (strstr ($row_array[2],"������� ��� �15")) $device=84606980;
	 if (strstr ($row_array[2],"������� ��� �263")) $device=84606981;
	 if (strstr ($row_array[2],"��������")) $device=84606982;
	 if (strstr ($row_array[2],"������� �3")) $device=84606983;
	 if (strstr ($row_array[2],"����� �106")) $device=84606984;
	 if (strstr ($row_array[2],"����������� �������� �1")) $device=84606985;
	 if (strstr ($row_array[2],"��� �5, ��������")) $device=84606986;
	 if (strstr ($row_array[2],"��� �5, �������������")) $device=84606987;
	 if (strstr ($row_array[2],"��� �5, ����������")) $device=84606988;
	 if (strstr ($row_array[2],"��� �5, ����������")) $device=84606989;
	 if (strstr ($row_array[2],"��� �3, ������")) $device=84606990;
	 if (strstr ($row_array[2],"��� �3, �����������")) $device=84606991;
	 if (strstr ($row_array[2],"��� �3, ������")) $device=84606992;
	 if (strstr ($row_array[2],"��� �3, ���")) $device=84606993;
	 if (strstr ($row_array[2],"��� �3, ����")) $device=84606994;
	 if (strstr ($row_array[2],"������������59, �����")) $device=84606995;
	 if (strstr ($row_array[2],"������������59, �������������")) $device=84606996;

	 if (strstr ($row_array[2],"���.�����_���_����������99")) $device=84606997;
	 if (strstr ($row_array[2],"���.�����_������_�������")) $device=84606998;
 	 if (strstr ($row_array[2],"���.�����_�������_�����������")) $device=84606999;
	 if (strstr ($row_array[2],"�����1_��������30�")) $device=84607000;
	 if (strstr ($row_array[2],"���ӹ102_��������������79")) $device=84607001;
	 if (strstr ($row_array[2],"���ӹ102_����������2")) $device=84607002;
	 if (strstr ($row_array[2],"���ӹ333_��������55�")) $device=84607003;
	 if (strstr ($row_array[2],"���ӹ90_��������85�")) $device=84607004;
	 if (strstr ($row_array[2],"���ӹ91_����������53�")) $device=84607005;

	 if (strstr ($row_array[2],"��� �10_���� ���������")) $device=84607006;
	 if (strstr ($row_array[2],"��� �3_����3")) $device=84607007;
	 if (strstr ($row_array[2],"��� �3_��������")) $device=84607008;
	 if (strstr ($row_array[2],"���� �7_�������")) $device=84607009;
	 if (strstr ($row_array[2],"��ӹ106_������ 3")) $device=84607010;
	 if (strstr ($row_array[2],"��ӹ107_������")) $device=84607011;
	 if (strstr ($row_array[2],"��ӹ45_�������� �����")) $device=84607012;
	 if (strstr ($row_array[2],"��������������� ����� 10")) $device=84607013;
	 if (strstr ($row_array[2],"50 ��� ����� 16")) $device=84607014;
	 if (strstr ($row_array[2],"�����_�������� 26")) $device=84607015;
	 if (strstr ($row_array[2],"����_������������ 4")) $device=84607016; */

	 if ($row_array[0]=="5" || $row_array[0]=="6") $device=84606978;
	 if ($row_array[0]=="2" || $row_array[0]=="3") $device=84606979;
	 if ($row_array[0]=="16") $device=84606980;
	 if ($row_array[0]=="17" || $row_array[0]=="22") $device=84606981;
	 if ($row_array[0]=="18" || $row_array[0]=="23") $device=84606982;
	 if ($row_array[0]=="19" || $row_array[0]=="24") $device=84606983;
	 if ($row_array[0]=="8" || $row_array[0]=="9") $device=84606984;
	 if ($row_array[0]=="15" || $row_array[0]=="20") $device=84606985;
	 if ($row_array[0]=="30" || $row_array[0]=="31") $device=84606986;
	 if ($row_array[0]=="41" || $row_array[0]=="42") $device=84606987;
	 if ($row_array[0]=="32" || $row_array[0]=="33") $device=84606988;
	 if ($row_array[0]=="34" || $row_array[0]=="35") $device=84606989;
	 if ($row_array[0]=="51" || $row_array[0]=="168") $device=84606990;
	 if ($row_array[0]=="50" || $row_array[0]=="170") $device=84606991;
	 if ($row_array[0]=="36" || $row_array[0]=="37") $device=84606992;
	 if ($row_array[0]=="49" || $row_array[0]=="167") $device=84606993;
	 if ($row_array[0]=="40" || $row_array[0]=="43") $device=84606994;
	 if ($row_array[0]=="53" || $row_array[0]=="55") $device=84606995;
	 if ($row_array[0]=="52" || $row_array[0]=="54") $device=84606996;

	 if ($row_array[0]=="67" || $row_array[0]=="68") $device=84606997;
	 if ($row_array[0]=="69" || $row_array[0]=="70") $device=84606998;
	 if ($row_array[0]=="71" || $row_array[0]=="72") $device=84606999;
	 if ($row_array[0]=="73" || $row_array[0]=="74") $device=84607000;
	 if ($row_array[0]=="79" || $row_array[0]=="80") $device=84607001;
	 if ($row_array[0]=="81" || $row_array[0]=="82") $device=84607002;
	 if ($row_array[0]=="75" || $row_array[0]=="76") $device=84607003;
	 if ($row_array[0]=="77" || $row_array[0]=="78") $device=84607004;
	 if ($row_array[0]=="65" || $row_array[0]=="66") $device=84607005;

	 if ($row_array[0]=="102"|| $row_array[0]=="162") $device=84607006;
	 if ($row_array[0]=="101") $device=84607007;
	 if ($row_array[0]=="108") $device=84607008;
	 if ($row_array[0]=="99") $device=84607009;
	 if ($row_array[0]=="97") $device=84607010;
	 if ($row_array[0]=="98") $device=84607011;
	 if ($row_array[0]=="100") $device=84607012;
	 if ($row_array[0]=="104") $device=84607013;
	 if ($row_array[0]=="103") $device=84607014;
	 if ($row_array[0]=="105") $device=84607015;
	 if ($row_array[0]=="107") $device=84607016;

	 if ($row_array[0]=="121" || $row_array[0]=="176") $device=84607017;
	 if ($row_array[0]=="125") $device=84607018;
	 if ($row_array[0]=="123") $device=84607019;
	 if ($row_array[0]=="119") $device=84607020;
	 if ($row_array[0]=="122") $device=84607021;
	 if ($row_array[0]=="124") $device=84607022;
	 if ($row_array[0]=="120") $device=84607023;
	 if ($row_array[0]=="126") $device=84607024;

	 if ($row_array[0]=="138" || $row_array[0]=="173") $device=84607025;
	 if ($row_array[0]=="139" || $row_array[0]=="174") $device=84607026;
	 if ($row_array[0]=="140" || $row_array[0]=="171") $device=84607027;
	 if ($row_array[0]=="144" || $row_array[0]=="169") $device=84607028;
	 if ($row_array[0]=="145") $device=84607029;
	 if ($row_array[0]=="146" || $row_array[0]=="165") $device=84607030;
	 if ($row_array[0]=="148" || $row_array[0]=="170") $device=84607031;
	 if ($row_array[0]=="150") $device=84607032;
	 if ($row_array[0]=="130" || $row_array[0]=="166") $device=84607033;
	 if ($row_array[0]=="131" || $row_array[0]=="161") $device=84607034;
	 if ($row_array[0]=="137" || $row_array[0]=="172") $device=84607035;
	 if ($row_array[0]=="153" || $row_array[0]=="164") $device=84607036;
	 if ($row_array[0]=="110" || $row_array[0]=="193") $device=84607042;

	 if ($row_array[0]=="154") $device=84607037;
	 if ($row_array[0]=="158") $device=84607038;
	 if ($row_array[0]=="159") $device=84607039;
	 if ($row_array[0]=="160") $device=84607040;
         if ($row_array[0]=="175") $device=84606991;
	 if ($row_array[0]=="132" || $row_array[0]=="163") $device=84607041;
	 if ($row_array[0]=="176") $device=84607017;
	 if ($row_array[0]=="177") $device=84607032;
	 if ($row_array[0]=="178") $device=84607022;
	 if ($row_array[0]=="179") $device=84607014;
	 if ($row_array[0]=="180") $device=84607029;
	 if ($row_array[0]=="182") $device=84607043;
	 if ($row_array[0]=="183") $device=84607043;
	 if ($row_array[0]=="184") $device=84607023;
	 if ($row_array[0]=="185") $device=84607037;
	 if ($row_array[0]=="186") $device=84607018;
	 if ($row_array[0]=="187") $device=84607019;
	 if ($row_array[0]=="188") $device=84607020;
	 if ($row_array[0]=="189") $device=84607007;
	 if ($row_array[0]=="190") $device=84607008;
	 if ($row_array[0]=="191") $device=84607009;
	 if ($row_array[0]=="192") $device=84607021;
	 if ($row_array[0]=="193") $device=84607042;
	 if ($row_array[0]=="194") $device=84606981;
	 if ($row_array[0]=="195") $device=84607010;
	 if ($row_array[0]=="196") $device=84607011;
	 if ($row_array[0]=="197") $device=84607012;
	 if ($row_array[0]=="198") $device=84607013;
	 if ($row_array[0]=="199") $device=84607015;
	 if ($row_array[0]=="200") $device=84607016;
	 if ($row_array[0]=="201") $device=84607024;
	 if ($row_array[0]=="203" || $row_array[0]=="205") $device=84607051;

	 if ($row_array[0]=="207" || $row_array[0]=="208") $device=84607052;
	 if ($row_array[0]=="209" || $row_array[0]=="210") $device=84607053;
	 if ($row_array[0]=="214" || $row_array[0]=="217") $device=84607054;
	 if ($row_array[0]=="215" || $row_array[0]=="218") $device=84607055;
	 if ($row_array[0]=="216" || $row_array[0]=="219") $device=84607056;
	 if ($row_array[0]=="224" || $row_array[0]=="228") $device=84607057;
	 if ($row_array[0]=="225" || $row_array[0]=="229") $device=84607058;
	 if ($row_array[0]=="226" || $row_array[0]=="230") $device=84607059;
	 if ($row_array[0]=="227" || $row_array[0]=="231") $device=84607060;

	 if ($row_array[0]=="239" || $row_array[0]=="240") $device=84607061;
	 if ($row_array[0]=="241" || $row_array[0]=="252") $device=84607062;
	 if ($row_array[0]=="242" || $row_array[0]=="251") $device=84607063;
	 if ($row_array[0]=="243" || $row_array[0]=="250") $device=84607064;
	 if ($row_array[0]=="244" || $row_array[0]=="249") $device=84607065;
	 if ($row_array[0]=="245" || $row_array[0]=="248") $device=84607066;
	 if ($row_array[0]=="246" || $row_array[0]=="247") $device=84607067;

	 if ($row_array[0]=="263" || $row_array[0]=="264") $device=84607068;
	 if ($row_array[0]=="265" || $row_array[0]=="266") $device=84607069;
	 if ($row_array[0]=="267" || $row_array[0]=="268") $device=84607070;
	 if ($row_array[0]=="269" || $row_array[0]=="270") $device=84607071;
	 if ($row_array[0]=="271" || $row_array[0]=="272") $device=84607072;
	 if ($row_array[0]=="273" || $row_array[0]=="274") $device=84607073;  // 104
	 if ($row_array[0]=="275" || $row_array[0]=="276") $device=84607074;
	 if ($row_array[0]=="277" || $row_array[0]=="278") $device=84607075;

	 if ($row_array[0]=="279" || $row_array[0]=="280") $device=84607076;
	 if ($row_array[0]=="281" || $row_array[0]=="282") $device=84607077;
	 if ($row_array[0]=="284" || $row_array[0]=="285") $device=84607078;
	 if ($row_array[0]=="288" || $row_array[0]=="289") $device=84607079;
	 if ($row_array[0]=="290" || $row_array[0]=="291") $device=84607080;

//84607068

	 $name=$row_array[2];
	 if (!$device) continue;

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
//echo $stmt2;
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

	 if ($device>0)
		{
		 $query='SELECT * FROM channels WHERE (prm=4 OR prm=12) AND lasthours>20100101000000 AND device='.$device.' ORDER BY lasthours DESC';
		 //echo $query.'<br>'; 
		 $e = mysql_query ($query,$i); 
		 if ($e) $ui = mysql_fetch_row ($e);
		 $dat='20'.$ui[12][2].$ui[12][3].$ui[12][5].$ui[12][6].$ui[12][8].$ui[12][9].$ui[12][11].$ui[12][12];
		 $today=getdate();
		 $dath=sprintf("%d%02d%02d%02d",$today["year"],$today["mon"],$today["mday"],$today["hours"]);
		 echo 'last one: '.$dat.' '.$dath.' '.number_format((int)$dath-(int)$dat,0).'<br>';
		 $old=number_format($dath-$dat,0);
		 if ($dath-$dat<1500) $sts=1;
		 if ($dath-$dat>1500) $sts=2;
		 if ($dath-$dat>10000) $sts=0;
		 
		 if (strstr ($name,"����") || strstr ($name,"���")) $query='UPDATE devices SET status2='.$sts.',date=date WHERE device='.$device;
		 else $query='UPDATE devices SET status='.$sts.',date=date WHERE device='.$device;

		 $e = mysql_query ($query,$i);
		 echo $query.'<br>';  
		}

         $stmt2 = 'select * from OPARH_TBL where SUBCODE='.$row_array[0].';'; 
         $sth2 = ibase_query ($dbh, $stmt2);
         while ($row_array2=ibase_fetch_row($sth2))
		{  
	 	// if ($device==84606981 || $device==84606982 || $device==84606980 || $device==84606985 || $device==84606984 || $device==84606983 || $device==84606988) break;      
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
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"����") && !strstr ($row_array2[2],"��+")) 
			{ 
			 $type=1; $prm=14; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"Q������") && !strstr ($row_array2[2],"��+")) 
			{ 
			 $type=4; $prm=13; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"G�����") || strstr ($row_array2[2],"��� G��") || (strstr ($row_array2[2],"G�����") && !strstr ($row_array2[2],"++")))
			{ 
			 $type=1; $prm=11; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���")) 
			{ 
			 $type=1; $prm=11; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
			{ 
			 $type=1; $prm=13; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� T��") || strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=1; $prm=4; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� T���") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=1; $prm=4; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                             
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
			{ 
			 $type=1; $prm=13; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
			{ 
			 $type=1; $prm=13; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"��� P��") || strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=1; $prm=16; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                  
		 if (strstr ($row_array2[2],"��� P���") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=1; $prm=16; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                            
		 if (strstr ($row_array2[2],"P�����") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=1; $prm=16; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}

		 if (strstr ($row_array2[2],"�Q����")) 
			{ 
			 $type=1; $prm=13; $source=10;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����")) 
			{ 
			 $type=1; $prm=13; $source=11;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"V��� ���") || strstr ($row_array2[2],"V�� ���")) 
			{ 
			 $type=1; $prm=12; $source=6;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V��� ���")) 
			{ 
			 $type=1; $prm=12; $source=5;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (!strstr ($row_array[2],"���"))
		 if (strstr ($row_array2[2],"G�����_") || strstr ($row_array2[2],"��� G��") || (strstr ($row_array2[2],"G�����") && !strstr ($row_array2[2],"++")))
			{ 
			 $type=2; $prm=11; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���")) 
			{ 
			 $type=2; $prm=11; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 //!!!!strstr ($row_array2[2],"��� � Q�")
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"���Q����")) 
			{ 
			 $type=2; $prm=13; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=2; $prm=4; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=2; $prm=4; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
			{ 
			 $type=2; $prm=13; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                          
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
			{ 
			 $type=2; $prm=13; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                              
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
			{ 
			 $type=2; $prm=13; $source=10;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
			{ 
			 $type=2; $prm=13; $source=11;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       

		 if (strstr ($row_array2[2],"G��++�")) 
			{ 
			 $type=2; $prm=12; $source=21;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"G��++�")) 
			{ 
			 $type=2; $prm=12; $source=22;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"G����++�")) 
			{ 
			 $type=2; $prm=12; $source=23;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"Q��++")) 
			{ 
			 $type=2; $prm=13; $source=21;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"Q��++")) 
			{ 
			 $type=2; $prm=13; $source=22;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"Q����++")) 
			{ 
			 $type=2; $prm=13; $source=23;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                               	
		 if (strstr ($row_array[2],"���") && strstr ($row_array2[2],"V�����++"))
			{ 
			 $type=2; $prm=12; $source=26;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       

		 if (strstr ($row_array2[2],"V�����++") || strstr ($row_array2[2],"G�����++")) 
			{ 
			 $type=2; $prm=12; $source=26;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"��� P��") || strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=2; $prm=16; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"��� P���") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=2; $prm=16; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"P�����") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=2; $prm=16; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}

		 if (!strstr ($row_array[2],"���") && !strstr ($row_array[2],"����"))
		 if (strstr ($row_array2[2],"�������") || strstr ($row_array2[2],"� ����  _��� ���") || strstr ($row_array2[2],"� ����_��� ���") || strstr ($row_array2[2],"������� _��� ���")) 
			{ 
			 $type=2; $prm=18; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array[2],"���") || strstr ($row_array[2],"����"))
		 if (strstr ($row_array2[2],"� ����") || strstr ($row_array2[2],"c ����") || strstr ($row_array2[2],"� ����  _��� ���") || strstr ($row_array2[2],"� ����_��� ���") || strstr ($row_array2[2],"������� _��� ���")) 
			{                    
			 $type=2; $prm=18; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
                                                  
		 if (strstr ($row_array[2],"���") || strstr ($row_array[2],"����"))
		 if (strstr ($row_array2[2],"V��� ���") || strstr ($row_array2[2],"V�� ���")) 
			{                    
			 $type=2; $prm=12; $source=6;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V��� ���")) 
			{ 
			 $type=2; $prm=12; $source=5;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (strstr ($row_array2[2],"G�����") || strstr ($row_array2[2],"��� G�� _���") || strstr ($row_array2[2],"��� G��"))
			{ 
			 $type=4; $prm=11; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���_���") || strstr ($row_array2[2],"��� G���")) 
			{ 
			 $type=4; $prm=11; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                                                   
		 if (strstr ($row_array2[2],"�Qo���") || strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�_���") || strstr ($row_array2[2],"���Q����")) 
			{ 
			 $type=4; $prm=13; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                                                  
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�") || strstr ($row_array2[2],"���Q����")) 
			{ 
			 $type=4; $prm=13; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�")) 
			{ 
			 $type=4; $prm=13; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
			{ 
			 $type=4; $prm=13; $source=10;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���")) 
			{ 
			 $type=4; $prm=13; $source=11;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}       
		 if (strstr ($row_array[2],"���") || strstr ($row_array[2],"����"))                                                                                  
		 if (strstr ($row_array2[2],"V��� ���") || strstr ($row_array2[2],"V�� ���") || strstr ($row_array2[2],"��� G���")) 
			{                    
			 $type=4; $prm=12; $source=6;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V��� ���") || strstr ($row_array2[2],"��� G���")) 
			{ 
			 $type=4; $prm=12; $source=5;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}

		//-----------------------------------------------------------------------------------------------------------------------------------------------
		 if (strstr ($row_array2[2],"G�����") || strstr ($row_array2[2],"��� G��")) 
			{ 
			 $type=0; $prm=11; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                 
		 if (strstr ($row_array2[2],"G�� ���") || strstr ($row_array2[2],"��� G���"))
			{ 
			 $type=0; $prm=11; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
//		 if (strstr ($row_array2[2],"Q����_���")) 
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� � Q�") || strstr ($row_array2[2],"���Q����")) 
			{ 
			 $type=0; $prm=13; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=0; $prm=4; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"t�����") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=0; $prm=4; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                                                      
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q��")) 
			{ 
			 $type=0; $prm=13; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                            
		 if (strstr ($row_array2[2],"�Q����") || strstr ($row_array2[2],"��� Q���"))
			{ 
			 $type=0; $prm=13; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����")) 
			{ 
			 $type=0; $prm=13; $source=10;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"�Q����")) 
			{ 
			 $type=0; $prm=13; $source=11;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V�� ���") || strstr ($row_array2[2],"��� G��")) 
			{ 
			 $type=0; $prm=12; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V�����")) 
			{ 
			 $type=0; $prm=12; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"G������")) 
			{ 
			 $type=0; $prm=12; $source=6;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V��� ���")) 
			{ 
			 $type=0; $prm=12; $source=7;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"V��� ���")) 
			{ 
			 $type=0; $prm=12; $source=5;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"P�����")) 
			{ 
			 $type=0; $prm=16; $source=2;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[2],"��� ���")) 
			{ 
			 $type=0; $prm=16; $source=0;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                             
		 if (strstr ($row_array2[2],"��� P��") || strstr ($row_array2[2],"��� ����")) 
			{ 
			 $type=0; $prm=16; $source=1;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		}
         $stmt2 = 'select * from OCONTROL_TBL where SUBCODE='.$row_array[0].';'; 
         $sth2 = ibase_query ($dbh, $stmt2);
         while ($row_array2=ibase_fetch_row($sth2))
		{  
		 $type=-1;
		 echo $row_array2[2].' '.$row_array2[10].'['.$row_array2[3].']<br>';

		 if (strstr ($row_array2[3],"� ���") || strstr ($row_array2[2],"T����") || strstr ($row_array2[2],"� ����")) 
			{ 
			 $type=0; $prm=4; $source=10;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}                                 
		 if (strstr ($row_array2[3],"Q���"))
			{ 
			 $type=0; $prm=13; $source=23;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[3],"G �3") && (strstr ($row_array2[10],"G���") || strstr ($row_array2[10],"G ���")))
			{ 
			 $type=0; $prm=12; $source=26;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[3],"G �3") && (strstr ($row_array2[10],"G���") || strstr ($row_array2[10],"G ���")))
			{ 
			 $type=0; $prm=12; $source=25;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}

		 if (strstr ($row_array2[3],"G �3") && (strstr ($row_array2[10],"G����")))
			{ 
			 $type=0; $prm=12; $source=21;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[3],"G �3") && (strstr ($row_array2[10],"G���")))
			{ 
			 $type=0; $prm=12; $source=22;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		 if (strstr ($row_array2[3],"���� ���") && (strstr ($row_array2[10],"Q ������")))
			{ 
			 $type=0; $prm=13; $source=23;
			 GetTimestamp($i,$dbh,$device,$prm,$source,$type,$row_array2[0]);
			}
		}
	}

 ibase_close ($dbh);
?>
