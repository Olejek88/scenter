<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Отчет о соблюдении поставщиком расчетного температурного графика поставки теплоносителя за '.$prevmonth.'</td></tr>';
  print '<tr><td align=center class="simple" colspan="2"></td></tr>';
  print '<tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Определение возможности в соответствии с договором выставить поставщику финансовые претензии за причиненный ущерб</td></tr>';

	 print '<table border="0" cellpadding="0" cellspacing="0"><tr><td width="1200">
		<table border="0" cellpadding="0" cellspacing="1">';
	 print '<tr><td class="m_separator">Дата</td><td class="m_separator">T наруж (С)</td>
		<td class="m_separator">Tпод. норм. (С)</td><td class="m_separator">Tпод. факт (С)</td>
		<td class="m_separator">Tобр. норм. (С)</td><td class="m_separator">Tобр. факт (С)</td><td class="m_separator">Qнекач. (ГКал)</td></tr>';
	 print '<tr align="center"><td class="menuitem">1</td><td class="menuitem">2</td><td class="menuitem">3</td><td class="menuitem">4</td><td class="menuitem">5</td><td class="menuitem">6</td><td class="menuitem">7</td></tr>';

	 $today=getdate();
	 $tm=$dy=31; $x=0;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
	 $tm=$dy; $x=0;
	 $sts=sprintf("%d%02d01000000",$ye,$mn);
	 $fns=sprintf("%d%02d01000000",$ye,$mn+1);
	 for ($tn=1; $tn<=$dy; $tn++)
		{		
		 $date11[$x]=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
		 $date12[$x]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
		 $dats[$x]=sprintf ("%02d-%02d-%d",$mn,$tm,$ye);    
		 $x++; $tm--;
		}
	 $max=$x;
			     
	 $query = 'SELECT * FROM data WHERE type=2 AND date>='.$sts.' AND date<'.$fns.' AND (device='.$device.' OR device=0)';
	 $aa = mysql_query ($query,$i);
	 if ($aa) $uy = mysql_fetch_row ($aa); $x=0;
	 while ($uy)
	      {      
		//echo $uy[2].' '.$date2[1].'<br>'; 
		for ($t=0;$t<$max;$t++)
		if ($date12[$t]==$uy[2]) $x=$t;	  

		if ($uy[8]==13 && $uy[6]==0) $datas4[$x]=$uy[3];
	       if ($uy[8]==4 && $uy[6]==0) if ($uy[3]>0) $datas5[$x]=$uy[3];
	       if ($uy[8]==4 && $uy[6]==1) if ($uy[3]>0) $datas6[$x]=$uy[3];
	       if ($uy[8]==4 && $uy[6]==10 && $uy[4]==0) $datas7[$x]=$uy[3];
	       $uy = mysql_fetch_row ($aa);	     
	      }
	 $max--;
	 for ($i=0; $i<=$max; $i++) 
		{ 
		 $x=$i;	
	          $datas7[$x]=number_format($datas7[$x],0);
                  if ($datas7[$x]<=-24) { $datas8[$x]=125.8; $datas9[$x]=63.4; }
	          if ($datas7[$x]==-23) { $datas8[$x]=123.4; $datas9[$x]=62.6; }
	          if ($datas7[$x]==-22) { $datas8[$x]=120.9; $datas9[$x]=61.9; }
	          if ($datas7[$x]==-21) { $datas8[$x]=128.5; $datas9[$x]=61.2; }
	          if ($datas7[$x]==-20) { $datas8[$x]=116.1; $datas9[$x]=60.4; }
	          if ($datas7[$x]==-19) { $datas8[$x]=113.7; $datas9[$x]=59.7; }
	          if ($datas7[$x]==-18) { $datas8[$x]=111.2; $datas9[$x]=59; }
	          if ($datas7[$x]==-17) { $datas8[$x]=108.8; $datas9[$x]=58.2; }
	          if ($datas7[$x]==-16) { $datas8[$x]=106.4; $datas9[$x]=57.5; }
	          if ($datas7[$x]==-15) { $datas8[$x]=104; $datas9[$x]=56.8; }
	          if ($datas7[$x]==-14) { $datas8[$x]=101.5; $datas9[$x]=56; }
	          if ($datas7[$x]==-13) { $datas8[$x]=99.1; $datas9[$x]=55.3; }
	          if ($datas7[$x]==-12) { $datas8[$x]=96.7; $datas9[$x]=54.6; }
	          if ($datas7[$x]==-11) { $datas8[$x]=94.3; $datas9[$x]=53.8; }
	          if ($datas7[$x]==-10) { $datas8[$x]=91.8; $datas9[$x]=53.1; }
	          if ($datas7[$x]==-9) { $datas8[$x]=89.4; $datas9[$x]=52.4; }
	          if ($datas7[$x]==-8) { $datas8[$x]=87.0; $datas9[$x]=51.6; }
	          if ($datas7[$x]==-7) { $datas8[$x]=84.6; $datas9[$x]=50.1; }
	          if ($datas7[$x]==-6) { $datas8[$x]=82.1; $datas9[$x]=49.4; }
	          if ($datas7[$x]==-5) { $datas8[$x]=79.7; $datas9[$x]=48.7; }
	          if ($datas7[$x]==-4) { $datas8[$x]=77.3; $datas9[$x]=47.9; }
	          if ($datas7[$x]==-3) { $datas8[$x]=74.9; $datas9[$x]=47.2; }
	          if ($datas7[$x]==-2) { $datas8[$x]=72.4; $datas9[$x]=46.5; }
	          if ($datas7[$x]==-1) { $datas8[$x]=70; $datas9[$x]=45.7; }
	          if ($datas7[$x]==0) { $datas8[$x]=70; $datas9[$x]=45; }
	          if ($datas7[$x]==1) { $datas8[$x]=70; $datas9[$x]=45.7; }
	          if ($datas7[$x]==2) { $datas8[$x]=70; $datas9[$x]=46.5; }
	          if ($datas7[$x]==3) { $datas8[$x]=70; $datas9[$x]=47.2; }
	          if ($datas7[$x]==4) { $datas8[$x]=70; $datas9[$x]=47.9; }
	         if ($datas7[$x]==5) { $datas8[$x]=70; $datas9[$x]=48.7; }
	         if ($datas7[$x]>=6) { $datas8[$x]=70; $datas9[$x]=50; }
  	  	 $dd=$datas8[$x]-$datas8[$x]*0.05;
		 $df=$datas9[$x]+$datas9[$x]*0.05;
		 //echo $datas5[$x].' '.$dd.' '.$datas6[$x].' '.$df.'<br>';

		 if ($datas5[$x]<$dd) $datas18[$x]=$datas4[$x];
		 else $datas18[$x]=0;
		 if ($datas6[$x]>$df) $datas19[$x]=$datas4[$x];
		 else $datas19[$x]=0;
		 $it3+=$datas4[$x];
		 if ($datas18[$x]>0.1 || $datas19[$x]>0.1) $tnv[$x]=24;
		}
	for ($i=$max; $i>=0; $i--) 
		{ 
		 print '<tr><td class="m_separator">'.$dats[$i].'</td><td class="simple_bold" align="center">'.$datas7[$i].'</td>
			<td class="simple_bold" align="center">'.$datas8[$i].'</td><td class="simple_bold" align="center">'.number_format($datas5[$i],3).'</td>
			<td class="simple_bold" align="center">'.$datas9[$i].'</td><td class="simple_bold" align="center">'.number_format($datas6[$i],3).'</td>
			<td class="simple_bold" align="center">'.number_format($datas18[$i],2).'</td></tr>';
		 $it1+=$datas18[$i];
		 $it2+=$datas19[$i];
		}
	 if ($it3) $pr=$it1*100/$it3;
	 print '<tr><td class="m_separator">Итого/Сред</td><td></td><td></td><td></td><td></td><td></td><td class="m_separator" align="center">'.number_format($it1,2).'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td class="simple" colspan="2"><strong>Вывод:</strong><br>Некачественно поставленная услуга за месяц составила '.number_format($it1,3).'ГКал ('.number_format($pr,2).'%)</td></tr>';	                         
	 print '<tr><td class="simple" colspan="2"><strong>Рекомендации:</strong><br>Провести обследование наружных сетей (теплотрассы) на предмет выявления утечек тепла (качество изоляции)</td></tr>';	                         
	 print '</td></tr></table>';
?>