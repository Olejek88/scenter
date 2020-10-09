<?php
print  '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" colspan=2><h1>Анализ эффективности потребления тепловой энергии по дням недели за '.$prevmonth.' (ГКал)(Средняя величина)</h1></td></tr></table>
	<table><tr><td align="center" class="m_separator">Назначение</td><td align=center class="menuitem">Оценка возможности дополнительной экономии тепловой энергии в выходные и праздничные дни</td></tr></table>

	<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>
	<tr><td><img src="charts/barplot_hourly.php?size=1&dev='.$device.'&type=6&year='.$ye.'&month='.$mn.'"></td></tr>
	<tr><td></td></tr>
	<tr><td>';
$today=getdate();
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
if ($_GET["month"]=='') $_GET["month"]=$today["mon"]-1;

$sts=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);
if (!$tarif_teplo) $tarif_teplo=1154.63;

for ($hr=0;$hr<=6;$hr++)
 {
  if ($_GET["src"]=='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=13 AND source=2 AND value>0 AND value<50 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
  if ($_GET["dev"]!='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND device='.$device.' AND prm=13 AND source=2 AND value>0 AND value<50 AND  date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
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
  if ($hr<=4) $t1+=$data[$hr]; else $t2+=$data[$hr];
 }
$avg/=5; 
if ($t1+$t2>0) $pr1=number_format($t2*100/($t1+$t2),2);
else $pr1='-';

for ($hr=0;$hr<=6;$hr++) $avgg[$hr]=$avg;
print '<table cellpadding="2" cellspacing="1"><tr><td class="m_separator"></td>';
for ($hr=0;$hr<=6;$hr++) print '<td class="m_separator">'.$dat[$hr].'</td>';
print '</tr><tr align="center"><td class="m_separator">Факт</td>';
for ($hr=0;$hr<=6;$hr++) print '<td class="simple">'.number_format($data[$hr],3).'</td>';
print '</tr><tr align="center"><td class="m_separator">Ср.вел.</td>';
for ($hr=0;$hr<=6;$hr++) print '<td class="simple">'.number_format($avg,3).'</td>';
print '</tr><tr align="center"><td class="m_separator">Экономия</td>';
for ($hr=0;$hr<=6;$hr++) print '<td class="simple">'.number_format($data[$hr]-$avg,3).'</td>';
print '</tr></table>';
print '</td></tr>
	<tr><td></td></tr>
	</tbody></table></td>
        <td>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>
	<tr><td>Тариф на тепловую энергию '.$tarif_teplo.' руб. с НДС</td></tr>
	<tr><td>
		<table cellpadding="2" cellspacing="1"><tr><td class="m_separator"></td>
		<td class="m_separator">Будние дни</td><td class="m_separator">Выходные и праздничные дни</td><td class="m_separator">Всего</td></tr>
		<tr><td class="m_separator">Итого за месяц</td>
		<td class="m_separator">'.number_format($t1,4).'</td><td class="m_separator">'.number_format($t2,4).'</td><td class="m_separator">'.number_format($t1+$t2,2).'</td>
		</tr></table>                                                                                                                     
	</td></tr> 
	<tr><td class="m_separator">Вывод:</td></tr>
	<tr><td>В данном МУ потребление тепла в выходные и праздничные дни составляет '.$pr1.'% от общего объема потребления. Проводится ручное регулирование потребления тепла в выходные и праздничные дни, что позволяет сэкономить '.$t2.'ГКал='.number_format($tarif_teplo*$t2,2).'руб. в месяц</td></tr>
	<tr><td class="m_separator">Рекомендации:</td></tr>
	<tr><td>Анализ позволяет выявить резервы экономии тепловой энергии в выходные и праздничные дни, для чего следует провести обследование системы отопления и разработать мероприятия по снижению потребления в нерабочее время.</td></tr>
	</table>
</td></tr>
<tr><td class="simple" colspan="2"><strong>Рекомендации:</strong><br>Необходимо организовать раздельный учет тепловой энергии на отопление и ГВС</td></tr>
</tbody></table>';
?>