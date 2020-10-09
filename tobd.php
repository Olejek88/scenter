<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);

 $query = 'SELECT * FROM objects';
 $maxd=0;
 if ($u = mysql_query ($query,$i)) 
 while ($uo = mysql_fetch_row ($u))
	{
	 $tarif=$uo[121]; $id=$uo[0].'-tarif';
	 //echo $id.' '.$_POST[$id].'<br>';
	 if ($_POST[$id]!='' && $_POST[$id]!=$tarif) $tarif=$_POST[$id];
	 $k=$uo[120]; $id=$uo[0].'-k';
	 //echo $id.' '.$_POST[$id].'<br>';
	 if ($_POST[$id]!='' && $_POST[$id]!=$k) $k=$_POST[$id];
	 $square=$uo[14]; $id=$uo[0].'-square';
	 if ($_POST[$id]!='' && $_POST[$id]!=$square) $square=$_POST[$id];

	 $vkl=$uo[10]; $id=$uo[0].'-vkl';
	 if ($_POST[$id]!='' && $_POST[$id]!=$vkl) $vkl=$_POST[$id];
	 if ($vkl=='on') $vkl=1;  if ($vkl=='off') $vkl=0; 
	 $query='UPDATE objects SET square='.$square.',Kpot='.$k.',tarif_teplo='.$tarif.',nlevels='.$vkl.' WHERE id='.$uo[0]; 
	 echo $query.'<br>';
	 mysql_query ($query,$i);
	}
 $query = 'SELECT * FROM devices';
 $u = mysql_query ($query,$i); $maxd=0;
 if ($u) $uo = mysql_fetch_row ($u);
 while ($uo)
	{
	 $devices[$maxd]=$uo[11];
	 $uo = mysql_fetch_row ($u); $maxd++;
	}

 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"];
 for ($mon=1;$mon<=12;$mon++)
 for ($tt=0; $tt<=$maxd; $tt++)
		 $data[$tt][$mon]=""; 

 for ($mon=1;$mon<=12;$mon++)
	{
	 $date=sprintf("%d%02d01000000",$today["year"],$mon);
	 $query='SELECT device,value FROM data WHERE type="4" AND date="'.$date.'" AND prm="13" AND source="12"';
echo $query;
	 $w = mysql_query ($query,$i); 
	 if ($w) $uw = mysql_fetch_row ($w);        		
	 while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) { $data[$tt][$mon]=$uw[1]; break; }
//echo $data[$tt][$mon]=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	}	

  for ($tm=0; $tm<=$maxd; $tm++)
	{ 
	 $device=$devices[$tm];
	 if ($_POST["year"]=='') $year=$today["year"]; else $year=$_POST["year"];
	 for ($mon=1;$mon<=12;$mon++)
		{
		 $id=$device.'-'.$mon;
		 //echo $id.' '.$_POST[$id].'<br>';
		 if ($_POST[$id]) 
			{
			 $date=sprintf ("%d%02d01000000",$year,$mon);
//echo $data[$tm][$mon];
			 if ($data[$tm][$mon]=="")
				{
				 $query='INSERT INTO data SET type="4", date="'.$date.'",value="'.$_POST[$id].'",device="'.$device.'",prm="13",source="12"';
				 echo $query.'<br>';
				 mysql_query ($query,$i);
				}
			 else	{
				 if ($_POST[$id]!=$data[$tm][$mon])
					{
					 $query='UPDATE data SET value="'.$_POST[$id].'",date=date WHERE type="4" AND date="'.$date.'" AND device="'.$device.'" AND prm="13" AND source="12"';
					 echo $query.'<br>';
					 mysql_query ($query,$i);
					}
				}
			}
		}
	}
 print '<script> window.location.href="index.php?sel=input3" </script>';

?>
