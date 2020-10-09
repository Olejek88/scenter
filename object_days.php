<?php
	 print '<table width=600px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
		<tr><td width=600 valign=top>
		<table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
		<tr class="m_separator"><td align=center class="m_separator">дата</td>
		<td class="m_separator" align="center">Tпод</td>
		<td class="m_separator" align="center">Tобр</td>
		<td class="m_separator" align="center">Vпод</td>
		<td class="m_separator" align="center">Vобр</td>
		<td class="m_separator" align="center">Qпод</td>
		<td class="m_separator" align="center">Qобр</td>
		<td class="m_separator" align="center">Qпот</td>
		<td class="m_separator" align="center">зQо</td>
		<td class="m_separator" align="center">Vхвс</td>
		</tr>';

	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $qnt=150;
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 if ($_GET["month"]=='')
	 	 $tm=$dy=$today["mday"]-1;
	 else	 $tm=$dy=$today["mday"]=$dy;

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
			
	       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==13 && $uy[6]==10) $data4[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==11) $data5[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==2) $data6[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==1) $data7[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==12 && $uy[6]==6 && $uy[3]<200) $data8[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==5 && $uy[3]<200) $data9[$x]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<=$qnt; $tn++) 
		{
		  if ($data0[$tn]!='' || $data1[$tn]!='')
			{
	        	 print '<tr><td align=center class="m_separator">'.$dat[$tn].'</td>';
			 print '<td align=center class="simple">'.$data0[$tn].'</td>';
			 print '<td align=center class="simple">'.$data1[$tn].'</td>';
			 print '<td align=center class="simple">'.$data2[$tn].'</td>';
			 print '<td align=center class="simple">'.$data3[$tn].'</td>';
			 print '<td align=center class="simple">'.$data4[$tn].'</td>';
			 print '<td align=center class="simple">'.$data5[$tn].'</td>';
			 print '<td align=center class="simple">'.$data6[$tn].'</td>';
			 print '<td align=center class="simple">'.$data7[$tn].'</td>';
			 if ($data8[$tn]) print '<td align=center class="simple">'.$data8[$tn].'</td>';
			 else print '<td align=center class="simple">'.$data9[$tn].'</td>';
			 print '</tr>';
		       }
	       }
	 print '</table></td>';
	 $desc=substr($ui[1],0,50);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 print '<td width="1000" valign=top><table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=1&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=2&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=5&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=6&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=7&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=8&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=2&prm=9&&x=1000&y=200&device='.$device.'&name='.$desc.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '</table>';
?>