<link rel="stylesheet" type="text/css" href="files/quote.css">

<?php      
 if ($_POST["frm"]=='2')
	{
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $f1='1-0-'.$ye; $f2='3-0-'.$ye;
	     $date1=sprintf ("%d0101000000",$ye);
	     $dat[$cn]=sprintf ("%d-01-01 00:00:00",$ye);
	     $query = 'SELECT * FROM trends WHERE object='.$_GET["id"].' AND date='.$date1;
	     echo $query.'<br>'; 	     
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);

	     if ($uy) $query = 'UPDATE trends SET nabs='.$_POST[$f1].', qrab='.$_POST[$f2].',date=date WHERE object='.$_GET["id"].' AND year='.$ye;
	     else $query = 'INSERT INTO trends SET nabs='.$_POST[$f1].', qrab='.$_POST[$f2].', object='.$_GET["id"].', year='.$ye;
	     $a = mysql_query ($query,$i);
	     echo $query.'<br>'; 	     
	     $ye--;
	    }
	}
 if ($_POST["frm"]=='4')
	{
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 if ($uo) $device=$uo[11];

	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++, $ye--)
	 for ($t3=0; $t3<=3; $t3++)
	    {	 
	     if ($t3==0) { $f='14-0-'.$ye; $prm=14; $source=0; }
	     if ($t3==1) { $f='13-0-'.$ye; $prm=13; $source=0; }
	     if ($t3==2) { $f='11-8-'.$ye; $prm=11; $source=8; }
	     if ($t3==3) { $f='12-6-'.$ye; $prm=12; $source=6; }
		echo $f.'<br>';
	     $date1=sprintf ("%d0101000000",$ye);
	     if ($_POST[$f])
		{
	  	 $query = 'SELECT * FROM data WHERE prm='.$prm.' AND source='.$source.' AND type=4 AND device='.$device.' AND date='.$date1;
		 echo $query.'<br>'; 	     
	     	 $a = mysql_query ($query,$i);
	     	 if ($a) $uy = mysql_fetch_row ($a);
		 if ($uy) $query = 'UPDATE data SET value='.$_POST[$f].',date=date WHERE prm='.$prm.' AND source='.$source.' AND type=4 AND device='.$device.' AND date='.$date1;
		 else $query = 'INSERT INTO data SET value='.$_POST[$f].', prm='.$prm.', source='.$source.', type=4, device='.$device.', date='.$date1;
	     	 $a = mysql_query ($query,$i);
		 echo $query.'<br>'; 	     
		}
	     $cn++;
	    }
	}
 if ($_POST["frm"]=='13')
	{
	 $query = 'UPDATE objects SET H_rasch_year='.$_POST["udv1"].',H_rasch_ud='.$_POST["udv2"].',Q_rasch_ot='.$_POST["udv3"].',Q_ud_ot='.$_POST["udv4"].' WHERE id='.$_GET["id"];
     	 //echo $query.'<br>'; 	     
	}

 print '<table border="0" cellpadding="2" cellspacing="1" style="width:100%"><tbody>';
 print '<tr><td colspan=2 align="center"><h1>�������������� ������� �����������</h1></td></tr>';
 print '</table>';
 print '<table class="nav" style="width:1050px"><tr>';
	for ($frm=1;$frm<=23;$frm++)
		print '<td width="120" height="22" align="center"><a href="index.php.?sel=object&menu=pass&frm='.$frm.'&id='.$_GET["id"].'">����� �'.$frm.'</a></td>';
 print '</tr></table>';

 if ($_GET["frm"]=='') $_GET["frm"]='1';

 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);

 $query = 'SELECT * FROM obj_out WHERE id=1';
 $e3 = mysql_query ($query,$i); 
 if ($e3) $uq = mysql_fetch_row ($e3);

 $query = 'SHOW FULL COLUMNS FROM objects';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 $uo = mysql_fetch_row ($e2); $cn++;
	}
 print '<form name="frm1" method="post" action="index.php?sel=pass&frm='.$_GET["frm"].'&id='.$_GET["id"].'" id="Form1">';
 if ($_GET["frm"]=='1')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="ps">�������������� ����������� "����� ����������������� ���� �������� � ������� ��������������" 
	 <br>���-�-010</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(������������ ���������������� �����������)</td></tr>';
	 print '<tr><td colspan="2" align="center" class="ps">�������� � ������������ ���������������� "������-������"</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(������������ ����������� (����), ������������ �������������� ������������)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:40px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="psb">�������������� ������� ���. <u>� ���-�-010-012.2011-</u></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">����������� ��������-�������������� ��������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:40px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="psb">������������� ���������� ��������������� ���������� ������� ��� ���������������� ���� � ������������ �������������� �������������-������������� ����������� �������� ������������� � 428 �.����������</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(������������ ������������� ����������� (�������))</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="ps">��������� �� ����������� ������������� ��������������� ������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:120px"></td></tr>';
         print '<tr><td align="left" class="ps" style="50%">����������� �������� ��� "������-������"</td>
		    <td align="right" class="ps" style="50%" valign="top">�.�. ������
		    <img src="files/bl.gif" width="100%" height="1px"><br>
		    <font style="font-size:11px">(������� ����, ������������ �������������� ������������ (������������ ������������ ����, ��������������� ���������������, ����������� ����) � ������ ������������ ����, ��������������� ���������������)</font></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:80px"></td></tr>';
         print '<tr><td align="left" class="ps" style="width:50%">���������� �������������� ����������� ���������������� ���������� ������� ��� ���������������� ���� � ������������ �������������� �������������-������������� ����������� �������� ������������� � 428 �.���������� </td>
		    <td align="right" class="ps" style="width:50%" valign="top">�.�. �������
		    <img src="files/bl.gif" width="100%" height="1px"><br>
		    <font style="font-size:11px">(��������� � ������� ������������ ������������ (��������������) ��������������� ������ �����������, ���������� ���������� ��������������� ������������, ��� ��������������� �� ����)</font></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:80px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="ps">��� 2011</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="30%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(�����, ��� ����������� ��������)</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='2')
	{
	 print '<input name="frm" type="hidden" value="2">';
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $query = 'SELECT * FROM trends WHERE object='.$_GET["id"].' AND year='.$ye;
	     //echo $query.'<br>'; 	     
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a))
		{
	       	 $data3[$cn]=$uy[9];
	       	 $data15[$cn]=$uy[10];
		}
	     $ye--;
	     $cn++;
	    }

	 print '<table border="0" cellpadding="2" cellspacing="2" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="1" align="left" class="ps">����� �'.$_GET["frm"].'</td><td><input name="add" value="���������" type="submit"></td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">����� �������� �� ������� ��������������� ������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="ps">������������� ���������� ��������������� ���������� ������� ��� ����������������
		���� � ������������ �������������� �������������-������������� ����������� �������� ������������� � 428 �.����������</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="simple">(������ ������������ �����������)</td></tr>';
	 print '<tr><td colspan="2" class="ps">1. ��������������-�������� ����� <u>������������� ���������� ��������������� ����������</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">2. ����������� ����� <u>454071, �. ���������, ��. ���������, �. 12</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">3. ����������� ����� <u>454071, �. ���������, ��. ���������, �. 12</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">4. ������������ ��������� �������� (��� �������� (���������) �������) <u>-</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">5. ���� ��������������� (�������������) �������������, % (��� ����������� �������) <u>-</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">6. ���������� ���������, <u>��� 7452019970, ��� 745201001, �/� 0348306572�, �/� 0747306455� � �����e�� �������� �. ����������</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">7. ��� �� ����� <u>80.10.1</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">8. �.�.�., ��������� ������������ <u>������� �������� �����������, ����������</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">9. �.�.�., ���������, �������, ���� ������������ ����, �������������� �� ����������� ���������
								������������ <u>�������� ���� ����������, ����������� ����������� �� ���������������-������������� �����, ���. 8(351)772-58-55</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">10. �.�.�., ���������, �������, ���� ������������ ����, �������������� �� �������������� ��������� <u>�������� ������ ������������, �������� ��� "�������������", ���. 8(351)793-09-00</u></td></tr>';
	 print '<tr><td colspan="2" align="right" class="ps">(������� 1)</td></tr>';
	 print '<tr><td colspan="2" class="ps">
		<table border="0" cellpadding="2" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>������������</td><td>������� ���������</td><td colspan="4">�������������� ����*</td><td>�������� (�������)**</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td>2010 ���**</td></tr>
		<tr bgcolor="#ffffff"><td>1. ������������ �������� ��������� (�����, �����)</td><td colspan="6">������ � ������� ����������� �����������, ��������������� ����������� ���������������� ������������</td></tr>
		<tr bgcolor="#ffffff"><td>1.1. ��� �������� ��������� (�����,�����) �� ���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2. ����� ������������ ��������� (�����, �����) </td><td>���. ���.</td><td>-</td><td>-</td><td>7409,4</td><td>9738,5</td><td>10386,3</td></tr>
		<tr bgcolor="#ffffff"><td>3. ������������ ��������� � ����������� ���������, ����� </td><td>���.</td><td><input name="1-0-2006" class="simple2" value="'.$data3[4].'"></td><td><input name="1-0-2007" class="simple2" value="'.$data3[3].'"></td><td><input name="1-0-2008" class="simple2" value="'.$data3[2].'"></td><td><input name="1-0-2009" class="simple2" value="'.$data3[1].'"></td><td><input name="1-0-2010" class="simple2" value="'.$data3[0].'"></td></tr>
		<tr bgcolor="#ffffff"><td>4. ����� ������������ �������� ���������, �����</td><td> ���. ���.</td><td>-</td><td>-</td><td>7409,4</td><td>9738,5</td><td>10386,3</td></tr>
		<tr bgcolor="#ffffff"><td>5. ������������ �������� ��������� � ����������� ���������, �����</td><td>���.</td><td>-</td><td>-</td><td>266</td><td>248</td><td>250</td></tr>
		<tr bgcolor="#ffffff"><td>6. ����� ������������ �������������� ���������</td><td>���.���.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>7. ����������� �������������� ��������, �����</td><td>���. � �.�.</td><td>-</td><td>-</td><td>0,160</td><td>0,176</td><td>0,159</td></tr>
		<tr bgcolor="#ffffff"><td>8. ����������� �������������� �������� �� ������������ �������� ���������, �����</td><td>���. � �.�.</td><td>-</td><td>-</td><td>0,160</td><td>0,176</td><td>0,159</td></tr>
		<tr bgcolor="#ffffff"><td>9. ����� ����������� �������������� �������� �� ������������ �������� ���������, �����</td><td>���. ���.</td><td>138,0</td><td>102,0</td><td>643,5</td><td>749,9</td><td>915,3</td></tr>
		<tr bgcolor="#ffffff"><td>10. ����������� ����, �����</td><td>���.���.�</td><td>-</td><td>-</td><td>7,8</td><td>9,2</td><td>7,9</td></tr>
		<tr bgcolor="#ffffff"><td>� �.�. �� ������������ �������� ���������</td><td>���.���.�</td><td>-</td><td>-</td><td>7,8</td><td>9,2</td><td>7,9</td></tr>
		<tr bgcolor="#ffffff"><td>11. ������������� ������������ ��������� (�����, �����) �����</td><td> ���. � �.�./���. ���.</td><td>-</td><td>-</td><td>0,000022</td><td>0,000018</td><td>0,000015</td></tr>
		<tr bgcolor="#ffffff"><td>12. ������������� ������������ ��������� (�����, �����) �� ������������ �������� ���������, �����</td><td>���. � �.�./ ���.���.</td><td>-</td><td>-</td><td>0,000022</td><td>0,000018</td><td>0,000015</td></tr>
		<tr bgcolor="#ffffff"><td>13. ���� ����� �� �������������� ������� � ��������� ������������� ��������� (�����, �����)</td><td>%</td><td>-</td><td>-</td><td>9</td><td>8</td><td>9</td></tr>
		<tr bgcolor="#ffffff"><td>14. ��������� �������� ��������������� ���������:
						-����������� �������������</td><td>���. ���.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>	-������������� ����������</td><td>���. ���.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>15. ������������� ����������� ����������</td><td>���.</td><td><input name="3-0-2006" class="simple2" value="'.$data15[4].'"></td><td><input name="3-0-2007" class="simple2" value="'.$data15[3].'"></td><td><input name="3-0-2008" class="simple2" value="'.$data15[2].'"></td><td><input name="3-0-2009" class="simple2" value="'.$data15[1].'"></td><td><input name="3-0-2010" class="simple2" value="'.$data15[0].'"></td></tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps">����������: ������ �� �������� ��������������� ��������� ������������ �� �������������.</td></tr>';
	print '<tr><td colspan="2" class="ps">����������: ������ �� 2006, 2007 ���� ����������� �� � ������ ������.</td></tr>';
	print '<tr><td colspan="2" align="right" class="ps">(������� 2)</td></tr>';
	print '<tr><td colspan="2" align="center" class="ps">�������� �� ������������ �������������� �����������</td></tr>';
	print '<tr><td colspan="2" class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ �������������</td><td>����������� �����</td><td>���/��� (� ������ ���������� - ��������������� ��� ���)</td><td>������������� ����������� ���������� </td><td>� �.�. �����������-���������������� ��������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps">* -������ �������������� ��������� (��������) ����
		** -��������� ������ ����������� ��� ����� ����� ����������� ��������������� ��������
		����������: ������������ ������������� ����������� �� �����.</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='3')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������������ ��������� �����</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ ����������</td><td>����������, ��.</td><td colspan="2">��� �������</td><td> ����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>�����</td><td>����� ��������</td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="6">1. ������������� �������</td></tr>
		<tr bgcolor="#ffffff"><td>1.1.</td><td>���������� ������������� ��������� ������ �����,� ��� �����:</td><td align="center">2</td><td colspan="2" align="center">-</td><td align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>������������</td><td>2</td><td>�������� 230</td><td>0.5</td><td>���� ����� � ������������ - 04.2011 �.</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.2.</td><td>���������� �� ������������� ��������� ������ �����, � ��� �����:</td><td>-</td><td colspan="2">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.3.</td><td>���������� �������� ����� � ����������� ������� �������</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.4.</td><td>���������� �������� ����� � ���������� ���������� ����������� ����������� ������������ � ������ �������� ��������</td><td>-</td><td colspan="2">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.5.</td><td>������������ �� ����������������� ������� ����� ������������� �������</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>2.</td><td colspan="5" align="center">�������� �������</td></tr>
		<tr bgcolor="#ffffff"><td>2.1.</td><td>���������� �������������  ��������� ������ �����, � ��� �����:</td><td>1</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������</td><td>1</td><td>�������������	�������� "�����-19"</td><td>�</td><td>������������: ����������� "�����-19" (1 ��.), ���� ������� 28.01.2011, ��������������� ������� ����-50 (2 ��.),��������������� ����������� �����-01 (2 ��.)</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.2.</td><td>���������� �� ������������� ��������� ������ �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.3.</td><td>���������� �������� ����� � ����������� ������� �������</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.4.</td><td>���������� �������� ����� � ���������� ���������� ����������� ����������� ������������ � ������ �������� ��������</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.5.</td><td>������������ �� ����������������� ������� ����� �������� �������</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>3.</td><td colspan="5" align="center">������� �������</td></tr>
		<tr bgcolor="#ffffff"><td>3.1.</td><td>���������� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>����������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>��������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.2.</td><td>���������� �� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>����������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>��������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.3.</td><td>���������� �������� ����� � ����������� ������� �������</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.4.</td><td>���������� �������� ����� � ���������� ���������� ����������� ����������� ������������ � ������ �������� ��������</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.5.</td><td>������������ �� ����������������� ������� ����� ������� �������</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>4.</td><td colspan="5" align="center">����</td></tr>
		<tr bgcolor="#ffffff"><td>4.1.</td><td>���������� �� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>����������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>��������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.2.</td><td>���������� �� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>����������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>��������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.3.</td><td>���������� �������� ����� � ����������� ������� ������� �����</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.4.</td><td>���������� �������� ����� � ���������� ���������� ����������� ����������� ������������ � ������ �������� �������� �����</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.5.</td><td>������������ �� ����������������� ������� ����� ����</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>5.</td><td colspan="5" align="center">����</td></tr>
		<tr bgcolor="#ffffff"><td>5.1.</td><td>���������� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>1</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������</td><td>1</td><td>��������� ���I</td><td> �</td><td> ������� ���. ���� ������� 15.09.2010.</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.2.</td><td>���������� �� ������������� ��������� ���� ����������� (��������) �����, � ��� �����:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>���������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������ ������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>������������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>�������� �� �������</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.3.</td><td>���������� �������� ����� � ����������� ������� ������� �����</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.4.</td><td>���������� �������� ����� � ���������� ���������� ����������� ����������� ������������ � ������ �������� �������� �����</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.5.</td><td>������������ �� ����������������� ������� ����� ����</td><td colspan="5" align="center">-</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='4')
	{
	 print '<input name="frm" type="hidden" value="4">';
	 print '<input name="device" type="hidden" value="'.$device.'">';
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $date1=sprintf ("%d0101000000",$ye);
	     $dat[$cn]=sprintf ("%d-01-01 00:00:00",$ye);
		 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
		 $y = mysql_query ($query,$i);
		 if ($y) $uo = mysql_fetch_row ($y);
		 if ($uo) $device=$uo[11];

	     $query = 'SELECT * FROM data WHERE type=4 AND device='.$device.' AND date='.$date1;
	     //echo $query.'<br>'; 	     
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);			 
	     while ($uy)
	      	{
	       	 if ($uy[8]==14 && $uy[6]==0) $data11[$cn]=number_format($uy[3],2);
	       	 if ($uy[8]==13 && $uy[6]==0) $data12[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==8) $data16[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==6) $data17[$cn]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	     $ye--;
	     $cn++;
	    }
	 print '<table border="0" cellpadding="2" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="1" align="left" class="ps">����� �'.$_GET["frm"].'</td><td><input name="add" value="���������" type="submit"></td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ����������� �������������� �������� � ��� ����������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ ��������������</td><td>������� ��������� (�������� ����������)</td><td colspan="4">�������������� ����</td><td>�������� (�������) 2010 ���</td><td>����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="8">����� �����������:</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>������������� �������</td><td>���. ���.�</td><td><input name="14-0-2006" class="simple2" value="'.$data11[4].'"></td><td><input name="14-0-2007" class="simple2" value="'.$data11[3].'"></td><td><input name="14-0-2008" class="simple2" value="'.$data11[2].'"></td><td><input name="14-0-2009" class="simple2" value="'.$data11[1].'"></td><td><input name="14-0-2010" class="simple2" value="'.$data11[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>�������� �������</td><td>����</td><td><input name="13-0-2006" class="simple2" value="'.$data12[4].'"></td><td><input name="13-0-2007" class="simple2" value="'.$data12[3].'"></td><td><input name="13-0-2008" class="simple2" value="'.$data12[2].'"></td><td><input name="13-0-2009" class="simple2" value="'.$data12[1].'"></td><td><input name="13-0-2010" class="simple2" value="'.$data12[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>�������� �������</td><td> �, ���. �</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>������� �������</td><td> �, ���. �</td><td> - </td><td>-</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>��������� ������� �����, � ��� �����:</td><td> �, �</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>�������</td><td>�, �</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>��������</td><td>�, �</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>���������� �������</td><td>�, �</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����</td><td>���. ���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td> ���������� ���� (����� ��������� �������)</td><td>���. ���.�</td><td><input name="11-8-2006" class="simple2" value="'.$data16[4].'"></td><td><input name="11-8-2007" class="simple2" value="'.$data16[3].'"></td><td><input name="11-8-2008" class="simple2" value="'.$data16[2].'"></td><td><input name="11-8-2009" class="simple2" value="'.$data16[3].'"></td><td><input name="11-8-2010" class="simple2" value="'.$data16[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td> ����</td><td>���. ���.�</td><td><input name="12-6-2006" class="simple2" value="'.$data17[4].'"></td><td><input name="12-6-2007" class="simple2" value="'.$data17[3].'"></td><td><input name="12-6-2008" class="simple2" value="'.$data17[2].'"></td><td><input name="12-6-2009" class="simple2" value="'.$data17[1].'"></td><td><input name="12-6-2010" class="simple2" value="'.$data17[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="8"> ����� ����������� � �������������� �������������� ���������� �������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td> ������������� �������</td><td>���. ���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td> �������� �������</td><td>����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="8" > ����������� �������� ��� ���������� �����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td>������������� �������</td><td colspan="7">���������� ������� ����������� �������������� � 2009 ���� ������� � �����������		��������� ����� � ����������� ���������� ������������. �������� ����������� � 2010 ����	������� � ������������ �������� �� ������������� �������������, ������� ����� ����	����������� �� ���������� �������������� �����. ������ �� ����������� ��������������	�� 2006, 2007 ���� �� �����������.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td> �������� �������</td><td colspan="7">��������� ������� ����������� �������� ������� �� ��������� � ��� � ������� 5-7% ������� � �������������� ��������� ������� (����� ���� ������������� �������, ������� ����������� �� ������������ ������), � ���������� ������� �������� ������� �� ����� ��� � ������������ � ���������� ����� �������������, � ����������� ����������� �� ��������� ������� � ������� �������. ������������� � ��������� ������ ��������, ������ �� ������� ������ ����������� � 2005 �. ������ �� ����������� �������� ������� �� 2006, 2007 ���� �� �����������. � 2010 ���� ����������� ������ ������ ������� �����, ������� �� ������������ �������� ������� ������������� � ������������ � ����������� ���������.  </td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td> �������� �������</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td> ������� �������</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td> ��������� �������, � ��� �����:</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>�������</td><td colspan="7"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>��������</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>���������� �������</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>����</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.6.</td><td> ���������� ���� (����� ��������� �������)</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.7.</td><td>����</td><td colspan="7"> ���������� ������� ����������� ������������-�������� ���� � 2009 ���� ������� ����������� ���������� � ���������� �����, � ����� � ����������� ������� ������ �������.������ �� ����������� ������������-�������� ���� �� 2006, 2007 ���� �� �����������.  </td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='5')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������� ������������� ������� � ��� ���������� (� ���. ���.�)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������ ������/������</td>
		<td colspan="4">�������������� ����</td><td>�������� (�������) 2010 ���</td>
		<td colspan="5">������� �� ����������� ����*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>������</td><td colspan="10"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>��������� ��������</td><td>-</td><td>-</td><td>80,20</td><td>109,42</td><td>83,01</td><td>83,01</td><td>74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>����������� ��������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������</td><td> -</td><td> -</td><td> 80,20</td><td> 109,42</td><td> 83,01</td><td> 83,01</td><td> 74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>������</td><td colspan="10"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>��������������� ������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>������ �� ����������� �����</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>����������� (��������� �����������)</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>����������� (��������) ������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>��������������� ������ �����, � ��� �����:</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 0,41</td><td> 0,41</td><td> 0,37</td><td> 0,28</td><td> 0,28</td><td> 0,28</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>�������-����������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>�����������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>������, ������������� ����������� ������������� �������� �����</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 0,41</td><td> 0,41</td><td> 0,37</td><td> 0,28</td><td> 0,28</td><td> 0,28</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>�������������� ������</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 27,40</td><td> 27,40</td><td> 18,68</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������</td><td> -</td><td> -</td><td> 80,20</td><td> 109,42</td><td> 83,01</td><td> 83,01</td><td> 74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*�����, ������������� � ����������<br>
	����������: ������ ������� �� ������, �������������� �������� ����, ���������� ���������� ��-�� ���������� ����������� ������ �� ������� ������ �������� � �������������� ������������.</td></tr>';
	}
 if ($_GET["frm"]=='6')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������� �������� ������� � ��� ���������� (� ����)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������ ������/������</td>
		<td colspan="4">�������������� ����</td><td>�������� (�������) 2010 ���</td>
		<td colspan="5">������� �� ����������� ����*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="11"> ������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td> ����������� ��������� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td> ��������� �������� </td><td>-</td><td>-</td><td>891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������ </td><td>-</td><td>-</td><td>891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="11"> ������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>��������������� ������� �����, � ��� ����� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����, �� ��� ���������� (������) �������� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>������� ���� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.2.<td> ��������� � ����������, � ��� ����� ���������� ��������� </td><td>-</td><td>-</td><td>-</td><td> 591,3</td><td> 612,2</td><td> 591,3</td><td> 591,3</td><td> 591,3</td><td> 591,3</td><td> 591,3</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td> ������� ������������� </td><td>-</td><td>-</td><td>-</td><td> 64,2</td><td> 64,3</td><td> 64,2</td><td> 64,2</td><td> 64,2</td><td> 64,2</td><td> 64,2</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td> ��������� ����������� (�����������) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td> ��������� ������� ������ </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ���������������� ������ </td><td>-</td><td>-</td><td>-</td><td>655,5</td><td> 676,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td> �������������� ��������������� ������ � ��������	���������, ����������, �������� ������������� </td><td>-</td><td>-</td><td>-</td><td> 276,0</td><td> 206,5</td><td> 127,5</td><td> 117,7</td><td> 81,6</td><td> 18,0</td><td> 9,0</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������ </td><td>-</td><td>-</td><td> 891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*�����, ������������� � ����������<br>����������: ������ ������� �� ������, �������������� 2009 ����, ���������� ���������� ��-�� ���������� ����������� ������ �� ������� ������ ������ ���������, ���������� � �������� �������������.</td></tr>';
	}
 if ($_GET["frm"]=='7')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������� ����������� ��������-������� ������� � ��� ���������� (����������� � � �.�.)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������ ������/������</td>
		<td colspan="4">�������������� ����</td><td>�������� (�������) 2010 ���</td>
		<td colspan="5">������� �� ����������� ����*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="11"> ������ </td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������ </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.</td><td colspan="11">������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.1.</td><td>��������������� ������������� �����, � ��� ����� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����������� ������������� (� ���� �����) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>������ </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� (���������, �����) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>�� ��������� �������� ������� �����, � ��� �����: </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>� ��������� </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>� ����������� ��� (������� ��������� ��������������) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>����� ��������� ������ </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*�����, ������������� � ���������� <br>����������: ����������� ��������-������ ������� �� ����������';
	}
 if ($_GET["frm"]=='8')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������� ����������� ����� ��������� ������� � ��� ����������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>��� ������������ �������</td><td>���������� ������������ ������� </td><td>���������������� �, ��������������������, ���</td><td>��� ��������������� �������</td><td>��.������ ������� �� ���������� ������, �/100��, �/�������</td><td>������, ���. �� ����������, ���/���</td><td>����� ��������������, ���. �-��, ���.����-��.</td><td>���������� ����������������</td><td>�������, ���.�, �3</td><td>������ ��������� ������� �������</td><td>��.������ ������� , �/�-��, �/����-��, �/100 ��, �/�������</td><td>���������� ����������� �������, ���. �, ���.�3</td><td>������ �������, ���.�, ���.�3</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">����������: ����������� �������� ������� �� ����������</td></tr>';
	}
 if ($_GET["frm"]=='9')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� �� ������������� ��������� �������������� ��������, �������������� (�������) ������ � �������������� ���������� �������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ ��������������</td><td>������� ���������</td><td>�������� ��������������</td><td>����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>��������� (��������) �������������� ������� (���)</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>�������������� ��� </td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.1.</td><td>������� ��������� <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.2.</td><td>������</td><td>�3/� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.3.</td><td>��������</td><td>��� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.4.</td><td>�����������</td><td>C<td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.5.</td><td>����������� ������������, �� ������������</td><td>% <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>������� ����� ���</td><td>���� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>������� ����������� �������������</td><td>���� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>�������������� (�������) � �������������� ���� ��� <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>������������ (���) <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>�������� �������������� <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.1.</td><td>������������ �����������</td><td>����/�� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.2.</td><td>������� ��������� ���������������</td><td>� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>�������� �������������� ���������</td><td>����/�, ��� <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>��� ���������������</td><td>% <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>������� ����������� ����� �������</td><td>����, ���.� <td>-</td><td>-</td></tr>';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� ��������� �������������� ������� , �������������� (�������) ������� � �������������� ��������� ������� �� ����������</td></tr>';
	}
 if ($_GET["frm"]=='10')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">���������� ������������� ������������� ������� �� ���� ���������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>�������������� ���������� ������� ���������</td><td colspan="2">���������� ������������</td><td>��������� ������������� ��������, ���</td>
		<td colspan="5">��������� ����� ����������� ��������������, ���.� </td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>� ������� �����������</td><td>� ������������������ �������</td><td></td><td>�������� (�������) 2010 ���</td>
		<td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td> ���������� ��������� �����, � ��� �����:</td><td>297</td><td>186</td><td>38,1</td><td>42881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td> �������� ����� (�����������) �����, � ��� �����: </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td> ��������������� ����� (�����������) �����, � ��� �����:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td> ���������������-������� �������� (���) �����, � ��� �����:</td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>������ �������� ����</td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>�������� ��������� <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td cospan="2">�����:</td><td></td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps">����������: ������� ����� ������ ����������� �������������� �� ���� ��������� �����������. ���������� ��������� ��������� �����
						����������� �� ������, �������������� �������� ����, ���������� ��-�� ���������� ����������� ������ � �����������.
						<br>����������: ��� ������������� ����������� ����������� � ��������������� (������������������) ������� (171 ��.) � ������������ � ��������.</td></tr>';
	}
 if ($_GET["frm"]=='11')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� ����������� �������������� � ����������� �������������� �������� ��������� ���������������� �����������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ ���� ��������� ���������������� ���������
		</td><td>���</td><td colspan="3"> �������� ����������� ��������������* </td><td>���� ������������ �������������� ��������, ������� ���������</td><td>����� ������������ �������������� �������� �� �������� (�������) 2010 ���</td><td>����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>������������� �������� �� ������������� �������, ���</td><td>������������� �������� �� �������� �������, ����</td><td>������������������</td><td></td><td></td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">1.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">2.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">3.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>  ';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps"> *�������� �� ����������� ��� �����������, �������������� ������������, �������� � ������������� ������������� � �������� �������
						<br>����������: � ����������� ��������������� ��������� ����������� </td></tr>';
	}
 if ($_GET["frm"]=='12')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">������� �������������� ������� (������, �������� � ����������)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>������������ ������, ��������, ����������</td>
		<td>��� ����� � ������������</td>
		<td colspan="2">����������� �����������</td>
		<td>����������� � ���������� ����� ������, ��������, c���������, %</td>
		<td colspan="2">�������� �������� �������������� ������, ��������, ���������� �� �������� (�������) 2010 ��� (��/���.� C)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>������������ �����������</td><td>������� ��������������</td><td></td><td>�����������</td><td>��������-�����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">������ �������� ����</td><td rowspan="3">1980</td>
		<td>�����</td><td>�� ��������� ������� � ���������� ������������ �������� �������� 530��</td>
		<td rowspan="3">64</td><td rowspan="3">0,96</td><td rowspan="3">0,86</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>����</td><td>2-� ���������� � ���������� � ��� ����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�����</td><td>������� ������, �/� ����� 220 ��, �������� �� �������� �������</td></tr>
		</table></table>';
	}
 if ($_GET["frm"]=='13')
	{
	 print '<input name="frm" type="hidden" value="13">';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
     	 //echo $query.'<br>'; 	     
	 if ($a = mysql_query ($query,$i))
	 if ($uy = mysql_fetch_array($a, MYSQL_ASSOC))
		{
	       	 $data3[1]=$uy["H_rasch_year"]; $data3[2]=$uy["H_rasch_ud"]; $data3[3]=$uy["Q_rasch_ot"]; $data3[4]=$uy["Q_ud_ot"];
		}

	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ����������� �������������� �������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="ffffff">
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td width="50%">�������� � ��������� ���������������� � ��������� ������������������� ����������� ����������� (��� �������)</td><td> ������� � �������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>������������ ��������� ���������������� � ��������� �������������������</td><td>��������� ���������������� � �������������� ������������� ���� �� �� � 428</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>���� �����������</td><td>��������� ���������������� � �������������� ������������� ���� �� �� � 428</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td><img src="files/bl.gif" width="100%" height="1px"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>������������ ������������� �����������</td><td>�� �������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td class="simple"><img src="files/bl.gif" width="100%" height="1px">( �������������, �� �������������)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>�������� � ���������� ������������ ������� ����������� ���������������� � ��������� �������������� �������������</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td class="simple"><img src="files/bl.gif" width="100%" height="1px">( ����������, �� ���������� )</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2"  class="ps">������ ������������ ����������� ����������� ���������� � ��������-�����������*</td></tr>
		<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ ���������� �������������� �������������</td><td>������� ���������</td><td colspan="2">�������� ����������</td><td>������������ �� ��������� ����������� �������������� �������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>����������� (�� �������� �����,��������)</td><td>�������� - ����������� �� ������� 2010 ���</td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1</td><td colspan="5">�� ������������ �������� � �������������� ���������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2</td><td colspan="5">�� ����� ���������� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3</td><td colspan="5">�� ����� ����������� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td align="left">�������� ������ �������� ���� (� �.�. �� ���) �� 1 ������������ � ��� (������� ������ �������� ��
	 	�����, ��������� � ��������������� ����������� ��������, ������ ���������, ������������-������� �����, ����� �������)</td><td>
		���.�/��� � ���</td>
		<td><input name="udv1" class="simple2" value="'.$data3[1].'"></td><td><input name="udv2" class="simple2" value="'.$data3[2].'"></td><td align="left">1. ��������� ��������� �� �����������.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td><td>�������� �������� �������������� ������</td><td>��/���.�</td>
		<td><input name="udv3" class="simple2" value="'.$data3[3].'"></td><td><input name="udv4" class="simple2" value="'.$data3[4].'"></td><td align="left">
		1. ������������� ��������������� ��������� ������.
		<br>2. �������������� �������� �������� �� ������� �������� ������� �������������� � ��� � �����������.
		<br>3. ������ ���� � ���������� ��������� �� ����������� � ��� ���������.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4</td><td colspan="5">�� �������� ����������� ��������������� ���������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5</td><td colspan="5">�� ��������� ���������������� ������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">* ��� �������������� ��������� �� ������������ ������������� � �������� ������� ����������� ����������� �������� ������ �������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2" class="ps">��������, ��������, ���������� �������������� ������������� ����������� ����������������� ����������� �� ����� �� ���� ���, �������������� ���� ���������� ��������������� ������������, ������������ �������� ����������� ������������� �������, �������� �������, ������� �������, ��������� �������, ����, ����</td></tr>';
	 print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ �����������</td><td>������� ���������</td><td>����������� ������� ��������</td><td>��� ���������</td><td>������� ��������, ����������� �������������� ������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="5">�������� ����������� �������������� ������������� ����������� ����������������� �����������, ������������ �������� �����������:</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>������������� �������</td><td>���. ���.�</td><td>0,9</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>������ ����� ���� �����������</td><td>���. ���.�</td><td>0,9</td><td>2010</td><td>������ ����� ���� ����������� ��������� 60 �� �� ���������� �������������� ����� ��������� 15 ��</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>�������� �������</td><td>����</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>�������� �������</td><td>�, ���. �</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>������� �������</td><td>�, ���. �</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>��������� �������</td><td>�</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.1.</td><td>�������</td><td>�</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.2.</td><td>��������</td><td>�</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.3.</td><td>���������� �������</td><td>�</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.4.</td><td>����</td><td>���. ���. �</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>���������� ����</td><td>���. ���. �</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>����</td><td>���. ���. �</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 if ($_GET["frm"]=='14')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� ����� �������� (���������������) �������������� �������� � ����*</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>������������ �����, ��� ������������� �������</td><td>������ ���������</td><td>��������� �������������, ��</tr>
		<tr bgcolor="#ffffff" align="center"><td>1</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>2</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>3</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>4</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>5</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>6</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>7</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>8</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>9</td><td>-</td><td>-</td><td>-</tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps"> * ����� ������������� �������
		<br>����������: ����������� �� ������������ �������� �������������� �������� � ����.</td></tr>';
	}
 if ($_GET["frm"]=='15')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ������������� ��������� � ��������� ����� �������� ��������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>����� ����������</td><td colspan="5">�������� ��������� ����������� �� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>�������� 2010</td><td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="6">��������� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>1150 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>850 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>750 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>500 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>400 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>330 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>220 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.8.</td><td>154 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.9.</td><td>110 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.10.</td><td>35 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.11.</td><td>27,5 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.12.</td><td>20 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.13.</td><td>10 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.14.</td><td>6 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.15.</td><td>����� �� 6 �� � ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.16.</td><td> ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.17.</td><td>2 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.18.</td><td>500 ����� � ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.19.</td><td>����� ���� 6 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.20.</td><td>����� �� ��������� ������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="6">��������� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>220 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>110 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>35 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>27,5 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>20 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>10 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.7.</td><td>6 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.8.</td><td>����� �� 6 �� � ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.9.</td><td>3 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.10.</td><td>2 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.11.</td><td>500 ����� � ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.12.</td><td>����� ���� 6 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.13.</td><td>����� �� ��������� ������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="6">����� �� ��������� � ��������� ������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td colspan="6">�����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.1.</td><td>800 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.2.</td><td>750 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.3.</td><td>500 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.4.</td><td>400 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.5.</td><td>330 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.6.</td><td>220 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.7.</td><td>154 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.8.</td><td>110 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.9.</td><td>35 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.10.</td><td>27,5 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.11.</td><td>20 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.12.</td><td>10 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.13.</td><td>6 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.14.</td><td>����� �� ������������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� �� ������������ �������� ������������� �������.</td></tr>';
	}
 if ($_GET["frm"]=='16')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ���������� � ������������� �������� ���������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>��������� ��������, ���</td>
		<td>������ ����������, ��</td><td colspan="10">�������� ��������� ����������� �� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td colspan="2">�������� (�������) 2010 ���</td>
		<td  colspan="2">2009</td><td colspan="2">2008</td><td colspan="2">2007</td><td colspan="2">2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td>
		<td>����������, ��.</td><td>������������� ��������, ���</td>
		<td>����������, ��.</td><td>������������� ��������, ���</td>
		<td>����������, ��.</td><td>������������� ��������, ���</td>
		<td>����������, ��.</td><td>������������� ��������, ���</td>
		<td>����������, ��.</td><td>������������� ��������, ���</td></tr>       
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>�� 2500</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td></td><td>27,5-35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>�� 2500 �� 10000</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td></td><td>35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td></td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>�� 10000 �� 80000 ������������</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td></td><td>27,5-35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td></td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td></td><td>220</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>����� 80000</td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.1.</td><td></td><td>220</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.2.</td><td></td><td>330 ����������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.3.</td><td></td><td>330 ����������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.4.</td><td></td><td>400-500 ����������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.5.</td><td></td><td>400-500 ����������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.6.</td><td></td><td>750-1150</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>�����:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� �� ������������ �������� ������������� �������.</td></tr>';	
	}
 if ($_GET["frm"]=='17')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ���������� � �������� ��������� ����������� ���������� ��������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">� �/�</td><td rowspan="3">��������� ��������, ���</td>
		<td rowspan="3">������ ����������, ��</td><td colspan="10">�������� ��������� ����������� �� �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="2">�������� (�������) 2010 ���</td>
		<td colspan="2">2009</td><td colspan="2">2008</td><td colspan="2">2007</td><td colspan="2">2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>���-��,��./�����</td><td>������������� ��������, ����</td>
		<td>���-��,��./�����</td><td>������������� ��������, ����</td>
		<td>���-��,��./�����</td><td>������������� ��������, ����</td>
		<td>���-��,��./�����</td><td>������������� ��������, ����</td>
		<td>���-��,��./�����</td><td>������������� ��������, ����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td rowspan="5">����������� ��������</td><td>3-20 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>27,5-35 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>150-110 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>500 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>750 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>�����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td rowspan="5">�� � ����������, � ������ ��</td><td>�� 15,0 ���.���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>�� 15,0 �� 37,5 ���.���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>50 ���.���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>�� 75,0 �� 100,0 ���.���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>160 ���.���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>�����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td rowspan="4">��� � ���</td><td>0,38-20 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td>35 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td>150-110 ��</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td>220 �� � ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td>�����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� �� ������������ �������� ������������� �������.</td></tr>';	
	}
 if ($_GET["frm"]=='18')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � �������� ������ ���������� �������������� ��������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center" rowspan="2"><td rowspan="2">� �/�</td><td rowspan="2">������������ ��������������</td><td rowspan="2">������� ���������</td>
		<td rowspan="2">������������ ���������� � ���</td><td rowspan="2">�������� (�������) 2010 ���</td><td colspan="4">���������� ����</td><td rowspan="2">����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td  colspan="9">����� ������������ �������������� ��������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>������������� �������</td><td>���. ���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>�������� �������</td><td>����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>�����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>��������������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>�������� ����������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>��������� ��������� ����</td><td>���.���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>���������� ����</td><td>���.���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.8.</td><td>����</td><td>���.���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="9">����������� ������ ������������ �������������� ��������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>������������� �������</td><td>���. ���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>�������� �������</td><td>����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>�����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>��������������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>�������� ����������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>��������� ��������� ����</td><td>���.���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.7.</td><td>���������� ����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.8.</td><td>����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="9">�������� ������������ ���������� ��������������� ������ �� ����� �������������� ��������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td>������������� �������</td><td>���. ���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td>�������� �������</td><td>����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td>�����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td>��������������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td>�������� ����������</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.6.</td><td>��������� ��������� ����</td><td>���.���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.7.</td><td>���������� ����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.8.</td><td>����</td><td>���.�</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� �� ������������ �������� �������������� ��������.</td></tr>';	
	}
 if ($_GET["frm"]=='19')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">������������ �� ���������� ������ �������������� �������� ��� �� ��������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center" rowspan="2"><td rowspan="2">� �/�</td>
		<td rowspan="2">������������ ������������ �����������</td>
		<td rowspan="2">������� ���. ��� (����)</td>
		<td colspan="3">����������� ���������� ������</td>
		<td rowspan="2">������� ���� ����������� (����)</td>
		<td rowspan="2">����������� ���� ��������� (�����, ���)</td>
		<td colspan="3">���������� ������ ��� �� ���� ������ �������� ��������������� ��������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>� ����������� ���������</td><td>��. ���������</td><td>� ����������� ��������� (���. ���)</td>
		<td>� ����������� ���������</td><td>��. ���������</td><td>� ����������� ��������� (���. ���)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="10" align="left">�� ���������� ������ ������������� �������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="10" align="left">�� ���������� ������ �������� �������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="10" align="left">�� ���������� ������ �����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td colspan="10" align="left">�� ���������� ������ ��������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td colspan="10" align="left">�� ���������� ������ �������� ����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>6.</td><td colspan="10" align="left">�� ���������� ������ ��������� ��������� ����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>7.</td><td colspan="10" align="left">�� ���������� ������ ���������� ����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>8.</td><td colspan="10" align="left">�� ���������� ������ ����</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>9.</td><td>�����:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ����������� �� ������������ �������� �������������� ��������.</td></tr>';		 
	}
 if ($_GET["frm"]=='20')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">��������� ���������������� � ������ ��������� �������� �������������� ��������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">� �/�</td>
		<td colspan="7">��������� ���������� ������������ � ���������� ����������������� �����������</td>
		<td colspan="4">���� ��������� ����������������� ����������� � ������������ ������������ �������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="2">������������ ����������� �� ����� �������������� ��������</td>
		<td rowspan="2">������� ���.��� (����)</td>
		<td colspan="3">������� �������� ��� (����)</td>
		<td rowspan="2">������� ���� ����������� (����), ���</td>
		<td colspan="3">������� �������� ��� (����)</td>
		<td rowspan="2">������� ���� ����������� (����), ���</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>� ����������� ���������</td><td>��. ���������</td><td>� ����������� ��������� (���. ���)</td>
		<td>� ����������� ���������</td><td>��. ���������</td><td>� ����������� ��������� (���. ���)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>�� ������������� �������</td><td>35,6</td><td>27,4</td><td>���. ���.�</td><td>91,0</td><td>0,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>�� �������� �������</td><td>1871,2</td><td>131,1</td><td>����</td><td>135,6</td><td>13,8</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>�� �������� �������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>�� ������� �������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>�� �������� ��������, � ��� �����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.1.</td><td>������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.2.</td><td>�������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.3.</td><td>��������� �������</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.4.</td><td>���</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>6.</td><td>�� ���������� ����</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>7.</td><td>�� ����</td><td>42,2</td><td>690,2</td><td>�3</td><td>8,7</td><td>4,9</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>8.</td><td>�����:</td><td>1949,0</td><td>-</td><td>-</td><td>235,3</td><td>8,3</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 if ($_GET["frm"]=='21')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� ������� ����������� �� ���������������� � ��������� �������������� �������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">������������ �����������,��� �������������</td>
		<td colspan="3">������� �������� �������������� ��������</td>
		<td rowspan="3">�������, ���. ���</td>
		<td rowspan="3">������� ���� �����������, ���</td>
		<td rowspan="3">������������� ���� ���������, �������, ���</td>
		</tr>
		<tr bgcolor="#ffffff"><td colspan="2">� ����������� ���������</td>
		<td rowspan="2">� ����������� ��������� ���. ���. (�� ������)</td></tr>
		<tr bgcolor="#ffffff"><td>������� ���������</td><td>���-��</td></tr>		
		<tr bgcolor="#ffffff" align="center"><td colspan="7">��������������� � ������������� �����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>������ ���� ����������� ��������� 150, 100, 75, 60 �� ����������� ��������� ��������� �� �������������� ���������� ����� ��������� 30, 15�� (297 ��.)</td><td>���. ���.�</td><td>24,9</td><td>82,7</td><td>35,6</td><td>0,4</td><td>1 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>��������������� ����������� (���������� ����������� �� �������� �� ������������� ��������������, ���������� ����������� � �������� ����� � ���������, ������������ �� ���������� ����������������)</td><td>���. ���.�</td><td>2,5</td><td>8,3</td><td>-</td><td>-</td><td>3 ��. 2011</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>��������� ����������� ��������� �� ��������� � �����</td><td>����</td><td>3,4</td><td>3,5</td><td>6,1</td><td>1,8</td><td>3 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�����</td><td>-</td><td>-</td><td>94,5</td><td>41,7</td><td>0,4</td><td>3 ��. 2011 - 3 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="7">���������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>������������� ��������������� ��������� ������: ������������ ��������� ������ � ������������ ������������� ������� ����� �� ����� ��������� � ����������� �� ����������� ��������� ������� � ����������� ������� ������ ���������.</td><td>����</td><td>70,6</td><td>73,0</td><td>331,5</td><td>4,5</td><td>4 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="2">��������� ��������� �� ����������� (66 ��., SBOT-Maxi, SBOT-Auto � �� �������)</td><td>����</td><td>10,7</td><td rowspan="2">11,1</td><td rowspan="2">42,2</td><td rowspan="2">2,1</td><td rowspan="2">2 ��. 2012 �3</tr><tr bgcolor="#ffffff" align="center"><td>690,2</td><td>8,7</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�����</td><td>-</td><td>-</td><td>92,8</td><td>373,7</td><td>4,0</td><td>2 ��. 2012 - 4 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="7">������������, ���������������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�������������� �������� �� ������� �������� ������� ��������� � ���</td><td>����</td><td>10,5</td><td>10,9</td><td>67,0</td><td>6,2</td><td>4 ��. 2012</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>������ ���� � ���������� ���������� �� ������������ ����������� � ��������������� ��������� � ��� ���������� (376 ��.�.)</td><td>����</td><td>35,9</td><td>37,1</td><td>1466,6</td><td>39,5</td><td>3 ��. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�����</td><td>-</td><td>-</td><td>48,0</td><td>1533,6</td><td>32,0</td><td>4 ��. 2012 - 3 ��. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�����, ���. � �.�. � ��� ����� �� ����� ���:</td><td>-</td><td>0,029</td><td>235,3</td><td>1949,0</td><td>8,3</td><td>3 ��. 2011 - 3 ��. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>��������-������ �������</td><td>���. � �.�.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�������� �������</td><td>����</td><td>131,1</td><td>135,6</td><td>1871,2</td><td>13,8</td><td>4 ��. 2012 - 3 ��. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>��������������</td><td>���. ���.�</td><td>27,4</td><td>91,0</td><td>35,6</td><td>0,4</td><td>3 ��. 2011 - 1 ��. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>�������� �������</td><td>���. �</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>��������� ���������</td><td>���. �</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>������ ������</td><td>���. �3</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>����</td><td>�3</td><td>690,2</td><td>8,7</td><td>42,2</td><td>4,9</td><td>2 ��. 2012</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">����������: ���� ����������� �� ����������� "������ ���� � ���������� ���������� �� ������������ ����������� � ��������������� ��������� � ��� ���������� (376 ��.�.)", �� ������ "�����" ������� "������������, ���������������" ������ ��� �������.</td></tr>';
	}
 if ($_GET["frm"]=='22')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� ����������� ���, ������������� �� ����������� ����������� �� ���������������� � ��������� �������������� �������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>���</td><td>������������ ���������</td>
		<td>���������� ���������� (������ ���������, ������, ������ ����������� �����)</td>
		<td>�������� ������� � ����������� �� ����������� �����������</td>
		<td>������������ � ��������� ����������� ����� �����������, ������������ ����������� �� ����������� �����������</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>�������� ���� ����������</td><td>�������� ���� ����������</td>
		<td>8(351)772-58-55</td><td>����������� ������ �� ����������� ����������� �� ���������������� � ��������� �������������� �������������</td><td>������ �1/17-�� �� 11.01.2011</td></tr>
		</table></td></tr>';
	}

 if ($_GET["frm"]=='23')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">����� �'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">�������� � ������������ ���������, ��������������� ���������� ����������� �� ���������������� � ��������� �������������� �������������</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px">���������� ����������� �����������, ��������� �������� � ������� ���������������� � ��������� �������������� ������������� - 0 �������.</td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>� �/�</td><td>���</td><td>������������ ���������</td>
		<td>�������� �� ��������������� ����������� ����������� �������� (������������, �����, ��������)</td>
		<td>������������ ����� �������� � ��� ��� (����������, ��������������, ��������� ������������)</td>
		<td>���� ������ � ��������� ��������</td>
		<td>�������� �� ����������� (������, �������������, ���������� � ��.)</td>
		<td>�������� �� ���������� � ���������� ������������.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 print  '</form>';
?>