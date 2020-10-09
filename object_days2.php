<?php
	 print '<table width=400px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
		<tr><td width=400 valign=top>
		<table width=400 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
		<tr><td class="m_separator" align=center><font style="font-weight:bold; color:black">дата</font></td>
		<td class="m_separator" align="center">Qпот</font></td>
		<td class="m_separator" align="center">Vхвс</font></td>
		<td class="m_separator" align="center">Vпод</font></td>
		<td class="m_separator" align="center">Vобр</font></td>
		<td class="m_separator" align="center">Qпод</font></td>
		<td class="m_separator" align="center">Qобр</font></td>
		</tr>';

	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $device=$_GET["device"];
	 if ($_GET["qnt"]=='') $qnt=150;
	 else $qnt=$_GET["qnt"];

	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 if ($_GET["month"]=='')
	 	 $tm=$dy=$today["mday"]-1;
	 else	 $tm=$dy=$today["mday"]=$dy;

	 $query = 'SELECT * FROM objects WHERE id='.$_GET["object"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 if ($ui) { $name=$ui[1]; $cat=$ui[2]; $square=$ui[14]; $nab=$ui[15]; $norm_hvs=$ui[17]; }

//	 for ($tm=1; $tm<=31; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
	     $dat[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
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
	 $query = 'SELECT * FROM data WHERE type=2 AND device='.$device.' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=$qnt;
		 for ($tn=0; $tn<=$qnt; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;
			
	       	 if ($uy[8]==13 && $uy[6]==23) $data0[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==26) $data1[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==21) $data2[$x]=number_format($uy[3],2);
	       	 if ($uy[8]==12 && $uy[6]==22) $data3[$x]=number_format($uy[3],2);
	       	 if ($uy[8]==13 && $uy[6]==21) $data4[$x]=number_format($uy[3],2);
	       	 if ($uy[8]==13 && $uy[6]==22) $data5[$x]=number_format($uy[3],2);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<=$qnt; $tn++) 
		{
		  if ($data0[$tn]!='' && $data1[$tn]!='')
			{
			 $dat[$tn]=substr($dat[$tn],0,10);
	        	 print '<tr><td align=center class="m_separator"><font color="black">'.$dat[$tn].'</font></td>';
			 print '<td align=center class="simple">'.$data0[$tn].'</td>';
			 print '<td align=center class="simple">'.$data1[$tn].'</td>';
			 print '<td align=center class="simple">'.$data2[$tn].'</td>';
			 print '<td align=center class="simple">'.$data3[$tn].'</td>';
			 print '<td align=center class="simple">'.$data4[$tn].'</td>';
			 print '<td align=center class="simple">'.$data5[$tn].'</td></tr>';
		       }
	       }
	 print '</table></td>';
	 $desc=substr($name,0,50);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 print '<td width="1000" valign=top><table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=12&source=26" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=13&source=23" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=12&source=21" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=12&source=22" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=13&source=21" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&x=1000&y=250&device='.$device.'&name='.$desc.'&param=13&source=22" width="1000"></td></tr>';
	 print '</table>';
?>