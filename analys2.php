<div id="maincontent"  style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">��������� ��������</div>
		<div class="menuitem first"><a href="index.php?sel=analys2" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">��� �������</a></div>
		<?php
		 $query = 'SELECT * FROM uprav';
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);  
		 while ($uy)
			{		
			 print '<div class="menuitem first"><a href="index.php?sel=analys2&type='.$uy[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$uy[1].'</a></div>';
			 $uy = mysql_fetch_row ($a);
			}
		?>
	</div>
	</div>
</div>
<div id="maincontent" style="width:820px">

<?php
 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>������ ���������� ���������� �261-�� � �������� ������ ������������ ��������</h1></td></tr></table>';
 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>';
 $today=getdate();
 if ($_GET["type"]) $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];
 else $query = 'SELECT * FROM objects';
 $a = mysql_query ($query,$i); $ccn=0; $object=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $sts=sprintf("%d0101000000",$today["year"]-1);
	 $fns=sprintf("%d1301000000",$today["year"]-1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal2[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND value<20 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal0[$object]=$uw[0]; 

	 $sts=sprintf("%d0101000000",$today["year"]-2);
	 $fns=sprintf("%d1301000000",$today["year"]-2);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal12[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND value<20 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal11[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal10[$object]=$uw[0]; 

	 $sts=sprintf("%d0101000000",$today["year"]);
	 $fns=sprintf("%d1301000000",$today["year"]);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datas2[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND value<20 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datas1[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datas0[$object]=$uw[0]; 

	 $name[$ccn]=$uy[1];	 
	 $desc=substr($name[$ccn],0,15);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);
  
	 $req.='name'.$cn.'='.$name[$ccn].'&';
	 $req2.='name'.$cn.'='.$name[$ccn].'&';
	 $req3.='name'.$cn.'='.$name[$ccn].'&';

	 $req.='da'.$cnn.'='.$datal0[$ccn].'&db'.$cnn.'='.$datal10[$ccn].'&dc'.$cnn.'='.$datas0[$ccn].'&';
	 $req2.='da'.$cnn.'='.$datal1[$ccn].'&db'.$cnn.'='.$datal11[$ccn].'&dc'.$cnn.'='.$datas1[$ccn].'&';
	 $req3.='da'.$cnn.'='.$datal2[$ccn].'&db'.$cnn.'='.$datal12[$ccn].'&dc'.$cnn.'='.$datas2[$ccn].'&';

	 $ot1[$ccn]=$ot2[$ccn]=$ot0[$ccn]='-';
	 $ot11[$ccn]=$ot12[$ccn]=$ot10[$ccn]='-';
	 $plan1[$ccn]=$plan2[$ccn]=$plan0[$ccn]='-';

	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}

 print '<tr><td align=center height="20px"></td></tr>';
 print '<tr><td align=center><table width="1800px" bgcolor="lightgray">';
 print '<tr><td class="m_separator">������������ �������������� �����������</td><td class="m_separator" colspan="3">����������� ��� �� 2009 ���</td>
	<td class="m_separator" colspan="3">����������� ��� �� 2010 ���</td><td class="m_separator" colspan="3">���������� �� ������������ �������� ���</td>
	<td class="m_separator" colspan="3">����������� ����������� ��� �� 2011 ��� � ����������� �� 6% � 2009 ����</td>
	<td class="m_separator" colspan="3">����������� ����������� ��� �� 2011 ���</td>
	<td class="m_separator" colspan="3">���������� �� ������������ �������� ����������� ��� �� 2011 ���</td></tr>';
 print '<tr><td class="menuitem"></td>
	<td class="menuitem">����� � ����</td><td class="menuitem">���� � �3</td><td class="menuitem">��. ������� � ���</td>
	<td class="menuitem">����� � ����</td><td class="menuitem">���� � �3</td><td class="menuitem">��. ������� � ���</td>
	<td class="menuitem">����� � %</td><td class="menuitem">���� � %</td><td class="menuitem">��. ������� � %</td>
	<td class="menuitem">����� � %</td><td class="menuitem">���� � %</td><td class="menuitem">��. ������� � %</td>
	<td class="menuitem">����� � ����</td><td class="menuitem">���� � �3</td><td class="menuitem">��. ������� � ���</td>
	<td class="menuitem">����� � %</td><td class="menuitem">���� � %</td><td class="menuitem">��. ������� � %</td></tr>';

 for ($cn=0;$cn<$ccn;$cn++)            
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="simple">'.number_format($datal11[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal10[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal12[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal1[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal0[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datal2[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.$ot1[$cn].'</td>';
	 print '<td align="center" class="simple">'.$ot0[$cn].'</td>';
	 print '<td align="center" class="simple">'.$ot2[$cn].'</td>';
	 print '<td align="center" class="simple">'.$plan1[$cn].'</td>';
	 print '<td align="center" class="simple">'.$plan0[$cn].'</td>';
	 print '<td align="center" class="simple">'.$plan2[$cn].'</td>';
	 print '<td align="center" class="simple">'.number_format($datas1[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datas0[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.number_format($datas2[$cn],3).'</td>';
	 print '<td align="center" class="simple">'.$ot11[$cn].'</td>';
	 print '<td align="center" class="simple">'.$ot10[$cn].'</td>';
	 print '<td align="center" class="simple">'.$ot12[$cn].'</td>';
	 print '</tr>';
	}
 print '</table></td></tr>';
 print '<tr><td><img src="charts/barplots20.php?type=1&'.$req.'"></td></tr>'; 
 print '<tr><td><img src="charts/barplots20.php?type=2&'.$req2.'"></td></tr>';                      
 print '<tr><td><img src="charts/barplots20.php?type=3&'.$req3.'"></td></tr>';                      
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>

<tr><td>
<table>
</table>
</td></tr>
</tbody></table>
</div>