<?php
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 if ($ui) $name=$ui[1]; $norm1=$ui[17]; $norm2=$ui[18];

	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 $device=$uo[11];

	 print '<tr><td align=center class="m_separator">Время работы прибора узла учета '.$name.'</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="600px">';
	 print '<tr><td class="m_separator">Дата</td><td class="m_separator" align="center">Время работы, час</td><td class="m_separator" align="center">Время выхода из строя, час</td></td></tr>';

	 $today=getdate();
 	 if ($_GET["year"]=='') $ye=$today["year"];
 	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 if ($mn>1) $mn--;

	 $tm=1; $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 for ($tn=1; $tn<=$dy; $tn++)
		{		
		 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
		 $date2=sprintf ("%d%02d%02d",$ye,$mn,$tn);
		 $dat=sprintf ("%02d-%02d-%d",$mn,$tn,$ye);			     
		 $query = 'SELECT * FROM data WHERE type=2 AND prm=18 AND device='.$device.' AND date='.$date1;
		 //echo $query;
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);
		 while ($uy)
		      {          
		       if ($uy[8]==18 && $uy[6]==0) $data0=number_format($uy[3],2);
		       if ($uy[8]==18 && $uy[6]==1) $data1=number_format($uy[3],2);
		       if ($uy[8]==18 && $uy[6]==2) $data2=number_format($uy[3],2);
		       if ($uy[8]==18 && $uy[6]==3) $data3=number_format($uy[3],2);
		       $uy = mysql_fetch_row ($a);	     
		      }
		 print '<tr><td class="m_separator">'.$dat.'</td><td class="menuitem" align="center">'.$data0.'</td><td class="menuitem" align="center">'.$data1.'</td></tr>';
		 $it1+=$data0; $it2+=$data1;
	       }
	 print '<tr><td class="m_separator">Итого</td><td class="m_separator" align="center">'.$it1.'</td><td class="m_separator" align="center">'.$it2.'</td></tr>';
	 print '</table></td></tr>';
?>