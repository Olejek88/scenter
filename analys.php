<div id="main">
<div id="maincontent" style="width:1000; left: 0px;">
<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody><tr>
<td>
<table border="0" cellpadding="0" cellspacing="0">
<tbody><tr>
<td>
<?php
 $query = 'SELECT MAX(value),device FROM data WHERE prm=4 AND source=0 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tpodmax=$ui[0]; $dTpodmax=$ui[1];
                                                                                
 $query = 'SELECT MIN(value),device FROM data WHERE prm=4 AND source=0 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tpodmin=$ui[0]; $dTpodmin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE prm=4 AND source=1 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tobrmax=$ui[0]; $dTobrmax=$ui[1];

 $query = 'SELECT MIN(value),device FROM data WHERE prm=4 AND source=1 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tobrmin=$ui[0]; $dTobrmin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE prm=4 AND source=3 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $TCOpodmax=$ui[0]; $dTCOpodmax=$ui[1];

 $query = 'SELECT MIN(value),device FROM data WHERE prm=4 AND source=3 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $TCOpodmin=$ui[0]; $dTCOpodmin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE prm=4 AND source=4 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $TCOobrmax=$ui[0]; $dTCOobrmax=$ui[1];

 $query = 'SELECT MIN(value),device FROM data WHERE prm=4 AND source=4 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $TCOobrmin=$ui[0]; $dTCOobrmin=$ui[1];


 $query = 'SELECT MAX(value),device FROM data WHERE prm=4 AND source=5 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tgvmax=$ui[0]; $dTgvmax=$ui[1];

 $query = 'SELECT MIN(value),device FROM data WHERE prm=4 AND source=5 AND type=1 AND date>20100901000000';
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $Tgvmin=$ui[0]; $dTgvmin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE type=1 AND prm=13 AND source=2 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $Teplomax=$ui[0]; $dTeplomax=$ui[1];
 $query = 'SELECT MIN(value),device FROM data WHERE type=1 AND prm=13 AND source=2 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $Teplomin=$ui[0]; $dTeplomin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE type=1 AND prm=12 AND source=5 AND value>0.1 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $GVmax=$ui[0]; $dGVmax=$ui[1];
 $query = 'SELECT MIN(value),device FROM data WHERE type=1 AND prm=12 AND source=5 AND value>0.1 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $GVmin=$ui[0]; $dGVmin=$ui[1];

 $query = 'SELECT MAX(value),device FROM data WHERE type=1 AND prm=12 AND source=6 AND value>0.1 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $HVmax=$ui[0]; $dHVmax=$ui[1];
 $query = 'SELECT MIN(value),device FROM data WHERE type=1 AND prm=12 AND source=6 AND value>0.1 AND date>20100901000000';
 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
 $HVmin=$ui[0]; $dHVmin=$ui[1];

 $query = 'SELECT * FROM objects';
 $a = mysql_query ($query,$i); $ccn=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $square=$uo[14];

	 $query = 'SELECT value FROM data WHERE type=1 AND prm=13 AND source=2 AND value>0.1';
	 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
	 if ($square) $Teplomax[$ccn]=$ui[0]/$square;
	 $query = 'SELECT value FROM data WHERE type=1 AND prm=13 AND source=2 AND value>0.1';
	 $e = mysql_query ($query,$i); $ui = mysql_fetch_row ($e); 
	 if ($square) $Teplomin[$ccn]=$ui[0]/$square;
	 $ccn++;
	 $uy = mysql_fetch_row ($a);
	}

  print '<tr><td width="300px">
	 <table border="0" cellpadding="0" cellspacing="5" width="100%">
	 <tbody>
	  <tr><td valign="top">
	  <table border="0">
	  <tbody><tr bgcolor="#476a94"><td colspan="3" align="center"><font color="white">Аналитика</font></td></tr>
	  <tr><td><b>Максимальная температура подачи:</b></td><td align="right"><span id="ajax_date">'.$Tpodmax.'</span></td><td align="right"><span id="ajax_date">'.$dTpodmax.'</span></td></tr>
	  <tr><td><b>Минимальная температура подачи:</b></td><td align="right"><span id="ajax_amount">'.$Tpodmin.'</span></td><td align="right"><span id="ajax_date">'.$dTpodmin.'</span></td></tr>
	  <tr><td><b>Максимальная температура обратки:</b></td><td align="right"><span id="ajax_date">'.$Tobrmax.'</span></td><td align="right"><span id="ajax_date">'.$dTobrmax.'</span></td></tr>
	  <tr><td><b>Минимальная температура обратки:</b></td><td align="right"><span id="ajax_amount">'.$Tobrmin.'</span></td><td align="right"><span id="ajax_date">'.$dTobrmin.'</span></td></tr>
	  <tr><td><b>Максимальная температура подачи СО:</b></td><td align="right"><span id="ajax_date">'.$TCOpodmax.'</span></td><td align="right"><span id="ajax_date">'.$dTCOpodmax.'</span></td></tr>
	  <tr><td><b>Минимальная температура подачи СО:</b></td><td align="right"><span id="ajax_amount">'.$TCOpodmin.'</span></td><td align="right"><span id="ajax_date">'.$dTCOpodmin.'</span></td></tr>
	  <tr><td><b>Максимальная температура обратки СО:</b></td><td align="right"><span id="ajax_date">'.$TCOobrmax.'</span></td><td align="right"><span id="ajax_date">'.$dTCOobrmax.'</span></td></tr>
	  <tr><td><b>Минимальная температура обратки СО:</b></td><td align="right"><span id="ajax_amount">'.$TCOobrmin.'</span></td><td align="right"><span id="ajax_date">'.$dTCOobrmin.'</span></td></tr>
	  <tr><td><b>Максимальная температура ГВС:</b></td><td align="right"><span id="ajax_date">'.$Tgvmax.'</span></td><td align="right"><span id="ajax_date">'.$dTgvmax.'</span></td></tr>
	  <tr><td><b>Минимальная температура ГВС:</b></td><td align="right"><span id="ajax_amount">'.$Tgvmin.'</span></td><td align="right"><span id="ajax_date">'.$dTgvmin.'</span></td></tr>
	  <tr><td><b>Максимальное потребление тепла:</b></td><td align="right"><span id="ajax_date">'.$Teplomax.'</span></td><td align="right"><span id="ajax_date">'.$dTeplomax.'</span></td></tr>
	  <tr><td><b>Минимальное потребление тепла:</b></td><td align="right"><span id="ajax_amount">'.$Teplomin.'</span></td><td align="right"><span id="ajax_date">'.$dTeplomin.'</span></td></tr>
	  <tr><td><b>Максимальное потребление ХВС:</b></td><td align="right"><span id="ajax_date">'.$HVmax.'</span></td><td align="right"><span id="ajax_date">'.$dHVmax.'</span></td></tr>
	  <tr><td><b>Минимальное потребление ХВС:</b></td><td align="right"><span id="ajax_amount">'.$HVmin.'</span></td><td align="right"><span id="ajax_date">'.$dHVmin.'</span></td></tr>
	  <tr><td><b>Максимальное потребление ГВС:</b></td><td align="right"><span id="ajax_date">'.$GVmax.'</span></td><td align="right"><span id="ajax_date">'.$dGVmax.'</span></td></tr>
	  <tr><td><b>Минимальное потребление ГВС:</b></td><td align="right"><span id="ajax_amount">'.$GVmin.'</span></td><td align="right"><span id="ajax_date">'.$dGVmin.'</span></td></tr>
   	  </tbody></table>
	  </td>';
?>
<td>
<img src="charts/barplots27.php?n1=13">
<img src="charts/barplots27.php?n1=8">
<img src="charts/barplots27.php?n1=6">
<img src="charts/barplots27.php?n1=2">
</td>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr></tbody></table>
</td>
</tr>
</tbody></table>
<br><br><br>
<br><br><br><br><br>
<?php 
//include ("all2.php"); 
?>
</div>