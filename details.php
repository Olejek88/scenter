<div id="main">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Детально</div>
		 <div class="menuitem first"><a href="index.php?sel=details&name=channels" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Все каналы</a></div>
		 <div class="menuitem"><a href="index.php?sel=details&name=protocols" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Протоколы</a></div>
		 <div class="menuitem"><a href="index.php?sel=details&name=var2" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">Параметры</a></div>
	</div>
	</div>
</div>

<div id="maincontent" style="width:840px">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td><table border="0" cellpadding="0" cellspacing="0">
<tr><td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr><td>
<table border="0" cellpadding="0" cellspacing="5" width="100%">
<tbody><tr><td valign="top">
<?php
if ($_GET["name"]=='channels')
	{
	 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
		<tr bgcolor="#476a94">
		<td align="center"><font color="white">Имя канала</font></td>
		<td align="center"><font color="white">Устройство</font></td>
		<td align="center"><font color="white">Опрос</font></td>
		<td align="center"><font color="white">Единицы измерения</font></td>
		<td align="center"><font color="white">Текущие</font></td>
		<td align="center"><font color="white">Часовые</font></td>
		<td align="center"><font color="white">Дневные</font></td>
		<td align="center"><font color="white">По месяцам</font></td>
		<td align="center"><font color="white">Параметр</font></td></tr>';
		$query = 'SELECT * FROM channels';
		$e = mysql_query ($query,$i);
		if ($e) $ui = mysql_fetch_row ($e);
		while ($ui)
			{	 
			 $query = 'SELECT * FROM var2 WHERE prm='.$ui[9].' AND pipe='.$ui[10];
			 $e2 = mysql_query ($query,$i);
			 if ($e2) $ur = mysql_fetch_row ($e2);
			 $name=$ur[1];

			 $query = 'SELECT * FROM devices WHERE device='.$ui[2];
			 $e2 = mysql_query ($query,$i);
			 if ($e2) $ur = mysql_fetch_row ($e2);
			 print '<tr id="row'.$ui[0].'" bgcolor="#ffffff">';
			 print '<td align="left"><b>'.$ui[1].'</b></td>';
			 print '<td align="left"><b>'.$ur[1].'('.$ui[2].')</b></td>';
			 if ($ui[3]=='1') print '<td align="center">Да</td>';
			 else print '<td align="center">Нет</td>';
			 print '<td align="center">'.$ui[4].'</td>';
			 print '<td align="center">'.$ui[5].'</td>';
			 print '<td align="center">'.$ui[6].'</td>';
			 print '<td align="center">'.$ui[7].'</td>';
			 print '<td align="center">'.$ui[8].'</td>';
			 print '<td align="center">('.$ui[9].'|'.$ui[10].')</td></tr>';
			 $ui = mysql_fetch_row ($e);
			}	 
	}
if ($_GET["name"]=='var2')
	{
	 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
		<tr bgcolor="#476a94">
		<td align="center"><font color="white">Название параметра</font></td>
		<td align="center"><font color="white">Параметр</font></td>
		<td align="center"><font color="white">Труба</font></td></tr>';
		$query = 'SELECT * FROM var2';
		$e = mysql_query ($query,$i);
		if ($e) $ui = mysql_fetch_row ($e);
		while ($ui)
			{	 
			 print '<tr bgcolor="#ffffff">';
			 print '<td align="left"><b>'.$ui[1].'</b></td>';
			 print '<td align="left">'.$ui[2].'</td>';
			 print '<td align="center">'.$ui[3].'</td></tr>';
			 $ui = mysql_fetch_row ($e);
			}	 
	}
if ($_GET["name"]=='protocols')
	{
	 print '<table cellpadding=2 cellspacing=1 bgcolor=#82cc7f align=center>
		<tr bgcolor="#476a94">
		<td align="center"><font color="white">Название</font></td>
		<td align="center"><font color="white">Тип</font></td>
		<td align="center"><font color="white">Протокол</font></td></tr>';
		$query = 'SELECT * FROM protocols';
		$e = mysql_query ($query,$i);
		if ($e) $ui = mysql_fetch_row ($e);
		while ($ui)
			{	 
			 print '<tr bgcolor="#ffffff">';
			 print '<td align="left"><b>'.$ui[1].'</b></td>';
			 print '<td align="left">'.$ui[2].'</td>';
			 print '<td align="center">'.$ui[3].'</td></tr>';
			 $ui = mysql_fetch_row ($e);
			}	 
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