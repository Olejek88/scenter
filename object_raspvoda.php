<?php
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
$sts=sprintf("%d%02d01000000",$ye,$mn);
$fns=sprintf("%d%02d01000000",$ye,$mn+1);
$allm1=$allm2=$dt0=0;
for ($hr=0;$hr<=23;$hr++)
 {
  if ($hr<10) $date1='%0'.$hr.':00:00%'; else $date1='%'.$hr.':00:00%'; 
  if ($device=='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND value>0 AND prm=12 AND source=6 AND value<10 AND date>='.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
  else  $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND device='.$device.' AND value>0 AND prm=12 AND source=6 AND value<10 AND date>'.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  
  if ($uy[1]) $data[$hr]=$uy[0]/$uy[1];
  if ($hr>=20 || $hr<=8) $dt0+=$uy[0];
  $dat[$hr]=$hr.':00';
  $allm1+=$uy[0];
  $allm2=$dt0;
 }
if ($allm1) $pr0=$allm2*100/$allm1;

for ($hr=0;$hr<=6;$hr++)
 {
  if ($device!='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND device='.$device.' AND prm=12 AND source=6 AND value>0 AND value<50 AND date>='.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
  else $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=12 AND source=6 AND value>0 AND value<50 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);

  if ($uy[1]) $data[$hr]=$uy[0]/$uy[1]-$data2;
  if ($hr==0) $dat[$hr]='понедельник';
  if ($hr==1) $dat[$hr]='вторник';
  if ($hr==2) $dat[$hr]='среда';
  if ($hr==3) $dat[$hr]='четверг';
  if ($hr==4) $dat[$hr]='пятница';
  if ($hr==5) $dat[$hr]='суббота';
  if ($hr==6) $dat[$hr]='воскресенье';
  if ($hr>=5) $dt1+=$uy[0];    
  if ($hr<=4) $avg+=$data[$hr];
  $allm3+=$uy[0];
  $allm4=$dt1;
 }
if ($allm3) $pr1=$allm4*100/$allm3;

print  '<table border="0" cellpadding="2" cellspacing="0"><tr><td align="center" class="m_separator">Назначение</td><td align=center class="menuitem">Оценка размера непроизводительных утечек воды в ночные часы и выходные дни</td></tr></table>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>
	<tr><td align=center class="m_separator" colspan="2">Анализ эффективности потребления воды по дням недели за '.$prevmonth.' года (куб.м.)</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=3&month='.$_GET["month"].'&year='.$_GET["year"].'"></td><td valign="top">
	<table border="0" cellpadding="2" cellspacing="2">
	<tr><td class="m_separator" colspan="2">Расход воды (куб.м.)</td><td class="simple"></td></tr>
	<tr><td class="m_separator">Итого за месяц</td><td class="simple">'.number_format($allm1,3).'</td></tr>
	<tr><td class="m_separator">Итого за выходные и праздничные дни</td><td class="simple">'.number_format($allm2,3).'</td></tr>
	<tr><td class="m_separator">Итого за рабочие дни</td><td class="simple">'.number_format($allm1-$allm2,3).'</td></tr>
	</table></td></tr>
	<tr><td></td></tr>
	<tr><td align=center class="m_separator">Анализ эффективности потребления воды по часам в среднем за '.$prevmonth.' года (куб.м.)</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=4&month='.$_GET["month"].'&year='.$_GET["year"].'"></td><td valign="top">
	<table border="0" cellpadding="2" cellspacing="2">
	<tr><td class="m_separator" colspan="2">Расход воды за день (куб.м.)</td><td class="simple"></td></tr>
	<tr><td class="m_separator">Итого за месяц</td><td class="simple">'.number_format($allm3,3).'</td></tr>
	<tr><td class="m_separator">Итого за выходные и праздничные дни</td><td class="simple">'.number_format($allm4,3).'</td></tr>
	<tr><td class="m_separator">% непроизводительных потерь</td><td class="simple">'.number_format($pr1,3).'</td></tr>
	</table></td></tr>
	<tr><td></td></tr>
	<tr><td class="simple" colspan="2"><strong>Рекомендации:</strong><br>Оценить возможность снижения потребления воды в нерабочее время (в.т.ч выходные и праздничные дни) и провести оптимизацию расхода в дневное время
	<br>За период '.$prevmonth.' количество непроизводительных потерь воды составило '.$allm2.' м3
	<br>Перерасход в процентном выражении составляет '.$pr0.' %</td></tr>
</tbody></table>
</td></tr>
<tr><td><img src="charts/barplots21.php?type=2&prm=10&&x=1200&y=300&device='.$uo[11].'&name='.$nnnm.'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1200"></td></tr>
</tbody></table>';
?>