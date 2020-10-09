<?php
require_once ("../../../jpgraph2/jpgraph.php");
require_once  ("../../../jpgraph2/jpgraph_log.php");
require_once ("../../../jpgraph2/jpgraph_gantt.php");

  // функция превода текста с кириллицы в траскрипт
  function encodestring($st)
  {
    // Сначала заменяем "односимвольные" фонемы.
    $st=strtr($st,"абвгдеёзийклмнопрстуфхъыэ_",
    "abvgdeeziyklmnoprstufh'iei");
    $st=strtr($st,"АБВГДЕЁЗИЙКЛМНОПРСТУФХЪЫЭ_",
    "ABVGDEEZIYKLMNOPRSTUFH'IEI");
    // Затем - "многосимвольные".
    $st=strtr($st, 
                    array(
                        "ж"=>"zh", "ц"=>"ts", "ч"=>"ch", "ш"=>"sh", 
                        "щ"=>"shch","ь"=>"", "ю"=>"yu", "я"=>"ya",
                        "Ж"=>"ZH", "Ц"=>"TS", "Ч"=>"CH", "Ш"=>"SH", 
                        "Щ"=>"SHCH","Ь"=>"", "Ю"=>"YU", "Я"=>"YA",
                        "ї"=>"i", "Ї"=>"Yi", "є"=>"ie", "Є"=>"Ye"
                        )
             );
    // Возвращаем результат.
    return $st;
  }

include("../config/local.php");
$arr = get_defined_vars();
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);

$today=getdate();
if ($_GET["year"]=='') $ye=$today["year"];
else $ye=$_GET["year"];
if ($_GET["month"]=='') $mn=$today["mon"];
else $mn=$_GET["month"];
$x=0; $tm=$dy=$today["mday"]-1;

 $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i); $obj=0;
// echo $query;

 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
 while ($ui2)
	{
	 $name[$obj]=$ui2["name"];
	 //echo $name[$obj].'<br>';
	 $query = 'SELECT * FROM uprav WHERE id='.$ui2["type"];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 if ($uo) $uprav=$uo[1];
	 
	 $query = 'SELECT * FROM devices WHERE object='.$ui2["id"];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);

	 for ($mon=1;$mon<=12;$mon++)
	 for ($day=1;$day<=31;$day++)
		$hours[$obj][$mon][$day]=0;
	 $dev[$obj]=$uo[11];

	 $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC); $obj++;
	}
 $objects=$obj;
 for ($obj=0;$obj<$objects;$obj++)
 for ($day=1;$day<=365;$day++)
	{
 	 $hr[$obj]=0;
	 $hour[$obj][$day]=0;		
	}
 $query = 'SELECT * FROM data WHERE type=1 AND value=0 AND (prm=16 OR prm=13) AND date>=20110101000000 AND source=2';
//echo $query;
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);	
 while ($ui) 
	{
	 for ($obj=0;$obj<$objects;$obj++)
		if ($dev[$obj]==$ui[4])
			{
			 $mon=$ui[2][5]*10+$ui[2][6];
	                 $day=$ui[2][8]*10+$ui[2][9];
			 //echo $mon.' '.$day.' '.$ui[8].'<br>';
			 if ($ui[8]==16) { $hours[$obj][$mon][$day]++; $smon[$obj]++; //echo $obj.' '.$mon.' '.$day.' '.$smon[$obj].'<br>'; 
			}
			 if ($ui[8]==13) { $hours2[$obj][$mon][$day]++; $smon2[$obj]++; }
			}
	 $ui = mysql_fetch_row ($e);
	}       
 $today=getdate();
 $currday=$today["yday"];
 $ye=$today["year"];
// echo $currday;

 for ($obj=0;$obj<$objects;$obj++)
// for ($obj=0;$obj<1;$obj++)
 for ($mon=1;$mon<=12;$mon++)
	{
	 $dy=31;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
	 for ($day=1;$day<=$dy;$day++)
		{
  		 $today=getdate(gmmktime (0, 0, 0, $mon, $day, $ye));
		 $date1=sprintf ("%d%02d%02d000000",$ye,$mon,$day);
		 //$dat[69-$x]=sprintf ("%02d-%02d-%d",$tm,$mn,$ye);
		 $days=$today["yday"];
		 //echo $obj.' '.$days.' '.$hours[$obj][$mon][$day].'<br>';
		 $dats[$days]=sprintf ("%d-%02d-%02d",$ye,$mon,$day);
		 //echo $dats[$currday-$days].'<br>';	
		 if ($hours[$obj][$mon][$day]>0) { $hour[$obj][$days]=1; $hr[$obj]++; }
		 //echo $dats[$currday-$days].' '.$hours[$obj][$mon][$day].' '.$hour[$obj][$days].'<br>';			 
		}
	}
//for ($obj=0; $obj<$objects; $obj++)
//for ($day=0; $day<$currday; $day++)
//	$hour[$obj][$day]=$hourr[$obj][$currday-$day-1];
	//echo $obj.'|'.$day.' '.$hour[$obj][$day].'<br>';

$graph = new GanttGraph(1600);
$graph->SetShadow();
 
// Add title and subtitle
$graph->title->Set("Перерывы энергоснабжения по всем объектам");
$graph->title->SetFont(FF_ARIAL,FS_BOLD,12);
 
// Show day, week and month scale
$graph->ShowHeaders(GANTT_HDAY | GANTT_HWEEK | GANTT_HMONTH);
 
// Instead of week number show the date for the first day in the week
// on the week scale
$graph->scale->week->SetStyle(WEEKSTYLE_FIRSTDAY);
 
// Make the week scale font smaller than the default
$graph->scale->week->SetFont(FF_FONT0);
 
// Use the short name of the month together with a 2 digit year
// on the month scale
$graph->scale->month->SetStyle(MONTHSTYLE_SHORTNAMEYEAR4);
$graph->scale->month->SetFontColor("white");
$graph->scale->month->SetBackgroundColor("#FFCF68");
 
// 0 % vertical label margin
$graph->SetLabelVMarginFactor(1); // 1=default value

// Setup some "very" nonstandard colors
$graph->SetMarginColor('lightgreen@0.8');
$graph->SetBox(true,'yellow:0.6',2);
$graph->SetFrame(true,'darkgreen',4);
$graph->scale->divider->SetColor('yellow:0.6');
$graph->scale->dividerh->SetColor('yellow:0.6');
 

// Setup activity info
// For the titles we also add a minimum width of 100 pixels for the Task name column
$graph->scale->actinfo->SetColTitles(array('N','Stat','%'),array(20,115,55));
$graph->scale->actinfo->SetBackgroundColor('#FFCF68');
$graph->scale->actinfo->SetFont(FF_ARIAL,FS_NORMAL,10);
$graph->scale->actinfo->vgrid->SetStyle('solid');
$graph->scale->actinfo->vgrid->SetColor('gray');

for ($obj=0; $obj<$objects; $obj++)
 {
  $name[$obj]=encodestring ($name[$obj]);
  $tn=1;
  while (!$hour[$obj][$tn] && $tn<$currday) $tn++;
  if ($tn==$currday) $begin=$dats[0];
	else $begin=$dats[$tn];
//  echo $obj.' '.$begin.'<br>';

  while ($tn<$currday)
	{
	  while ($hour[$obj][$tn] && $tn<$currday)
		{
		 //printf ("%2s ",$otv[$y][$tn]);
		 $tn++;
		}
	  if ($tn==$currday) $end=$dats[$currday];
	  else $end=$dats[$tn];

	  // Format the bar for the first activity
	  // ($row,$title,$startdate,$enddate)
      	  //if ($y==2) echo 	$y.' '.$irp.' b='.$begin.', e='.$end.'<br>';
	  $pr=number_format($hr[$obj]*100/$currday,2);
	  $ans=$hr[$obj].'/'.$currday;
//	  echo $obj.' '.$ans.'<br>';
	  $activity1 = new GanttBar($obj,array($name[$obj],$ans,$pr),$begin,$end,"",10);
//	  echo 'GanttBar('.$obj.',array('.$name[$obj].','.$ans.','.$pr.'),"'.$begin.'","'.$end.'","",10)<br>';
		
	  // Yellow diagonal line pattern on a red background
	  $activity1->SetPattern(BAND_RDIAG,"yellow");
	  $activity1->SetFillColor("red");
	  // Set absolute height of activity
	  $activity1->SetHeight(10);
	  $graph->Add($activity1);
	  while (!$hour[$obj][$tn] && $tn<$currday) $tn++;
	  $begin=$dats[$tn];
	}
 }
$graph->SetVMarginFactor(0.30); 
// ... and display it
$graph->Stroke();

?>