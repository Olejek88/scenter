<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once ("../../../jpgraph2/jpgraph_line.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once  ("../../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");

$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
if ($_GET["month"]=='') $_GET["month"]=$today["mon"]-1;

$sts=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);

if ($_GET["type"]==' ') $_GET["type"]='1';

if ($_GET["type"]=='1' || $_GET["type"]=='3')
for ($hr=0;$hr<=23;$hr++)
 {
  if ($hr<10) $date1='%0'.$hr.':00:00%'; else $date1='%'.$hr.':00:00%'; 
  if ($_GET["type"]==1)
	{
	  if ($_GET["dev"]=='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND value>0 AND prm=13 AND source=2 AND value<10 AND date>'.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
	  else  $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND device='.$_GET["dev"].' AND value>0 AND prm=13 AND source=2 AND value<10 AND  date>'.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
	}
  if ($_GET["type"]==3)
	{
	  if ($_GET["dev"]=='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND value>0 AND prm=12 AND source=6 AND value<10 AND date>'.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
	  else  $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=1 AND device='.$_GET["dev"].' AND value>0 AND prm=12 AND source=6 AND value<10 AND  date>'.$sts.' AND date<'.$fns.' AND date LIKE \''.$date1.'\'';  
	}

  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  
  if ($uy[1]) $data[$hr]=$uy[0]/$uy[1];  
  if ($hr>=20 || $hr<=8) $dt0+=$uy[0];
  $dat[$hr]=$hr.':00';
 }

if ($_GET["type"]=='2' || $_GET["type"]=='4' || $_GET["type"]=='6')
for ($hr=0;$hr<=6;$hr++)
 {
  if ($_GET["type"]==2 || $_GET["type"]=='6')
	{
	  if ($_GET["src"]=='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=13 AND source=2 AND value>0 AND value<50 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
	  if ($_GET["dev"]!='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND device='.$_GET["dev"].' AND prm=13 AND source=2 AND value>0 AND value<50 AND  date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
	}
  if ($_GET["type"]==4)
	{
	 if ($_GET["dev"]!='') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND device='.$_GET["dev"].' AND prm=12 AND source=6 AND value>0 AND value<50 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
	 else $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=12 AND source=6 AND value>0 AND value<50 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
	}

  if ($_GET["src"]=='8') 
	{
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=12 AND value>0 AND source=5 AND date>20110501000000 AND WEEKDAY(date)='.$hr;
	  $a = mysql_query ($query,$i);
	  if ($a) $uy = mysql_fetch_row ($a);
	  $data2=$uy[0]/$uy[1];	
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=12 AND source=6 AND date>21190501000000 AND WEEKDAY(date)='.$hr;  
	}
  if ($_GET["src"]=='6') $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE type=2 AND prm=12 AND source=5 AND date>'.$sts.' AND date<'.$fns.' AND WEEKDAY(date)='.$hr;
  //echo $query;
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
 }
$avg/=5;
for ($hr=0;$hr<=6;$hr++) $avgg[$hr]=$avg;

if ($_GET["type"]=='4' || $_GET["type"]=='3')
	{
	 $rdt1=$dt1*9.72;
	 $rdt0=$dt0*9.72;
	}
else
	{
	 $rdt1=$dt1*1137;
	 $rdt0=$dt0*1137;
	}

if ($_GET["size"]=='') $graph = new Graph(800,300,"auto");
else $graph = new Graph(550,250,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data);
if ($_GET["type"]=='6')
	{
	 $lineplot2=new LinePlot($avgg);
	 $lineplot2->SetWeight(2);
	 $graph->Add($lineplot2);
	}

if ($_GET["type"]=='1') $lineplot->SetFillColor("blue");
if ($_GET["type"]=='2') $lineplot->SetFillColor("red");
if ($_GET["src"]=='8')  $lineplot->SetFillColor("blue");
if ($_GET["src"]=='6')  $lineplot->SetFillColor("red");

if ($_GET["type"]=='4') $title='Непроизводительные потери воды за выходные и праздничные дни за месяц составили '.number_format($dt1,2).' кубометров ('.number_format($rdt1,2).' руб.)                            ';
if ($_GET["type"]=='3') $title='Непроизводительные потери воды в период с 20.00 до 6.00 за месяц составили '.number_format($dt0,2).' кубометров ('.number_format($rdt0,2).' руб.)                                 ';
if ($_GET["type"]=='2')
if ($data[5]>=$avg || $data[6]>=$avg)
	$title='Отсутствует снижение потребления в выходные и праздничные дни                                           ';
else $title='Изучить возможность дополнительного снижения потребления в выходные и праздничные дни                               ';

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
if ($_GET["type"]=='6') $lineplot->SetLegend("Фактический расход         ");
if ($_GET["type"]=='6') $lineplot2->SetLegend("Средняя величина потребления в рабочие дни               ");
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);

$graph->tabtitle->Set($title);                                                                                             
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,9);
$graph->tabtitle->SetColor('darkred','#E1E1FF');

$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');
//$lineplot->SetShadow();
$lineplot->value->Show();
$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,7); 
$lineplot->value->SetFormat('%.3f');

// Add the plot to the graph
$graph->img->SetMargin(5,10,75,25);
//----------- title --------------------
$graph->Add($lineplot);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
// Display the graph
$graph->Stroke();
?>