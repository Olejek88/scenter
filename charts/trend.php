<?php
include ("../../../jpgraph2/jpgraph.php");
include ("../../../jpgraph2/jpgraph_log.php");
include ("../../../jpgraph2/jpgraph_line.php");
include ("../../../jpgraph2/jpgraph_bar.php");
include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
     if ($_GET["type"]=='1')
	{
 	     $query = 'SELECT * FROM data WHERE type=1 AND prm=4 AND value<110 AND source=0 AND device='.$_GET["device"].' ORDER BY date DESC';
echo $query;
	     $a = mysql_query ($query,$i);  $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3]; $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	     $query = 'SELECT * FROM data WHERE type=1 AND prm=4 AND value<110 AND source=1 AND device='.$_GET["device"].' ORDER BY date DESC';
	     $a = mysql_query ($query,$i);  $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

     if ($_GET["type"]=='2')
	{
	     $query = 'SELECT * FROM data WHERE type=1 AND prm=11 AND value<80 AND source=6 AND device=84606978 ORDER BY date DESC';
	     //echo $query.'<br>';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3]; $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	     $query = 'SELECT * FROM data WHERE type=1 AND prm=11 AND value<80 AND source=5 AND device=84606978 ORDER BY date DESC';
	     //echo $query.'<br>';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

    if ($_GET["type"]=='3')
	{
	     $query = 'SELECT * FROM data WHERE type=1 AND prm=13 AND source=2 AND device='.$_GET["device"].' ORDER BY date DESC';
	     //echo $query.'<br>';                                 
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3]; $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	     $query = 'SELECT * FROM data WHERE type=1 AND prm=13 AND source=0 AND device='.$_GET["device"].' ORDER BY date DESC';
	     //echo $query.'<br>';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

    if ($_GET["type"]=='4')
	{
 	     $query = 'SELECT * FROM data WHERE type=1 AND prm='.$_GET["prm"].' AND value<110 AND source='.$_GET["source"].' AND device='.$_GET["device"].' ORDER BY date DESC';
	     $a = mysql_query ($query,$i);  $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3]; $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

for ($i=0; $i<=$max; $i++) 
	{ 
	 $dat[$i]=$dats[$max-$i]; 

	 if ($_GET["type"]=='1') { if ($datas0[$max-$i]>50 && $datas1[$max-$i]>20) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i];} else {$data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas1[$max-$i-1];}}
	 if ($_GET["type"]=='2') { if ($datas0[$max-$i]>0 && $datas1[$max-$i]>0) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i]; } else {$data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas1[$max-$i-1];}}
	 if ($_GET["type"]=='3') { if ($datas0[$max-$i]>0 && $datas1[$max-$i]>0) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i]; } else {$data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas1[$max-$i-1];}}
	 if ($_GET["type"]=='4') { if ($datas0[$max-$i]>0) $data0[$i]=$datas0[$max-$i]; else $data0[$i]=$datas0[$max-$i-1]; }
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(1100,100,"auto");	
$graph->img->SetMargin(35,15,22,5);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);
$graph->tabtitle->SetFont(FF_ARIAL,FS_BOLD,9);
if ($_GET["type"]==1) $graph->tabtitle->Set('Температура подающей и обратной (С)                 ');
if ($_GET["type"]==2) $graph->tabtitle->Set('Потребление холодной и горячей воды (м3)             ');
if ($_GET["type"]==3) $graph->tabtitle->Set('Потребление тепловой энергии (ГКал)             ');
if ($_GET["type"]==4) $graph->tabtitle->Set($_GET["name"]);

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
if ($_GET["type"]<4) $lineplot2=new LinePlot($data1);

//$lineplot->SetLegend($datw[0]);
//$lineplot2->SetLegend($datw[1]);
//$graph->legend->SetAbsPos(30,10,'right','top');

// Add the plot to the graph
$graph->Add($lineplot);
if ($_GET["type"]<4) $graph->Add($lineplot2);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("red");
$lineplot->SetWeight(2);
if ($_GET["type"]<4) $lineplot2->SetColor("blue");
if ($_GET["type"]<4) $lineplot2->SetWeight(2);

//$graph->yaxis->SetWeight(1);
//$graph->xaxis->SetTickLabels($dat);
//$graph->legend->Pos(0.15,0.02);
//--------------------------------------
// Display the graph
$graph->xaxis->HideLabels();
try {
     $graph->Stroke();
    }
catch ( JpGraphException $e ) 
	{ }
?>                   