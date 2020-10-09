<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 $month=$mn;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];
 $tarif_svoda=18.56;

 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);

 $stdate2=sprintf ("%02d-%02d-%d",$_POST["year"],$_POST["month"],$_POST["day"]);
 $endate2=sprintf ("%02d-%02d-%d",$_POST["year2"],$_POST["month2"],$_POST["day2"]);

 $query = 'SELECT * FROM uprav';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{		
	 $nametype[$uy[0]]=$uy[1];
	 $query = 'SELECT COUNT(id) FROM objects WHERE uteplo>0 AND type='.$uy[0];
	 $a2 = mysql_query ($query,$i);
	 $uo = mysql_fetch_row ($a2);
	 $count[$uy[0]]=$uo[0];

	 $uy = mysql_fetch_row ($a);
	}
 print '<table><tr><td class="m_separator">Выбрать период: '; include("ch_mon2.php"); print '</td></tr></table>';
// print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Удельное потрбление тепла организациями, присоединенными к ситуационному центру по состоянию на </h1></td></tr></table>';	

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" valign="top">';
 print '<table width="1200px" cellspacing="1" bgcolor="#5D6D2f"><tr>';
 print '<td align="center" class="m_separator">N </td>';
 print '<td align="center" class="m_separator">Код объекта</td>';
 print '<td align="center" class="m_separator">Объект расчета </td>';
 print '<td align="center" class="m_separator">Начало периода</td>';
 print '<td align="center" class="m_separator">Конец периода</td>';
 print '<td align="center" class="m_separator">Тепло прибор</td>';
 print '<td align="center" class="m_separator">ХОВ прибор</td>';
 print '<td align="center" class="m_separator">Отопление часы</td>';
 print '<td align="center" class="m_separator">ГВС часы</td>';
 print '<td align="center" class="m_separator">Вентиляция часы</td>';
 print '<td align="center" class="m_separator">Утечка часы</td>';
 print '<td align="center" class="m_separator">Часы прибор</td>';
 print '<td align="center" class="m_separator">Контрагент (договор контрагента)</td>';
 print '<td align="center" class="m_separator">Ответственный (код)</td>';
 print '<td align="center" class="m_separator">Доначисления</td>';
 print '</tr>';

 $query = 'SELECT * FROM objects WHERE type=3 OR type=4 ORDER BY type';
 if ($_POST["uprav"]) $query = 'SELECT * FROM objects WHERE type='.$_POST["uprav"].' ORDER BY id';
 $a = mysql_query ($query,$i);$object=0;
 if ($a)
 while ($uy = mysql_fetch_row ($a))
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i); 
	 if ($u) $uo = mysql_fetch_row ($u);
	 if ($uo)
		 $dev[$object]=$uo[11];
	 $data6[$object]=$data16[$object]=$data3[$object]=$data13[$object]=0;
	 $object++;
	}

 $query = 'SELECT * FROM data WHERE type=2 AND value>0 AND (prm=13 OR prm=12) AND source>20 AND date<='.$stdate.' ORDER BY date DESC LIMIT 5000';
 //echo $query;
 $a2 = mysql_query ($query,$i);
 if ($a2) $uy2 = mysql_fetch_row ($a2);
 while ($uy2)
      {          
	$x=$object;
	for ($t=0;$t<$object;$t++)
	if ($uy2[4]==$dev[$t]) $x=$t;

       	if ($uy2[8]==13 && $uy2[6]==23) if ($data6[$x]==0) $data6[$x]=$uy2[3];

       	if ($uy2[8]==12 && $uy2[6]==22) if ($data4[$x]==0) $data4[$x]=$uy2[3];
       	if ($uy2[8]==12 && $uy2[6]==21) if ($data3[$x]==0) $data3[$x]=$uy2[3];
        $uy2 = mysql_fetch_row ($a2);	     
      }
 $query = 'SELECT * FROM data WHERE type=2 AND value>0 AND (prm=13 OR prm=12) AND source>20 AND date<='.$endate.' ORDER BY date DESC LIMIT 5000';
 $a2 = mysql_query ($query,$i);
 if ($a2) $uy2 = mysql_fetch_row ($a2);
 while ($uy2)
      {          
	$x=$object;
	for ($t=0;$t<$object;$t++)
	if ($uy2[4]==$dev[$t]) $x=$t;

       	if ($uy2[8]==13 && $uy2[6]==23) if ($data16[$x]==0) $data16[$x]=$uy2[3];

       	if ($uy2[8]==12 && $uy2[6]==22) if ($data14[$x]==0) $data14[$x]=$uy2[3];
      	if ($uy2[8]==12 && $uy2[6]==21) if ($data13[$x]==0) $data13[$x]=$uy2[3];
        $uy2 = mysql_fetch_row ($a2);	     
      }

 $today=getdate();
 $x=0;
 $query = 'SELECT * FROM objects WHERE type=3 OR type=4 ORDER BY type';
 if ($_POST["uprav"]) $query = 'SELECT * FROM objects WHERE type='.$_POST["uprav"].' ORDER BY id';
 $a = mysql_query ($query,$i); $ccn=1; $object=0; $itt=0; $max=0;
 if ($a)
 while ($uy = mysql_fetch_row ($a))
	{
	 //$data13[$x]=$data16[$x]=$data3[$x]=$data6[$x]=0;
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $device=$uo[11];
	 $types[$object]=$uy[2];
	 $name[$object]=$uy[1];
	 $adr[$object]=$uy[3];
	 
	 $query = 'SELECT SUM(value) FROM data WHERE value<25 AND value>0 AND type=2 AND prm=18 AND source=0 AND device='.$device.' AND date<'.$endate.' AND date>='.$stdate;
	 //echo $query;
	 if ($a2 = mysql_query ($query,$i)) 
	 if ($uy2 = mysql_fetch_row ($a2))
         	$data18[$x]=$uy2[0];
	 $query = 'SELECT SUM(value) FROM data WHERE value<25 AND value>0 AND type=2 AND prm=18 AND source=1 AND device='.$device.' AND date<'.$endate.' AND date>='.$stdate;
	 //echo $query;
	 if ($a2 = mysql_query ($query,$i)) 
	 if ($uy2 = mysql_fetch_row ($a2))
         	$data19[$x]=$uy2[0];

         //$teplo=$data16[$x]-$data6[$x];
         //$voda=$data13[$x]-$data3[$x];
         if ($teplo<0) $teplo=0; if ($voda<0) $voda=0;
	 if ($data18[$x]>$max) $max=$data18[$x];
	 $object++;  $x++;	  
	}
 $query = 'SELECT * FROM objects WHERE type=3 OR type=4 ORDER BY type';
 if ($_POST["uprav"]) $query = 'SELECT * FROM objects WHERE type='.$_POST["uprav"].' ORDER BY id';
 $a = mysql_query ($query,$i); $ccn=1; $object=0; $itt=0; $x=0;
 if ($a)
 while ($uy = mysql_fetch_row ($a))
	{
         $teplo=$data16[$x]-$data6[$x];

         $voda=$data13[$x]-$data3[$x];
         $voda2=$data14[$x]-$data4[$x];
	 $rpv=$voda-$voda2;

         if ($teplo<0) $teplo=0; if ($voda<0) $voda=0;
	 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
	 print '<td align="center" class="simple">-</td>';
	 print '<td align="left" class="simple"  style="white-space:nowrap"><font style="font-weight:bold"><a href="index.php?sel=object&menu=report_heat2&day='.$_POST["day"].'&month='.$_POST["month"].'&year='.$_POST["year"].'&day2='.$_POST["day2"].'&month2='.$_POST["month2"].'&year2='.$_POST["year2"].'&id='.$uy[0].'">'.$name[$object].'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$stdate2.'</font></td>';
	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$endate2.'</font></td>';
	 //print '<td align="center" class="simple">'.number_format($teplo,3).' '.$data16[$x].'-'.$data6[$x].'</font></td>';
	 //print '<td align="center" class="simple">'.number_format($voda,3).' '.$data13[$x].'-'.$data3[$x].'</font></td>';
	 print '<td align="center" class="simple">'.number_format($teplo,3).'</font></td>';
//	 print '<td align="center" class="simple">'.number_format($rpv,3).' '.$voda.' '.$voda2.'</font></td>';
	 print '<td align="center" class="simple">'.number_format($rpv,3).'</font></td>';

	 print '<td align="center" class="simple">'.number_format($max-$data18[$x],2).'</font></td>';
//	 print '<td align="center" class="simple">'.number_format($data19[$x],2).'</font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '<td align="center" class="simple"></font></td>';
	 print '</tr>';
	 $object++;  $x++;	  
	}

 print '</table></td>';
?>
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