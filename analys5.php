<div id="maincontent"  style="width:100%; left: 0px;">
<style>
td.simple
{
 font-size: 13px;
}
</style>
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
 $ccr=$cct=0;

 print '<table><tr><td class="m_separator">Выбрать район: '; include("ch_mon3.php"); print '</td></tr></table>';

 if ($_GET["raion"]=='') $raion='Все районы';
 if ($_GET["raion"]=='1') $raion='Калининский';
 if ($_GET["raion"]=='2') $raion='Курчатовский';
 if ($_GET["raion"]=='3') $raion='Центральный';
 if ($_GET["raion"]=='4') $raion='Советский';
 if ($_GET["raion"]=='5') $raion='Ленинский';
 if ($_GET["raion"]=='6') $raion='Тракторозаводский';
 if ($_GET["raion"]=='7') $raion='Металлургический';

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сведения с ОПУ по району '.$raion.'</h1></td></tr></table>';
 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center">данные расходов с общедомовых приборов учета установленных на домах в районе '.$raion.'</td></tr></table>';

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" valign="top">';
 print '<table width="1200px" cellspacing="1" bgcolor="#5D6D2f"><tr class="m_separator"><td class="m_separator" align="center"></td>';

 $query = 'SELECT * FROM objects WHERE uvoda>0 ORDER BY type';
 if ($_GET["raion"]!='' && $_GET["raion"]!=0) $query = 'SELECT * FROM objects WHERE uvoda>0 AND nentr='.$_GET["raion"].' ORDER BY type';
 $e = mysql_query ($query,$i); $cnt=0; $maxd=0;
 if ($e)
 while ($ui = mysql_fetch_row ($e))
	{
	 print '<td class="m_separator" align="center"><div style="word-wrap: break-word; width: 70px;">'.substr ($ui[1],0,35).'</div></td>';	 	 

	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i); 
	 if ($u) $uo = mysql_fetch_row ($u);
	 if ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}
	}
 print '<td class="m_separator" align="center">Итого по ОПУ</td></tr>';

 $today=getdate(); $cn=0;
 $ye=$today["year"];
 $tm=1;
 //----------------------------------------------------------------------------------------------------------
 if ($_GET["type"]=='' || $_GET["type"]=='0' || $_GET["type"]=='4')
 for ($tn=1; $tn<=12; $tn++)
    {	 
     $date1[$cn]=sprintf ("%d%02d01000000",$today["year"],$tn);
     $dats[$cn]=sprintf ("%d-%02d-01 00:00:00",$today["year"],$tn);
     include("time.inc");
     $dat[$cn].=','.$today["year"];
     if ($tm<12) $tm++;
     $cn++;
    }

 if ($_GET["type"]=='2')
	{
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 if ($_GET["month"]=='') $month=$today["mon"];
 	 else $month=$_GET["month"];

	 for ($tn=1; $tn<=$dy; $tn++)
	    {	 
	     $date1[$tn]=sprintf ("%d%02d%02d000000",$ye,$month,$tn);
	     $dats[$tn]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$month,$tn);
	     $dat[$tn]=sprintf ("%d-%02d-%02d",$ye,$month,$tn);
	    }
    }
 if ($_GET["type"]=='1')
	{
	 if ($_GET["month"]=='') $month=$today["mon"];
 	 else $month=$_GET["month"];
	 if ($_GET["day"]=='') $day=$today["mday"];
 	 else $day=$_GET["day"];

	 for ($tn=0; $tn<=23; $tn++)
		{
		 $date1[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$month,$day,$tn);
		 $dats[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$month,$day,$tn);
		 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00",$ye,$month,$day,$tn);
		}
	 $date_1=sprintf ("%d%02d%02d000000",$ye,$month,$day);
	 $date_2=sprintf ("%d%02d%02d000000",$ye,$month,$day+1);
	}
 //----------------------------------------------------------------------------------------------------------
 if ($_GET["type"]=='' || $_GET["type"]=='0' || $_GET["type"]=='4')
	{
	 $query = 'SELECT * FROM data WHERE type=4 AND prm=12 AND (source=5 OR source=6)';
	 //echo $query.'<br>'; 
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uy[4]==$devices[$tt]) break;
		 for ($tn=0; $tn<=$cn; $tn++)
		 if ($uy[2]==$dats[$tn]) break;
	       	 //$data[$tt][$tn]+=number_format($uy[3],3);
	       	 $data[$tt][$tn]+=$uy[3];
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<12; $tn++)
	    { 
	     print '<tr class="m_separator">'; $it=0;	 
	     print '<td class="m_separator"><a href="index.php?sel=analys5&type=2&month='.($tn+1).'&raion='.$_GET["raion"].'" style="text-decoration:none">'.$dat[$tn].'</a></td>';	 
	     for ($tt=0; $tt<$maxd; $tt++)
		{
		 print '<td align="center" class="simple">'.number_format($data[$tt][$tn],3).'</td>';
		 $it+=$data[$tt][$tn]; $its[$tt]+=$data[$tt][$tn];
		}
	     print '<td class="m_separator" align="center">'.$it.'</td>';
	     print '</tr>';	 
	    }
	}
 if ($_GET["type"]=='2')
	{
	 $query = 'SELECT * FROM data WHERE type=2 AND prm=12 AND (source=5 OR source=6)';
	 //echo $query.'<br>'; 
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uy[4]==$devices[$tt]) break;
		 for ($tn=1; $tn<=$dy; $tn++)
		 if ($uy[2]==$dats[$tn]) break;
	       	 $data[$tt][$tn]+=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=1; $tn<=$dy; $tn++)
	    { 
	     print '<tr class="m_separator">'; $it=0;	 
	     print '<td class="m_separator"><a href="index.php?sel=analys5&type=1&month='.($month).'&day='.$tn.'&raion='.$_GET["raion"].'" style="text-decoration:none">'.$dat[$tn].'</a></td>';	 
	     for ($tt=0; $tt<$maxd; $tt++)
		{
		 print '<td align="center" class="simple">'.$data[$tt][$tn].'</td>';
		 $it+=$data[$tt][$tn]; $its[$tt]+=$data[$tt][$tn];
		}
	     print '<td class="m_separator" align="center">'.$it.'</td>';
	     print '</tr>';	 
	    }

	}
 if ($_GET["type"]=='1')
	{
	 $query = 'SELECT * FROM data WHERE type=1 AND prm=12 AND (source=5 OR source=6) AND date>='.$date_1.' AND date<'.$date_2;
	 //echo $query.'<br>'; 
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uy[4]==$devices[$tt]) break;
		 for ($tn=0; $tn<=23; $tn++)
		 if ($uy[2]==$dats[$tn]) break;
	       	 $data[$tt][$tn]+=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<=23; $tn++)
	    { 
	     print '<tr class="m_separator">'; $it=0;	 
	     print '<td class="m_separator" style="white-space: nowrap"><a href="index.php?sel=analys5&type=1&month='.($month).'&day='.$tn.'&raion='.$_GET["raion"].'" style="text-decoration:none">'.$dat[$tn].'</a></td>';	 
	     for ($tt=0; $tt<$maxd; $tt++)
		{
		 print '<td align="center" class="simple">'.$data[$tt][$tn].'</td>';
		 $it+=$data[$tt][$tn]; $its[$tt]+=$data[$tt][$tn];
		}
	     print '<td class="m_separator" align="center">'.$it.'</td>';
	     print '</tr>';	 
	    }

	}

 if ($_GET["type"]=='1') print '<tr class="m_separator"><td class="m_separator">за день</td>';	 
 if ($_GET["type"]=='2') print '<tr class="m_separator"><td class="m_separator">за месяц</td>';	 
 if ($_GET["type"]=='4') print '<tr class="m_separator"><td class="m_separator">за год</td>';	 

 for ($tt=0; $tt<$maxd; $tt++)
	{
	 print '<td align="center" class="m_separator">'.number_format($its[$tt],3).'</td>';
	 $itr+=$its[$tt];
	}
 print '<td class="m_separator" align="center">'.number_format($itr,3).'</td>';
 print '</tr>';	 
 print '</table></td></tr>';

?>
</tbody></table>
</td>
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