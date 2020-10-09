<?php
include "../../../jpgraph2/jpgraph.php";
include "../../../jpgraph2/jpgraph_led.php";
 

// By default each "LED" circle has a radius of 3 pixels. Change to 5 and slghtly smaller margin
$led = new DigitalLED74(4);
$led->SetSupersampling(1);
$str=$_GET["dat"].'';
if ($_GET["n"]==0) $led->StrokeNumber($str,LEDC_GREEN); 
if ($_GET["n"]==1) $led->StrokeNumber($str,LEDC_RED); 
if ($_GET["n"]==2) $led->StrokeNumber($str,LEDC_BLUE); 
if ($_GET["n"]==3) $led->StrokeNumber($str,LEDC_YELLOW); 
if ($_GET["n"]==4) $led->StrokeNumber($str,LEDC_NAVY); 
?>