<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once  ("../../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
//------------------------------------------------------------------------
$cm=0;  $id="dt".$cm;
while ($_GET[$id])
{
 $id="dt".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm]=$_GET[$id];
 $id="pt".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm]=$_GET[$id]*1;
 $id="nt".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas2[$cm]=$_GET[$id]*1;
 $cm++;
 $id="dt".$cm;
}
// dt0=2453.95361328&nm1=%CC%D3%C7%20%C3%CA%C1%20%B9%205,%20&dt1=1375.78613281&
//$cm--;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $data0[$cm-$rr-1]=$datas1[$rr]; 
	 $data1[$cm-$rr-1]=$datas2[$rr];
	 $dat[$cm-$rr-1]=$dats[$rr];
	}

if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else if ($_GET["cons"]>3) $graph = new Graph(1550,350,"auto");	
else $graph = new Graph(1150,300,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
//$lineplot=new BarPlot($data0);

$lineplot=new BarPlot($data0);
$lineplot->SetFillColor("red");
$lineplot2=new BarPlot($data1);
$lineplot2->SetFillColor("blue");
$gbplot  = new GroupBarPlot (array($lineplot ,$lineplot2)); 
$graph->Add($gbplot);

$lineplot->SetWidth(0.8);
$lineplot2->SetWidth(0.8);

$name='Потребление        ';
$name2='Нормативное потребление        ';

if ($_GET["cons"]==12)
{
 $name='Договорной уровень 2011 г., ГКал                 ';
 $name2='Фактическое потребление 2011 г., ГКал           ';
}

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);

if ($_GET["cons"]>3) $graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["cons"]==1) $graph->title->Set("Массовый расход теплоносителя (т)");
if ($_GET["cons"]==2 || $_GET["cons"]==12) $graph->title->Set("Потребление тепловой энергии (ГКал)");
if ($_GET["cons"]==3) $graph->title->Set("Давление в системе теплоснабжения (МПа)");
if ($_GET["cons"]==4) $graph->title->Set("Общее время исправной работы (часы)");
if ($_GET["cons"]==5) $graph->title->Set("Потребление тепловой энергии за последний месяц (ГКал)");
if ($_GET["cons"]==6) $graph->title->Set("Потребление воды за последний месяц (м3)");

// Add the plot to the graph
if ($_GET["cons"]>3) $graph->img->SetMargin(38,8,25,80);
else $graph->img->SetMargin(38,8,25,5);
//----------- title --------------------
$lineplot->value->Show();
$lineplot2->value->Show();

if ($_GET["cons"]!=3 && $_GET["cons"]!=12) $lineplot->value->SetFormat('%.2f');

//$graph->Add($lineplot);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->xaxis->SetLabelAngle(60);

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
try {
     $graph->Stroke();
    }
catch ( JpGraphException $e ) 
	{ }
?>