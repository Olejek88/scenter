<div id="main"  style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">��������� ��������</div>
		<div class="menuitem first"><a href="index.php?sel=compare&type=2" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">��������</a></div>
		<div class="menuitem"><a href="index.php?sel=compare&type=3" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">����</a></div>
		<div class="menuitem"><a href="index.php?sel=compare&type=4" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">����������</a></div>
		<div class="menuitem"><a href="index.php?sel=compare&type=5" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">��� ���</a></div>
		<div class="menuitem"><a href="index.php?sel=compare&type=6" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">������ �������</a></div>
	</div>
	</div>
</div>
<div id="maincontent" style="width:820px">
<?php

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>��������� ������� ��������</h1></td></tr></table>';
 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>';
 $query = 'SELECT * FROM objects WHERE square>0 AND type='.$_GET["type"];
 $a = mysql_query ($query,$i); $ccn=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT nab,square FROM objects WHERE id='.$uy[0];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $sum1=$uy2[0]; $sum2=$uy2[1];

	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>=20121001000000 AND date<20121101000000 AND type=4 AND device='.$uo[11].' AND prm=13 AND source=2 AND value>0.1';
	 $e2 = mysql_query ($query,$i); 
	 $ui = mysql_fetch_row ($e2);
	 $teplo[$ccn]=$ui[0];
	 $normteplo[$ccn]=$ui[1]*0.0322/30*$sum2;
	 $square[$ccn]=$sum2;
	 $nab[$ccn]=$sum1;
	 $nums[$ccn]=$ui[1];
	 if ($square[$ccn]>0) $udteplo[$ccn]=$teplo[$ccn]/$square[$ccn];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=4 AND device='.$uo[11].' AND prm=12 AND source=6 AND value>0.1 AND value<50';
	 $e2 = mysql_query ($query,$i); 
	 $ui = mysql_fetch_row ($e2);
	 $voda[$ccn]=$ui[0];
	 if ($sum1>0) $normvoda[$ccn]=$ui[1]*5.4/30*$sum1;
	 if ($sum2>0) $udvoda[$ccn]=$ui[1]*0.0322/30*$sum2;
	 if ($nab[$ccn]>0) $udvoda[$ccn]=$voda[$ccn]/$nab[$ccn];

	 $name[$ccn]=$uy[1];	 
	 $photo[$ccn]=$uy[6];
	 $ccn++;
	 $uy = mysql_fetch_row ($a); 
	}

 print '<tr bgcolor=#D0EEC2><td align="center"><font style="font-weight:bold">�������� �������</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)            
	{
	 print '<td align="center"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 $desc=substr($name[$cn],0,10);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 $dat0.='&dt'.$cn.'='.$desc;
	 $req.='name'.$cn.'='.$name[$cn].'&';
	 $req2.='name'.$cn.'='.$name[$cn].'&';
	}
 print '</tr>';
// print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">����������</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 //print '<td><img width="150" src="'.$photo[$cn].'"></td>';
	}
// print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">�������� �������</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.$square[$cn].' �3</td>';
	}
 print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">���������� �������</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.$nab[$cn].'</td>';
	}
 print '</tr>';

 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">����������� �����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($teplo[$cn],1).' ����</td>';
	}
 print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">����������� ����������� �����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($normteplo[$cn],1).' ����</td>';
	}
 print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">�������� ����������� �����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($udteplo[$cn],4).' ����/�2</td>';
	 $req.='da'.$cn.'='.$udteplo[$cn].'&';
	}
 print '</tr>';

 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">����������� ����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($voda[$cn],1).' �3</td>';
	}
 print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">����������� ����������� ����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($normvoda[$cn],1).' �3</td>';
	}
 print '</tr>';
 print '<tr><td bgcolor=#D0EEC2><font style="font-weight:bold">�������� ����������� ����</font></td>';
 for ($cn=0;$cn<$ccn;$cn++)
	{
	 print '<td>'.number_format($udvoda[$cn],3).' �3/���</td>';
	 $req2.='da'.$cn.'='.$udvoda[$cn].'&';
	}
 print '</tr>';

?>

</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>

<tr><td>
<table>
<tr><td><img src="charts/barplots29.php?type=1&<?php print $req; ?>"></td><td><img src="charts/barplots29.php?type=2&<?php print $req2; ?>"></td></tr>
</table>
</td></tr>
</tbody></table>
</div>