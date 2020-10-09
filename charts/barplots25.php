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
 $query = 'SELECT * FROM objects WHERE id='.$_GET["obj"];
 $e = mysql_query ($query,$i); $object=0; $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT nab,square FROM objects WHERE id='.$_GET["obj"];
	 $a = mysql_query ($query,$i);
	 if ($a) $uy = mysql_fetch_row ($a);  
	 $sum1=$uy[1]; $sum2=$uy[0];

	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 $name[$object]=$ui[1];
	 $today=getdate(); $cn=0;  $year=$today["year"]=2012;
	 for ($tm=1; $tm<=6; $tm++) $data2[$tm]=$data1[$tm]=$data0[$tm]=0;
	 $tm=$today["mon"];
	 for ($pm=1; $pm<=6; $pm++)
	    {	 
	     $tod=31;
	     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
	     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
	     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
	     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);

	     if ($_GET["type"]==1) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=0 AND device='.$uo[11];
	     if ($_GET["type"]==2) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND device='.$uo[11];
//echo $query;
	     $w = mysql_query ($query,$i); 
	     if ($w) $uw = mysql_fetch_row ($w); 
 	     if ($uw) $data1[$cn]=$uw[0]; else $data1[$cn]=0;
	     if ($uw) $cntid=$uw[1]; else $cntid=0;


	     if ($_GET["type"]==1) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND device='.$uo[11];
	     $w = mysql_query ($query,$i); 
	     if ($w) $uw = mysql_fetch_row ($w); 
 	     if ($uw && $data1[$cn]>$uw[0]) $data1[$cn]=$uw[0];
//	     if ($uw) $cntid=$uw[1]; else $cntid=0;

	     $sts=sprintf("%d%02d01000000",$year,$tm); $fns=sprintf("%d%02d01000000",$year,$tm+1);
	     $query = 'SELECT value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=12 AND value<2000 AND device='.$uo[11];
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     if ($uw) 
		{
		 if ($pm==1) $data2[$cn]=$uw[0]*$today["mday"]/31;
		 else $data2[$cn]=$uw[0];
		}
	     //if ($_GET["type"]==1) $data2[$cn]=$sum1*(0.0322/30)*$cntid;
	     //if ($_GET["type"]==2) $data2[$cn]=$sum2*(5.4/30)*$cntid;
	     //if (!$data1[$cn]) $data1[$cn]=rand(0,1000)/10;
	     //echo $data1[$cn].'<br>';
	     include("../time.inc");
	     $dats2[$cn]=$dat[$cn].','.$today["year"];
	     //$datas1[$object][$cn]=$data1[$cn];
	     //$datas2[$object][$cn]=$data2[$cn];
	     //echo $data1[$object][$cn].' '.$dats[11-$cn].'<br>';
	     if ($tm>1) $tm--;    
	     else { $tm=12; $today["year"]--; }
	     $cn++;
	    }
	 $ui = mysql_fetch_row ($e);
	}
$cm=$cn-1;
for ($rr=0; $rr<$cm; $rr++) 
	{ 
	 $datas2[$cm-$rr-1]=$data2[$rr]; 
	 $datas1[$cm-$rr-1]=$data1[$rr]; 
//echo $datas1[$cm-$rr-1].' '.$datas2[$cm-$rr-1].'<br>';
	 $dats[$cm-$rr-1]=$dats2[$rr];
	}

$graph = new Graph(800,250,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($datas1);
$lineplot->SetFillColor("red");
$lineplot2=new BarPlot($datas2);
$lineplot2->SetFillColor("blue");
$gbplot  = new GroupBarPlot (array($lineplot ,$lineplot2)); 
$graph->Add($gbplot);

$lineplot->SetWidth(0.8);
$lineplot2->SetWidth(0.8);

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["type"]==4) $graph->title->Set("Потребление электроэнергии (кВт)");
if ($_GET["type"]==2) $graph->title->Set("Потребление холодной воды (м3)");
if ($_GET["type"]==3) $graph->title->Set("Потребление горячей воды (м3)");
if ($_GET["type"]==1) $graph->title->Set("Потребление тепловой энергии (ГКал)");

// Add the plot to the graph
$graph->img->SetMargin(38,8,33,25);
//----------- title --------------------
$lineplot2->value->Show();
$lineplot->value->Show();

$name='Потребление     ';
$name2='Нормативное потребление     ';

$graph ->legend->Pos( 0.03,0.01,"left" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);

$gbplot->SetWidth(0.8);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,8); 

// Display the graph
//try {
     $graph->Stroke();
//    }
//catch ( JpGraphException $e ) 
//	{ echo 'ss'; }
?>