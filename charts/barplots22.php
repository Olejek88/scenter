<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once  ("../../../jpgraph2/jpgraph_line.php");
require_once  ("../../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
//------------------------------------------------------------------------
$type=2; $rr=0;
if ($_GET["type"]) $type=$_GET["type"];
if ($type==2) $max=31;
if ($type==4) $max=12;
if ($_GET["max"]!='') $max=$_GET["max"];
$today=getdate();

if ($_GET["year"]=='') $_GET["year"]=$today["year"];
if ($_GET["month"]=='') $_GET["month"]=$today["mon"];

$sts=sprintf("%d%02d00000000",$_GET["year"],$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);
if ($_GET["type"]==4) 
{
$sts=sprintf("%d%02d00000000",$_GET["year"]-1,$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);
}

$query = 'SELECT * FROM data2 WHERE type='.$type.' AND channel='.$_GET["channel"].' AND date>'.$sts.' AND date<'.$fns.'  ORDER BY date DESC';
$a = mysql_query ($query,$i);
if ($a) $uy = mysql_fetch_row ($a);
while ($uy)
	{
	 $datas0[$rr]=$uy[3];
	 $dats[$rr]=$uy[2]; $rr++;
	 if ($rr>$max) break;
	 $uy = mysql_fetch_row ($a);
	}
$max=$rr-1;

for ($i=0; $i<=$max; $i++) 
	{ 
	 if ($_GET["type"]==1) $dat[$i]=$dats[$max-$i][8].$dats[$max-$i][9].'/'.$dats[$max-$i][5].$dats[$max-$i][6].' '.$dats[$max-$i][11].$dats[$max-$i][12].'-'.$dats[$max-$i][14].$dats[$max-$i][15]; 
	 if ($_GET["type"]==2) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'-'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($_GET["type"]==4) $dat[$i]=$dats[$max-$i][2].$dats[$max-$i][3].'/'.$dats[$max-$i][5].$dats[$max-$i][6]; 
	 if ($_GET["type"]==7) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'-'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($datas0[$max-$i]>0) $data0[$i]=$datas0[$max-$i]; else $data0[$i]=$datas0[$max-$i];
	 //echo $data0[$i].' '.$data1[$i].'<br>';
	}

if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(1870,200,"auto");	
$graph->img->SetMargin(35,15,22,22);

$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($data0);
$lineplot->SetFillColor("blue");
$graph->yaxis->HideZeroLabel();
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTickLabels($dat);

$graph->SetMarginColor('#D0EEC2');
//$lineplot->SetShadow();
$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
$lineplot->SetWidth(0.8); 
//$lineplot->value->Show();
$lineplot->SetValuePos('center');
//if ($_GET["prm"]=='') $name=$_GET["name"]='';
$name=$_GET["name"].'                          ';
$graph->tabtitle->Set($name);

$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);

// Add the plot to the graph
//----------- title --------------------
$graph->Add($lineplot);

//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
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
