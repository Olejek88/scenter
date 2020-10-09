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
$cm=0;  $id="da".$cm;
while ($_GET[$id])
{
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm-1]=$_GET[$id];
 $id="dt".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm-1]=$_GET[$id]*1;
 $cm++;
 $id="da".$cm;
}
$cm--;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $data0[$cm-$rr-1]=$datas1[$rr]; 
	 $dat[$cm-$rr-1]=$dats[$rr];
	}

if ($_GET["cons"]==4) $graph = new Graph(1150,400,"auto");
else if ($_GET["cons"]==5) $graph = new Graph(1150,550,"auto");
else $graph = new Graph(1150,350,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
if ($_GET["cons"]==1) $lineplot->SetFillColor("red");
if ($_GET["cons"]==2) $lineplot->SetFillColor("blue");
if ($_GET["cons"]==3) $lineplot->SetFillColor("red");
if ($_GET["cons"]==4) $lineplot->SetFillColor("gray");


$lineplot->SetWidth(0.8);

if ($_GET["cons"]==4) $graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["cons"]==1) $graph->title->Set("Массовый расход теплоносителя (т)");
if ($_GET["cons"]==2) $graph->title->Set("Потребление тепловой энергии (ГКал)");
if ($_GET["cons"]==3) $graph->title->Set("Давление в системе теплоснабжения (МПа)");
if ($_GET["cons"]==4) $graph->title->Set("Общее время исправной работы (часы)");
if ($_GET["cons"]==5) $graph->title->Set("Общее потребление воды (м3)");
if ($_GET["cons"]==6) $graph->title->Set("Общее потребление электроэнергии (кВт)");

// Add the plot to the graph
if ($_GET["cons"]==4) $graph->img->SetMargin(38,8,25,125);
else $graph->img->SetMargin(38,8,25,5);
if ($_GET["cons"]==5) $graph->img->SetMargin(38,8,25,85);
//----------- title --------------------
$lineplot->value->Show();
if ($_GET["cons"]!=3) $lineplot->value->SetFormat('%d');

$graph->Add($lineplot);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->xaxis->SetTickLabels($dat);
$graph->xaxis->SetLabelAngle(22);

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