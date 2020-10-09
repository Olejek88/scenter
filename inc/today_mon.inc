<?php
for ($z=1;$z<=12;$z++)
   {
    print '<option value="'; if ($z>9) print $z; else print '0'.$z; print '" ';
    if ($z==$today[mon]) print 'selected '; print '>'; 
    if ($z==1) print 'Января'; if ($z==2) print 'Февраля';
    if ($z==3) print 'Марта';  if ($z==4) print 'Апреля';
    if ($z==5) print 'Мая';    if ($z==6) print 'Июня';
    if ($z==7) print 'Июля';   if ($z==8) print 'Августа';
    if ($z==9) print 'Сентября';   if ($z==10) print 'Октября';
    if ($z==11) print 'Ноября';    if ($z==12) print 'Декабря';
   }
?>