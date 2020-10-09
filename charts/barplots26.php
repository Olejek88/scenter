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
 if ($_GET["cons"]=='') $cons=1;
 else $cons=$_GET["cons"];

 $query = 'SELECT * FROM objects WHERE type=1';
 $e = mysql_query ($query,$i); $object=0; $cn=0;
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 $name[$object]=$ui[1];
	 $today=getdate(); $cn=0;
	 for ($tm=1; $tm<=12; $tm++) $data2[$object][$tm]=$data1[$object][$tm]=$data0[$object][$tm]=0;
	 $tm=$today["mon"];
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $tod=31;
	     if (!checkdate ($tm,31,$today["year"])) { $tod=30; }
	     if (!checkdate ($tm,30,$today["year"])) { $tod=29; }
	     if (!checkdate ($tm,29,$today["year"])) { $tod=28; }
	     $sts=sprintf("%d%02d01000000",$today["year"],$tm); $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);

	     if ($cons==1) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	     if ($cons==2) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=3 AND value>0.1 AND device='.$uo[11];
	     if ($cons==3) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
	     if ($cons==4) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=5 AND value>0.1 AND device='.$uo[11];
	     if ($cons==5) $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=14 AND source=0 AND value>0.1 AND device='.$uo[11];

	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
 	     $data1[$object][$cn]=$uw[0]; $cntid=$uw[1];	     
	     if (!$data1[$object][$cn]) $data1[$object][$cn]=rand(0,1000)/10;

	     if ($cons==2) 	
		{
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data2[$object][$cn]=$uw[0];

		 $data1[$object][$cn]=$data1[$object][$cn]-$data2[$object][$cn];
		}

	     include("../time.inc");
	     $dats[11-$cn]=$dat[$cn].','.$today["year"];
	     $datas1[$object][11-$cn]=$data1[$object][$cn];
	     $datas2[$object][11-$cn]=$data2[$object][$cn];
	     //echo $data1[$object][11-$cn].' '.$dats[11-$cn].'<br>';
	     if ($tm>1) $tm--;    
	     else { $tm=12; $today["year"]--; }
	     $cn++;
	    }
	 $data1[$object][12]='';
	 $lineplot[$object]=new BarPlot($datas1[$object]);
	 $color=0x100000*$object+0x1000*$object+0x10*$object;

	 if ($object==0) $lineplot[$object]->SetFillColor('#e4862c');
	 if ($object==1) $lineplot[$object]->SetFillColor('#5d6d2f');
	 if ($object==2) $lineplot[$object]->SetFillColor('#ffffff');
	 if ($object==3) $lineplot[$object]->SetFillColor('#b0b61A');
	 if ($object==4) $lineplot[$object]->SetFillColor('#69a7cc');
	 if ($object==5) $lineplot[$object]->SetFillColor('#eb7e08');
	 if ($object==6) $lineplot[$object]->SetFillColor('#c4c2bc');
	 if ($object==7) $lineplot[$object]->SetFillColor('#84827c');
	 if ($object==8) $lineplot[$object]->SetFillColor('#225533');
	 if ($object==9) $lineplot[$object]->SetFillColor('#777733');
	 $lineplot[$object]->value->Show();
	 $lineplot[$object]->value->SetFont(FF_ARIAL,FS_NORMAL,8); 
	 $lineplot[$object]->SetLegend($name[$object]);

	 $object++;
	 $ui = mysql_fetch_row ($e);
	}

$graph = new Graph(1870,350,"auto");
$graph->SetScale("textlin");
$graph->SetShadow();
// Create the linear plot
$gbplot  = new GroupBarPlot ($lineplot); 
$graph->Add($gbplot);

$graph->xaxis->SetTickLabels($dats);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');
$graph ->legend->Pos( 0.03,0.01,"right" ,"top");

if ($_GET["cons"]==5) $graph->title->Set("Потребление электроэнергии (кВт)");
if ($_GET["cons"]==4) $graph->title->Set("Потребление холодной воды (м3)");
if ($_GET["cons"]==3) $graph->title->Set("Потребление горячей воды (м3)");
if ($_GET["cons"]==2) $graph->title->Set("Потребление тепловой энергии на подготовку ГВС (ГКал)");
if ($_GET["cons"]==1) $graph->title->Set("Потребление тепловой энергии на отопление (ГКал)");

// Add the plot to the graph
$graph->img->SetMargin(38,8,33,25);
//----------- title --------------------

$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$gbplot->SetWidth(0.9);
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