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
$type=$_GET["type"];
$cm=0;  $id="da".$cm;
while ($_GET[$id])
{
 $id="da".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $dats[$cm-1]=$_GET[$id];
 $id="db".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas1[$cm-1]=$_GET[$id]*1;
 $id="dc".$cm;
 if ($_GET[$id] || $_GET[$id]==0) $datas2[$cm-1]=$_GET[$id]*1;
 //echo $dats[$cm-$rr-1].' '.$datas1[$cm-$rr-1].' '.$datas2[$cm-$rr-1].'<br>';

 $cm++;
 $id="da".$cm;
}
$cm--;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $data0[$cm-$rr-1]=$datas1[$rr]; 
	 $data1[$cm-$rr-1]=$datas2[$rr]; 
	 $dat[$cm-$rr-1]=$dats[$rr];
	 //echo $dat[$cm-$rr-1].' '.$data0[$cm-$rr-1].' '.$data1[$cm-$rr-1].'<br>';
	}

if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(1000,300,"auto");	

$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$lineplot->SetFillColor("red");
//$lineplot->SetWidth(0.8);
$graph->xaxis->SetTickLabels($dat);

$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["src"]==1) $graph->title->Set("Экономия тепла по отношению к аналогичному периоду прошлого года");
if ($_GET["src"]==2) $graph->title->Set("Экономия воды по отношению к аналогичному периоду прошлого года");

// Add the plot to the graph
$graph->img->SetMargin(38,8,25,80);
//----------- title --------------------
$lineplot->value->Show();
$lineplot->value->SetFormat('%d');
if ($type==1)
	{
	 $graph->Add($lineplot);
	}
if ($type==2)
	{
	 $lineplot2=new BarPlot($data1);
	 $lineplot2->SetFillColor("blue");
	 //$lineplot2->SetWidth(0.8);
	 $lineplot2->value->Show();
	 $gbplot  = new GroupBarPlot (array($lineplot ,$lineplot2)); 
	 $graph->Add($gbplot);
	}

//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->xaxis->SetLabelAngle(15);

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