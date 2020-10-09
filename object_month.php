<?php
	 print '<table width=600px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
		<tr><td width=600 valign=top>
		<table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
		<tr><td class="m_separator" align=center>дата</td>
		<td class="m_separator" align="center">Vпод</td>
		<td class="m_separator" align="center">Vобр</td>
		<td class="m_separator" align="center">Qпот</td>
		<td class="m_separator" align="center">Vхвс</td>
		<td class="m_separator" align="center">Vгвс</td>
		</tr>';

	 $today=getdate();
	 $ye=$today["year"]; $qnt=6;
	 $tm=$today["mon"];
	  $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $tod=31;
	     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
	     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
	     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
	     $date1=sprintf ("%d%02d01000000",$today["year"],$tm);
	     $dat[$cn]=sprintf ("%d-%02d-01 00:00:00",$today["year"],$tm);

	     $query = 'SELECT * FROM data WHERE type=4 AND device='.$device.' AND date='.$date1;
	     //echo $query.'<br>'; 
	     
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);			 
	     while ($uy)
	      	{
	 	 //echo $uy[3];
	       	 if ($uy[8]==4 && $uy[6]==0) $data0[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==4 && $uy[6]==1) $data1[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==0 && $uy[3]<200000) $data2[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1 && $uy[3]<200000) $data3[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==13 && $uy[6]==0 && $uy[3]<2000) $data4[$cn]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==2 && $uy[3]<2000) $data6[$cn]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==1 && $uy[3]<2000) $data7[$cn]=number_format($uy[3],4);
	       	 if ($uy[8]==12 && $uy[6]==6 && $uy[3]<2000) $data8[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==5 && $uy[3]<2000) $data9[$cn]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}

	     include("time.inc");
		$dat[$tn].=','.$today["year"];
	     if ($tm>1) $tm--;
	     else { $tm=12; $today["year"]--; }
	     $cn++;
	    }
	 for ($tn=0; $tn<=$qnt; $tn++) 
		{
		 if ($data2[$tn]!='' || $data3[$tn]!='')
			{
	        	 print '<tr><td align=center class="m_separator">'.$dat[$tn].'</td>';
			 print '<td align=center class="simple">'.$data2[$tn].'</td>';
			 print '<td align=center class="simple">'.$data3[$tn].'</td>';
			 print '<td align=center class="simple">'.$data6[$tn].'</td>';
			 print '<td align=center class="simple">'.$data8[$tn].'</td>';
			 print '<td align=center class="simple">'.$data9[$tn].'</td></tr>';
		       }
	       }
	 print '</table></td>';
	 print '<td width="1000" valign=top><table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
	 print '<tr><td><img src="charts/barplots21.php?type=4&prm=5&&x=1000&y=200&device='.$device.'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=4&prm=6&&x=1000&y=200&device='.$device.'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '<tr><td><img src="charts/barplots21.php?type=4&prm=9&&x=1000&y=200&device='.$device.'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1000"></td></tr>';
	 print '</table>';
?>