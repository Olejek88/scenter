<?php
 print '<table width=600px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
	<tr><td width=600 valign=top>
	<table width=600 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
	<tr><td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">дата</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">макс. допустимый расход куб.м</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">расход теплоносителя в под.трубе</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">превышение</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">расход теплоносителя в обр.трубе</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">допустимый размер утечки</font></td>
	<td bgcolor="#5D6D2f" align="center"><font color="white">фактический размер утечки</font></td></tr>';
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $x=0; $nn=1; $ts=$today["hours"];
	 $tm=$dy=$today["mday"];
	
	 for ($tn=0; $tn<=450; $tn++)
		{		
		 $date1[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
		 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$mn,$tm,$ts);
		 $data2[$tn]=$data3[$tn]='-';
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

	 $query = 'SELECT * FROM data WHERE type=1 AND prm=11 AND device='.$uo[11].' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=451;
		 for ($tn=0; $tn<=450; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;			
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<=450; $tn++) 
		{
		 if ($data2[$tn]!='-')
			{
	        	 print '<tr><td align=center bgcolor=#5D6D2f><font color="white">'.$dat[$tn].'</font></td>';
			 print '<td align=center bgcolor=#ffffff>6.2</td>';
			 print '<td align=center bgcolor=#ffffff>'.$data2[$tn].'</td>';
			 print '<td align=center bgcolor=#ffffff>'.number_format($data2[$tn]-6.2,2).'</td>';
			 print '<td align=center bgcolor=#ffffff>'.$data3[$tn].'</td>';
			 print '<td align=center bgcolor=#ffffff>0.0143</td>';
			 print '<td align=center bgcolor=#ffffff>'.number_format($data2[$tn]-$data3[$tn],4).'</td></tr>';
		       }
	       }
	 print '</table></td>';
	 $desc=substr($ui[1],0,60);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 print '<td width="1000" valign=top><table width=1000 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>';
	 print '<tr><td><img src="charts/trend2.php?type=3&prm=1&&x=1000&y=330&device='.$uo[11].'&name='.$desc.'" width="1000" height="330"></td></tr>';
	 print '</table>';
?>