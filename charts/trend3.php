<?php
include ("../../../jpgraph2/jpgraph.php");
include ("../../../jpgraph2/jpgraph_log.php");
include ("../../../jpgraph2/jpgraph_line.php");
include ("../../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");

$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
if ($_GET["month"]=='') $_GET["month"]=$today["mon"]-1;

$sts=sprintf("%d%02d00000000",$_GET["year"],$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);

$max=500;
$type=2;
$rr=0;
$today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 if ($_GET["type"]) $type=$_GET["type"];

 if ($_GET["max"]=='') $max=740;
 else $max=$_GET["max"];

  $query = 'SELECT * FROM data2 WHERE type='.$type.' AND channel='.$_GET["channel"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
  $a = mysql_query ($query,$i);
  if ($a) 
  while ($uy = mysql_fetch_row ($a))
	{
	 $datas0[$rr]=$uy[3];
	 $dats[$rr]=$uy[2]; $rr++;
	 if ($rr>$max) break;
	}
$max=$rr-1;
if ($max<1) break;

for ($i=0; $i<$max; $i++) 
	{ 
	 if ($_GET["type"]==1) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'/'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($_GET["type"]==2) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'-'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 $data0[$i]=$datas0[$max-$i];  
	}

// Create the graph. These two calls are always required
if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(1870,200,"auto");	

$graph->img->SetMargin(35,15,22,22);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);

$graph->tabtitle->Set($_GET["name"].'                     ');
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetWidth(TABTITLE_WIDTHFIT);
$graph->xgrid->Show();
$graph->xgrid->SetColor('gray@0.5');
$graph->ygrid->SetColor('gray@0.5');

$graph->SetScale("textlin");
$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);

// Add the plot to the graph
$graph->Add($lineplot);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
$lineplot->SetColor("red");
$lineplot->SetWeight(2);

$graph->xaxis->SetTickLabels($dat);
//--------------------------------------
// Display the graph
//$graph->xaxis->HideLabels();
$graph->xaxis->SetTextTickInterval(24,0);

JpGraphError::SetImageFlag(false);
try {
     $graph->Stroke();
    }
catch ( JpGraphException $e ) 
	{ }
//$graph->Stroke();
?>                   