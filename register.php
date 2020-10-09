<div id="main">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Объекты</div>
		 <div class="menuitem first"><a href="index.php?sel=register" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Все объекты</a></div>
		<?php
		 $query = 'SELECT * FROM objects';
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 while ($ui)
			{	 
			 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
			 $y = mysql_query ($query,$i);
			 if ($y) $uo = mysql_fetch_row ($y);
			 print '<div class="menuitem"><a href="index.php?sel=register&id='.$uo[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></div>';
			 $ui = mysql_fetch_row ($e);
			}
		?>			
	</div>
	</div>
</div>

<div id="maincontent" style="width:820px">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="2" cellspacing="0">
<tbody><tr><td>
<ul id="navigation"> 
<?php
print '<li><a href="index.php?sel=register&id='.$_GET["id"].'"';
if (!$_GET["type"]) print 'class="sel"'; print '><span>Все события</span></a></li>';
print '<li><a href="index.php?sel=register&type=1&id='.$_GET["id"].'"';
if ($_GET["type"]==1) print 'class="sel"'; print '><span>Критические</span></a></li>';
print '<li><a href="index.php?sel=register&type=2&id='.$_GET["id"].'"';
if ($_GET["type"]==2) print 'class="sel"'; print '><span>Предупреждения</span></a></li>';
print '<li><a href="index.php?sel=register&type=3&id='.$_GET["id"].'"';
if ($_GET["type"]==3) print 'class="sel"'; print '><span>Информационные</span></a></li>';
print '<li><a href="index.php?sel=register&type=4&id='.$_GET["id"].'"';
if ($_GET["type"]==4) print 'class="sel"'; print '><span>Включение/выключение</span></a></li>';
?>
</ul>
<div id="border"></div>
</td></tr>
</tbody></table>
</td>
</tr>

<tr>
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody><tr><td valign="top">
<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
<tr bgcolor="#476a94">
<td align="center"><font color="white">Объект</font></td>
<td align="center"><font color="white">Устройство</font></td>
<td align="center"><font color="white">Дата</font></td>
<td align="center"><font color="white">Tип события</font></td>
<td align="center"><font color="white">Событие</font></td>
<td align="center"><font color="white">Значение</font></td>
</tr>

<?php
 if ($_GET["id"]) $query = 'SELECT * FROM devices WHERE id='.$_GET["id"];
 else $query = 'SELECT * FROM devices';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 $query = 'SELECT * FROM objects WHERE id='.$ui[8];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $ur = mysql_fetch_row ($e2);
	 if ($_GET["type"])  $query = 'SELECT * FROM register WHERE type='.$_GET["type"].' AND device='.$ui[11].' ORDER BY date DESC';
	 else $query = 'SELECT * FROM register WHERE device='.$ui[11].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 while ($uo)
		{
		 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff">';
		 print '<td align="left"><b>'.$ur[1].'</b></td>';
		 print '<td align="left"><b>'.$ui[1].'('.$ui[11].')</b></td>';
		 print '<td align="center">'.$uo[5].'</td>';
		 if ($uo[2]!=1 && $uo[2]!=2 && $uo[2]!=3 && $uo[2]!=4) print '<td align="center"></td>';
		 if ($uo[2]==1) print '<td align="center">критическое</td>';
		 if ($uo[2]==2) print '<td align="center">предупреждение</td>';
		 if ($uo[2]==3) print '<td align="center">информационное</td>';
		 if ($uo[2]==4) print '<td align="center">вкл./выкл.</td>';
		 print '<td align="left">'.$uo[3].'</td>';
		 print '<td align="center">'.$uo[4].'</td></tr>';
		 $uo = mysql_fetch_row ($y);	 
		}
	 $ui = mysql_fetch_row ($e);
	}
?>

</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>
</div>