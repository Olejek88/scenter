<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $query = 'SELECT * FROM data WHERE type=2 AND date LIKE \'%01:00:00%\'';
echo $query;
 if ($a = mysql_query ($query,$i))
 while ($uy = mysql_fetch_row ($a))
	{
	 $date=$uy[2]; 
	 if ($date[12]=='1')
		{
		 $date[12]='0';
		 $query = 'UPDATE data SET date=\''.$date.'\' WHERE id='.$uy[0];
		 print $query.'<br>';	
		 $a2 = mysql_query ($query,$i);
		}
	}
?>
</div>