<div id="maincontent" style="width:100%; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody>
<?php
 $query = 'SELECT * FROM objects';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 while ($ui)
	{
	 $query = 'SELECT * FROM devices WHERE ust=1 AND object='.$ui[0].' ORDER BY interface';
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 if ($_GET["type"]==1) print '<tr><td><img src="charts/trend2.php?type=1&prm=1&device='.$uo[11].'&name='.$ui[1].'" width="1870" height="200"></td></tr>';
		 if ($_GET["type"]==2) print '<tr><td><img src="charts/trend2.php?type=2&prm=2&device='.$uo[11].'&name='.$ui[1].'" width="1870" height="200"></td></tr>';
		 if ($_GET["type"]==3) print '<tr><td><img src="charts/trend2.php?type=1&prm=3&device='.$uo[11].'&name='.$ui[1].'" width="1870" height="200"></td></tr>';
		 $uo = mysql_fetch_row ($u);
		}
	 $ui = mysql_fetch_row ($e);
	}
?>
</tbody></table>
</div>