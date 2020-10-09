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
$cm=1;  $id="dt".$cm;
while ($_GET[$id])
{
// $id="dt".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm-1]=$_GET[$id];
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm-1]=$_GET[$id]*1;
 $id="db".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas0[$cm-1]=$_GET[$id]*1;
 $cm++;
 $id="dt".$cm;
}

if ($_GET["size"]=='') $graph = new Graph(1400,350,"auto");
else $graph = new Graph(600,250,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($datas1);
$lineplot->SetFillColor("#D0EEC2");
$lineplot2=new BarPlot($datas0);
$lineplot2->SetFillColor("blue");

$lineplot->SetWidth(0.4);
$lineplot2->SetWidth(0.8);

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('#E4FFD5');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$graph->title->Set("Сравнение установленного и нормативного значений");

// Add the plot to the graph
$graph->img->SetMargin(38,8,33,49);
//----------- title --------------------
$lineplot2->value->Show();
$lineplot->value->Show();

$name='Установленный лимит         ';
$name2='Фактический расход         ';

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);

$gbplot  = new GroupBarPlot (array($lineplot,$lineplot2)); 
$graph->Add($gbplot);
//$acbplot->value->Show();
//$gbplot->value->Show();
$gbplot->SetWidth(0.8);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
$graph->xaxis->SetLabelAngle(35);
// Display the graph
$graph->Stroke();
?>