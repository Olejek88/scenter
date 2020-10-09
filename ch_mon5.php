<?php
if ($_GET["month"]=='') $_GET["month"]=$today["mon"];
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
//$pos=strpos ($_SERVER["REQUEST_URI"],"&type");
//if ($pos) $reqq=substr ($_SERVER["REQUEST_URI"],1,$pos);
//else $reqq=substr ($_SERVER["REQUEST_URI"],1);

if ($_GET["day"] && !$_POST["day"]) $_POST["day"]=$_GET["day"];
else if (!$_POST["day"]) $_GET["day"]=$_POST["day"]=$today["mday"]; 

if ($_GET["day2"] && !$_POST["day2"]) $_POST["day2"]=$_GET["day2"];
else if (!$_POST["day2"]) $_GET["day2"]=$_POST["day2"]=$today["mday"];

if ($_GET["month"] && !$_POST["month"]) $_POST["month"]=$_GET["month"];
else if (!$_POST["month"]) $_GET["month"]=$_POST["month"]=$today["mon"];

if ($_GET["month2"] && !$_POST["month2"]) $_POST["month2"]=$_GET["month2"];
else if (!$_POST["month2"]) $_GET["month2"]=$_POST["month2"]=$today["mon"];

if ($_GET["year"] && !$_POST["year"]) $_POST["year"]=$_GET["year"];
else if (!$_POST["year"]) $_GET["year"]=$_POST["year"]=$today["year"];

if ($_GET["year2"] && !$_POST["year2"]) $_POST["year2"]=$_GET["year2"];
else if (!$_POST["year2"]) $_GET["year2"]=$_POST["year2"]=$today["year"];

if ($_POST["month"]) $_GET["month"]=$_POST["month"];
if ($_POST["year"]) $_GET["year"]=$_POST["year"];
$reqq2='index.php?sel='.$_GET["sel"].'&menu='.$_GET["menu"].'&day='.$_POST["day"].'&month='.$_POST["month"].'&year='.$_POST["year"].'&day2='.$_POST["day2"].'&month2='.$_POST["month2"].'&year2='.$_POST["year2"].'&id='.$_GET["id"];

print '<form method="post" name="add" action="'.$reqq2.'">';

print '<select style="font-family:verdana; font-size:11px" id="day" name="day">';
for ($z=1;$z<=31;$z++)
   {
    if ($_POST["day"]==$z) 
	{ print '<option selected value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
    else { print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
   }
print '</select>';
print '<select style="font-family:verdana; font-size:11px" id="month" name="month">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'.$z.'" ';
    if ($z==$_GET["month"]) print 'selected '; print '>'; 
    if ($z==1) print 'Январь'; if ($z==2) print 'Февраль';
    if ($z==3) print 'Март';  if ($z==4) print 'Апрель';
    if ($z==5) print 'Май';    if ($z==6) print 'Июнь';
    if ($z==7) print 'Июль';   if ($z==8) print 'Август';
    if ($z==9) print 'Сентябрь';   if ($z==10) print 'Октябрь';
    if ($z==11) print 'Ноябрь';    if ($z==12) print 'Декабрь';
   }
print '</select><select id="year" name="year" style="font-family:verdana; font-size:11px">';
for ($z=0;$z<=5;$z++)
   {
    print '<option value="'.($today["year"]-$z).'" '; 
    if (($today["year"]-$z)==$_POST["year"]) print 'selected';
    print '>';
    print $today["year"]-$z;
   }
print '</select> - ';
print '<select style="font-family:verdana; font-size:11px" id="day2" name="day2">';
for ($z=1;$z<=31;$z++)
   {
    if ($_POST["day2"]==$z) 
	{ print '<option selected value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
    else { print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '">'; print $z; }
   }
print '</select>';
print '<select style="font-family:verdana; font-size:11px" id="month2" name="month2">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'.$z.'" ';
    if ($z==$_POST["month2"]) print 'selected '; print '>'; 
    if ($z==1) print 'Январь'; if ($z==2) print 'Февраль';
    if ($z==3) print 'Март';  if ($z==4) print 'Апрель';
    if ($z==5) print 'Май';    if ($z==6) print 'Июнь';
    if ($z==7) print 'Июль';   if ($z==8) print 'Август';
    if ($z==9) print 'Сентябрь';   if ($z==10) print 'Октябрь';
    if ($z==11) print 'Ноябрь';    if ($z==12) print 'Декабрь';
   }
print '</select><select id="year2" name="year2" style="font-family:verdana; font-size:11px">';
for ($z=0;$z<=5;$z++)
   {
    print '<option value="'.($today["year"]-$z).'" '; 
    if (($today["year"]-$z)==$_POST["year2"]) print 'selected';
    print '>';
    print $today["year"]-$z;
   }
print '</select>&nbsp;&nbsp;&nbsp;';
print '<input name="add" value="вывести" type="submit">';
print '</form>';
?>