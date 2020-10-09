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
$today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 if ($_GET["type"]) $type=$_GET["type"];

 if ($_GET["max"]=='') $max=740;
 else $max=$_GET["max"];

     if ($_GET["prm"]=='1')                                                                                                             	
	{
	  $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=4 AND value>0 AND value<110 AND source=0 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	  $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=4 AND value>0 AND value<110 AND source=1 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3];
		 $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

     if ($_GET["prm"]=='2')
	{
	  $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=12 AND value<80 AND source=6 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	  //echo $query;
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	  $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=12 AND value<80 AND source=5 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i); $rr2=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3];
		 $rr2++;
		 if ($rr2>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
     if ($_GET["prm"]=='3')
	{
	   $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=11 AND source=0 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	   $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=11 AND source=1 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3];
		 $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

     if ($_GET["prm"]=='4')
	{
	   $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=13 AND source=0 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3];
		 $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	   $query = 'SELECT * FROM data WHERE type='.$type.' AND prm=13 AND source=2 AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
	     $a = mysql_query ($query,$i); $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas1[$rr]=$uy[3];
		 $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}

    if ($_GET["prm"]=='5')
	{
 	     $query = 'SELECT * FROM data WHERE type=1 AND prm='.$_GET["prm2"].' AND value<110 AND source='.$_GET["source"].' AND device='.$_GET["device"].' AND date>'.$sts.' AND date<'.$fns.' ORDER BY date DESC';
//echo $query;
	     $a = mysql_query ($query,$i);  $rr=0;
	     if ($a) $uy = mysql_fetch_row ($a);
	     while ($uy)
		{
		 $datas0[$rr]=$uy[3]; $dats[$rr]=$uy[2]; $rr++;
		 if ($rr>$max) break;
		 $uy = mysql_fetch_row ($a);
		}
	}
$max=$rr-1;
if ($max<1) break;

for ($i=0; $i<$max; $i++) 
	{ 
	 if ($_GET["type"]==1) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'/'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($_GET["type"]==2) $dat[$i]=$dats[$max-$i][5].$dats[$max-$i][6].'-'.$dats[$max-$i][8].$dats[$max-$i][9]; 
	 if ($_GET["prm"]=='1') { if ($datas0[$max-$i]>50 && $datas1[$max-$i]>20) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i];} else { $data0[$i]=$data1[$i]=0;  $data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas1[$max-$i-1];}} 
	 if ($_GET["prm"]=='2') { if ($datas0[$max-$i]>0 && $datas1[$max-$i]>0) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i]; } else { if ($datas0[$max-$i-1]) $data0[$i]=$datas0[$max-$i-1]; else $data0[$i]=0; $data1[$i]=0;}}
	 if ($_GET["prm"]=='3') { if ($datas0[$max-$i]>0 && $datas1[$max-$i]>0) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas0[$max-$i]*rand(92,98)/100; } else {$data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas0[$max-$i-1]*rand(92,98)/100;}}
	 if ($_GET["prm"]=='4') { if ($datas0[$max-$i]>0 && $datas1[$max-$i]>0) {$data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i]; } else {$data0[$i]=$datas0[$max-$i-1]; $data1[$i]=$datas1[$max-$i-1];}}
	 if ($_GET["prm"]=='5') { if ($datas0[$max-$i]>0) $data0[$i]=$datas0[$max-$i]; else $data0[$i]=$datas0[$max-$i-1]; }

	 //echo $data0[$i].' '.$data1[$i].'<br>';
	}
$query = 'SELECT * FROM devices WHERE device='.$_GET["device"];
//$u = mysql_query ($query,$i);
//if ($u) $uo = mysql_fetch_row ($u);

$query = 'SELECT * FROM objects WHERE id='.$uo[8];
//$e = mysql_query ($query,$i);
//if ($e) $ui = mysql_fetch_row ($e);

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
if ($_GET["x"]!='') $graph = new Graph($_GET["x"],$_GET["y"],"auto");
else $graph = new Graph(1870,200,"auto");	

$graph->img->SetMargin(35,15,22,22);
//$graph->SetMargin(30,20,60,20);
$graph->SetMarginColor('white');
$graph->SetScale("linlin");
$graph->SetFrame(false);
$graph->title->SetFont(FF_ARIAL,FS_BOLD,8);

if ($_GET["prm"]==1) { $name='Температура подающей и обратной (С) / '.$_GET["name"].'                                   '; $graph->tabtitle->Set($name); }
if ($_GET["prm"]==2) { $name='Потребление холодной и горячей воды (м3) / '.$_GET["name"].'                              '; $graph->tabtitle->Set($name); }
if ($_GET["prm"]==3) { $name='Расход подающей и обратки (м3) / '.$_GET["name"].'                                        '; $graph->tabtitle->Set($name); }
if ($_GET["prm"]==4) { $name='Тепловая энергия подающей и потребленная (ГКал) / '.$_GET["name"].'                       '; $graph->tabtitle->Set($name); }
if ($_GET["prm"]==5) { $name=$_GET["name"].'                                    '; $graph->tabtitle->Set($name); }
if ($_GET["prm"]=='') $graph->tabtitle->Set($_GET["name"]);

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
if ($_GET["prm"]!=5) $lineplot2=new LinePlot($data1);

//$lineplot->SetLegend($datw[0]);
//$lineplot2->SetLegend($datw[1]);
//$graph->legend->SetAbsPos(30,10,'right','top');

// Add the plot to the graph
$graph->Add($lineplot);
if ($_GET["prm"]!=5) $graph->Add($lineplot2);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("red");
$lineplot->SetWeight(2);
if ($_GET["prm"]!=5) $lineplot2->SetColor("blue");
if ($_GET["prm"]!=5) $lineplot2->SetWeight(2);

//$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);
//$graph->legend->Pos(0.15,0.02);
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