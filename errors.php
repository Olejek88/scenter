<div id="main" style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Объекты</div>
		 <div class="menuitem first"><a href="index.php?sel=errors" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Все объекты</a></div>
		<?php
		 $query = 'SELECT * FROM objects';
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 while ($ui)
			{	 
			 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
			 $y = mysql_query ($query,$i);
			 if ($y) $uo = mysql_fetch_row ($y);
			 print '<div class="menuitem"><a href="index.php?sel=errors&id='.$uo[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></div>';
			 $ui = mysql_fetch_row ($e);
			}
		?>			
	</div>
	</div>
</div>

<div id="maincontent" style="width:1020px">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="2" cellspacing="0">
<tbody><tr><td>
<ul id="navigation"> 
<?php
print '<li><a href="index.php?sel=errors&id='.$_GET["id"].'"';
if (!$_GET["type"]) print 'class="sel"'; print '><span>Все записи</span></a></li>';
print '<li><a href="index.php?sel=errors&type=1&id='.$_GET["id"].'"';
if ($_GET["type"]==1) print 'class="sel"'; print '><span>Критические</span></a></li>';
print '<li><a href="index.php?sel=errors&type=2&id='.$_GET["id"].'"';
if ($_GET["type"]==2) print 'class="sel"'; print '><span>Предупреждения</span></a></li>';
print '<li><a href="index.php?sel=errors&type=3&id='.$_GET["id"].'"';
if ($_GET["type"]==3) print 'class="sel"'; print '><span>Информационные</span></a></li>';
print '<li><a href="index.php?sel=errors&type=4&id='.$_GET["id"].'"';
if ($_GET["type"]==4) print 'class="sel"'; print '><span>Ошибки</span></a></li>';
?>
</ul>
<div id="border"></div>
</td></tr>
</tbody></table>
</td>
</tr>

<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody><tr><td valign="top">
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">Объект</font></td>
<td align="center"><font color="white">Устройство</font></td>
<td align="center"><font color="white">Дата</font></td>
<td align="center"><font color="white">Tип события</font></td>
<td align="center"><font color="white">Событие</font></td>
<td align="center"><font color="white">Значение</font></td>
</tr>

<?php
 $query = 'SELECT * FROM devices';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $tpod=$tobr=$vpod=$vobr=$qpod=$qobr=$qpot=$vgvs=$vhvs=0;
	 $query = 'SELECT * FROM data WHERE type=0 AND value>0 AND device='.$ui[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uy = mysql_fetch_row ($y);
	 while ($uy)
		{
		 if ($uy[8]==4 && $uy[6]==0 && !$tpod) $tpod=$uy[3];
		 if ($uy[8]==4 && $uy[6]==1 && !$tobr) $tobr=$uy[3];
		 if ($uy[8]==11 && $uy[6]==0 && !$vpod) $vpod=$uy[3];
		 if ($uy[8]==11 && $uy[6]==1 && !$vobr) $vobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==0 && !$qpod) $qpod=$uy[3];
		 if ($uy[8]==13 && $uy[6]==1 && !$qobr) $qobr=$uy[3];
		 if ($uy[8]==13 && $uy[6]==2 && !$qpot) $qpot=$uy[3];
		 if ($uy[8]==12 && $uy[6]==5 && !$vgvs) $vgvs=$uy[3];
		 if ($uy[8]==12 && $uy[6]==6 && !$vhvs) $vhvs=$uy[3];		 
		 $uy = mysql_fetch_row ($y);
		}
	 if ($vpod<$vobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Расход обратной больше подающей (возможно перепутаны местами или нет отопления) Vпод='.$vpod.' Vобр='.$vobr.'\',\''.$vpod.'\')'; $e2 = mysql_query ($query,$i);}
	 if ($tpod<$tobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Температура обратной больше подающей (возможно перепутаны местами или нет отопления) Tпод='.$tpod.' Tобр='.$tobr.'\',\''.$tpod.'\')'; $e2 = mysql_query ($query,$i);}
	 if ($qpod<$qobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия обратной больше подающей (возможно перепутаны местами или нет отопления) Qпод='.$qpod.' Qобр='.$qobr.'\',\''.$qpod.'\')'; $e2 = mysql_query ($query,$i);}

	 if ($vpod>$vobr+$vobr && $vobr>0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Расход подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Vпод='.$vpod.' Vобр='.$vobr.'\',\''.$vpod.'\')'; $e2 = mysql_query ($query,$i);}
	 if ($tpod>$tobr+$tobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Температура подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Tпод='.$tpod.' Tобр='.$tobr.'\',\''.$tpod.'\')'; $e2 = mysql_query ($query,$i);}
	 if ($qpod>$qobr+$qobr && $qobr>0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Qпод='.$qpod.' Qобр='.$qobr.'\',\''.$qpod.'\')'; $e2 = mysql_query ($query,$i);}

	 if ($qpot<0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия отрицательна (возможно перепутаны датчики на прямом и обратном трубопроводе) Qпот='.$qpot.'\',\''.$qpot.'\')'; $e2 = mysql_query ($query,$i); }
	 /*
	 $today=getdate();
	 if ($_GET["year"]=='') $ye=$today["year"];
	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 $x=0; $nn=1; $ts=23;
	 $tm=$dy=$today["mday"]-1;
	
	 for ($tn=0; $tn<=250; $tn++)
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

	 $query = 'SELECT * FROM data WHERE type=1 AND device='.$ui[11].' ORDER BY date DESC LIMIT 30000';
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);			 
	 while ($uy)
	      	{
		 $x=451;
		 for ($tn=0; $tn<=450; $tn++) 
		 if ($uy[2]==$dat[$tn]) $x=$tn;
			
	       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
	       	 if ($uy[8]==13 && $uy[6]==0) $data4[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==1) $data5[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==13 && $uy[6]==2) $data6[$x]=number_format($uy[3],4);
	       	 if ($uy[8]==12 && $uy[6]==5) $data7[$x]=number_format($uy[3],5);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	 for ($tn=0; $tn<=450; $tn++) 
		{
		 if ($vpod<$vobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Расход обратной больше подающей (возможно перепутаны местами или нет отопления) Vпод='.$vpod.' Vобр='.$vobr.'\',\''.$vpod.'\')'; $e2 = mysql_query ($query,$i);}
		 if ($tpod<$tobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Температура обратной больше подающей (возможно перепутаны местами или нет отопления) Tпод='.$tpod.' Tобр='.$tobr.'\',\''.$tpod.'\')'; $e2 = mysql_query ($query,$i);}
		 if ($qpod<$qobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия обратной больше подающей (возможно перепутаны местами или нет отопления) Qпод='.$qpod.' Qобр='.$qobr.'\',\''.$qpod.'\')'; $e2 = mysql_query ($query,$i);}

		 if ($vpod>$vobr+$vobr && $vobr>0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Расход подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Vпод='.$vpod.' Vобр='.$vobr.'\',\''.$vpod.'\')'; $e2 = mysql_query ($query,$i);}
		 if ($tpod>$tobr+$tobr)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Температура подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Tпод='.$tpod.' Tобр='.$tobr.'\',\''.$tpod.'\')'; $e2 = mysql_query ($query,$i);}
		 if ($qpod>$qobr+$qobr && $qobr>0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия подающей больше чем в два раза больше обратной (возможно некорректная настройка оборудования) Qпод='.$qpod.' Qобр='.$qobr.'\',\''.$qpod.'\')'; $e2 = mysql_query ($query,$i);}

		 if ($qpot<0)  { $query = 'INSERT INTO register (device, type, descr, value) VALUES (\''.$ui[11].'\',\'3\',\'Тепловая энергия отрицательна (возможно перепутаны датчики на прямом и обратном трубопроводе) Qпот='.$qpot.'\',\''.$qpot.'\')'; $e2 = mysql_query ($query,$i); }
	       } */
	 $ui = mysql_fetch_row ($e);	
	}


 if ($_GET["id"])
	{
	 if ($_GET["type"])  $query = 'SELECT * FROM register WHERE type='.$_GET["type"].' AND device='.$ui[11].' ORDER BY date DESC';
	 else $query = 'SELECT * FROM register WHERE device='.$ui[11].' ORDER BY date DESC';
	}
 else
	{
	 if ($_GET["type"])  $query = 'SELECT * FROM register WHERE type='.$_GET["type"].' ORDER BY date DESC';
	 else $query = 'SELECT * FROM register ORDER BY date DESC';
	}
 $y = mysql_query ($query,$i);
 if ($y) $uo = mysql_fetch_row ($y);
 while ($uo)
	{
	 $query = 'SELECT * FROM devices WHERE device='.$uo[1];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 if ($ui)
		{	 
		 $query = 'SELECT * FROM objects WHERE id='.$ui[8];
		 $e2 = mysql_query ($query,$i);
		 if ($e2) $ur = mysql_fetch_row ($e2);
		}

	 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff">';
	 print '<td align="left"><b>'.$ur[1].'</b></td>';
	 print '<td align="left"><b>'.$ui[1].'('.$ui[11].')</b></td>';
	 print '<td align="center">'.$uo[5].'</td>';
	 if ($uo[2]==1) print '<td align="center">критическое</td>';
	 if ($uo[2]==2) print '<td align="center">предупреждение</td>';
	 if ($uo[2]==3) print '<td align="center">информационное</td>';
	 if ($uo[2]==4) print '<td align="center">вкл./выкл.</td>';
	 print '<td align="left">'.$uo[3].'</td>';
	 print '<td align="center">'.$uo[4].'</td></tr>';
	 $uo = mysql_fetch_row ($y);	 
	}

?>

</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>
</div>