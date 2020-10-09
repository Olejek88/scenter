<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once  ("../../../jpgraph2/jpgraph_bar.php");
require_once  ("../../../jpgraph2/jpgraph_line.php");
include("../config/local.php");
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);

$query = 'SELECT * FROM devices WHERE object='.$_GET["obj"];
$y = mysql_query ($query,$i);
if ($y) $uo = mysql_fetch_row ($y);
$dev=$uo[11];

$today=getdate();
if ($_GET["year"]=='') $ye=$today["year"];
else $ye=$_GET["year"];
if ($_GET["month"]=='') $mn=$today["mon"];
else $mn=$_GET["month"];
$x=0; $tm=$dy=$today["mday"];
for ($tn=1; $tn<=130; $tn++)
{		
 $date1[$x]=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
 $date2[$x]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
 $dats[$x]=sprintf ("%02d-%02d-%d",$mn,$tm,$ye);
 $x++; $tm--;
 if ($tm==0)
	{
	 $mn--;
	 if ($mn==0) { $mn=12; $ye--; }
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
		$tm=$dy;
	 }
}
$max=$x;
			     
$query = 'SELECT * FROM data WHERE type=2 AND prm=4 AND (device='.$dev.' OR device=0)';
//echo $query;
$aa = mysql_query ($query,$i);
if ($aa) $uy = mysql_fetch_row ($aa); $x=0;
while ($uy)
      {      
//       echo $uy[8].' '.$uy[6].'<br>'; 
	for ($t=0;$t<$max;$t++)
	if ($date2[$t]==$uy[2]) $x=$t;	  

       if ($uy[8]==4 && $uy[6]==0) $datas5[$x]=$uy[3];
       if ($uy[8]==4 && $uy[6]==1) $datas6[$x]=$uy[3];
       if ($uy[8]==4 && $uy[6]==10 && $uy[4]==0) $datas7[$x]=$uy[3];
       $uy = mysql_fetch_row ($aa);	     
      }

$max--;
for ($i=0; $i<=$max; $i++) 
	{ 
	 $x=$i;	
          $datas7[$x]=number_format($datas7[$x],0);
          if ($datas7[$x]<=-24) { $datas8[$x]=93; $datas9[$x]=76; }
          if ($datas7[$x]==-23) { $datas8[$x]=92; $datas9[$x]=75; }
          if ($datas7[$x]==-22) { $datas8[$x]=91; $datas9[$x]=74; }
          if ($datas7[$x]==-21) { $datas8[$x]=90; $datas9[$x]=73; }
          if ($datas7[$x]==-20) { $datas8[$x]=88; $datas9[$x]=72; }
          if ($datas7[$x]==-19) { $datas8[$x]=87; $datas9[$x]=71; }
          if ($datas7[$x]==-18) { $datas8[$x]=86; $datas9[$x]=70; }
          if ($datas7[$x]==-17) { $datas8[$x]=84; $datas9[$x]=69; }
          if ($datas7[$x]==-16) { $datas8[$x]=83; $datas9[$x]=68; }
          if ($datas7[$x]==-15) { $datas8[$x]=81; $datas9[$x]=67; }
          if ($datas7[$x]==-14) { $datas8[$x]=80; $datas9[$x]=66; }
          if ($datas7[$x]==-13) { $datas8[$x]=79; $datas9[$x]=65; }
          if ($datas7[$x]==-12) { $datas8[$x]=77; $datas9[$x]=64; }
          if ($datas7[$x]==-11) { $datas8[$x]=76; $datas9[$x]=63; }
          if ($datas7[$x]==-10) { $datas8[$x]=74; $datas9[$x]=61; }
          if ($datas7[$x]==-9) { $datas8[$x]=73; $datas9[$x]=60; }
          if ($datas7[$x]==-8) { $datas8[$x]=71; $datas9[$x]=59; }
          if ($datas7[$x]==-7) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-6) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-5) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-4) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-3) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-2) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==-1) { $datas8[$x]=70; $datas9[$x]=60; }
          if ($datas7[$x]==0) { $datas8[$x]=70; $datas9[$x]=61; }
          if ($datas7[$x]==1) { $datas8[$x]=70; $datas9[$x]=61; }
          if ($datas7[$x]==2) { $datas8[$x]=70; $datas9[$x]=61; }
          if ($datas7[$x]==3) { $datas8[$x]=70; $datas9[$x]=61; }
          if ($datas7[$x]==4) { $datas8[$x]=70; $datas9[$x]=61; }
         if ($datas7[$x]==5) { $datas8[$x]=70; $datas9[$x]=61; }
         if ($datas7[$x]>=6) { $datas8[$x]=70; $datas9[$x]=62; }
	$datas8[$x]-=10; //$datas9[$x]-=10;
}

for ($i=0; $i<=$max; $i++) 
	{ 

	 $dat[$i]=$dats[$max-$i]; 
	 if ($_GET["type"]=='1') { $data0[$i]=$datas0[$max-$i]; $data1[$i]=$datas1[$max-$i]; }
	 if ($_GET["type"]=='2') { $data0[$i]=$datas2[$max-$i]; $data1[$i]=$datas3[$max-$i]; }
	 if ($_GET["type"]=='3') { $data0[$i]=$datas5[$max-$i]; $data1[$i]=$datas8[$max-$i]; }
	 if ($_GET["type"]=='4') { $data0[$i]=$datas6[$max-$i]; $data1[$i]=$datas9[$max-$i]; }
	 if ($_GET["type"]=='5') { $data2[$i]=$datas6[$max-$i]; $data1[$i]=$datas8[$max-$i]; $data0[$i]=$datas9[$max-$i]; }
//	 echo $i.' '.$dat[$i].' '.$data0[$i].' '.$data1[$i].'<br>';
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(1200,300,"auto");	
$graph->img->SetMargin(50,15,5,30);

//$lineplot3=new BarPlot($data2);
//$lineplot3->SetFillColor("green");

if ($_GET["type"]=='1') $graph->SetScale("textlin",0,70);
if ($_GET["type"]=='2') $graph->SetScale("textlin");
if ($_GET["type"]=='3') $graph->SetScale("textlin",0,110);
if ($_GET["type"]=='4') $graph->SetScale("textlin",0,85);
if ($_GET["type"]=='5') $graph->SetScale("textlin");

$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Create the linear plot
$lineplot=new LinePlot($data0);
$lineplot2=new LinePlot($data1);

if ($_GET["type"]=='1') { $datw[0]='Фактическая температура горячей воды'; $datw[1]='Нормативное значение температуры горячей воды     '; }
if ($_GET["type"]=='2') { $datw[0]='Удельный расход тепловой энергии на подготовку ГВС     '; $datw[1]='Нормативное значение'; }
if ($_GET["type"]=='3') { $datw[0]='Фактическая температура подающей на входе           '; $datw[1]='Расчетное значение'; }
if ($_GET["type"]=='4') { $datw[0]='Фактическая температура обратной на входе           '; $datw[1]='Расчетное значение'; }
if ($_GET["type"]=='5') { $datw[1]='Нормативное значение'; $datw[2]='Фактический расход тепловой энергии     '; $datw[0]='Проектное значение     '; }

$graph->legend->SetFont(FF_ARIAL,FS_NORMAL,9);

$lineplot->SetLegend($datw[0]);
$lineplot2->SetLegend($datw[1]);
if ($_GET["type"]=='5') { $lineplot3->SetLegend($datw[2]); }
//$lineplot3->SetLegend($datw[2]);

$graph->legend->SetAbsPos(70,10,'right','top');

// Add the plot to the graph
$graph->Add($lineplot2);
//if ($_GET["type"]!='5') 
$graph->Add($lineplot);
//else 
if ($_GET["type"]=='5') $graph->Add($lineplot3);

$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
//$graph->xaxis->SetLabelAngle(45);
$lineplot->SetColor("blue");
$lineplot->SetWeight(2);
$lineplot2->SetColor("red");
$lineplot2->SetWeight(2);


$graph->yaxis->SetWeight(1);
$graph->xaxis->SetTickLabels($dat);
$graph->xaxis->SetTextTickInterval(7,0);

$graph->legend->Pos(0.15,0.02);
//--------------------------------------
// Display the graph
$graph->Stroke();
?>