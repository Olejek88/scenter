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
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
if ($_GET["month"]=='') $_GET["month"]=$today["mon"]-1;

$sts=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]);
$fns=sprintf("%d%02d01000000",$_GET["year"],$_GET["month"]+1);

if ($_GET["year"]=='') $ye=$today["year"];
else $ye=$_GET["year"];
if ($_GET["month"]=='') $mn=$today["mon"];
else $mn=$_GET["month"];
$tm=$dy=31; $x=0;
if (!checkdate ($mn,31,$ye)) { $dy=30; }
if (!checkdate ($mn,30,$ye)) { $dy=29; }
if (!checkdate ($mn,29,$ye)) { $dy=28; }
$tm=$dy;

for ($tn=1; $tn<=$dy; $tn++)
{		
 $date1[$x]=sprintf ("%d%02d%02d000000",$ye,$mn,$tm);
 $date2[$x]=sprintf ("%d-%02d-%02d 00:00:00",$ye,$mn,$tm);
 $dats[$x]=sprintf ("%02d-%02d-%d",$mn,$tm,$ye);
 $x++; $tm--;
}
$max=$x;
			     
$query = 'SELECT * FROM data WHERE type=2 AND date>='.$sts.' AND date<'.$fns.' AND (device='.$dev.' OR device=0)';
//echo $query;
$aa = mysql_query ($query,$i);
if ($aa) $uy = mysql_fetch_row ($aa); $x=0;
while ($uy)
      {      
       //echo $uy[8].' '.$uy[6].'<br>'; 
	for ($t=0;$t<$max;$t++)
	if ($date2[$t]==$uy[2]) $x=$t;	  

	if ($uy[8]==13 && $uy[6]==0) $datas4[$x]=$uy[3];
       if ($uy[8]==4 && $uy[6]==0) $datas5[$x]=$uy[3];
       if ($uy[8]==4 && $uy[6]==1) $datas6[$x]=$uy[3];
       if ($uy[8]==4 && $uy[6]==10 && $uy[4]==0) $datas7[$x]=$uy[3];
       $uy = mysql_fetch_row ($aa);	     
      }
 //echo $x.' '.$datas5[$x].' '.$datas6[$x].' '.$datas7[$x].'<br>';

$max--;
for ($i=0; $i<=$max; $i++) 
	{ 
	 $x=$i;
	  //$datas8[$x]=$datas9[$x]=0;
          $datas7[$x]=number_format($datas7[$x],0);

	  //if ($i>0) { $datas8[$x]=$datas8[$x-1]+10; $datas9[$x]=$datas9[$x-1]; }
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
 	 //$datas8[$x]-=10;
	 //$datas9[$x]-=10;
	 $dd=$datas8[$x]-$datas8[$x]*0.05;
	 $df=$datas9[$x]+$datas9[$x]*0.05;
//	 echo $datas5[$x].' '.$dd.'<br>';
	 if ($datas5[$x]<$dd) $datas4[$x]=$datas4[$x];
	 else if ($datas6[$x]>$df) $datas4[$x]=$datas4[$x];
	 else $datas4[$x]=0;
}
$x=0;
for ($i=0; $i<=$max; $i++) 
	{ 
	 $dat[$i]=$dats[$max-$i]; 
	 $data0[$i]=$datas4[$max-$i];
	 if ($datas5[$i]<40) $data0[$i]=0;
	 $sum+=$data0[$i];
	 //echo $i.' '.$data0[$i].' '.$data1[$i].'<br>';
	}

//for ($i=0; $i<31; $i++) print $dat[$i].' '.$data0[$i];
// Create the graph. These two calls are always required
$graph = new Graph(1200,300,"auto");	
$graph->img->SetMargin(50,15,5,30);

$lineplot=new BarPlot($data0);
$lineplot->SetFillColor("blue");

$ddd='Некачественно поставленное тепло'.$sum;
$graph ->legend->Pos( 0.03,0.01,"right" ,"top");
$lineplot->SetLegend($sum);

$graph->SetScale("textlin");
$graph->SetShadow();

$graph->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->yaxis->title->SetFont(FF_ARIAL,FS_BOLD);
$graph->xaxis->title->SetFont(FF_ARIAL,FS_BOLD);

// Add the plot to the graph
$graph->Add($lineplot);
$graph->SetMarginColor('white');
$graph->ygrid->SetFill(true,'#EFEFEF@0.5','#BBCCFF@0.5');
//----------- legend -------------------
$graph->xaxis->SetTickLabels($dat);
$graph->xaxis->SetTextTickInterval(7,0);

// Display the graph
$graph->Stroke();
?>