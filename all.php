<table width=1890px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td valign=top>

<table width=1800px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td width=1790 valign=top>
<table width=1790 bgcolor=#eeeeee valign=top cellpadding=1 cellspacing=1>
<tr><td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white"><?php $today=getdate(); print $today["mon"].'/'.$today["year"]; ?></font></td>
<td bgcolor="#5D6D2f" align=center colspan=6><font style="font-weight:bold; color:white">Тепловая энергия</font></td>
<td bgcolor="#5D6D2f" align=center colspan=4><font style="font-weight:bold; color:white">ХВС</font></td>
<td bgcolor="#5D6D2f" align=center colspan=5><font style="font-weight:bold; color:white">ГВС</font></td>
<td bgcolor="#5D6D2f" align=center colspan=3><font style="font-weight:bold; color:white">Экономия (руб.)</font></td>
</tr>
<tr><td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Объект</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">потребление</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">удельное</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">норм.</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">% эко</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">Тпод (макс/мин)</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">Тобр (макс/мин)</font></td>

<td bgcolor="#5D6D2f" align=center><font style="color:white">потребление</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">удельное</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">норм.</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">% эко</font></td>

<td bgcolor="#5D6D2f" align=center><font style="color:white">потребление</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">удельное</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">норм.</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">Тгвс (макс/мин)</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">% эко</font></td>

<td bgcolor="#5D6D2f" align=center><font style="color:white">тепло</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">ХВС</font></td>
<td bgcolor="#5D6D2f" align=center><font style="color:white">ГВС</font></td>
</tr>
<?php
$today=getdate();

$query = 'SELECT * FROM objects WHERE type<10';
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);  
$sum=$uy[0]; $type=$uy[2]; $cn=0;
while ($uy)
    {	 
     $sum0=$uy[14]; // square
     $sum1=$uy[15]; // nab

     $query = 'SELECT * FROM devices WHERE object='.$uy[0];
     $y = mysql_query ($query,$i);
     if ($y) $uo = mysql_fetch_row ($y);
     $ust[$cn]=$uo[14];
     $name[$cn]=$uy[1];

     $sts=sprintf("%d%02d%02d000000",$today["year"]-1,12,1); $fns=sprintf("%d%02d%02d000000",$today["year"],$today["mon"],$today["mday"]);
     $query = 'SELECT SUM(value),COUNT(id),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$uo[11].' AND prm=13 AND source=2 AND value>0.1 AND value<20';
	//echo $query;  
   $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0]; $cntid=$ui[1];
     if ($ust[$cn]) $data1[$cn]=$ui[0]; else $data1[$cn]=0;
    // if ($uo[11]==84606985 || $uo[11]==84606984) $data1[$cn]=$data1[$cn]*2.5;
	
     if ($sum0>0) $data3[$cn]=$data1[$cn]/$sum0;    // udelnaya

     $data0[$cn]=0.0322*$sum0*$cntid/30+$sum1*0.105*30*50/1000;	    // normativ
     if ($ui[1]<26) $data0[$cn]=$data0[$cn]*$ui[1]/25;

     if ($data1[$cn]>0) $rub1[$cn]=1154*($data0[$cn]-$data1[$cn]);  else $rub1[$cn]=0;
     if ($data0[$cn]>0) $pr1[$cn]=($data0[$cn]-$data1[$cn])*100/$data0[$cn]; else $pr1[$cn]=0;

     if ($uo[14]==0) $data1[$cn]=0;

     $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=0 AND value>10 AND value<100 AND device='.$uo[11];
     $e = mysql_query ($query,$i);
     $ui = mysql_fetch_row ($e);
//     $ui[2]=rand(6000,6500)/100; $ui[1]=rand(5500,6000)/100; $ui[0]=rand(6500,7500)/100;

     $data11[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';
     $it7=($it7+$ui[2])/2;
     $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=1 AND value>10 AND value<100 AND device='.$uo[11];
     $e = mysql_query ($query,$i);
     $ui = mysql_fetch_row ($e); 
//     $ui[2]=rand(4000,4500)/100; $ui[1]=rand(3500,4000)/100; $ui[0]=rand(4500,5000)/100;
     $data12[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';

     $it8=($it8+$ui[2])/2;

     $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$uo[11].' AND prm=12 AND source=6';
     $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data21[$cn]=$ui[0];
     $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$uo[11].' AND prm=12 AND source=5';
     $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data20[$cn]=$ui[0];
     //if ($ust[$cn]) $data21[$cn]=5.4*$sum1-5.4*$sum1*rand(1000,3000)/10000; else $data21[$cn]=0;
     //if ($ust[$cn]) $data20[$cn]=3.6*$sum1-3.6*$sum1*rand(1000,3000)/10000; else $data20[$cn]=0;

     if ($sum1>0) $data33[$cn]=$data21[$cn]/$sum1;    // udelnaya
     $data31[$cn]=5.4*$sum1;	    // normativ

     if ($sum1>0) $data32[$cn]=$data20[$cn]/$sum1;    // udelnaya
     $data30[$cn]=3.6*$sum1;	    // normativ

     if ($data0[$cn]>0) $rub2[$cn]=12.41*($data31[$cn]-$data21[$cn]); else $rub2[$cn]=0;
     if ($data0[$cn]>0) $rub3[$cn]=12.41*($data30[$cn]-$data20[$cn]); else $rub2[$cn]=0;

     if ($data31[$cn]>0) $pr2[$cn]=100*($data31[$cn]-$data21[$cn])/$data31[$cn]; else $pr2[$cn]=0;
     if ($data30[$cn]>0) $pr3[$cn]=100*($data30[$cn]-$data20[$cn])/$data30[$cn]; else $pr3[$cn]=0;

     $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=6 AND value!=0 AND device='.$uo[11];
     $e = mysql_query ($query,$i);
     $ui = mysql_fetch_row ($e); 
     //$ui[2]=rand(5900,6500)/100; $ui[1]=rand(1500,2000)/100; $ui[0]=rand(6600,6900)/100;
     //$data15[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';

     $it1+=$data1[$cn];
     $it2+=$data3[$cn];

     $it21+=$data21[$cn];
     $it20+=$data20[$cn];

     $cn++;
     $uy = mysql_fetch_row ($a); 
    }
 $max=$cn;
 $prt1='charts/barplots28.php?n1=13';
 $prt2='charts/barplots28.php?n1=8';
 $prt3='charts/barplots28.php?n1=6';
 $prt4='charts/barplots29.php?n1=1';    $cm=1;
 for ($cn=0; $cn<$max; $cn++)
 if ($data1[$cn]>10)
    {
     print '<tr><td bgcolor="#5D6D2f" align=center><font style="color:white">'.$name[$cn].'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data3[$cn],4).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data0[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($pr1[$cn],2).'</font></td>';
     
     print '<td align=center bgcolor=#ffffff><font class=top2>'.$data11[$cn].'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.$data12[$cn].'</font></td>';

     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data21[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data33[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data31[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($pr2[$cn],2).'</font></td>';

     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data20[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data32[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data30[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.$data15[$cn].'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($pr3[$cn],2).'</font></td>';

     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub1[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub2[$cn],2).'</font></td>';
     print '<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub3[$cn],2).'</font></td></tr>';
     $it15+=$rub1[$cn];
     $it16+=$rub2[$cn];
     $it17+=$rub3[$cn];
     if ($ust[$cn])
	{
	 $name[$cm]=str_replace("МДОУ детский сад","МДОУ",$name[$cm]);
	 $name[$cm]=str_replace("Средняя Школа","СШ",$name[$cm]);
	 $name[$cm]=str_replace("Городская больница","ГБ",$name[$cm]);
	     $prt1.='&name'.$cm.'='.$name[$cn].'&dat'.$cm.'='.$cn.'&da'.$cm.'='.$data1[$cn].'&db'.$cm.'='.$data0[$cn].'&dc'.$cm.'='.$data0[$cn];
	     $prt2.='&name'.$cm.'='.$name[$cn].'&dat'.$cm.'='.$cn.'&da'.$cm.'='.$data21[$cn].'&db'.$cm.'='.$data31[$cn].'&dc'.$cm.'='.$data0[$cn];
	     $prt3.='&name'.$cm.'='.$name[$cn].'&dat'.$cm.'='.$cn.'&da'.$cm.'='.$data20[$cn].'&db'.$cm.'='.$data30[$cn].'&dc'.$cm.'='.$data0[$cn];
	     $prt4.='&name'.$cm.'='.$name[$cn].'&dat'.$cm.'='.$cn.'&da'.$cm.'='.$rub1[$cn].'&db'.$cm.'='.$rub2[$cn].'&dc'.$cm.'='.$rub3[$cn];
	     $cm++;
	}
    }

 print '<tr><td bgcolor="#5D6D2f" align=center><font style="font-weight:bold; color:white">Итого</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it1,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it2/$max,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it3,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it4,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it5,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it6,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it7,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it8,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it9,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it10,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it11,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it12,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it13,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it14,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it1,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it15,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it16,2).'</font></td>';
 print '<td align=center bgcolor="#5D6D2f"><font style="color:white">'.number_format($it17,2).'</font></td></tr>';
 print '<tr><td bgcolor="#ffffff" align=center colspan=16></td><td bgcolor="#5D6D2f" align=center colspan=3><font style="color:white; font-weight:bold">'.number_format($it15+$it16+$it17,2).'</font></td></tr>';
?>

</table></td></tr></table>

<table width=1800px cellpadding=0 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td><table width=1800px cellpadding=1 cellspacing=1 bgcolor=#ffffff align=center>
<?php
print '<tr><td><img src="'.$prt1.'"></td></tr>';
//print '<tr><td><img src="'.$prt2.'"></td></tr>';
?>
</table></td></tr>
</table>
</td></tr></table>
