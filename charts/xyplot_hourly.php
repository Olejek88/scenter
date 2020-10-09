<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once  ("../../../jpgraph2/jpgraph_line.php");
include("../config/local.php");

$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$today=getdate();
$graph = new Graph(800,520,"auto");
$graph->img->SetMargin(40,30,75,30);

if ($_GET["type"]==2) $graph->SetScale("textlin",0.0,3.5);
if ($_GET["type"]==1) $graph->SetScale("textlin",0.0,0.2);

$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

//--------------------------------------------------------------------------------------------------
if ($_GET["type"]=='') $_GET["type"]='1';
if ($_GET["types"]=='') $_GET["types"]='3';

 $query = 'SELECT * FROM objects WHERE type='.$_GET["types"];
 $a = mysql_query ($query,$i); $ccn=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
//	 if (strstr($uy[1],"93") || strstr($uy[1],"4") || strstr($uy[1],"24") || strstr($uy[1],"95") || strstr($uy[1],"84") || strstr($uy[1],"77") || strstr($uy[1],"96")  || strstr($uy[1],"73")) 
	 if (0)
		{
		 $uy = mysql_fetch_row ($a); 
		 continue;
		}
	 $query = 'SELECT nab,square FROM objects WHERE id='.$uy[0];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $sum1=$uy2[0]; $sum2=$uy2[1];

	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);

	 $obj[$ccn]=$uy[1];

	 if ($_GET["type"]=='1')
	 for ($hr=0;$hr<=23;$hr++)
		 {
		  if ($hr<10) $date1='%0'.$hr.':00:00%'; else $date1='%'.$hr.':00:00%';
		  $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE device='.$uo[11].' AND type=1 AND prm=13 AND source=2 AND value<10 AND date<20110501000000 AND date>20110401000000 AND date LIKE \''.$date1.'\'';  
		  $b = mysql_query ($query,$i);
		  if ($b) $uu = mysql_fetch_row ($b);
		  if ($uu[1]) $data[$ccn][$hr]=$uu[0]/$uu[1];  
//echo $ccn.'/'.$hr.' '.$data[$ccn][$hr].'<br>';
		  $dat[$hr]=$hr.':00';
		 }
         if ($_GET["type"]=='2')
	 for ($hr=0;$hr<=6;$hr++)
		 {
		  $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE device='.$uo[11].' AND type=2 AND prm=13 AND source=2 AND value<50 AND date<20110501000000 AND date>20110401000000 AND WEEKDAY(date)='.$hr;
		  $b = mysql_query ($query,$i);
		  if ($b) $uu = mysql_fetch_row ($b);
		  if ($uu[1]) $data[$ccn][$hr]=$uu[0]/$uu[1];
		  if ($hr==0) $dat[$hr]='понедельник';
		  if ($hr==1) $dat[$hr]='вторник';
		  if ($hr==2) $dat[$hr]='среда';
		  if ($hr==3) $dat[$hr]='четверг';
		  if ($hr==4) $dat[$hr]='пятница';
		  if ($hr==5) $dat[$hr]='суббота';
		  if ($hr==6) $dat[$hr]='воскресенье';
		 }
	 $lineplot[$ccn]=new LinePlot($data[$ccn]);
	 $lineplot[$ccn]->SetLegend($obj[$ccn]);
	 $graph->Add($lineplot[$ccn]);
	 $lineplot[$ccn]->SetWeight(2);
	 $ccn++;
	 $uy = mysql_fetch_row ($a); 
	}
//--------------------------------------------------------------------------------------------------
$graph->xaxis->SetTickLabels($dat);
$graph->yaxis->HideZeroLabel();
$graph->SetMarginColor('lavender');
//$lineplot->SetShadow();
//$lineplot->value->Show();
//$lineplot->value->SetFont(FF_ARIAL,FS_NORMAL,7); 
//$lineplot->value->SetFormat('%.3f');

// Add the plot to the graph
//$graph->img->SetMargin(5,10,10,25);
//----------- title --------------------
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,8);
$graph->legend->SetLayout(LEGEND_HOR);
$graph->legend->Pos(0.02,0.02,"left","top");
$graph->legend->SetColumns(4);
//----------- legend -------------------
$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->SetFont(FF_ARIAL,FS_NORMAL,7); 
// Display the graph
$graph->Stroke();
?>