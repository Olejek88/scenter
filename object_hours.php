<?php
	 print '<table width=600px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
		<tr><td width=600 valign=top>
		<table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
		<tr><td class="m_separator" align=center><font style="font-weight:bold; color:white">дата</font></td>
		<td class="m_separator" align="center"><font color="white">Tпод</font></td>
		<td class="m_separator" align="center"><font color="white">Tобр</font></td>
		<td class="m_separator" align="center"><font color="white">Vпод</font></td>
		<td class="m_separator" align="center"><font color="white">Vобр</font></td>
		<td class="m_separator" align="center"><font color="white">Qпод</font></td>
		<td class="m_separator" align="center"><font color="white">Qобр</font></td>
		<td class="m_separator" align="center"><font color="white">Qпот</font></td>
		<td class="m_separator" align="center"><font color="white">Vхвс</font></td>
		</tr>';
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $x=0; $nn=1; $ts=$today["hours"];
	 if ($_GET["month"]=='') $tm=$dy=$today["mday"];
	 else $tm=$dy=31;
	 $max=740;	
	 for ($tn=0; $tn<=$max; $tn++)
		{		
		 $date1[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
		 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$mn,$tm,$ts);
		 $data0[$tn]=$data1[$tn]=$data2[$tn]=$data3[$tn]=$data4[$tn]=$data5[$tn]=$data6[$tn]=$data7[$tn]=$data8[$tn]=$data9[$tn]='-';
	         if ($tm==1 && $ts==0)
			{
			 $mn--; $ts=24;					
			 $dy=31;
			 if (!checkdate ($mn,31,$ye)) { $dy=30; }
			 if (!checkdate ($mn,30,$ye)) { $dy=29; }
			 if (!checkdate ($mn,29,$ye)) { $dy=28; }
			 $tm=$dy;
		        }
		 if ($ts==0) { $ts=24; $tm--; }
		 $ts--;
		}

	 $query = 'SELECT * FROM data WHERE type=1 AND device='.$device.' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=$max+1;
		 for ($tn=0; $tn<=$max; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;
			
	       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==13 && $uy[6]==0) $data4[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==1) $data5[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==2) $data6[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==12 && $uy[6]==6) $data7[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==5) $data8[$x]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 $query = 'SELECT * FROM data2 WHERE type=1 AND device='.$device.' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=$max+1;
		 for ($tn=0; $tn<=$max; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;
			
	       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==13 && $uy[6]==0) $data4[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==1) $data5[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==2) $data6[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==12 && $uy[6]==6) $data7[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==5) $data8[$x]=number_format($uy[3],3);

	       	 $uy = mysql_fetch_row ($a);	     
	      	}

	 for ($tn=0; $tn<=$max; $tn++) 
		{
		 $data10[$tn]=$data10[$tn]-$data11[$tn];
		 if ($data0[$tn]!='-' || $data1[$tn]!='-')
			{
	        	 print '<tr><td align=center class="m_separator">'.$dat[$tn].'</td>';
			 print '<td align=center class="simple">'.$data0[$tn].'</td>';
			 print '<td align=center class="simple">'.$data1[$tn].'</td>';
			 print '<td align=center class="simple">'.$data2[$tn].'</td>';
			 print '<td align=center class="simple">'.$data3[$tn].'</td>';
			 print '<td align=center class="simple">'.$data4[$tn].'</td>';
			 print '<td align=center class="simple">'.$data5[$tn].'</td>';
			 print '<td align=center class="simple">'.$data6[$tn].'</td>';
			 if ($data7[$x]) print '<td align=center class="simple">'.$data7[$tn].'</td></tr>';
			 else print '<td align=center class="simple">'.$data8[$tn].'</td></tr>';
		       }
	       }
	 print '</table></td>';
	 $desc=substr($ui[1],0,60);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 print '<td width="1000" valign=top><table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=1&&x=1000&y=330&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000" height="330"></td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=3&&x=1000&y=330&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000" height="330"></td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=4&&x=1000&y=330&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000" height="330"></td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=2&&x=1000&y=330&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000" height="330"></td></tr>';
	 print '</table>';
?>