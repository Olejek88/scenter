<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
 if($_POST['name'] && $_POST['pass'])
    {
     $query='SELECT id,pass,name,login FROM users WHERE login=\''.mysql_real_escape_string($_POST['name']).'\' LIMIT 1';
     $quer = mysql_query ($query,$i);
     $data = mysql_fetch_assoc($quer);
     if($data['pass'] == $_POST['pass'])
    	{
    	 $query='UPDATE users SET ip="'.$_SERVER['REMOTE_ADDR'].'" WHERE id="'.$data['id'].'"';
	 mysql_query ($query,$i);
	 setcookie("id", $data['id'], time()+60*60*24*30); 
	 setcookie("name", $data['name'], time()+60*60*24*30);
	 print '<script> window.location.href="index.php" </script>';
	 //$query = 'INSERT INTO registers SET who="'.$data['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="user login success"';
	 //mysql_query ($query,$i);
         //echo $query;
	}
     else  
        {
    	 //$query='INSERT INTO registers SET who="'.$data['name'].'", ip="'.$_SERVER['REMOTE_ADDR'].'", what="user login failed with pass '.$_POST["pass"].'"';
	 //mysql_query ($query,$i);
         //echo $query;
        }
    }
?>

<html><head>
<title>Вход в систему</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
</head>
<body><center>
<form name="Form1" method="post" action="index.php" id="Form1">
<table style="margin-top:200px; border: 1px solid black; background-color: rgb(250, 252, 251); width: 100px; border-collapse: collapse;" align="Center" border="0" cellpadding="4" cellspacing="0">
	<?php
	if ($_COOKIE["name"] && $_COOKIE["id"])
	        {
	         print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: 16px;">
	    		<td colspan="5">Вы зарегистрированы в системе</td></tr>';
	        }
	else
	        {
	         print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: 16px;">
			<td>Логин</td><td align="center"><input type="text" name="name" style="width:100px; height:26px; font-size:16px"></td></tr>';
		 print '<tr style="color: Black; background-color: White; font-family: Verdana; font-size: 16px;">
			<td>Пароль</td><td align="center">
			<input type="text" name="pass" style="width:100px; height:26px; font-size:16px"></td></tr>
			<tr style="color: Black; background-color: White; font-family: Verdana; font-size: 16px;"><td align="center" colspan="2"><input type="submit" value="войти" style="font-family: arial;  font-size:16px"></td></tr>';
		}
	?>
</table>
</form>

</body>
</html>