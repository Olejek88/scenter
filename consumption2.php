<div id="maincontent"  style="width:100%; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody>
<tr><td>
<table width=100% bgcolor=#ffffff valign=top cellpadding=1 cellspacing=1>
<tr bgcolor="#5D6D2f"><td align=center><font color="white"><?php $today=getdate(); print $today["year"]; ?></font></td><td align=center colspan=20>
<?php
 if ($cons==1) print '<font color="white">Количество тепловой энергии (Гкал)</font>';
 if ($cons==2) print '<font color="white">Потребление воды (м3)</font>';
 if ($cons==3) print '<font color="white">Потребление электроэнергии (кВт)</font>';
?>
</td></tr>
<tr bgcolor="#5D6D2f">
<td bgcolor="#5D6D2f" align=center rowspan="2"><font color="white">месяц</font></td>
<?php
 $query = 'SELECT * FROM objects WHERE type=1';
 $e = mysql_query ($query,$i); $object=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 print '<td bgcolor="#5D6D2f" align=center colspan=2><font color="white">'.$ui[1].'</font></td>';
	 $ui = mysql_fetch_row ($e);
	}
 print '</tr>';
 print '<tr bgcolor="#5D6D2f">';
 $query = 'SELECT * FROM objects WHERE type=1';
 $e = mysql_query ($query,$i); $object=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 if ($cons==1) print '<td bgcolor="#5D6D2f" align=center><font color="white">QСО,ГКал</font></td>';
	 if ($cons==1) print '<td bgcolor="#5D6D2f" align=center><font color="white">Qгвс,ГКал</font></td>';
	 if ($cons==2) print '<td bgcolor="#5D6D2f" align=center><font color="white">Vхвс,м3</font></td>';
	 if ($cons==2) print '<td bgcolor="#5D6D2f" align=center><font color="white">Vгвс,м3</font></td>';
	 if ($cons==3) print '<td bgcolor="#5D6D2f" align=center><font color="white">W1,кВт</font></td>';
	 if ($cons==3) print '<td bgcolor="#5D6D2f" align=center><font color="white">W2,кВт</font></td>';
	 $ui = mysql_fetch_row ($e);
	}
 print '</tr>';

 if ($_GET["cons"]=='') $cons=1;
 else $cons=$_GET["cons"];

 $query = 'SELECT * FROM objects WHERE type=1';
 $e = mysql_query ($query,$i); $object=0; $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 $name[$object]=$ui[1];
	 $today=getdate(); $cn=0;
	 $ye=$today["year"];
	 $mn=$today["mon"]-2;
 	 $tm=$dy=$today["mday"]-1;
	 for ($tm=1; $tm<=31; $tm++) $data2[$object][$tm]=$data1[$object][$tm]=$data0[$object][$tm]=0;
	 $tm=$today["mon"];
	 for ($pm=1; $pm<=31; $pm++)
	    {	 
	     $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
	     $dat[$cn]=sprintf ("%02d-%02d-%d",$mn,$tm,$ye);			     

	     if ($cons==1) 
		{
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data1[$object][$cn]=$uw[0]; $cntid=$uw[1];
	     	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND type=2 AND prm=13 AND source=3 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data2[$object][$cn]=$uw[0]; $cntid=$uw[1];
		 $data2[$object][$cn]=$data2[$object][$cn]-$data1[$object][$cn];
		}
	     if ($cons==2) 
		{
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data1[$object][$cn]=$uw[0]; $cntid=$uw[1];
	     	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=5 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data2[$object][$cn]=$uw[0]; $cntid=$uw[1];
		}
	     if ($cons==3) 
		{
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data1[$object][$cn]=$uw[0]; $cntid=$uw[1];
	     	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$date1.' AND type=2 AND prm=14 AND source=1 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data2[$object][$cn]=$uw[0]; $cntid=$uw[1];
		}

	     if ($cons==1) 	
		{
		 if ($cntid>28) $data0[$object][$cn]=0.0322*$sum0;
		 else $data0[$object][$cn]=($cntid/31)*0.0322*$sum0;
		}

	     $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date='.$date1.' AND type=2 AND prm=4 AND source=3 AND value>10';
	     $w = mysql_query ($query,$i);
	     $uw = mysql_fetch_row ($w);
	     $data11[$object][$cn]=number_format($uw[2],2).' ('.number_format($uw[0],1).'/'.number_format($uw[1],1).')';
	     $it7=($it7+$uw[2])/2;

             $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date='.$date1.' AND type=2 AND prm=4 AND source=4 AND value>10';
     	     $w = mysql_query ($query,$i);
	     $uw = mysql_fetch_row ($w); 
	     $data12[$object][$cn]=number_format($uw[2],2).' ('.number_format($uw[0],1).'/'.number_format($uw[1],1).')';
	     $it8=($it8+$ui[2])/2;


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
	     $cn++;
	    }
	 $object++;
	 $ui = mysql_fetch_row ($e);
	}
 for ($cn=0; $cn<31; $cn++)
	{
	 print '<tr><td bgcolor="#5D6D2f" align=center><font color="white">'.$dat[$cn].'</font></td>'; 
	 for ($ob=0; $ob<$object; $ob++)
	    {	 
	     if ($data1[$ob][$cn]) print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$ob][$cn],2).'</font></td>';
	     else  print '<td align=center bgcolor=#ffffff><font class=top2>-</font></td>';
	     if ($data2[$ob][$cn]) print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data2[$ob][$cn],2).'</font></td>';
	     else  print '<td align=center bgcolor=#ffffff><font class=top2>-</font></td>';
	     $it1[$ob]+=$data1[$ob][$cn];
	     $it2[$ob]+=$data2[$ob][$cn];
	    }
	 print '</tr>';
	}
 print '<tr><td bgcolor=#5D6D2f align=center><font color="white">Итого</font></td>'; 
 for ($ob=0; $ob<$object; $ob++)
    {	 
     print '<td align=center bgcolor=#5D6D2f><font color="white">'.number_format($it1[$ob],2).'</font></td>';
     print '<td align=center bgcolor=#5D6D2f><font color="white">'.number_format($it2[$ob],2).'</font></td>';
    }
 print '</tr></tbody></table>';
 print '<table><tbody>';
// if ($cons==1) print '<tr><td><img src="charts/barplots26.php?cons=1"></td></tr>';
// if ($cons==1) print '<tr><td><img src="charts/barplots26.php?cons=2"></td></tr>';
// if ($cons==2) print '<tr><td><img src="charts/barplots26.php?cons=3"></td></tr>';
// if ($cons==2) print '<tr><td><img src="charts/barplots26.php?cons=4"></td></tr>';
// if ($cons==3) print '<tr><td><img src="charts/barplots26.php?cons=5"></td></tr>';
?>
</tbody></table>
</div>