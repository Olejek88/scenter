<div id="main"  style="width:100%; left: 0px;">
<?php
 if ($_GET["print"]=='') include ("object_menu.php");

 $query = 'SELECT * FROM devices WHERE type=15 AND object='.$_GET["id"];
 $cnt=1;
 if ($y = mysql_query ($query,$i))
 while ($ur = mysql_fetch_row ($y)) 
	{
	 $query = 'SELECT * FROM channels WHERE prm=14 AND device='.$ur[11];
	 if ($y2 = mysql_query ($query,$i))
	 while ($uo2 = mysql_fetch_row ($y2))
		{
		 if ($cnt>1) $channel.=' OR channel='.$uo2[0];
		 else $channel.='channel='.$uo2[0];
		 if ($cnt>1) $idchan.=' OR id='.$uo2[0];
		 else $idchan.='id='.$uo2[0]; $cnt++;
		}
	}
 $query = 'SELECT * FROM tarifs WHERE year=2010 AND object='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $tarif_teplo=$ui[4]; $tarif_electr=$ui[6]; $tarif_gvs=$ui[8]; $tarif_hvs=$ui[10]; $tarif_voda=$ui[12]; $tarif_svoda=$ui[14]; $tarif_kanal=$ui[16];
 if ($tarif_svoda=='') $tarif_svoda=18.56;
 if (!$limit_voda) $limit_voda=15;

 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) { $name=$ui[1]; $cat=$ui[2]; $square=$ui[14]; $nab=$ui[15]; $norm_hvs=$ui[17]; }

 $query = 'SELECT * FROM uprav WHERE id='.$cat;
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 if ($ui) $catname=$ui[1];

 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
 $limit_voda=$ui2["H_rasch_day"];
 $adr=$ui2["teh_addr"]; 
 if ($ui2["uteplo"]) $ust1='<td class="m_separator" style="background-color: lightgreen">Установлен</td>';
 else $ust1='<td class="m_separator" style="background-color: gray">Не установлен</td>';
 if ($ui2["uvoda"]) $ust2='<td class="m_separator" style="background-color: lightgreen">Установлен</td>';
 else $ust2='<td class="m_separator" style="background-color: gray">Не установлен</td>';
 if ($ui2["uelec"]) $ust3='<td class="m_separator" style="background-color: lightgreen">Установлен</td>';
 else $ust3='<td class="m_separator" style="background-color: gray">Не установлен</td>';

 $query = 'SELECT * FROM devices WHERE type=11 AND object='.$_GET["id"];
 $y = mysql_query ($query,$i);
 if ($y) $uo = mysql_fetch_row ($y);
 if ($uo) $device=$uo[11];
 if ($uo[12]) $status1='<td class="m_separator" style="background-color: lightgreen">Связь есть</td>'; 
 else $status1='<td class="m_separator" style="background-color: red">Нет связи</td>';
 if ($uo[15]) $status2='<td class="m_separator" style="background-color: lightgreen">Связь есть</td>';
 else $status2='<td class="m_separator" style="background-color: red">Нет связи</td>';

 $query = 'SELECT SUM(status) FROM devices WHERE type=15 AND object='.$_GET["id"];
 $y = mysql_query ($query,$i);
 if ($y) $uo = mysql_fetch_row ($y);
 if ($uo[0]) $status3='<td class="m_separator" style="background-color: lightgreen">Связь есть</td>';
 else if ($ui2["uelec"]) $status3='<td class="m_separator" style="background-color: red">Нет связи</td>';
 else $status3='<td class="m_separator" style="background-color: gray"></td>';

 $today=getdate();
 $query='SELECT * FROM channels WHERE prm=4 AND pipe=0 AND lasthours>20100101000000 AND device='.$device;
 if ($e = mysql_query ($query,$i)) { $ui = mysql_fetch_row ($e); $dato1=$ui[12]; }
 $query='SELECT * FROM channels WHERE prm=12 AND pipe=6 AND lasthours>20100101000000 AND device='.$device;
 if ($e = mysql_query ($query,$i)) { $ui = mysql_fetch_row ($e); $dato2=$ui[12]; }
 $query='SELECT * FROM channels WHERE prm=14 AND lasthours>20100101000000 AND ('.$idchan.') ORDER BY lasthours DESC';
 if ($e = mysql_query ($query,$i)) { $ui = mysql_fetch_row ($e); $dato3=$ui[12]; }
 
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 $month=$mn;
// if ($today["mon"]>1) $month=$today["mon"]-1; else $month=1;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];
 if ($startday==1)
	{
	 $date1=sprintf ("%d%02d%02d000000",$ye,$mn+1,$startday);
	 $date2=sprintf ("%d%02d%02d000000",$ye,$mn,$startday);
	}
 else 	
 	{
	 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$startday);
	 if ($mn>1) $date2=sprintf ("%d%02d%02d000000",$ye,$mn-1,$startday);
	 else $date2=sprintf ("%d%02d%02d000000",$ye-1,12,$startday);
	}
 //echo $date2.' - '.$date1.'<br>';

if($_POST['input']==1)
{
 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $query = 'SHOW FULL COLUMNS FROM objects';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 if ($cn>0)
		{
		 $pst=$_POST[$uo[0]];
		 $query='UPDATE objects SET '.$uo[0].'=\''.$pst.'\' WHERE id='.$_POST["objid"];
		 //echo $query.'<br>';
		 mysql_query($query);
		 $ps='cn'.$cn;
		 if ($_POST[$ps]) $pst=1;
		 else $pst=0;
		 $query='UPDATE obj_out SET out'.$cn.'='.$pst;
		 //echo $query.'<br>';
		 mysql_query($query);
		}
	 $cn++;
	 $uo = mysql_fetch_row ($e2);
	}
}
if($_POST['input']==3)
{
 $query = 'SELECT * FROM tarifs WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $query = 'SHOW FULL COLUMNS FROM tarifs';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 if ($cn>0)
		{
		 $field.=$uo[0].',';
		 $values.='\''.$_POST[$uo[0]].'\',';
		}
	 $cn++;
	 $uo = mysql_fetch_row ($e2);
	}
 $field[strlen($field)-1]=' ';
 $values[strlen($values)-1]=' ';
 $query='INSERT INTO tarifs ('.$field.') VALUES ('.$values.')';
 //echo $query;
 mysql_query($query);
}
if($_POST['input']==2)
{
 $query = 'SELECT * FROM trends WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $query = 'SHOW FULL COLUMNS FROM trends';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 if ($cn>0)
		{
		 $field.=$uo[0].',';
		 $values.='\''.$_POST[$uo[0]].'\',';
		}
	 $cn++;
	 $uo = mysql_fetch_row ($e2);
	}
 $field[strlen($field)-1]=' ';
 $values[strlen($values)-1]=' ';
 $query='INSERT INTO trends ('.$field.') VALUES ('.$values.')';
 mysql_query($query);
}
if($_POST['input']==4)
{
 $query = 'SELECT * FROM limits WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $query = 'SHOW FULL COLUMNS FROM limits';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 if ($cn>0)
		{
		 $field.=$uo[0].',';
		 $values.='\''.$_POST[$uo[0]].'\',';
		}
	 $cn++;
	 $uo = mysql_fetch_row ($e2);
	}
 $field[strlen($field)-1]=' ';
 $values[strlen($values)-1]=' ';
 $query='INSERT INTO limits ('.$field.') VALUES ('.$values.')';
 mysql_query($query);
}

?>

<div id="maincontent" >

<table border="0" cellpadding="0" cellspacing="0" width="99%">
<tbody>
<?php
 if ($_GET["menu"]=="report_heat2" || $_GET["menu"]=="report_voda2")
	{
	 print '<table><tr><td class="m_separator">Выбрать период: '; include("ch_mon5.php"); print '</td></tr></table>';
	}
 else
	{
	 print '<tr><td width="59%">
	   <table border="0" cellpadding="0" cellspacing="1">
	   <tr><td class="m_separator" colspan="3">Категория:'.$catname.'</td></tr>
	   <tr><td class="m_separator" colspan="3">Название:'.$name.'</td></tr>
	   <tr><td class="m_separator">Адрес:'.$adr.'</td><td class="m_separator">Выбрать период: ';
	   include("ch_mon.php");
	   print '</td></tr>
	   </table></td>
	   <td width="55%"><table border="0" cellpadding="0" cellspacing="1">
	   <tr><td class="m_separator">Узел учета тепла</td>'.$ust1.$status1.'<td class="m_separator">'.$dato1.'</td></tr>
	   <tr><td class="m_separator">Узел учета воды</td>'.$ust2.$status2.'<td class="m_separator">'.$dato2.'</td></tr>
	   <tr><td class="m_separator">Узел учета ЭЭ</td>'.$ust3.$status3.'<td class="m_separator">'.$dato3.'</td></tr>
	   </table></td>
	   </tr>';
	}
?>

<tr><td colspan="2">
<table border="0" cellpadding="0" cellspacing="0" width="880">
<tbody><tr>
<td>
<?php
 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);
 $nnnm=$ui[1];
 if ($_GET["menu"]=='')
 while ($ui)
	{	 
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);

	 $query='SELECT AVG(value) FROM data WHERE type="4" AND prm="11" AND source="15" AND device='.$uo[11];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($e);	
	 if ($ui) $vod=$uo[0];

	 $query='SELECT AVG(value) FROM data WHERE type="4" AND prm="13" AND source="2" AND device='.$uo[11];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($e);	
	 if ($ui) $tep=$uo[0];

	 print '<div class="feature">
		<h1 class="ul">'.$ui[1].'</h1>
		<div class="dateline_below"></div>
		</div>
		</td></tr>

	<tr><td>
	<table border="0" cellpadding="0" cellspacing="5" width="100%">
	<tbody><tr>
	<td colspan="3"><font size="2">
  	<strong><span id="ajax_name">Тип:  </span>';
	  if ($ui[2]==0) print 'не определен';
	  if ($ui[2]==1) print 'Жилое здание';
	  if ($ui[2]==2) print 'Поставщик энергоресурсов';
	  if ($ui[2]==3) print 'Муниципальный объект';
	  if ($ui[2]==4) print 'Промышленный объект';
	  print '</strong></font></td></tr>

	  <tr>
	  <td valign="top">
	  <table border="0">
	  <tbody><img src="'.$ui[6].'" align="left" width="180px"></tbody></table>
	  </td>

	  <td valign="top">

	  <table border="0">
	  <tbody><tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Узел учета</font></td></tr>
	  <tr><td><b>Корректор:</b></td><td align="right"><span id="ajax_date">'.$uo[1].'</span></td></tr>
	  <tr><td><b>Электросчетчик:</b></td><td align="right"><span id="ajax_amount">Меркурий 230</span></td></tr>
	  <tr><td colspan="2">Комплектация:  преобразователь расхода ПРЭМ-50 (2 шт.),преобразователь температуры КТПТР-01 (2 шт.), счетчик ХВС ЕТКI</td></tr>	
	  <tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Тарифы</font></td></tr>
	  <tr><td><b>Электроэнергия:</b></td><td align="right">1.12</td></tr>
	  <tr><td><b>Вода:</b></td><td align="right">'.$ui[122].'</td></tr>
	  <tr><td><b>Тепло:</b></td><td align="right">'.$ui[121].'</td></tr>
	  <tr><td><b>Газ:</b></td><td align="right">2020</td></tr>
   	  </tbody></table>
	  </td>

	  <td valign="top">
	  <table border="0" width="200">
	  <tbody>
	  <tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Информация об объекте</font></td></tr>
	  <tr><td><b>Работников:</b></td><td align="right">'.$ui[15].'</td></tr>
	  <tr><td><b>Посетителей:</b></td><td align="right">-</td></tr>
	  <tr><td><b>Площадь:</b></td><td align="right">'.$ui[14].'м2</td></tr>
	  <tr bgcolor="#476a94"><td colspan="2" align="center"><font color="white">Нормативное потребление</font></td></tr>
	  <tr><td><b>Электроэнергия:</b></td><td align="right">-</td></tr>
	  <tr><td><b>Вода:</b></td><td align="right">'.$vod.'м3</td></tr>
	  <tr><td><b>Тепло:</b></td><td align="right">'.$tep.'ГКал</td></tr>
	  <tr><td><b>Газ:</b></td><td align="right">-</td></tr>
	  </table></td>

	  <td><img src="charts/barplots25.php?obj='.$_GET["id"].'&type=1"></td>
	  </tr>
	  </table>
	  </td></tr>
	  <tr><td>
	  <table border="0">';
 	  include ("pass.php");
	  print '</table>
	  </td></tr>';

          $ui = mysql_fetch_row ($e);
	}
 if ($_GET["menu"]=='reports')
	{	 
	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<tr><td colspan="2" bgcolor="#5D6D2f" align=center><font color="white" style="font-size:12px">Вывести отчет по определенному ресурсу за произвольное время</td></tr>';
	 print '<tr><td width=200><font class="down">Объект</td><td align=right><select class=log id="object" name="object" style="height:18">';
	 $query = 'SELECT * FROM objects';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{	 
		 $query = 'SELECT * FROM devices WHERE object='.$ui[0];
		 $y = mysql_query ($query,$i);
		 if ($y) $uo = mysql_fetch_row ($y);
		 print '<option value="'.$uo[11].'">'.$ui[1];
		 $ui = mysql_fetch_row ($e);
		}
	 print '</select></td></tr>';
	 print '<tr><td width=200><font class="down">Тип энергоресурса</td><td align=right><select class=log id="source" name="source" style="height:18">';
	 print '<option value="0">По всем ресурсам';
	 print '<option value="1" selected>Тепловая энергия';
	 print '<option value="2">Водоснабжение';
	 print '<option value="3">Электрическая энергия';
	 print '</select></td></tr>';
	 print '<tr><td width=200><font class="down">Тип отчета</td><td align=right><select class=log id="otch" name="otch" style="height:18">';
	 print '<option value="1">Часовой';
	 print '<option value="2" selected>Суточный';
	 print '<option value="4">По месяцам';
	 print '</select></td></tr>';
	 $today = getdate ();
	 print '<tr><td width=120><font class="down">Дата начала отчета</td><td align=right><table><tr><td><select class=log id="day" name="day" style="height:18">';
	 include ("inc/today_day.inc");
	 print '</select></td><td><select class=log id="month" name="month" style="height:18">';
	 include ("inc/today_mon.inc");
	 print '</select></td><td><select class=log id="year" name="year" style="height:18">';
	 include ("inc/today_year.inc");
	 print '</select></tr></table></tr>';
	 print '<tr><td width=120><font class="down">Дата конца отчета</td><td align=right><table><tr><td><select class=log id="eday" name="eday" style="height:18">';
	 include ("inc/today_day.inc");
	 print '</select></td><td><select class=log id="emonth" name="emonth" style="height:18">';
	 include ("inc/today_mon.inc");
	 print '</select></td><td><select class=log id="eyear" name="eyear" style="height:18">';
	 include ("inc/today_year.inc");
	 print '</select></tr></table></tr></td></tr>';
	 print '<tr><td><font class="down">Вывести отчет</font></td><td><input alt="ok" border=0 hspace=3 name=A1 align=left src="files/outp.gif" type=image></td></tr>';
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='qual')
	{	 
	 include ("object_qual.php");
	}
 if ($_GET["menu"]=='qual2')
	{	 
	 include ("object_qual2.php");
	}
 if ($_GET["menu"]=='qual3')
	{	 
	 include ("object_qual3.php");
	}
 if ($_GET["menu"]=='qual4')
	{	 
	 include ("object_qual4.php");
	}

 if ($_GET["menu"]=='reports2')
	{
	 include ("object_reports2.php");
	}

 if ($_GET["menu"]=='eff')
	{	 
         print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) //$ui = mysql_fetch_row ($e);
		 $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
	 if ($ui) $name=$ui[1];
	 $query = 'SELECT * FROM uprav WHERE id='.$ui2["uprav"];
	 $e2 = mysql_query ($query,$i);
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 if ($uo) $uprav=$uo[1];
	 
	 print '<tr><td align=center class="m_separator">Анализ эффективности выполнения энергосервисных контрактов</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="600px" bgcolor="lightgray">';
	 print '<tr><td class="m_separator">Наименование объекта</td><td class="menuitem"><a href="index.php?sel=object">'.$name.'</a></td></tr>';
	 print '<tr><td class="m_separator">Наименование управления</td><td class="menuitem"><a href="index.php?sel=object">'.$uprav.'</a></td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Затраты по проекту</td></tr>';
	 print '<tr><td align=left>';
	 print '<table width="600px" bgcolor="lightgray">';
	 print '<tr><td class="m_separator">Затраты по проекту</td><td class="m_separator">тыс.руб.</td></tr>';
	 print '<tr><td class="m_separator">Затраты на проведение оборудования</td><td></td></tr>';
	 print '<tr><td class="m_separator">Затраты на монтаж</td><td></td></tr>';
	 print '<tr><td class="m_separator">Прочие единовременные затраты</td><td></td></tr>';
	 print '<tr><td class="m_separator">Затраты на эксплуатацию оборудования</td><td></td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Экономия расходов (тыс.руб.)</td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 print '<tr><td align=center class="m_separator">Отчет о потреблении топливно-энергетических ресурсов и средств за 2011 год</td></tr>';
	 print '<tr><td class="simple">Наименование организации '.$name.'</td></tr>';
	 print '<tr><td class="simple">Адрес '.$adr.'</td></tr>';
	 print '<tr><td class="simple">Руководитель (Ф.И.О., тел.)</td></tr>';
	 print '<tr><td class="simple">Наименование энергосберегающих мероприятий</td></tr>';
	 print '<tr><td align=center height="20px"></td></tr>';
	 print '<tr><td align=center><table width="1400px" bgcolor="lightgray">';
	 print '<tr><td class="m_separator">Показатель/Период</td><td class="m_separator">Январь</td><td class="m_separator">Февраль</td><td class="m_separator">Март</td><td class="m_separator">Апрель</td><td class="m_separator">Май</td><td class="m_separator">Июнь</td><td class="m_separator">Июль</td><td class="m_separator">Август</td><td class="m_separator">Сентябрь</td><td class="m_separator">Октябрь</td><td class="m_separator">Ноябрь</td><td class="m_separator">Декабрь</td></tr>';
	 print '<tr><td class="m_separator">Базовое значение потребления тепла, ГКал</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Объем потребления тепла послевнедрения мероприятий, ГКал</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Экономия тепла помесячно, ГКал</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Экономия тепла нарастающим итогом, ГКал</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Тариф, действовавший на период подсчета экономии</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Стоимость сэкономленного тепла помесячно, руб</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '<tr><td class="m_separator">Стоимость сэкономленного тепла нарастающим итогом, руб</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>';
	 print '</table></td></tr>';
	 print '</table>';
	}
 if ($_GET["menu"]=='per')
	{	 
	 include ("object_per.php");
	}
 if ($_GET["menu"]=='per2')
	{	 
	 include ("object_per2.php");
	}

 if ($_GET["menu"]=='pass')
	{	 
	 include ("pass.php");
	}
 if ($_GET["menu"]=='tarifs')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Тарифы на энергоресурсы</h1></td></tr></table>';

	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM tarifs';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:12px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM tarifs';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='limits')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Лимиты финансирования потребления энергетических ресурсов и воды, руб</h1></td></tr></table>';

	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM limits';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:12px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM limits WHERE object='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='trend')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Задания по экономии энергетических ресурсов и воды в процентах</h1></td></tr></table>';

	 print '<table border="0" cellpadding="2" cellspacing="2"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM trends';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:12px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM trends';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='input1')
	{	 
//	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
//	 $e = mysql_query ($query,$i);
//	 if ($e) $ui = mysql_fetch_row ($e);

	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<form method="post" name="add" action="index.php?sel=object&menu=input1&id='.$_GET["id"].'">';
	 print '<input name="objid" type="hidden" value="'.$_GET["id"].'">';
	 print '<input name="input" type="hidden" value="1">';
	 print '<tr><td colspan="2" bgcolor="#5D6D2f" align=center><font color="white" style="font-size:16px">Ввод энергопаспортных данных по объекту '.$ui[1].'</td></tr>';
	 $query = 'SHOW FULL COLUMNS FROM objects';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 $query = 'SELECT * FROM obj_out WHERE id=1';
		 $e3 = mysql_query ($query,$i); 
		 $uq = mysql_fetch_row ($e3);
		 if ($cn>0)
			{	 
			 if ($cn%2) print '<tr><td width=500 bgcolor=#D0EEC2><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 else print '<tr><td width=500><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 if ($uq[$cn]==1) $ch=' checked';
			 else $ch='';
			 if ($uo[1]=='float') print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="10" value="'.$ui[$cn].'"></td><td bgcolor=#D0EEC2><input type="checkbox" name="cn'.$cn.'" '.$ch.'></td></tr>';
			 else  print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="50" value="'.$ui[$cn].'"></td><td bgcolor=#D0EEC2><input type="checkbox" name="cn'.$cn.'" '.$ch.'></td></tr>';
			}
		 $cn++;
		 $uo = mysql_fetch_row ($e2);
		}
	 print '</font>';
	 print '<tr><td><input name="add" value="Сохранить изменения" type="submit"></form></td></tr>';
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='input3')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM trends';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:14px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM trends';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';

	 $query = 'SELECT * FROM trends';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);

	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<form method="post" name="add" action="index.php?sel=object&menu=input3&id='.$_GET["id"].'">';
	 print '<input name="objid" type="hidden" value="'.$_GET["id"].'">';
	 print '<input name="input" type="hidden" value="3">';
	 print '<tr><td colspan="2" bgcolor="#5D6D2f" align=center><font color="white" style="font-size:16px">Ввод заданий по объекту '.$ui[1].'</td></tr>';
	 $query = 'SHOW FULL COLUMNS FROM trends';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0)
			{	 
			 if ($cn%2) print '<tr><td width=500 bgcolor=#D0EEC2><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 else print '<tr><td width=500><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 if ($uo[0]=='object') print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="10" value="'.$_GET["id"].'"></td></tr>';
			 else  print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="50" value="'.$ui[$cn].'"></td></tr>';
			}
		 $cn++;
		 $uo = mysql_fetch_row ($e2);
		}
	 print '</font>';
	 print '<tr><td><input name="add" value="Сохранить изменения" type="submit"></form></td></tr>';
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='input2')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM tarifs';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:14px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM tarifs';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';

	 $query = 'SELECT * FROM tarifs';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);

	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<form method="post" name="add" action="index.php?sel=object&menu=input2&id='.$_GET["id"].'">';
	 print '<input name="input" type="hidden" value="3">';
	 print '<input name="objid" type="hidden" value="'.$_GET["id"].'">';
	 print '<tr><td colspan="2" bgcolor="#5D6D2f" align=center><font color="white" style="font-size:16px">Ввод тарифов по объекту '.$ui[1].'</td></tr>';
	 $query = 'SHOW FULL COLUMNS FROM tarifs';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0)
			{	 
			 if ($cn%2) print '<tr><td width=500 bgcolor=#D0EEC2><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 else print '<tr><td width=500><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 if ($uo[0]=='object') print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="10" value="'.$_GET["id"].'"></td></tr>';
			 else  print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="50" value="'.$ui[$cn].'"></td></tr>';
			}
		 $cn++;
		 $uo = mysql_fetch_row ($e2);
		}
	 print '</font>';
	 print '<tr><td><input name="add" value="Сохранить изменения" type="submit"></form></td></tr>';
	 print '</tbody></table>';
	}
 if ($_GET["menu"]=='input4')
	{	 
	 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr bgcolor=#D0EEC2>';
	 $query = 'SHOW FULL COLUMNS FROM limits';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0) print '<td align="center"><font style="font-size:14px; font-weight: bold">'.$uo[8].'</font></td>';
		 $uo = mysql_fetch_row ($e2); $cn++;
		}
	 print '</tr><tr>';

	 $query = 'SELECT * FROM limits';
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);
	 while ($ui)
		{
		 print '<tr>';
		 for ($h=1; $h<=10; $h++) print '<td align="center">'.$ui[$h].'</td>';
		 print '</tr>';
		 $ui = mysql_fetch_row ($e);
		}
	 print '</tbody></table>';
	 $query = 'SELECT * FROM limits WHERE id='.$_GET["id"];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui = mysql_fetch_row ($e);

	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<form method="post" name="add" action="index.php?sel=object&menu=input4&id='.$_GET["id"].'">';
	 print '<input name="objid" type="hidden" value="'.$_GET["id"].'">';
	 print '<input name="input" type="hidden" value="4">';
	 print '<input name="object" type="hidden" value="'.$_GET["id"].'">';
	 print '<tr><td colspan="2" bgcolor="#5D6D2f" align=center><font color="white" style="font-size:16px">Ввод лимитов по объекту '.$ui[1].'</td></tr>';
	 $query = 'SHOW FULL COLUMNS FROM limits';
	 $e2 = mysql_query ($query,$i); $cn=0;
	 if ($e2) $uo = mysql_fetch_row ($e2);
	 while ($uo)
		{
		 if ($cn>0)
			{	 
			 if ($cn%2) print '<tr><td width=500 bgcolor=#D0EEC2><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 else print '<tr><td width=500><font style="font-size:12px">'.$uo[8].'</td><td align=left>';
			 if ($uo[0]=='object') print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="10" value="'.$_GET["id"].'"></td></tr>';
			 else  print '<input id="'.$uo[0].'" name="'.$uo[0].'" size="50" value="'.$ui[$cn].'"></td></tr>';
			}
		 $cn++;
		 $uo = mysql_fetch_row ($e2);
		}
	 print '</font>';
	 print '<tr><td><input name="add" value="Сохранить изменения" type="submit"></form></td></tr>';
	 print '</tbody></table>';
	}

 if ($_GET["menu"]=='register')
	{
	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody><tr><td>
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
		</tr>';
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
	 print '</tbody></table></td></tr></tbody></table></td></tr></tbody></table>';
	}
 if ($_GET["menu"]=='trends')
	{
	 print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
	 print '<tr><td align=center class="m_separator"><font color="black">Температура во входящем и обратном трубопроводах ['.$name.']</td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=1&&x=1670&y=230&device='.$uo[11].'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1670" height="230"></td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=2&&x=1670&y=230&device='.$uo[11].'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1670" height="230"></td></tr>';
	 print '<tr><td align=center class="m_separator"><font color="black">Расход теплофикационной воды ['.$name.']</td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=3&&x=1670&y=230&device='.$uo[11].'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1670" height="230"></td></tr>';
	 print '<tr><td align=center class="m_separator"><font color="black">Расход воды ['.$name.']</td></tr>';
	 print '<tr><td><img src="charts/trend2.php?type=1&prm=4&&x=1670&y=230&device='.$uo[11].'&name='.$ui[1].'&month='.$_GET["month"].'&year='.$_GET["year"].'" width="1670" height="230"></td></tr>';
	 print '</table>';
	}
 if ($_GET["menu"]=='report_heat') include ("object_report_heat.php");
 if ($_GET["menu"]=='report_heat2') include ("object_report_heat2.php");
 if ($_GET["menu"]=='report_electr') include ("object_report_electr.php");
 if ($_GET["menu"]=='report_voda') include ("object_report_water.php");
 if ($_GET["menu"]=='report_voda2') include ("object_report_water2.php");
 if ($_GET["menu"]=='report261') include ("object_report261.php");
 if ($_GET["menu"]=='reports3')	 include ("object_report261.php");

 if ($_GET["menu"]=='report_water') include ("object_repwater.php");
 if ($_GET["menu"]=='raspvoda')
	{
	 include ("object_raspvoda.php");
	}
 if ($_GET["menu"]=='raspheat')
	{
	 include ("object_raspheat.php");
	}
 if ($_GET["menu"]=='raspheat2')
	{
	 include ("object_raspheat2.php");
	}

 if ($_GET["menu"]=='rasphour')
	{
	 include ("object_raspvoda.php");
	}
 if ($_GET["menu"]=='hours')
	{
	 include ("object_hours.php");
	}
 if ($_GET["menu"]=='days')
	{
	 include ("object_days.php");
	}
 if ($_GET["menu"]=='month')
	{
	 include ("object_month.php");
	}
 if ($_GET["menu"]=='mnem')
	{
	 include ("object_mnem.php");
	}
 if ($_GET["menu"]=='swater')
	{
	 include ("object_swater.php");
	}
 if ($_GET["menu"]=='overlimit')
	{
	 include ("object_overlimit.php");
	}
 if ($_GET["menu"]=='overlimit2')
	{
	 include ("object_overlimit2.php");
	}
 if ($_GET["menu"]=='rrr')
	{
	 include ("object_rrr.php");
	}
 if ($_GET["menu"]=='object_avar')
	{
	 include ("object_avar.php");
	}
 if ($_GET["menu"]=='object_avar1')
	{
	 include ("object_awater.php");
	}
 if ($_GET["menu"]=='object_avar2')
	{
	 include ("object_aheat.php");
	}
 if ($_GET["menu"]=='object_avar3')
	{
	 include ("object_aelectr.php");
	}
 if ($_GET["menu"]=='hours_electro')
	{
	 include ("object_hours_electro.php");
	}
 if ($_GET["menu"]=='days_electro')
	{
	 include ("object_days_electro.php");
	}
 if ($_GET["menu"]=='month_electro')
	{
	 include ("object_month_electro.php");
	}
 if ($_GET["menu"]=='prog')
	{
	 $file='prog/'.$_GET["id"].'.php';
	 include ($file);
	}
?>

</tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
</td></tr></tbody></table>
<br><br><br><br><br><br><br><br>
</div>