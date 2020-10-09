<div id="main">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Объекты</div>
		 <div class="menuitem first"><a href="http://ce-chel.info/index.php?sel=register" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Все объекты</a></div>
		<?php
		 $query = 'SELECT * FROM objects';
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 while ($ui)
			{	 
			 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
			 $y = mysql_query ($query,$i);
			 if ($y) $uo = mysql_fetch_row ($y);
			 print '<div class="menuitem"><a href="http://ce-chel.info/index.php?sel=register&id='.$ui[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$ui[1].'</a></div>';
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
print '<li><a href="http://ce-chel.info/index.php?sel=what&id='.$_GET["id"].'"';
if (!$_GET["type"]) print 'class="sel"'; print '><span>Все мероприятия</span></a></li>';
print '<li><a href="http://ce-chel.info/index.php?sel=what&type=1&id='.$_GET["id"].'"';
if ($_GET["type"]==1) print 'class="sel"'; print '><span>Монтаж</span></a></li>';
print '<li><a href="http://ce-chel.info/index.php?sel=what&type=2&id='.$_GET["id"].'"';
if ($_GET["type"]==2) print 'class="sel"'; print '><span>Демонтаж</span></a></li>';
print '<li><a href="http://ce-chel.info/index.php?sel=what&type=3&id='.$_GET["id"].'"';
if ($_GET["type"]==3) print 'class="sel"'; print '><span>Подключение</span></a></li>';
print '<li><a href="http://ce-chel.info/index.php?sel=what&type=10&id='.$_GET["id"].'"';
if ($_GET["type"]==10) print 'class="sel"'; print '><span>Обслуживание</span></a></li>';
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
<td align="center"><font color="white">Tип мероприятия</font></td>
<td align="center"><font color="white">Событие</font></td>
<td align="center"><font color="white">Значение</font></td>
</tr>

<?php

 if ($_GET["id"]) $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 else $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{	 
	 if ($_GET["type"])  $query = 'SELECT * FROM what WHERE type='.$_GET["type"].' AND object='.$ui[0].' ORDER BY date DESC';
	 else $query = 'SELECT * FROM what WHERE object='.$ui[0].' ORDER BY date DESC';
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 while ($uo)
		{
		 $query = 'SELECT * FROM devices WHERE device='.$uo[6];
		 $w = mysql_query ($query,$i);
		 if ($w) $uw = mysql_fetch_row ($w);
                                              
		 print '<tr bgcolor="#ffffff">';
		 print '<td align="left"><b>'.$ui[1].'</b></td>';
		 print '<td align="left"><b>'.$uw[1].'('.$uo[6].')</b></td>';
		 print '<td align="center">'.$uo[2].'</td>';
		 if ($uo[1]==0) print '<td align="center">Неизвестно</td>';
		 if ($uo[1]==1) print '<td align="center">Монтаж/Установка</td>';
		 if ($uo[1]==2) print '<td align="center">Демонтаж/Снятие</td>';
		 if ($uo[1]==3) print '<td align="center">Замена</td>';
		 if ($uo[1]==10) print '<td align="center">Обслуживание</td>';
		 print '<td align="left">'.$uo[5].'</td>';
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