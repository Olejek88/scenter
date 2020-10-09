<?php                   
include("config/local.php"); 
$i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
$query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
$query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
$query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
$arr = get_defined_vars();
?>
<!doctype html public "-//w3c//dtd html 4.0 transitional//en">
<!doctype php manual "-//by the PHP Documentation Group//en">
<!doctype odbc manual "-//by microsoft corp.//en">
<html xmlns="http://www.w3.org/1999/xhtml">
<title>Загрузка погоды с метеосайтов</title>
<meta http-equiv="content-type" content="text/html; charset=Windows-1251" />
<?php
function url_exists($url){
    if(strstr($url, "http://")) $url = str_replace("http://", "", $url);
 //   echo 'url='.$url.'<br>';
    $fp = @fsockopen($url, 80);
    if($fp === false) return false;
    return true;
}
function parse_file($filename,$i)
{
 $file=fopen($filename,'rb');
 echo $file.'<br>'; $cn=0;
 if ($file)
 while (!feof ($file)) 
	{
	 $buffer = fgets($file, 1024);
	 $pieces = explode (",", $buffer);
	 //2011-2-21,-22,-26,-31,-26,-29,-34,84,75,65,1031,1029,1026,7,4,2,11,8,,0.00,3,,305<br />
	 if (!strstr($pieces[0],"20")) { print $buffer.'<br>'; continue; }
	 if (strlen($pieces[0])<8) { print $buffer.'<br>'; continue; }
	 $temp=$pieces[2];
	 $dates = explode ("-", $pieces[0]);
	 $date=sprintf("%d%02d%02d000000",$dates[0],$dates[1],$dates[2]);

	 $query = 'SELECT * FROM data WHERE prm=4 AND source=10 AND date=\''.$date.'\'';
	 echo $query.'<br>';	 
	 if ($e2 = mysql_query ($query,$i))
		{
		 $ui2 = mysql_fetch_row ($e2);
		 if (!$ui2)
			{		  
			 $query = 'INSERT INTO data(prm,source,date,value,device,type) VALUES (\'4\',\'10\',\''.$date.'\',\''.$temp.'\',\'0\',\'2\')';
			 $e2 = mysql_query ($query,$i);
	 		 echo $query.' '.$e2.'<br>';
		 	}
		}
	}
 fclose ($file);
}

$today=getdate();
$filename='http://www.wunderground.com/history/airport/USCC/2012/4/21/CustomHistory.html?dayend='.$today["mday"].'&monthend='.$today["mon"].'&yearend='.$today["year"].'&req_city=NA&req_state=NA&req_statename=NA&format=1';
echo $filename;
parse_file($filename,$i);
?>