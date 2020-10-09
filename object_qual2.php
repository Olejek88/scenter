<?php
	 print '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="1200" valign=top>';	 
         print '<table border="0" cellpadding="1" cellspacing="1"><tbody>';
	 print '<tr><td align=center class="m_separator"><font color="black">Давление воды ['.$name.']</td></tr>';
	 print '<tr><td align=center><img src="charts/trend2.php?obj='.$_GET["id"].'&device='.$device.'&type=1&prm=5&prm2=16&source=2&x=1200&y=300&month='.$_GET["month"].'&year='.$_GET["year"].'" width=1200 height=300></td></tr>';
	 print '<tr><td align=center class="m_separator"><font color="black">Расход воды ['.$name.']</td></tr>';
	 print '<tr><td align=center><img src="charts/trend2.php?obj='.$_GET["id"].'&device='.$device.'&type=1&prm=5&prm2=12&source=6&x=1200&y=300&month='.$_GET["month"].'&year='.$_GET["year"].'" width=1200 height=300></td></tr>';
	 print '<tr><td align=center class="m_separator"><font color="black">Расход воды по дням ['.$name.']</td></tr>';
	 print '<tr><td align=center><img src="charts/barplots21.php?type=2&prm=3&x=1200&y=300&device='.$device.'&name='.$name.'&month='.$_GET["month"].'&year='.$_GET["year"].'"></td></tr>';
	 print '</table></td><td width="400px" valign="top"><table border="0" cellpadding="0" cellspacing="0">';

	 print '<tr align="center"><td class="m_separator">Дата</td><td class="m_separator">Pхвс</td><td class="m_separator">Vхвс</td><td class="m_separator">час</td></tr>';
	 $today=getdate();
 	 if ($_GET["year"]=='') $ye=$today["year"];
 	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $tm=$dy=31; $x=0;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 for ($tn=$dy; $tn>=1; $tn--)
		{		
		 $date11[$x]=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
		 $date12[$x]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tn);
		 $dats[$x]=sprintf ("%d-%02d-%02d",$ye,$mn,$tn);
		 $x++;
		}
	 $max=$x;
			     
	 $query = 'SELECT * FROM data WHERE type=2 AND device='.$device;
	 $aa = mysql_query ($query,$i);
	 if ($aa) $uy = mysql_fetch_row ($aa); $x=0;
	 while ($uy)
	      {      
		for ($t=0;$t<$max;$t++)
		if ($date12[$t]==$uy[2]) $x=$t;	  
	       	if ($uy[8]==16 && $uy[6]==2) $datas0[$x]=$uy[3];
	       	if ($uy[8]==12 && $uy[6]==6) if ($uy[3]>0) $datas1[$x]=$uy[3];
	       	$uy = mysql_fetch_row ($aa);	     
	      }

	 $max--;
	 for ($j=0; $j<=$max; $j++) 
		{                                                                                               
		 $like='\''.$dats[$j].'%\'';
		 $query = 'SELECT COUNT(id) FROM data WHERE type=1 AND prm=16 AND source=2 AND value=0 AND date LIKE '.$like.' AND device='.$device;
		 $aa = mysql_query ($query,$i);
		 if ($aa) $uy = mysql_fetch_row ($aa);
		 if ($uy) $datas2[$j]=$uy[0];
		 		 
		 print '<tr><td class="m_separator">'.$dats[$j].'</td><td class="simple_bold" align="center">'.number_format($datas0[$j],3).'</td>
			<td class="simple_bold" align="center">'.number_format($datas1[$j],3).'</td><td class="simple_bold" align="center">'.number_format($datas2[$j],0).'</td></tr>';
		 $it1+=$datas1[$j]; $it2+=$datas2[$j];
		}
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator"></td><td class="m_separator">'.number_format($it1,2).'</td><td class="m_separator">'.number_format($it2,0).'</td></tr>';
	 print '</table></td></tr>';	                         
	 print '</td></tr></table>';
?>