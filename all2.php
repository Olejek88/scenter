<table width=1390px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td valign=top>

<table width=700px cellpadding=2 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td width=490 valign=top>
<table width=690 bgcolor=#664466 valign=top cellpadding=1 cellspacing=1>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz><?php $today=getdate(); print $today["year"]; ?></font></td><td bgcolor=#ffcf68 align=center colspan=10><font class=tablz>Количество тепловой энергии (Гкал)</font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz>месяц</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>потребление</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>удельное</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>среднее</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>норм.</font></td>
<td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>% эко</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>в рублях</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>Тпод (макс/мин)</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>Тобр (макс/мин)</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>Тн.в (макс/мин)</font></td>
</tr>
<?php
$today=getdate();
if ($_GET["year"]=='') $ye=$today["year"]; else $ye=$_GET["year"];
if ($_GET["month"]=='') $mn='0'.$today["mon"]; else $mn=$_GET["month"];
if ($today["mday"]<20) { $today["mon"]--; $today["mday"]=31; }

$query = 'SELECT nab,square FROM objects WHERE id='.$_GET["id"];
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);  
$sum=$uy[0]; $sum0=$uy[1]; $type=$uy[2];

$query = 'SELECT SUM(nab),SUM(square) FROM objects WHERE type='.$type;
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);  
$ssum=$uy[0]; $ssum0=$uy[1];

for ($tm=1; $tm<=12; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
$tm=$today["mon"];
for ($pm=1; $pm<=12; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$_GET["id"].' AND prm=13 AND source=2 AND value>0.1';
	 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0]; $cntid=$ui[1];

	 $query = 'SELECT SUM(nab),SUM(square) FROM objects WHERE type='.$type;
	 $a = mysql_query ($query,$i); $ccn=0;
	 if ($a) $uy = mysql_fetch_row ($a);  
	 while ($uy)
		{
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 $u = mysql_query ($query,$i);
		 if ($u) $uo = mysql_fetch_row ($u);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$uo[11].' AND prm=13 AND source=2 AND value>0.1';
		 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $sdata1[$cn]+=$ui[0];  $ccn++;
		 $uy = mysql_fetch_row ($a);
		}
	 if ($sum0>0) $data3[$cn]=$data1[$cn]/$sum0;
	 $data5[$cn]=$sdata1[$cn]/$ccn;
	 if ($cntid>28) $data0[$cn]=0.0322*$sum0;
	 else $data0[$cn]=($cntid/31)*0.0322*$sum0;
	 $rub[$cn]=537*($data0[$cn]-$data9[$cn]);

         $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=3 AND value>10';
	 $e = mysql_query ($query,$i);
	 $ui = mysql_fetch_row ($e);
	 $data11[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';
	 $it7=($it7+$ui[2])/2;
         $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=4 AND value>10';
	 $e = mysql_query ($query,$i);
	 $ui = mysql_fetch_row ($e); 
	 $data12[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';
	 $it8=($it8+$ui[2])/2;
         $query = 'SELECT MAX(value),MIN(value),AVG(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=4 AND source=10 AND value!=0';
	 $e = mysql_query ($query,$i);
	 $ui = mysql_fetch_row ($e); 
	 $data13[$cn]=number_format($ui[2],2).' ('.number_format($ui[0],1).'/'.number_format($ui[1],1).')';
	 $it9=($it9+$ui[2])/2;

     include("time.inc");
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
  }
 for ($cn=0; $cn<12; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>'.$dat[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data3[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data5[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data0[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff colspan=2><font class=top2>'.number_format($pr[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.$data11[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.$data12[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.$data13[$cn].'</font></td></tr>'; print $prt;
     $it1+=$data2[$cn]; $it2+=$data1[$cn]; $it3+=$data9[$cn]; $it4+=$data0[$cn];
    }

 $it5=($it4-$it3)*100/$it4; $it6=537*($it4-$it3);
 
 $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>Итого</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it1,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it2,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it3,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it4,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68 colspan=2><font class=tablz>'.number_format($it5,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it6,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it7,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it8,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it9,2).'</font></td></tr>'; print $prt;

 $prt1='charts/barplots28.php?n1=13';
 for ($cn=0; $cn<12; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt1.='&dat'.$cm.'='.$dat[$cn].'&da'.$cm.'='.$data2[$cn].'&db'.$cm.'='.$data5[$cn].'&dc'.$cm.'='.$data0[$cn]; $cm++;
    }

$it1=$it2=$it3=$it4=$it5=$it6=0;
?>
</table></td></tr><tr><td width=490 valign=top><table width=490 bgcolor=#664466 valign=top cellpadding=1 cellspacing=1>
<tr><td bgcolor=#e8e8e8 align=center colspan=8><font class=tablz></font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz><?php print $today["year"]; ?></font></td><td bgcolor=#ffcf68 align=center colspan=7><font class=tablz>Объем ХВС (м3)</font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz>месяц</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>потребление</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>среднее</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>всего</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>норматив</font></td>
<td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>% экономии по общему объему</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>экономия в рублях</font></td></tr>

<?php
$cn=0; $today=getdate();
for ($tm=1; $tm<=12; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
$tm=$today["mon"];
for ($pm=1; $pm<=12; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     include("time.inc");
     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
     $stl=sprintf("%d-%02d",$today["year"],$tm);
     $data01[$cn]=$data02[$cn]=0;
     if ($tm==$today["mon"]) $query = 'SELECT SUM(value) FROM data WHERE date LIKE \'%'.$stl.'%\' AND type=2 AND device='.$_GET["id"].' AND prm=12 AND source=6';
     else $query = 'SELECT value FROM data WHERE date='.$sts.' AND type=4 AND device='.$_GET["id"].' AND prm=12 AND source=6';
     $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0];
     if ($tm==$today["mon"]) $query = 'SELECT SUM(value) FROM data WHERE date LIKE \'%'.$stl.'%\' AND type=2 AND device='.$_GET["id"].' AND prm=12 AND source=5';
     else $query = 'SELECT value FROM data WHERE date='.$sts.' AND type=4 AND device='.$_GET["id"].' AND prm=12 AND source=5';
     $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data0[$cn]=$ui[0];
     $data1[$cn]-=$data0[$cn];

     if ($today["mon"]!=$tm) $data0[$cn]=(5.4/30)*$tod*$sum;
     else $data0[$cn]=5.4*$sum*($today["mday"]/30);

     $data2[$cn]=0;

     $query = 'SELECT * FROM device WHERE type=2';
     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e); $cm=0;
     while ($ui) { $dev[$cm]=$ui[1];  $datas[$cm]=$datad[$cm]=-1; $cm++; $ui = mysql_fetch_row ($e); }

	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=8 AND date<'.$sts.' ORDER BY date DESC LIMIT 10000';
	     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 for ($b=0;$b<$cm;$b++) 
		 if ($dev[$b]==$ui[1] && $datas[$b]<0) $datas[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}
	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=8 AND date>='.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 if ($ui[5]>0) for ($b=0;$b<$cm;$b++)
		 if ($dev[$b]==$ui[1] && $datad[$b]<0) $datad[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}
	     for ($b=0;$b<$cm;$b++) 
		{
	 	 if ($datad[$b]-$datas[$b]>=0) $data01[$cn]+=$datas[$b]; 
		 $data02[$cn]+=$datad[$b];
		}
	     //echo $data02[$cn].' '.$data01[$cn].'<br>';
	     if ($data02[$cn]-$data01[$cn]>0) $data2[$cn]=$data02[$cn]-$data01[$cn];  	     
	     $data2[$cn]+=$sum2*(5.4/30)*$tod;

	 $data9[$cn]=$data1[$cn];
	 if ($data1[$cn]-$data2[$cn]>0) $data1[$cn]=$data1[$cn]-$data2[$cn]; 
	 else {$data2[$cn]=$data1[$cn]; $data1[$cn]=0;}
    	 if ($data0[$cn]>0) $pr[$cn]=($data0[$cn]-$data9[$cn])*100/$data0[$cn];
	 $rub[$cn]=12.41*($data0[$cn]-$data9[$cn]);
  	 //echo $data2[$cn].' '.$data1[$cn].' '.$data9[$cn].'<br>';
     include("time.inc");
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
    }
$fp=fopen($ffile,"w");

for ($cn=0; $cn<11; $cn++)
if ($data9[$cn]>1)
    {	 
     $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>'.$dat[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data2[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data9[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data0[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff colspan=2><font class=top2>'.number_format($pr[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub[$cn],2).'</font></td></tr>'; print $prt;
     $sums1[$cn]=$data2[$cn]; $sums2[$cn]=$data1[$cn]; $sums3[$cn]=$data9[$cn]; $sums4[$cn]=$data0[$cn]; $sums6[$cn]=$rub[$cn];
     $it1+=$data2[$cn]; $it2+=$data1[$cn]; $it3+=$data9[$cn]; $it4+=$data0[$cn]; $it5*=$pr[$cn]; 
    }
 $it5=($it4-$it3)*100/$it4; $it6=12.41*($it4-$it3);
 $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>Итого</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it1,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it2,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it3,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it4,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68 colspan=2><font class=tablz>'.number_format($it5,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it6,2).'</font></td></tr>'; print $prt;
 fclose($fp);

 $ffile="inc/all".$_GET["obj"]."_3g.php"; $cm=1;
 $fp=fopen($ffile,"w"); $prt='charts/barplots28.php?n1=8&obj='.$_GET["obj"]; print $prt;
 for ($cn=0; $cn<11; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt='&dat'.$cm.'='.$dat[$cn].'&da'.$cm.'='.$data2[$cn].'&db'.$cm.'='.$data1[$cn].'&dc'.$cm.'='.$data0[$cn]; print $prt; $cm++;
    }
 fclose($fp);

$sumit1=$it1; $sumit2=$it2; $sumit3=$it3; $sumit4=$it4; $sumit6=$it6;
$it1=$it2=$it3=$it4=$it5=$it6=0;
$sums1[$cn]=$data2[$cn]; $sums2[$cn]=$data1[$cn]; $sums3[$cn]=$data9[$cn]; $sums4[$cn]=$data0[$cn]; $sums6[$cn]=$rub[$cn];
?>

<tr><td bgcolor=#e8e8e8 align=center colspan=8><font class=tablz></font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz><?php print $today["year"]; ?></font></td><td bgcolor=#ffcf68 align=center colspan=7><font class=tablz>Объем ГВС (м3)</font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz>месяц</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>инд. часть</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>общ. часть</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>всего</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>норматив</font></td><td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>% экономии по общему объему</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>экономия в рублях</font></td></tr>

<?php
$cn=0; $today=getdate();
$ffile="inc/all".$_GET["obj"]."_4.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");
	 $contents = fread ($fp, filesize ($ffile));
	 print $contents;	 
	 fclose($fp);
	}
else
{
 for ($tm=1; $tm<=10; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
 $tm=$today["mon"];
 for ($pm=1; $pm<=10; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
     $stl=sprintf("%d-%02d",$today["year"],$tm); $st1=sprintf("%d%02d01000000",$today["year"],$tm);

     $data01[$cn]=$data02[$cn]=0;
	    if ($tm==$today["mon"]) $query = 'SELECT SUM(value) FROM data WHERE date LIKE \'%'.$stl.'%\' AND type=2 AND device='.$_GET["id"].' AND prm=12 AND source=5';
	    else $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$st1.' AND type=4 AND device='.$_GET["id"].' AND prm=12 AND source=5';

		$e = mysql_query ($query,$i);
	    $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0];
	    if ($today["mon"]!=$tm) $data0[$cn]=(3.6/30)*$tod*$sum;
	    else $data0[$cn]=3.6*$sum*($today["mday"]/30);

	    $data2[$cn]=0;

	     $query = 'SELECT * FROM device WHERE type=2';
	     $e = mysql_query ($query,$i);
	     if ($e) $ui = mysql_fetch_row ($e); $cm=0;
	     while ($ui) { $dev[$cm]=$ui[1];  $datas[$cm]=$datad[$cm]=-1; $cm++; $ui = mysql_fetch_row ($e); }

	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=6 AND date<'.$sts.' ORDER BY date DESC LIMIT 10000';
		//echo $query.'<br>';
	     $e = mysql_query ($query,$i);
	     if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 for ($b=0;$b<$cm;$b++) 
		 if ($dev[$b]==$ui[1] && $datas[$b]<0) $datas[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}
	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=6 AND date>='.$sts.' AND date<'.$fns.' ORDER BY date DESC';
		//echo $query.'<br>';
	     $e = mysql_query ($query,$i);
	     if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 if ($ui[5]>0) for ($b=0;$b<$cm;$b++)
		 if ($dev[$b]==$ui[1] && $datad[$b]<0) $datad[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}
	     for ($b=0;$b<$cm;$b++) 
		{
	 	 if ($datad[$b]-$datas[$b]>=0) $data01[$cn]+=$datas[$b]; 
		 $data02[$cn]+=$datad[$b];
		}

		//echo $data1[$cn].' '.$data02[$cn].' '.$data01[$cn].'<br>';
	     if ($data02[$cn]-$data01[$cn]>0) $data2[$cn]=$data02[$cn]-$data01[$cn];  	     
	     $data2[$cn]+=$sum2*(3.6/30)*$tod;

	$data9[$cn]=$data1[$cn];	
	if ($data1[$cn]-$data2[$cn]>0) $data1[$cn]=$data1[$cn]-$data2[$cn]; 
	else {$data2[$cn]=$data1[$cn]; $data1[$cn]=0;}
    	if ($data0[$cn]>0) $pr[$cn]=($data0[$cn]-$data9[$cn])*100/$data0[$cn];
	$rub[$cn]=12.41*($data0[$cn]-$data9[$cn]);
     include("time.inc");
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
    }
 $fp=fopen($ffile,"w");
 for ($cn=0; $cn<10; $cn++)
 if ($data9[$cn]>1)
    {	 
     $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>'.$dat[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data2[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data9[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data0[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff colspan=2><font class=top2>'.number_format($pr[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub[$cn],2).'</font></td></tr>'; print $prt;
     $it1+=$data2[$cn]; $it2+=$data1[$cn]; $it3+=$data9[$cn]; $it4+=$data0[$cn];
     $sums1[$cn]+=$data2[$cn]; $sums2[$cn]+=$data1[$cn]; $sums3[$cn]+=$data9[$cn]; $sums4[$cn]+=$data0[$cn]; $sums6[$cn]+=$rub[$cn];
    }
 $it5=($it4-$it3)*100/$it4; $it6=12.41*($it4-$it3);
 $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>Итого</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it1,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it2,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it3,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it4,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68 colspan=2><font class=tablz>'.number_format($it5,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it6,2).'</font></td></tr>'; print $prt;
 fclose($fp);

 $ffile="inc/all".$_GET["obj"]."_4g.php"; $cm=1;
 $fp=fopen($ffile,"w"); $prt='charts/barplots28.php?n1=6&obj='.$_GET["obj"];  print $prt;
 for ($cn=0; $cn<11; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt='&dat'.$cm.'='.$dat[$cn].'&da'.$cm.'='.$data2[$cn].'&db'.$cm.'='.$data1[$cn].'&dc'.$cm.'='.$data0[$cn]; print $prt; $cm++;
    }
 fclose($fp);
}
$sumit1+=$it1; $sumit2+=$it2; $sumit3+=$it3; $sumit4+=$it4; $sumit6+=$it6;
$it1=$it2=$it3=$it4=$it5=$it6=0;

print '<tr><td bgcolor=#e8e8e8 align=center colspan=8><font class=tablz></font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz><?php print $today["year"]; ?></font></td><td bgcolor=#ffcf68 align=center colspan=3><font class=tablz>Количество тепловой энергии (Гкал)</font></td>
<td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>В сопоставлении по факт. объему</font></td><td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>В сопоставлении по норм. объему</font></td></tr>

<tr><td bgcolor=#ffcf68 align=center><font class=tablz>месяц</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>факт</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>норматив на факт. объем</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>норматив на норм. объем</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>% экономии</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>Экономия в рублях</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>% экономии</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>Экономия в рублях</font></td>
</tr>';

$cn=0; $today=getdate();
$ffile="inc/all".$_GET["obj"]."_5.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");
	 $contents = fread ($fp, filesize ($ffile));
	 print $contents;	 
	 fclose($fp);
	}
else
{
 for ($tm=1; $tm<=10; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0; 
 $tm=$today["mon"];
 for ($pm=1; $pm<=10; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
     $sts=sprintf("%d%02d00000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
     $stl=sprintf("%d-%02d",$today["year"],$tm); $st1=sprintf("%d%02d01000000",$today["year"],$tm);

     if ($tm==$today["mon"]) $query = 'SELECT SUM(value) FROM data WHERE date LIKE \'%'.$stl.'%\' AND type=2 AND device='.$_GET["id"].' AND prm=12 AND source=5';
     else $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date='.$st1.' AND type=4 AND device='.$_GET["id"].' AND prm=12 AND source=5';
     $e = mysql_query ($query,$i);
     $ui = mysql_fetch_row ($e); 
     if ($today["mon"]!=$tm) $datas0[$cn]=(3.6)*$sum;
     else $datas0[$cn]=3.6*$sum*($today["mday"]/30);

     $query = 'SELECT SUM(value) FROM data WHERE date>'.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=3 AND device='.$_GET["id"].'';
     $a = mysql_query ($query,$i);
     if ($a) $uy = mysql_fetch_row ($a);
     if ($uy) $datas2[$cn]=$uy[0];
     $query = 'SELECT SUM(value) FROM data WHERE date>'.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND device='.$_GET["id"].'';
     $a = mysql_query ($query,$i);
     if ($a) $uy = mysql_fetch_row ($a);
     if ($uy) $datas3[$cn]=$uy[0];
     $query = 'SELECT SUM(value) FROM data WHERE date='.$st1.' AND type=4 AND prm=12 AND source=5 AND device='.$_GET["id"].'';
     $a = mysql_query ($query,$i);
     if ($a) $uy = mysql_fetch_row ($a);
     if ($uy) $datas4[$cn]=$uy[0];

	 $data2[$cn]=$datas2[$cn]-$datas3[$cn];
	 $data1[$cn]=0.0467*$datas4[$cn];
	 $data9[$cn]=0.0467*$datas0[$cn];
	 
	 if ($data1[$cn]>0) $pr[$cn]=($data1[$cn]-$data2[$cn])*100/$data2[$cn];
	 else  $pr[$cn]=100;
	 if ($data9[$cn]>0) $pr1[$cn]=($data9[$cn]-$data2[$cn])*100/$data9[$cn];
	 else $pr1[$cn]=0;
         $rub[$cn]=537*($data1[$cn]-$data2[$cn]);
         $rub1[$cn]=537*($data9[$cn]-$data2[$cn]);
     include("time.inc");
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
   $cn++;
  } 
 $fp=fopen($ffile,"w");
 for ($cn=0; $cn<=9; $cn++)
 if ($data2[$cn]>1 && $data1[$cn]>1)
    {	 
     $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>'.$dat[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data2[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data9[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($pr[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($pr1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub1[$cn],2).'</font></td></tr>'; print $prt;
     $it1+=$data2[$cn]; $it2+=$data1[$cn]; $it3+=$data9[$cn];
    }
 if ($it2>0) $it4=($it2-$it1)*100/$it2; $it5=537*($it2-$it1);
 if ($it3>0)$it6=($it3-$it1)*100/$it3; $it7=537*($it3-$it1);

 $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>Итого</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it1,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it2,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it3,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it4,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it5,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it6,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it7,2).'</font></td></tr>'; print $prt;
 fclose($fp);

 $ffile="inc/all".$_GET["obj"]."_5g.php"; $cm=1;
 $fp=fopen($ffile,"w"); $prt='charts/barplots28.php?n1=15&obj='.$_GET["obj"]; print $prt;
 for ($cn=0; $cn<11; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt='&dat'.$cm.'='.$dat[$cn].'&da'.$cm.'='.$data2[$cn].'&db'.$cm.'='.$data1[$cn].'&dc'.$cm.'='.$data9[$cn]; print $prt; $cm++;
    }
 fclose($fp);
}
$it1=$it2=$it3=$it4=$it5=$it6=0;
?>

<tr><td bgcolor=#e8e8e8 align=center colspan=8><font class=tablz></font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz><?php print $today["year"]; ?></font></td><td bgcolor=#ffcf68 align=center colspan=7><font class=tablz>Количество электроэнергии (кВт/ч)</font></td></tr>
<tr><td bgcolor=#ffcf68 align=center><font class=tablz>месяц</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>инд. часть</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>общ. часть</font></td><td bgcolor=#ffcf68 align=center><font class=tablz>всего</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>норматив</font></td><td bgcolor=#ffcf68 align=center colspan=2><font class=tablz>% экономии по общему объему</font></td>
<td bgcolor=#ffcf68 align=center><font class=tablz>экономия в рублях</font></td></tr>

<?php
$cn=0; $today=getdate();
$ffile="inc/all".$_GET["obj"]."_6.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");
	 $contents = fread ($fp, filesize ($ffile));
	 print $contents;	 
	 fclose($fp);
	}
else
{
 $tm=$today["mon"]-1;
 for ($pm=1; $pm<=12; $pm++)
    {	 
     $tod=31;
     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }

     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
     $data01[$cn]=$data02[$cn]=0;
     include("time.inc");

	    $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND device='.$_GET["id"].' AND prm=14 AND value<2000';
	    $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); $data1[$cn]=$ui[0];
	    if ($today["mon"]!=$tm) $data0[$cn]=(130/30)*$tod*$sum;
	    else $data0[$cn]=130*$sum*($today["mday"]/30);
	    $data2[$cn]=0; $data02[$cn]=$data01[$cn]=0;
	     $query = 'SELECT * FROM device WHERE type=4';
	     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e); $cm=0;
	     while ($ui) { $dev[$cm]=$ui[1];  $datas[$cm]=$datad[$cm]=-1; $cm++; $ui = mysql_fetch_row ($e); }

	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=2 AND date>='.$sts.' AND date<'.$fns.' ORDER BY date';
	      //echo $query;
	     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 for ($b=0;$b<$cm;$b++) 
		 if ($dev[$b]==$ui[1] && $datas[$b]<0) $datas[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}                                                                                                                                                     
	     $query = 'SELECT * FROM prdata WHERE type=2 AND prm=2 AND date>='.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $e = mysql_query ($query,$i); if ($e) $ui = mysql_fetch_row ($e);
	     while ($ui)
		{ 
		 if ($ui[5]>0) for ($b=0;$b<$cm;$b++)
		 if ($dev[$b]==$ui[1] && $datad[$b]<0) $datad[$b]=$ui[5];
		 $ui = mysql_fetch_row ($e);
		}
	     for ($b=0;$b<$cm;$b++) if ($datas[$b]>0) if ($datad[$b]>$datas[$b]) $data01[$cn]+=$datas[$b];
	     for ($b=0;$b<$cm;$b++) if ($datad[$b]>0) $data02[$cn]+=$datad[$b];
	     if ($data02[$cn]-$data01[$cn]>0) $data2[$cn]=$data02[$cn]-$data01[$cn];
	     //echo $data2[$cn].' '.$data1[$cn].'<br>';
	 if ($data1[$cn]>$data2[$cn]) $data9[$cn]=$data1[$cn];
	 else $data9[$cn]=$data2[$cn];

	 if ($data1[$cn]-$data2[$cn]>0) $data1[$cn]=$data1[$cn]-$data2[$cn]; 
	 else $data1[$cn]=0;
    	 if ($data0[$cn]>0) $pr[$cn]=($data0[$cn]-$data9[$cn])*100/$data0[$cn];
	 $rub[$cn]=1.14*($data0[$cn]-$data9[$cn]);
     if ($tm>1) $tm--;
     else { $tm=12; $today["year"]--; }
     $cn++;
    }
 $fp=fopen($ffile,"w"); 
 for ($cn=0; $cn<12; $cn++)
 if ($data9[$cn]>1)
    {	 
     $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>'.$dat[$cn].'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data2[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data1[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data9[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($data0[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff colspan=2><font class=top2>'.number_format($pr[$cn],2).'</font></td>'; print $prt;
     $prt='<td align=center bgcolor=#ffffff><font class=top2>'.number_format($rub[$cn],2).'</font></td></tr>'; print $prt;
     $sums1[$cn]=$data2[$cn]; $sums2[$cn]=$data1[$cn]; $sums3[$cn]=$data9[$cn]; $sums4[$cn]=$data0[$cn]; $sums6[$cn]=$rub[$cn];
     $it1+=$data2[$cn]; $it2+=$data1[$cn]; $it3+=$data9[$cn]; $it4+=$data0[$cn]; $it5*=$pr[$cn]; 
    }
 if ($it4>0) $it5=($it4-$it3)*100/$it4; $it6=1.14*($it4-$it3);
 $prt='<tr><td bgcolor=#ffcf68 align=center><font class=tablz>Итого</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it1,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it2,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it3,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it4,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68 colspan=2><font class=tablz>'.number_format($it5,2).'</font></td>'; print $prt;
 $prt='<td align=center bgcolor=#ffcf68><font class=tablz>'.number_format($it6,2).'</font></td></tr>'; print $prt;
 fclose($fp);

 $ffile="inc/all".$_GET["obj"]."_6g.php"; $cm=1;
 $fp=fopen($ffile,"w"); $prt='charts/barplots28.php?n1=2&obj='.$_GET["obj"]; print $prt;
 for ($cn=0; $cn<12; $cn++)
 if ($data9[$cn]>0)
    {	 
     $prt='&dat'.$cm.'='.$dat[$cn].'&da'.$cm.'='.$data2[$cn].'&db'.$cm.'='.$data1[$cn].'&dc'.$cm.'='.$data0[$cn]; print $prt; $cm++;
    }
 fclose($fp);
}
?>

</table></td></tr></table></td>

<td>
<table width=700px cellpadding=0 cellspacing=1 bgcolor=#ffffff align=center>
<tr><td><table width=700px cellpadding=1 cellspacing=1 bgcolor=#ffffff align=center>
<?php
 print '<tr><td><font class=tablz>Отчет по потреблению энергоресурсов дома по адресу '.$build.'<font></td><td bgcolor=red align=center><font class=tablz>реальное</td><td align=center bgcolor=blue class=tablz>среднее по домам</td></tr>';
?>
</td></tr></table></td></tr>
<?php
$ffile="inc/all".$_GET["obj"]."_1g.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");	 $contents = fread ($fp, filesize ($ffile));
	 print '<tr><td><img alt="пожалуйста подождите пока идет построение изображения" width=700 height=250 src="'.$contents.'"></td></tr>';
	 fclose($fp);
	}
$ffile="inc/all".$_GET["obj"]."_3g.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");	 $contents = fread ($fp, filesize ($ffile));
	 print '<tr><td><img alt="пожалуйста подождите пока идет построение изображения" width=700 height=250 src="'.$contents.'"></td></tr>';
	 fclose($fp);
	}
$ffile="inc/all".$_GET["obj"]."_4g.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");	 $contents = fread ($fp, filesize ($ffile));
	 print '<tr><td><img alt="пожалуйста подождите пока идет построение изображения" width=700 height=250 src="'.$contents.'"></td></tr>';
	 fclose($fp);
	}
$ffile="inc/all".$_GET["obj"]."_5g.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");	 $contents = fread ($fp, filesize ($ffile));
	 print '<tr><td><img alt="пожалуйста подождите пока идет построение изображения" width=700 height=250 src="'.$contents.'"></td></tr>';
	 fclose($fp);
	}
$ffile="inc/all".$_GET["obj"]."_6g.php";
if (file_exists($ffile))
	{
	 $fp=fopen($ffile,"r");	 $contents = fread ($fp, filesize ($ffile));
	 print '<tr><td><img alt="пожалуйста подождите пока идет построение изображения" width=700 height=250 src="'.$contents.'"></td></tr>';
	 fclose($fp);
	}
?>
</table>
</td></tr></table>
