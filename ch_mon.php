<?php
if ($_GET["month"]=='') $_GET["month"]=$today["mon"];
if ($_GET["year"]=='') $_GET["year"]=$today["year"];
print '<select style="font-family:verdana; font-size:11px" id="month" name="month" onchange="location.href=document.getElementById(\'month\').options[document.getElementById(\'month\').selectedIndex].value;">';
for ($z=1;$z<=12;$z++)
   {
    print '<option value="index.php?sel=object&menu='.$_GET["menu"].'&id='.$_GET["id"].'&year='.$_GET["year"].'&month='.$z.'" ';
    if ($z==$_GET["month"]) print 'selected '; print '>'; 
    if ($z==1) print '������'; if ($z==2) print '�������';
    if ($z==3) print '����';  if ($z==4) print '������';
    if ($z==5) print '���';    if ($z==6) print '����';
    if ($z==7) print '����';   if ($z==8) print '������';
    if ($z==9) print '��������';   if ($z==10) print '�������';
    if ($z==11) print '������';    if ($z==12) print '�������';
   }
print '</select><select id="year" name="year" style="font-family:verdana; font-size:11px" onchange="location.href=document.getElementById(\'year\').options[document.getElementById(\'year\').selectedIndex].value;">';
for ($z=0;$z<=5;$z++)
   {
    print '<option value="index.php?sel=object&menu='.$_GET["menu"].'&id='.$_GET["id"].'&month='.$_GET["month"].'&year='.($today["year"]-$z).'" >'; 
    print $today["year"]-$z;
   }
print '</select>';
?>