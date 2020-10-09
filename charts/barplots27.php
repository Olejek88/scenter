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
 $sts=sprintf("20100101000000",$today["year"]); $fns=sprintf("20101001000000",$today["year"]);

 $query = 'SELECT id,nab,square FROM objects';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $id=$uy[0];
	 $nab=$uy[1];
	 $ssquare=$uy[2];
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $e = mysql_query ($query,$i); 
	 if ($e) $ui = mysql_fetch_row ($e);  
	 if ($ui[1]>30) { $udels1+=$ui[0]/$ssquare; $ccn1++; }

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
	 $e = mysql_query ($query,$i); 
	 if ($e) $ui = mysql_fetch_row ($e);  
	 if ($ui[1]>30) { $udels2+=$ui[0]/$nab; $ccn2++; }

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND type=2 AND prm=12 AND source=5 AND value>0.1 AND device='.$uo[11];
	 $e = mysql_query ($query,$i); 
	 if ($e) $ui = mysql_fetch_row ($e);  
	 if ($ui[1]>30) { $udels3+=$ui[0]/$nab; $ccn3++; }

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];
	 $e = mysql_query ($query,$i); 
	 if ($e) $ui = mysql_fetch_row ($e);  
	 if ($ui[1]>30) { $udels4+=$ui[0]/$nab; $ccn4++; }

	 $uy = mysql_fetch_row ($a);  
	}
 //echo $udels1.' '.$udels2.' '.$udels3.' '.$udels4.'<br>';
 //echo $ccn1.' '.$ccn2.' '.$ccn3.' '.$ccn4;
 $udels1=$udels1/$ccn1; 
 $udels2=$udels2/$ccn2; 
 $udels3=$udels3/$ccn3; 
 $udels4=$udels4/$ccn4; 

 $query = 'SELECT * FROM objects';
 $a = mysql_query ($query,$i); $ccn=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $square=$uy[14];
	 $nab=$uy[15];
	 if ($_GET["n1"]==13) $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 if ($_GET["n1"]==8) $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
	 if ($_GET["n1"]==6) $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND type=2 AND prm=12 AND source=5 AND value>0.1 AND device='.$uo[11];
	 if ($_GET["n1"]==2) $query = 'SELECT SUM(value) FROM data WHERE date>='.$sts.' AND type=2 AND prm=14 AND value>0.1 AND device='.$uo[11];
//	echo $query;
	 $e = mysql_query ($query,$i); 
	 if ($e) $ui = mysql_fetch_row ($e); 

	 if ($_GET["n1"]==13) if ($square) $ud[$ccn]=$ui[0]/$square;
	 if ($_GET["n1"]==8) if ($nab) $ud[$ccn]=$ui[0]/$nab;
	 if ($_GET["n1"]==6) if ($nab) $ud[$ccn]=$ui[0]/$nab;
	 if ($_GET["n1"]==2) if ($nab) $ud[$ccn]=$ui[0]/$nab;
//	echo $ud[$ccn];

	 if ($_GET["n1"]==13) $norm[$ccn]=0.0322;
	 if ($_GET["n1"]==8) $norm[$ccn]=5.4;
	 if ($_GET["n1"]==6) $norm[$ccn]=3.6;
	 if ($_GET["n1"]==2) $norm[$ccn]=130;

	 $name[$ccn]=$uy[0];
	 //$udel[$ccn]=$udels;
	 //if ($_GET["n1"]==13) $udel[$ccn]=$udels1;
	 //if ($_GET["n1"]==8) $udel[$ccn]=$udels2;
	 //if ($_GET["n1"]==6) $udel[$ccn]=$udels3;
	 //if ($_GET["n1"]==2) $udel[$ccn]=$udels4;
	 $udel[$ccn]=0.03;

	 $ccn++;
	 $uy = mysql_fetch_row ($a);
	}

$graph = new Graph(700,250,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$lineplot=new BarPlot($ud);
$lineplot->SetFillColor("red");
$lineplot2=new BarPlot($norm);
$lineplot2->SetFillColor("blue");
$gbplot  = new GroupBarPlot (array($lineplot ,$lineplot2)); 
$graph->Add($gbplot);

$lineplot3=new LinePlot($udel);
$lineplot3->SetColor("red");
$graph->Add($lineplot3);

$graph->xaxis->SetTickLabels($name);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');

$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
if ($_GET["n1"]==2) $graph->title->Set("Потребление электроэнергии (кВт)");
if ($_GET["n1"]==8) $graph->title->Set("Потребление холодной воды (м3)");
if ($_GET["n1"]==6) $graph->title->Set("Потребление горячей воды (м3)");
if ($_GET["n1"]==13) $graph->title->Set("Потребление тепловой энергии (ГКал)");

// Add the plot to the graph
$graph->img->SetMargin(38,8,33,25);
//----------- title --------------------
$lineplot2->value->Show();
$lineplot->value->Show();

$name='Удельное потребление     ';
$name2='Нормативное потребление     ';
$name3='Среднее значение    ';

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($name);
$lineplot2->SetLegend($name2);
$lineplot3->SetLegend($name3);

$gbplot->SetWidth(0.7);
//----------- legend -------------------
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);
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