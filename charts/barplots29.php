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
$cm=0;  $id="name".$cm;
//echo $_GET[$id];
while ($_GET[$id])
{
 $id="name".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dat[$cm]=$_GET[$id];
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm]=$_GET[$id]*1;
 $cm++;
 $id="name".$cm;
}
$cm--;

for ($rr=0; $rr<=$cm; $rr++) 
	{ 
	 $data1[$cm-$rr]=$datas1[$rr]; 
	 $dats[$cm-$rr]=$dat[$rr];
	 $est[$cm]=1;	 
	}
sort($data1);
reset($data1);

for ($tt=0; $tt<=$cm; $tt++)
for ($rr=0; $rr<=$cm; $rr++)
if ($datas1[$rr]==$data1[$tt] && $est[$cm]==1) 
	{ 
//	echo $dats[$tt];
	 $est[$cm]=0;
	 $dats[$tt]=$dat[$rr];	 
	}
$height=$cm*30+70;
$graph = new Graph(400,$height,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data1);
$lineplot->SetFillColor("#D0EEC2");

$lineplot->SetWidth(0.8);

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('#E4FFD5');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$title="Сравнительные анализ потребления за ".$_GET["mon"];
if ($_GET["type"]==1 || $_GET["type"]==3) $graph->title->Set($title);
if ($_GET["type"]==2 || $_GET["type"]==4) $graph->title->Set($title);

// Add the plot to the graph
//$graph->img->SetMargin(35,8,33,25);
//----------- title --------------------
$lineplot->value->Show();
if ($_GET["type"]==1 || $_GET["type"]==3) $lineplot->value->SetFormat('%.4f GKal/m2');
else $lineplot->value->SetFormat('%.3f m3/m');

$graph->Add($lineplot);

$graph->Set90AndMargin(150,20,40,20);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD,9);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 
// Display the graph
$graph->Stroke();
?>