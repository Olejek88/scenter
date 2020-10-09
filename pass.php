<link rel="stylesheet" type="text/css" href="files/quote.css">

<?php      
 if ($_POST["frm"]=='2')
	{
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $f1='1-0-'.$ye; $f2='3-0-'.$ye;
	     $date1=sprintf ("%d0101000000",$ye);
	     $dat[$cn]=sprintf ("%d-01-01 00:00:00",$ye);
	     $query = 'SELECT * FROM trends WHERE object='.$_GET["id"].' AND date='.$date1;
	     echo $query.'<br>'; 	     
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);

	     if ($uy) $query = 'UPDATE trends SET nabs='.$_POST[$f1].', qrab='.$_POST[$f2].',date=date WHERE object='.$_GET["id"].' AND year='.$ye;
	     else $query = 'INSERT INTO trends SET nabs='.$_POST[$f1].', qrab='.$_POST[$f2].', object='.$_GET["id"].', year='.$ye;
	     $a = mysql_query ($query,$i);
	     echo $query.'<br>'; 	     
	     $ye--;
	    }
	}
 if ($_POST["frm"]=='4')
	{
	 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
	 $y = mysql_query ($query,$i);
	 if ($y) $uo = mysql_fetch_row ($y);
	 if ($uo) $device=$uo[11];

	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++, $ye--)
	 for ($t3=0; $t3<=3; $t3++)
	    {	 
	     if ($t3==0) { $f='14-0-'.$ye; $prm=14; $source=0; }
	     if ($t3==1) { $f='13-0-'.$ye; $prm=13; $source=0; }
	     if ($t3==2) { $f='11-8-'.$ye; $prm=11; $source=8; }
	     if ($t3==3) { $f='12-6-'.$ye; $prm=12; $source=6; }
		echo $f.'<br>';
	     $date1=sprintf ("%d0101000000",$ye);
	     if ($_POST[$f])
		{
	  	 $query = 'SELECT * FROM data WHERE prm='.$prm.' AND source='.$source.' AND type=4 AND device='.$device.' AND date='.$date1;
		 echo $query.'<br>'; 	     
	     	 $a = mysql_query ($query,$i);
	     	 if ($a) $uy = mysql_fetch_row ($a);
		 if ($uy) $query = 'UPDATE data SET value='.$_POST[$f].',date=date WHERE prm='.$prm.' AND source='.$source.' AND type=4 AND device='.$device.' AND date='.$date1;
		 else $query = 'INSERT INTO data SET value='.$_POST[$f].', prm='.$prm.', source='.$source.', type=4, device='.$device.', date='.$date1;
	     	 $a = mysql_query ($query,$i);
		 echo $query.'<br>'; 	     
		}
	     $cn++;
	    }
	}
 if ($_POST["frm"]=='13')
	{
	 $query = 'UPDATE objects SET H_rasch_year='.$_POST["udv1"].',H_rasch_ud='.$_POST["udv2"].',Q_rasch_ot='.$_POST["udv3"].',Q_ud_ot='.$_POST["udv4"].' WHERE id='.$_GET["id"];
     	 //echo $query.'<br>'; 	     
	}

 print '<table border="0" cellpadding="2" cellspacing="1" style="width:100%"><tbody>';
 print '<tr><td colspan=2 align="center"><h1>Энергетический паспорт организации</h1></td></tr>';
 print '</table>';
 print '<table class="nav" style="width:1050px"><tr>';
	for ($frm=1;$frm<=23;$frm++)
		print '<td width="120" height="22" align="center"><a href="index.php.?sel=object&menu=pass&frm='.$frm.'&id='.$_GET["id"].'">Форма №'.$frm.'</a></td>';
 print '</tr></table>';

 if ($_GET["frm"]=='') $_GET["frm"]='1';

 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
 $e = mysql_query ($query,$i);
 if ($e) $ui = mysql_fetch_row ($e);

 $query = 'SELECT * FROM obj_out WHERE id=1';
 $e3 = mysql_query ($query,$i); 
 if ($e3) $uq = mysql_fetch_row ($e3);

 $query = 'SHOW FULL COLUMNS FROM objects';
 $e2 = mysql_query ($query,$i); $cn=0;
 if ($e2) $uo = mysql_fetch_row ($e2);
 while ($uo)
	{
	 $uo = mysql_fetch_row ($e2); $cn++;
	}
 print '<form name="frm1" method="post" action="index.php?sel=pass&frm='.$_GET["frm"].'&id='.$_GET["id"].'" id="Form1">';
 if ($_GET["frm"]=='1')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="ps">Некоммерческое партнерство "Совет энергоаудиторских фирм нефтяной и газовой промышленности" 
	 <br>СРО-Э-010</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(наименование саморегулируемой организации)</td></tr>';
	 print '<tr><td colspan="2" align="center" class="ps">Общество с ограниченной ответственностью "Проект-сервис"</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(наименование организации (лица), проводившего энергетическое обследование)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:40px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="psb">ЭНЕРГЕТИЧЕСКИЙ ПАСПОРТ Рег. <u>№ СРО-Э-010-012.2011-</u></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">потребителя топливно-энергетических ресурсов</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:40px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="psb">Муниципальное дошкольное образовательное учреждение детский сад общеразвивающего вида с приоритетным осуществлением художественно-эстетического направления развития воспитанников № 428 г.Челябинска</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(наименование обследованной организации (объекта))</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="ps">Составлен по результатам обязательного энергетического обследования</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:120px"></td></tr>';
         print '<tr><td align="left" class="ps" style="50%">Генеральный директор ООО "Проект-сервис"</td>
		    <td align="right" class="ps" style="50%" valign="top">Н.С. Багина
		    <img src="files/bl.gif" width="100%" height="1px"><br>
		    <font style="font-size:11px">(подпись лица, проводившего энергетическое обследование (руководителя юридического лица, индивидуального предпринимателя, физического лица) и печать юридического лица, индивидуального предпринимателя)</font></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:80px"></td></tr>';
         print '<tr><td align="left" class="ps" style="width:50%">Заведующий Муниципального дошкольного образовательного учреждения детский сад общеразвивающего вида с приоритетным осуществлением художественно-эстетического направления развития воспитанников № 428 г.Челябинска </td>
		    <td align="right" class="ps" style="width:50%" valign="top">С.А. Сочнева
		    <img src="files/bl.gif" width="100%" height="1px"><br>
		    <font style="font-size:11px">(должность и подпись руководителя единоличного (коллегиального) исполнительного органа организации, заказавшей проведение энергетического обследования, или уполномоченного им лица)</font></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:80px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="ps">Май 2011</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="30%" height="1px"></td></tr>';
	 print '<tr><td colspan="2" align="center" class="simple">(месяц, год составления паспорта)</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='2')
	{
	 print '<input name="frm" type="hidden" value="2">';
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $query = 'SELECT * FROM trends WHERE object='.$_GET["id"].' AND year='.$ye;
	     //echo $query.'<br>'; 	     
	     if ($a = mysql_query ($query,$i))
	     if ($uy = mysql_fetch_row ($a))
		{
	       	 $data3[$cn]=$uy[9];
	       	 $data15[$cn]=$uy[10];
		}
	     $ye--;
	     $cn++;
	    }

	 print '<table border="0" cellpadding="2" cellspacing="2" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="1" align="left" class="ps">Форма №'.$_GET["frm"].'</td><td><input name="add" value="сохранить" type="submit"></td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Общие сведения об объекте энергетического обследования</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="ps">Муниципальное дошкольное образовательное учреждение детский сад общеразвивающего
		вида с приоритетным осуществлением художественно-эстетического направления развития воспитанников № 428 г.Челябинска</td></tr>';
	 print '<tr><td colspan="2" align="center"><img src="files/bl.gif" width="100%" height="1px"></td></tr>';
         print '<tr><td colspan="2" align="center" class="simple">(полное наименование организации)</td></tr>';
	 print '<tr><td colspan="2" class="ps">1. Организационно-правовая форма <u>Муниципальное дошкольное образовательное учреждение</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">2. Юридический адрес <u>454071, г. Челябинск, ул. Шуменская, д. 12</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">3. Фактический адрес <u>454071, г. Челябинск, ул. Шуменская, д. 12</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">4. Наименование основного общества (для дочерних (зависимых) обществ) <u>-</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">5. Доля государственной (муниципальной) собственности, % (для акционерных обществ) <u>-</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">6. Банковские реквизиты, <u>ИНН 7452019970, КПП 745201001, л/с 0348306572Б, л/с 0747306455В в Комитeте финансов г. Челябинска</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">7. Код по ОКВЭД <u>80.10.1</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">8. Ф.И.О., должность руководителя <u>Сочнева Светлана Альбертовна, заведующий</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">9. Ф.И.О., должность, телефон, факс должностного лица, ответственного за техническое состояние
								оборудования <u>Смирнова Инна Валерьевна, заместитель заведующего по административно-хозяйственной части, тел. 8(351)772-58-55</u></td></tr>';
	 print '<tr><td colspan="2" class="ps">10. Ф.И.О., должность, телефон, факс должностного лица, ответственного за энергетическое хозяйство <u>Сушенцев Михаил Владимирович, директор ООО "СтройКонтроль", тел. 8(351)793-09-00</u></td></tr>';
	 print '<tr><td colspan="2" align="right" class="ps">(Таблица 1)</td></tr>';
	 print '<tr><td colspan="2" class="ps">
		<table border="0" cellpadding="2" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>Наименование</td><td>Единица измерения</td><td colspan="4">Предшествующие годы*</td><td>Отчетный (базовый)**</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td>2010 год**</td></tr>
		<tr bgcolor="#ffffff"><td>1. Номенклатура основной продукции (работ, услуг)</td><td colspan="6">Услуги в области дошкольного образования, предоставляемые дошкольными образовательными учреждениями</td></tr>
		<tr bgcolor="#ffffff"><td>1.1. Код основной продукции (работ,услуг) по ОКП</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2. Объем производства продукции (работ, услуг) </td><td>тыс. руб.</td><td>-</td><td>-</td><td>7409,4</td><td>9738,5</td><td>10386,3</td></tr>
		<tr bgcolor="#ffffff"><td>3. Производство продукции в натуральном выражении, всего </td><td>чел.</td><td><input name="1-0-2006" class="simple2" value="'.$data3[4].'"></td><td><input name="1-0-2007" class="simple2" value="'.$data3[3].'"></td><td><input name="1-0-2008" class="simple2" value="'.$data3[2].'"></td><td><input name="1-0-2009" class="simple2" value="'.$data3[1].'"></td><td><input name="1-0-2010" class="simple2" value="'.$data3[0].'"></td></tr>
		<tr bgcolor="#ffffff"><td>4. Объем производства основной продукции, всего</td><td> тыс. руб.</td><td>-</td><td>-</td><td>7409,4</td><td>9738,5</td><td>10386,3</td></tr>
		<tr bgcolor="#ffffff"><td>5. Производство основной продукции в натуральном выражении, всего</td><td>чел.</td><td>-</td><td>-</td><td>266</td><td>248</td><td>250</td></tr>
		<tr bgcolor="#ffffff"><td>6. Объем производства дополнительной продукции</td><td>тыс.руб.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>7. Потребление энергетических ресурсов, всего</td><td>тыс. т у.т.</td><td>-</td><td>-</td><td>0,160</td><td>0,176</td><td>0,159</td></tr>
		<tr bgcolor="#ffffff"><td>8. Потребление энергетических ресурсов по номенклатуре основной продукции, всего</td><td>тыс. т у.т.</td><td>-</td><td>-</td><td>0,160</td><td>0,176</td><td>0,159</td></tr>
		<tr bgcolor="#ffffff"><td>9. Объем потребления энергетических ресурсов по номенклатуре основной продукции, всего</td><td>тыс. руб.</td><td>138,0</td><td>102,0</td><td>643,5</td><td>749,9</td><td>915,3</td></tr>
		<tr bgcolor="#ffffff"><td>10. Потребление воды, всего</td><td>тыс.куб.м</td><td>-</td><td>-</td><td>7,8</td><td>9,2</td><td>7,9</td></tr>
		<tr bgcolor="#ffffff"><td>в т.ч. на производство основной продукцию</td><td>тыс.куб.м</td><td>-</td><td>-</td><td>7,8</td><td>9,2</td><td>7,9</td></tr>
		<tr bgcolor="#ffffff"><td>11. Энергоемкость производства продукции (работ, услуг) всего</td><td> тыс. т у.т./тыс. руб.</td><td>-</td><td>-</td><td>0,000022</td><td>0,000018</td><td>0,000015</td></tr>
		<tr bgcolor="#ffffff"><td>12. Энергоемкость производства продукции (работ, услуг) по номенклатуре основной продукции, всего</td><td>тыс. т у.т./ тыс.руб.</td><td>-</td><td>-</td><td>0,000022</td><td>0,000018</td><td>0,000015</td></tr>
		<tr bgcolor="#ffffff"><td>13. Доля платы за энергетические ресурсы в стоимости произведенной продукции (работ, услуг)</td><td>%</td><td>-</td><td>-</td><td>9</td><td>8</td><td>9</td></tr>
		<tr bgcolor="#ffffff"><td>14. Суммарная мощность электроприемных устройств:
						-разрешенная установленная</td><td>тыс. кВт.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>	-среднегодовая заявленная</td><td>тыс. кВт.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>15. Среднегодовая численность работников</td><td>чел.</td><td><input name="3-0-2006" class="simple2" value="'.$data15[4].'"></td><td><input name="3-0-2007" class="simple2" value="'.$data15[3].'"></td><td><input name="3-0-2008" class="simple2" value="'.$data15[2].'"></td><td><input name="3-0-2009" class="simple2" value="'.$data15[1].'"></td><td><input name="3-0-2010" class="simple2" value="'.$data15[0].'"></td></tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps">Примечание: Данные по мощности электроприемных устройств организацией не предоставлены.</td></tr>';
	print '<tr><td colspan="2" class="ps">Примечание: Данные за 2006, 2007 года сохранились не в полном объеме.</td></tr>';
	print '<tr><td colspan="2" align="right" class="ps">(Таблица 2)</td></tr>';
	print '<tr><td colspan="2" align="center" class="ps">Сведения об обособленных подразделениях организации</td></tr>';
	print '<tr><td colspan="2" class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование подразделения</td><td>Фактический адрес</td><td>ИНН/КПП (в случае отсутствия - территориальный код ФНС)</td><td>Среднегодовая численность работников </td><td>в т.ч. промышленно-производственный персонал</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps">* -четыре предшествующих отчетному (базовому) году
		** -последний полный календарный год перед датой составления энергетического паспорта
		Примечание: Обособленных подразделений организация не имеет.</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='3')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения об оснащенности приборами учета</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование показателя</td><td>Количество, шт.</td><td colspan="2">Тип прибора</td><td> Примечание</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>марка</td><td>класс точности</td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="6">1. Электрической энергии</td></tr>
		<tr bgcolor="#ffffff"><td>1.1.</td><td>Количество оборудованных приборами вводов всего,в том числе:</td><td align="center">2</td><td colspan="2" align="center">-</td><td align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>потребляемой</td><td>2</td><td>Меркурий 230</td><td>0.5</td><td>Дата ввода в эксплуатацию - 04.2011 г.</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.2.</td><td>Количество не оборудованных приборами вводов всего, в том числе:</td><td>-</td><td colspan="2">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>потребляемой</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td></td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.3.</td><td>Количество приборов учета с нарушенными сроками поверки</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.4.</td><td>Количество приборов учета с нарушением требований нормативной технической документации к классу точности приборов</td><td>-</td><td colspan="2">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>1.5.</td><td>Рекомендации по совершенствованию системы учета электрической энергии</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>2.</td><td colspan="5" align="center">Тепловой энергии</td></tr>
		<tr bgcolor="#ffffff"><td>2.1.</td><td>Количество оборудованных  приборами вводов всего, в том числе:</td><td>1</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемой</td><td>1</td><td>Измерительный	комплекс "ТЭКОН-19"</td><td>С</td><td>Комплектация: вычислитель "Тэкон-19" (1 шт.), дата поверки 28.01.2011, преобразователь расхода ПРЭМ-50 (2 шт.),преобразователь температуры КТПТР-01 (2 шт.)</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.2.</td><td>Количество не оборудованных приборами вводов всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемой</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.3.</td><td>Количество приборов учета с нарушенными сроками поверки</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.4.</td><td>Количество приборов учета с нарушением требований нормативной технической документации к классу точности приборов</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>2.5.</td><td>Рекомендации по совершенствованию системы учета тепловой энергии</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>3.</td><td colspan="5" align="center">Жидкого топлива</td></tr>
		<tr bgcolor="#ffffff"><td>3.1.</td><td>Количество оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученного со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемого</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданного на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.2.</td><td>Количество не оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученного со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемого</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданного на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.3.</td><td>Количество приборов учета с нарушенными сроками поверки</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.4.</td><td>Количество приборов учета с нарушением требований нормативной технической документации к классу точности приборов</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>3.5.</td><td>Рекомендации по совершенствованию системы учета жидкого топлива</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>4.</td><td colspan="5" align="center">Газа</td></tr>
		<tr bgcolor="#ffffff"><td>4.1.</td><td>Количество не оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученного со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемого</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданного на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.2.</td><td>Количество не оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученного со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемого</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданного на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.3.</td><td>Количество приборов учета с нарушенными сроками поверки всего</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.4.</td><td>Количество приборов учета с нарушением требований нормативной технической документации к классу точности приборов всего</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>4.5.</td><td>Рекомендации по совершенствованию системы учета газа</td><td colspan="5" align="center">-</td></tr>
		<tr bgcolor="#ffffff"><td>5.</td><td colspan="5" align="center">Воды</td></tr>
		<tr bgcolor="#ffffff"><td>5.1.</td><td>Количество оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>1</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемой</td><td>1</td><td>Крыльчаый ЕТКI</td><td> В</td><td> Счетчик ХВС. Дата поверки 15.09.2010.</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.2.</td><td>Количество не оборудованных приборами мест поступления (отгрузки) всего, в том числе:</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>полученной со стороны</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>собственного производства</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>потребляемой</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"></td><td><td>отданной на сторону</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.3.</td><td>Количество приборов учета с нарушенными сроками поверки всего</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.4.</td><td>Количество приборов учета с нарушением требований нормативной технической документации к классу точности приборов всего</td><td>-</td><td colspan="2" align="center">-</td><td>-</td></tr>
		<tr bgcolor="#ffffff"><td>5.5.</td><td>Рекомендации по совершенствованию системы учета воды</td><td colspan="5" align="center">-</td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='4')
	{
	 print '<input name="frm" type="hidden" value="4">';
	 print '<input name="device" type="hidden" value="'.$device.'">';
	 $today=getdate();
	 $ye=$today["year"]; $qnt=4; $ye=2010; $cn=0;
	 for ($tn=0; $tn<=$qnt; $tn++)
	    {	 
	     $date1=sprintf ("%d0101000000",$ye);
	     $dat[$cn]=sprintf ("%d-01-01 00:00:00",$ye);
		 $query = 'SELECT * FROM devices WHERE object='.$_GET["id"];
		 $y = mysql_query ($query,$i);
		 if ($y) $uo = mysql_fetch_row ($y);
		 if ($uo) $device=$uo[11];

	     $query = 'SELECT * FROM data WHERE type=4 AND device='.$device.' AND date='.$date1;
	     //echo $query.'<br>'; 	     
	     $a = mysql_query ($query,$i);
	     if ($a) $uy = mysql_fetch_row ($a);			 
	     while ($uy)
	      	{
	       	 if ($uy[8]==14 && $uy[6]==0) $data11[$cn]=number_format($uy[3],2);
	       	 if ($uy[8]==13 && $uy[6]==0) $data12[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==11 && $uy[6]==8) $data16[$cn]=number_format($uy[3],3);
	       	 if ($uy[8]==12 && $uy[6]==6) $data17[$cn]=number_format($uy[3],3);
	       	 $uy = mysql_fetch_row ($a);	     
	      	}
	     $ye--;
	     $cn++;
	    }
	 print '<table border="0" cellpadding="2" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="1" align="left" class="ps">Форма №'.$_GET["frm"].'</td><td><input name="add" value="сохранить" type="submit"></td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о потреблении энергетических ресурсов и его изменениях</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование энергоносителя</td><td>Единица измерения (ненужное зачеркнуть)</td><td colspan="4">Предшествующие годы</td><td>Отчетный (базовый) 2010 год</td><td>Примечание</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="8">Объем потребления:</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>Электрической энергии</td><td>тыс. кВт.ч</td><td><input name="14-0-2006" class="simple2" value="'.$data11[4].'"></td><td><input name="14-0-2007" class="simple2" value="'.$data11[3].'"></td><td><input name="14-0-2008" class="simple2" value="'.$data11[2].'"></td><td><input name="14-0-2009" class="simple2" value="'.$data11[1].'"></td><td><input name="14-0-2010" class="simple2" value="'.$data11[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>Тепловой энергии</td><td>Гкал</td><td><input name="13-0-2006" class="simple2" value="'.$data12[4].'"></td><td><input name="13-0-2007" class="simple2" value="'.$data12[3].'"></td><td><input name="13-0-2008" class="simple2" value="'.$data12[2].'"></td><td><input name="13-0-2009" class="simple2" value="'.$data12[1].'"></td><td><input name="13-0-2010" class="simple2" value="'.$data12[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>Твердого топлива</td><td> т, куб. м</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>Жидкого топлива</td><td> т, куб. м</td><td> - </td><td>-</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>Моторного топлива всего, в том числе:</td><td> л, т</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>бензина</td><td>л, т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>керосина</td><td>л, т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>дизельного топлива</td><td>л, т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>газа</td><td>тыс. куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td> Природного газа (кроме моторного топлива)</td><td>тыс. куб.м</td><td><input name="11-8-2006" class="simple2" value="'.$data16[4].'"></td><td><input name="11-8-2007" class="simple2" value="'.$data16[3].'"></td><td><input name="11-8-2008" class="simple2" value="'.$data16[2].'"></td><td><input name="11-8-2009" class="simple2" value="'.$data16[3].'"></td><td><input name="11-8-2010" class="simple2" value="'.$data16[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td> Воды</td><td>тыс. куб.м</td><td><input name="12-6-2006" class="simple2" value="'.$data17[4].'"></td><td><input name="12-6-2007" class="simple2" value="'.$data17[3].'"></td><td><input name="12-6-2008" class="simple2" value="'.$data17[2].'"></td><td><input name="12-6-2009" class="simple2" value="'.$data17[1].'"></td><td><input name="12-6-2010" class="simple2" value="'.$data17[0].'"></td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="8"> Объем потребления с использованием возобновляемых источников энергии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td> Электрической энергии</td><td>тыс. кВт.ч</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td> Тепловой энергии</td><td>Гкал</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="8" > Обоснование снижения или увеличения потребления</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td>Электрической энергии</td><td colspan="7">Увеличение объемов потребления электроэнергии в 2009 году связано с проведением		ремонтных работ с применением сварочного оборудования. Снижение потребления в 2010 году	связано с ужесточением контроля за расходованием энергоресурса, заменой части ламп	накаливания на компактные люминесцентные лампы. Данные по потреблению электроэнергии	за 2006, 2007 года не сохранились.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td> Тепловой энергии</td><td colspan="7">Колебания объемов потребления тепловой энергии на отопление и ГВС в размере 5-7% связаны с климатическими условиями региона (число дней отопительного периода, средняя температура за отопительный период), с изменением расхода тепловой энергии на нужды ГВС в соответствии с изменением числа воспитанников, с проведением мероприятий по утеплению оконных и дверных проемов. Гидроизоляция и утепление кровли нарушены, работы по ремонту кровли проводились в 2005 г. Данные по потреблению тепловой энергии за 2006, 2007 года не сохранились. В 2010 году выполнялась замена замена прибора учета, расчеты за потребленную тепловую энергию производились в соответствии с договорными условиями.  </td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td> Твердого топлива</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td> Жидкого топлива</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td> Моторного топлива, в том числе:</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>бензина</td><td colspan="7"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>керосина</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>дизельного топлива</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"></td><td><td>газа</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.6.</td><td> Природного газа (кроме моторного топлива)</td><td colspan="7">-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.7.</td><td>Воды</td><td colspan="7"> Увеличение объемов потребления хозяйственно-питьевой воды в 2009 году связано саварийными ситуациями в инженерных сетях, а также с увеличением объемов полива газонов.Данные по потреблению хозяйственно-питьевой воды за 2006, 2007 года не сохранились.  </td></tr>';
	 print '</table>';
	}
 if ($_GET["frm"]=='5')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения по балансу электрической энергии и его изменениях (в тыс. кВт.ч)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Статья приход/расход</td>
		<td colspan="4">Предшествующие годы</td><td>Отчетный (базовый) 2010 год</td>
		<td colspan="5">Прогноз на последующие годы*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>Приход</td><td colspan="10"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>Сторонний источник</td><td>-</td><td>-</td><td>80,20</td><td>109,42</td><td>83,01</td><td>83,01</td><td>74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>Собственный источник</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный приход</td><td> -</td><td> -</td><td> 80,20</td><td> 109,42</td><td> 83,01</td><td> 83,01</td><td> 74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>Расход</td><td colspan="10"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>Технологический расход</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td><td> 55,20</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>Расход на собственные нужды</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>Субабоненты (сторонние потребители)</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>Фактические (отчетные) потери</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>Технологические потери всего, в том числе:</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 0,41</td><td> 0,41</td><td> 0,37</td><td> 0,28</td><td> 0,28</td><td> 0,28</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>условно-постоянные</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>нагрузочные</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>потери, обусловленные допустимыми погрешностями приборов учета</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 0,41</td><td> 0,41</td><td> 0,37</td><td> 0,28</td><td> 0,28</td><td> 0,28</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>Нерациональные потери</td><td> -</td><td> -</td><td> -</td><td> -</td><td> 27,40</td><td> 27,40</td><td> 18,68</td><td> -</td><td> -</td><td> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный расход</td><td> -</td><td> -</td><td> 80,20</td><td> 109,42</td><td> 83,01</td><td> 83,01</td><td> 74,25</td><td> 55,48</td><td> 55,48</td><td> 55,48</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*Графы, рекомендуемые к заполнению<br>
	Примечание: Статьи расхода за период, предшествующий базовому году, определить невозможно из-за отсутствия достоверных данных по режимам работы силового и осветительного оборудования.</td></tr>';
	}
 if ($_GET["frm"]=='6')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения по балансу тепловой энергии и его изменениях (в Гкал)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Статья приход/расход</td>
		<td colspan="4">Предшествующие годы</td><td>Отчетный (базовый) 2010 год</td>
		<td colspan="5">Прогноз на последующие годы*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="11"> Приход</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td> Собственная котельная </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td> Сторонний источник </td><td>-</td><td>-</td><td>891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный приход </td><td>-</td><td>-</td><td>891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="11"> Расход</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>Технологические расходы всего, в том числе </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>пара, из них контактным (острым) способом </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>горячей воды </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.2.<td> Отопление и вентиляция, в том числе калориферы воздушные </td><td>-</td><td>-</td><td>-</td><td> 591,3</td><td> 612,2</td><td> 591,3</td><td> 591,3</td><td> 591,3</td><td> 591,3</td><td> 591,3</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td> Горячее водоснабжение </td><td>-</td><td>-</td><td>-</td><td> 64,2</td><td> 64,3</td><td> 64,2</td><td> 64,2</td><td> 64,2</td><td> 64,2</td><td> 64,2</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td> Сторонние потребители (субабоненты) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td> Суммарные сетевые потери </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого производственный расход </td><td>-</td><td>-</td><td>-</td><td>655,5</td><td> 676,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td><td> 655,5</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td> Нерациональные технологические потери в системах	отопления, вентиляции, горячего водоснабжения </td><td>-</td><td>-</td><td>-</td><td> 276,0</td><td> 206,5</td><td> 127,5</td><td> 117,7</td><td> 81,6</td><td> 18,0</td><td> 9,0</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный расход </td><td>-</td><td>-</td><td> 891,9</td><td> 931,5</td><td> 883,0</td><td> 783,0</td><td> 773,2</td><td> 737,1</td><td> 673,5</td><td> 664,5</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*Графы, рекомендуемые к заполнению<br>Примечание: Статьи расхода за период, предшествующий 2009 году, определить невозможно из-за отсутствия достоверных данных по режимам работы систем отопления, вентиляции и горячего водоснабжения.</td></tr>';
	}
 if ($_GET["frm"]=='7')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения по балансу потребления котельно-печного топлива и его изменениях (потребление в т у.т.)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Статья приход/расход</td>
		<td colspan="4">Предшествующие годы</td><td>Отчетный (базовый) 2010 год</td>
		<td colspan="5">Прогноз на последующие годы*</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>2006</td><td>2007</td><td>2008</td><td>2009</td><td></td><td>2011</td><td>2012</td><td>2013</td><td>2014</td><td>2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="11"> Приход </td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный приход </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.</td><td colspan="11">Расход</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td>2.1.</td><td>Технологическое использование всего, в том числе </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>нетопливное использование (в виде сырья) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>нагрев </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>сушка </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>обжиг (плавление, отжиг) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>На выработку тепловой энергии всего, в том числе: </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>в котельной </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>в собственной ТЭС (включая выработку электроэнергии) </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Итого суммарный расход </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">*Графы, рекомендуемые к заполнению <br>Примечание: Организация котельно-печное топливо не потребляет';
	}
 if ($_GET["frm"]=='8')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения по балансу потребления видов моторного топлива и его изменениях</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>Вид транспортных средств</td><td>Количество транспортных средств </td><td>Грузоподъемность т, пассажировместимость, чел</td><td>Вид использованного топлива</td><td>Уд.расход топлива по паспортным данным, л/100км, л/моточас</td><td>Пробег, тыс. км отработано, маш/час</td><td>Объем грузоперевозок, тыс. т-км, тыс.пасс-км.</td><td>Количество израсходованного</td><td>топлива, тыс.л, м3</td><td>Способ измерения расхода топлива</td><td>Уд.расход топлива , л/т-км, л/пасс-км, л/100 км, л/моточас</td><td>Количество полученного топлива, тыс. л, тыс.м3</td><td>Потери топлива, тыс.л, тыс.м3</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	print '</table>';
	print '<tr><td colspan="2" class="ps">Примечание: Организация моторное топливо не потребляет</td></tr>';
	}
 if ($_GET["frm"]=='9')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения об использовании вторичных энергетических ресурсов, альтернативных (местных) топлив и возобновляемых источников энергии</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование характеристики</td><td>Единица измерения</td><td>Значение характеристики</td><td>Примечание</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>Вторичные (тепловые) энергетические ресурсы (ВЭР)</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>Характеристика ВЭР </td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.1.</td><td>Фазовое состояние <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.2.</td><td>Расход</td><td>м3/ч <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.3.</td><td>Давление</td><td>МПа <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.4.</td><td>Температура</td><td>C<td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.5.</td><td>Характерные загрязнители, их концентрация</td><td>% <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>Годовой выход ВЭР</td><td>Гкал <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>Годовое фактическое использование</td><td>Гкал <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>Альтернативные (местные) и возобновляемые виды ТЭР <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>Наименование (вид) <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>Основные характеристики <td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.1.</td><td>Теплотворная способность</td><td>ккал/кг <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.2.</td><td>Годовая наработка энергоустановки</td><td>ч <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>Мощность энергетической установки</td><td>Гкал/ч, кВт <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>КПД энергоустановки</td><td>% <td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>Годовой фактический выход энергии</td><td>Гкал, МВт.ч <td>-</td><td>-</td></tr>';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация вторичные энергетические ресурсы , альтернативные (местные) топлива и возобновляемые источники энергии не использует</td></tr>';
	}
 if ($_GET["frm"]=='10')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Показатели использования электрической энергии на цели освещения</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Функциональное назначение системы освещения</td><td colspan="2">Количество светильников</td><td>Суммарная установленная мощность, кВт</td>
		<td colspan="5">Суммарный объем потребления электроэнергии, кВт.ч </td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>с лампами накаливания</td><td>с энергосберегающими лампами</td><td></td><td>Отчетный (базовый) 2010 год</td>
		<td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td> Внутреннее освещение всего, в том числе:</td><td>297</td><td>186</td><td>38,1</td><td>42881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td> Основных цехов (производств) всего, в том числе: </td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td> Вспомогательных цехов (производств) всего, в том числе:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td> Административно-бытовых корпусов (АБК) всего, в том числе:</td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Здание детского сада</td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>Наружное освещение <td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td cospan="2">ИТОГО:</td><td></td><td>297</td><td>186</td><td>38,1</td><td>42 881,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps">Примечание: Приборы учета объема потребления электроэнергии на цели освещения отсутствуют. Определить корректно расчётным путем
						потребление за период, предшествующий базовому году, невозможно из-за отсутствия достоверных данных в организации.
						<br>Примечание: При строительстве установлены светильники с люминесцентными (энергосберегающими) лампами (171 шт.) в соответствии с проектом.</td></tr>';
	}
 if ($_GET["frm"]=='11')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Основные технические характеристики и потребление энергетических ресурсов основными технологическими комплексами</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование вида основного технологического комплекса
		</td><td>Тип</td><td colspan="3"> Основные технические характеристики* </td><td>Виды потребляемых энергетических ресурсов, единицы измерения</td><td>Объем потребленных энергетических ресурсов за отчетный (базовый) 2010 год</td><td>Примечание</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>Установленная мощность по электрической энергии, МВт</td><td>Установленная мощность по тепловой энергии, Гкал</td><td>Производительность</td><td></td><td></td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">1.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">2.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="5">3.</td><td rowspan="5"> -</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>  ';
	 print '</table>';
	 print '<tr><td colspan="2" class="ps"> *Сведения не заполняются для организаций, осуществляющих производство, передачу и распределение электрической и тепловой энергии
						<br>Примечание: В организации технологические комплексы отсутствуют </td></tr>';
	}
 if ($_GET["frm"]=='12')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Краткая характеристика объекта (зданий, строений и сооружений)</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>Наименование здания, строения, сооружения</td>
		<td>Год ввода в эксплуатацию</td>
		<td colspan="2">Ограждающие конструкции</td>
		<td>Фактический и физический износ здания, строения, cооружения, %</td>
		<td colspan="2">Удельная тепловая характеристика здания, строения, сооружения за отчетный (базовый) 2010 год (Вт/куб.м C)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>наименование конструкции</td><td>краткая характеристика</td><td></td><td>фактическая</td><td>расчетно-нормативная</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">Здание детского сада</td><td rowspan="3">1980</td>
		<td>Стены</td><td>Из глиняного кирпича с облицовкой керамическим кирпичом толщиной 530мм</td>
		<td rowspan="3">64</td><td rowspan="3">0,96</td><td rowspan="3">0,86</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Окна</td><td>2-е остекление в деревянном и ПВХ переплетах</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Крыша</td><td>Плоская кровля, ж/б плиты 220 мм, рубероид на битумной мастике</td></tr>
		</table></table>';
	}
 if ($_GET["frm"]=='13')
	{
	 print '<input name="frm" type="hidden" value="13">';
	 $query = 'SELECT * FROM objects WHERE id='.$_GET["id"];
     	 //echo $query.'<br>'; 	     
	 if ($a = mysql_query ($query,$i))
	 if ($uy = mysql_fetch_array($a, MYSQL_ASSOC))
		{
	       	 $data3[1]=$uy["H_rasch_year"]; $data3[2]=$uy["H_rasch_ud"]; $data3[3]=$uy["Q_rasch_ot"]; $data3[4]=$uy["Q_ud_ot"];
		}

	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о показателях энергетической эффективности</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="ffffff">
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td width="50%">Сведения о программе энергосбережения и повышения энергоэффективности обследуемой организации (при наличии)</td><td> имеется в наличии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>Наименование программы энергосбережения и повышения энергоэффективности</td><td>Программа энергосбережения и энергетической эффективности МДОУ ДС ОВ № 428</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>Дата утверждения</td><td>Программа энергосбережения и энергетической эффективности МДОУ ДС ОВ № 428</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td><img src="files/bl.gif" width="100%" height="1px"></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>Соответствие установленным требованиям</td><td>не соответствует</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td class="simple"><img src="files/bl.gif" width="100%" height="1px">( соответствует, не соответствует)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>Сведения о достижении утвержденных целевых показателей энергосбережения и повышения энергетической эффективности</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td class="simple"><img src="files/bl.gif" width="100%" height="1px">( достигнуты, не достигнуты )</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2"  class="ps">Оценка соответствия фактических показателей паспортным и расчетно-нормативным*</td></tr>
		<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование показателя энергетической эффективности</td><td>Единица измерения</td><td colspan="2">Значение показателя</td><td>Рекомендации по улучшению показателей энергетической эффективности</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td>Фактическое (по приборам учета,расчетам)</td><td>Расчетно - нормативное за базовый 2010 год</td><td></td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1</td><td colspan="5">По номенклатуре основной и дополнительной продукции</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2</td><td colspan="5">По видам проводимых работ</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3</td><td colspan="5">По видам оказываемых услуг</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td align="left">Удельный расход холодной воды (в т.ч. на ГВС) на 1 воспитанника в год (включая работу столовой на
	 	сырье, прачечной с автоматическими стиральными машинами, уборку помещений, хозяйственно-бытовые нужды, полив газонов)</td><td>
		куб.м/чел в год</td>
		<td><input name="udv1" class="simple2" value="'.$data3[1].'"></td><td><input name="udv2" class="simple2" value="'.$data3[2].'"></td><td align="left">1. Установка аэраторов на рукомойники.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td><td>Удельная тепловая характеристика здания</td><td>Вт/куб.м</td>
		<td><input name="udv3" class="simple2" value="'.$data3[3].'"></td><td><input name="udv4" class="simple2" value="'.$data3[4].'"></td><td align="left">
		1. Автоматизация индивидуального теплового пункта.
		<br>2. Восстановление тепловой изоляции на трубной разводке системы теплоснабжения и ГВС в техподполье.
		<br>3. Замена окон в деревянном переплете на стеклопакет в ПВХ переплете.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4</td><td colspan="5">По основным энергоемким технологическим процессам</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5</td><td colspan="5">По основному технологическому оборудованию</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">* Для энергетических установок по производству электрической и тепловой энергии обязательно указывается удельный расход топлива</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2" class="ps">Перечень, описание, показатели энергетической эффективности выполненных энергосберегающих мероприятий по годам за пять лет, предшествующих году проведения энергетического обследования, обеспечивших снижение потребления электрической энергии, тепловой энергии, жидкого топлива, моторного топлива, газа, воды</td></tr>';
	 print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование мероприятия</td><td>Единица измерения</td><td>Фактическая годовая экономия</td><td>Год внедрения</td><td>Краткое описание, достигнутый энергетический эффект</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="5">Перечень показателей энергетической эффективности выполненных энергосберегающих мероприятий, обеспечивших снижение потребления:</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>электрической энергии</td><td>тыс. кВт.ч</td><td>0,9</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>Замена части ламп накаливания</td><td>тыс. кВт.ч</td><td>0,9</td><td>2010</td><td>Замена части ламп накаливания мощностью 60 Вт на компактные люминесцентные лампы мощностью 15 Вт</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>тепловой энергии</td><td>Гкал</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>твердого топлива</td><td>т, куб. м</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>жидкого топлива</td><td>т, куб. м</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>моторного топлива</td><td>т</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.1.</td><td>бензина</td><td>т</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.2.</td><td>керосина</td><td>т</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.3.</td><td>дизельного топлива</td><td>т</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.4.</td><td>газа</td><td>тыс. куб. м</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>природного газа</td><td>тыс. куб. м</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>воды</td><td>тыс. куб. м</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 if ($_GET["frm"]=='14')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Описание линий передачи (транспортировки) энергетических ресурсов и воды*</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Наименование линии, вид передаваемого ресурса</td><td>Способ прокладки</td><td>Суммарная протяженность, км</tr>
		<tr bgcolor="#ffffff" align="center"><td>1</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>2</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>3</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>4</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>5</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>6</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>7</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>8</td><td>-</td><td>-</td><td>-</tr>
		<tr bgcolor="#ffffff" align="center"><td>9</td><td>-</td><td>-</td><td>-</tr>
		</table></td></tr>';
	print '<tr><td colspan="2" class="ps"> * кроме электрической энергии
		<br>Примечание: Организация не осуществляет передачу энергетических ресурсов и воды.</td></tr>';
	}
 if ($_GET["frm"]=='15')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о протяженности воздушных и кабельных линий передачи электроэнергии</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Класс напряжения</td><td colspan="5">Динамика изменения показателей по годам</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td>Отчетный 2010</td><td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="6">Воздушные линии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>1150 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>850 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>750 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>500 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>400 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>330 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>220 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.8.</td><td>154 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.9.</td><td>110 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.10.</td><td>35 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.11.</td><td>27,5 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.12.</td><td>20 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.13.</td><td>10 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.14.</td><td>6 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.15.</td><td>Итого от 6 кВ и выше</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.16.</td><td> кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.17.</td><td>2 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.18.</td><td>500 Вольт и ниже</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.19.</td><td>Итого ниже 6 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.20.</td><td>Всего по воздушным линиям</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="6">Кабельные линии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>220 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>110 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>35 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>27,5 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>20 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>10 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.7.</td><td>6 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.8.</td><td>Итого от 6 кВ и выше</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.9.</td><td>3 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.10.</td><td>2 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.11.</td><td>500 Вольт и ниже</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.12.</td><td>Итого ниже 6 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.13.</td><td>Всего по кабельным линиям</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="6">Всего по воздушным и кабельным линиям</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td colspan="6">Шинопроводы</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.1.</td><td>800 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.2.</td><td>750 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.3.</td><td>500 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.4.</td><td>400 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.5.</td><td>330 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.6.</td><td>220 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.7.</td><td>154 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.8.</td><td>110 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.9.</td><td>35 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.10.</td><td>27,5 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.11.</td><td>20 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.12.</td><td>10 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.13.</td><td>6 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.14.</td><td>Всего по шинопроводам</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация не осуществляет передачу электрической энергии.</td></tr>';
	}
 if ($_GET["frm"]=='16')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о количестве и установленной мощности трансформаторов</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>Единичная мощность, кВА</td>
		<td>Высшее напряжение, кВ</td><td colspan="10">Динамика изменения показателей по годам</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td><td colspan="2">Отчетный (базовый) 2010 год</td>
		<td  colspan="2">2009</td><td colspan="2">2008</td><td colspan="2">2007</td><td colspan="2">2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td></td><td></td>
		<td>Количество, шт.</td><td>Установленная мощность, кВА</td>
		<td>Количество, шт.</td><td>Установленная мощность, кВА</td>
		<td>Количество, шт.</td><td>Установленная мощность, кВА</td>
		<td>Количество, шт.</td><td>Установленная мощность, кВА</td>
		<td>Количество, шт.</td><td>Установленная мощность, кВА</td></tr>       
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>До 2500</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td></td><td>27,5-35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>От 2500 до 10000</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td></td><td>35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td></td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>От 10000 до 80000 включительно</td><td>3-20</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td></td><td>27,5-35</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td></td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td></td><td>220</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>Более 80000</td><td>110-154</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.1.</td><td></td><td>220</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.2.</td><td></td><td>330 однофазные</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.3.</td><td></td><td>330 трехфазные</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.4.</td><td></td><td>400-500 однофазные</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.5.</td><td></td><td>400-500 трехфазные</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.6.</td><td></td><td>750-1150</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>Итого:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация не осуществляет передачу электрической энергии.</td></tr>';	
	}
 if ($_GET["frm"]=='17')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о количестве и мощности устройств компенсации реактивной мощности</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">№ п/п</td><td rowspan="3">Единичная мощность, кВА</td>
		<td rowspan="3">Высшее напряжение, кВ</td><td colspan="10">Динамика изменения показателей по годам</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="2">Отчетный (базовый) 2010 год</td>
		<td colspan="2">2009</td><td colspan="2">2008</td><td colspan="2">2007</td><td colspan="2">2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Кол-во,шт./групп</td><td>Установленная мощность, МВАр</td>
		<td>Кол-во,шт./групп</td><td>Установленная мощность, МВАр</td>
		<td>Кол-во,шт./групп</td><td>Установленная мощность, МВАр</td>
		<td>Кол-во,шт./групп</td><td>Установленная мощность, МВАр</td>
		<td>Кол-во,шт./групп</td><td>Установленная мощность, МВАр</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td rowspan="5">Шунтирующие реакторы</td><td>3-20 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>27,5-35 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>150-110 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>500 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>750 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>Итого</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td rowspan="5">СК и генераторы, в режиме СК</td><td>до 15,0 тыс.кВА</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>от 15,0 до 37,5 тыс.кВА</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>50 тыс.кВА</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>от 75,0 до 100,0 тыс.кВА</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>160 тыс.кВА</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>Итого</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td rowspan="4">БСК и СТК</td><td>0,38-20 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td>35 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td>150-110 кВ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td>220 кВ и выше</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td>Итого</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация не осуществляет передачу электрической энергии.</td></tr>';	
	}
 if ($_GET["frm"]=='18')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о величине потерь переданных энергетических ресурсов</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center" rowspan="2"><td rowspan="2">№ п/п</td><td rowspan="2">Наименование энергоносителя</td><td rowspan="2">Единица измерения</td>
		<td rowspan="2">Потребленное количество в год</td><td rowspan="2">Отчетный (базовый) 2010 год</td><td colspan="4">Предыдущие годы</td><td rowspan="2">Примечание</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2009</td><td>2008</td><td>2007</td><td>2006</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td  colspan="9">Объем передаваемых энергетических ресурсов</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.1.</td><td>Электрической энергии</td><td>тыс. кВт.ч</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.2.</td><td>Тепловой энергии</td><td>Гкал</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.3.</td><td>Нефти</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.4.</td><td>Нефтепродуктов</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.5.</td><td>Газового конденсата</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.6.</td><td>Попутного нефтяного газа</td><td>млн.куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.7.</td><td>Природного газа</td><td>млн.куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.8.</td><td>Воды</td><td>тыс.куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="9">Фактические потери передаваемых энергетических ресурсов</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.1.</td><td>Электрической энергии</td><td>тыс. кВт.ч</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.2.</td><td>Тепловой энергии</td><td>Гкал</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.3.</td><td>Нефти</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.4.</td><td>Нефтепродуктов</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.5.</td><td>Газового конденсата</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.6.</td><td>Попутного нефтяного газа</td><td>млн.куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.7.</td><td>Природного газа</td><td>куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.8.</td><td>Воды</td><td>куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="9">Значения утвержденных нормативов технологических потерь по видам энергетических ресурсов</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.1.</td><td>Электрической энергии</td><td>тыс. кВт.ч</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.2.</td><td>Тепловой энергии</td><td>Гкал</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.3.</td><td>Нефти</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.4.</td><td>Нефтепродуктов</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.5.</td><td>Газового конденсата</td><td>тыс.т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.6.</td><td>Попутного нефтяного газа</td><td>млн.куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.7.</td><td>Природного газа</td><td>куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.8.</td><td>Воды</td><td>куб.м</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация не осуществляет передачу энергетических ресурсов.</td></tr>';	
	}
 if ($_GET["frm"]=='19')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Рекомендации по сокращению потерь энергетических ресурсов при их передаче</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center" rowspan="2"><td rowspan="2">№ п/п</td>
		<td rowspan="2">Наименование планируемого мероприятия</td>
		<td rowspan="2">Затраты тыс. руб (план)</td>
		<td colspan="3">Планируемое сокращение потерь</td>
		<td rowspan="2">Средний срок окупаемости (план)</td>
		<td rowspan="2">Планируемая дата внедрения (месяц, год)</td>
		<td colspan="3">Сокращение потерь ТЭР на весь период действия энергетического паспорта</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>в натуральном выражения</td><td>ед. измерения</td><td>в стоимостном выражении (тыс. руб)</td>
		<td>в натуральном выражения</td><td>ед. измерения</td><td>в стоимостном выражении (тыс. руб)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td colspan="10" align="left">По сокращению потерь электрической энергии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td colspan="10" align="left">По сокращению потерь тепловой энергии</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td colspan="10" align="left">По сокращению потерь нефти</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td colspan="10" align="left">По сокращению потерь нефтепродуктов</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td colspan="10" align="left">По сокращению потерь газового конденсата</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>6.</td><td colspan="10" align="left">По сокращению потерь попутного нефтяного газа</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>7.</td><td colspan="10" align="left">По сокращению потерь природного газа</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>8.</td><td colspan="10" align="left">По сокращению потерь воды</td></tr>
		<tr bgcolor="#ffffff" align="center"><td></td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>9.</td><td>ИТОГО:</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Организация не осуществляет передачу энергетических ресурсов.</td></tr>';		 
	}
 if ($_GET["frm"]=='20')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Потенциал энергосбережения и оценка возможной экономии энергетических ресурсов</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">№ п/п</td>
		<td colspan="7">Расчетные показатели предлагаемых к реализации энергосберегающих мероприятий</td>
		<td colspan="4">Опыт внедрения энергосберегающих мероприятий в организациях аналогичного профиля</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="2">Наименование мероприятий по видам энергетических ресурсов</td>
		<td rowspan="2">Затраты тыс.руб (план)</td>
		<td colspan="3">Годовая экономия ТЭР (план)</td>
		<td rowspan="2">Средний срок окупаемости (план), лет</td>
		<td colspan="3">Годовая экономия ТЭР (факт)</td>
		<td rowspan="2">Средний срок окупаемости (факт), лет</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>в натуральном выражении</td><td>ед. измерения</td><td>в стоимостном выражении (тыс. руб)</td>
		<td>в натуральном выражении</td><td>ед. измерения</td><td>в стоимостном выражении (тыс. руб)</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>По электрической энергии</td><td>35,6</td><td>27,4</td><td>тыс. кВт.ч</td><td>91,0</td><td>0,4</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>По тепловой энергии</td><td>1871,2</td><td>131,1</td><td>Гкал</td><td>135,6</td><td>13,8</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>По твердому топливу</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>По жидкому топливу</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>По моторным топливам, в том числе</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.1.</td><td>бензин</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.2.</td><td>керосин</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.3.</td><td>дизельное топливо</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.4.</td><td>газ</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>6.</td><td>По природному газу</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>7.</td><td>По воде</td><td>42,2</td><td>690,2</td><td>м3</td><td>8,7</td><td>4,9</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>8.</td><td>ИТОГО:</td><td>1949,0</td><td>-</td><td>-</td><td>235,3</td><td>8,3</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 if ($_GET["frm"]=='21')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Перечень типовых мероприятий по энергосбережению и повышению энергетической эффективности</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td rowspan="3">Наименование мероприятия,вид энергоресурса</td>
		<td colspan="3">Годовая экономия энергетических ресурсов</td>
		<td rowspan="3">Затраты, тыс. руб</td>
		<td rowspan="3">Средний срок окупаемости, лет</td>
		<td rowspan="3">Согласованный срок внедрения, квартал, год</td>
		</tr>
		<tr bgcolor="#ffffff"><td colspan="2">в натуральном выражении</td>
		<td rowspan="2">в стоимостном выражении тыс. руб. (по тарифу)</td></tr>
		<tr bgcolor="#ffffff"><td>единица измерения</td><td>кол-во</td></tr>		
		<tr bgcolor="#ffffff" align="center"><td colspan="7">Организационные и малозатратные мероприятия</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Замена ламп накаливания мощностью 150, 100, 75, 60 Вт внутреннего освещения помещений на люминесцентные компактные лампы мощностью 30, 15Вт (297 шт.)</td><td>тыс. кВт.ч</td><td>24,9</td><td>82,7</td><td>35,6</td><td>0,4</td><td>1 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Организационные мероприятия (инструктаж сотрудников по контролю за расходованием энергоресурсов, проведение мероприятий с участием детей и родителей, направленных на пропаганду энергосбережения)</td><td>тыс. кВт.ч</td><td>2,5</td><td>8,3</td><td>-</td><td>-</td><td>3 кв. 2011</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Установка регуляторов отопления на радиаторы в кухне</td><td>Гкал</td><td>3,4</td><td>3,5</td><td>6,1</td><td>1,8</td><td>3 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Итого</td><td>-</td><td>-</td><td>94,5</td><td>41,7</td><td>0,4</td><td>3 кв. 2011 - 3 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="7">Среднезатратные</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Автоматизация индивидуального теплового пункта: модернизация теплового пункта с возможностью регулирования расхода тепла на нужды отопления в зависимости от температуры наружного воздуха и температуры воздуха внутри помещения.</td><td>Гкал</td><td>70,6</td><td>73,0</td><td>331,5</td><td>4,5</td><td>4 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td rowspan="2">Установка аэраторов на рукомойники (66 шт., SBOT-Maxi, SBOT-Auto и их аналоги)</td><td>Гкал</td><td>10,7</td><td rowspan="2">11,1</td><td rowspan="2">42,2</td><td rowspan="2">2,1</td><td rowspan="2">2 кв. 2012 м3</tr><tr bgcolor="#ffffff" align="center"><td>690,2</td><td>8,7</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Итого</td><td>-</td><td>-</td><td>92,8</td><td>373,7</td><td>4,0</td><td>2 кв. 2012 - 4 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td colspan="7">Долгосрочные, крупнозатратные</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Восстановление изоляции на трубной разводке системы отопления и ГВС</td><td>Гкал</td><td>10,5</td><td>10,9</td><td>67,0</td><td>6,2</td><td>4 кв. 2012</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Замена окон в деревянных переплетах на однокамерный стеклопакет с теплоотражающим покрытием в ПВХ переплетах (376 кв.м.)</td><td>Гкал</td><td>35,9</td><td>37,1</td><td>1466,6</td><td>39,5</td><td>3 кв. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Итого</td><td>-</td><td>-</td><td>48,0</td><td>1533,6</td><td>32,0</td><td>4 кв. 2012 - 3 кв. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Всего, тыс. т у.т. в том числе по видам ТЭР:</td><td>-</td><td>0,029</td><td>235,3</td><td>1949,0</td><td>8,3</td><td>3 кв. 2011 - 3 кв. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Котельно-печное топливо</td><td>тыс. т у.т.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Тепловая энергия</td><td>Гкал</td><td>131,1</td><td>135,6</td><td>1871,2</td><td>13,8</td><td>4 кв. 2012 - 3 кв. 2015</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Электроэнергия</td><td>тыс. кВт.ч</td><td>27,4</td><td>91,0</td><td>35,6</td><td>0,4</td><td>3 кв. 2011 - 1 кв. 2013</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Моторное топливо</td><td>тыс. т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Смазочные материалы</td><td>тыс. т</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Сжатый воздух</td><td>тыс. м3</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>Вода</td><td>м3</td><td>690,2</td><td>8,7</td><td>42,2</td><td>4,9</td><td>2 кв. 2012</td></tr>
		</table></td></tr>';
	 print '<tr><td colspan="2" class="ps">Примечание: Срок окупаемости по мероприятию "Замена окон в деревянных переплетах на однокамерный стеклопакет с теплоотражающим покрытием в ПВХ переплетах (376 кв.м.)", по строке "Итого" раздела "Долгосрочные, крупнозатратные" указан для справки.</td></tr>';
	}
 if ($_GET["frm"]=='22')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Перечень должностных лиц, ответственных за обеспечение мероприятий по энергосбережению и повышению энергетической эффективности</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>ФИО</td><td>Наименование должности</td>
		<td>Контактная информация (номера телефонов, факсов, адреса электронной почты)</td>
		<td>Основные функции и обязанности по обеспечению мероприятий</td>
		<td>Наименования и реквизиты нормативных актов организации, определяющих обязанности по обеспечению мероприятий</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>Смирнова Инна Валерьевна</td><td>Смирнова Инна Валерьевна</td>
		<td>8(351)772-58-55</td><td>Организация работы по обеспечению мероприятий по энергосбережению и повышению энергетической эффективности</td><td>Приказ №1/17-ОД от 11.01.2011</td></tr>
		</table></td></tr>';
	}

 if ($_GET["frm"]=='23')
	{
	 print '<table border="0" cellpadding="1" cellspacing="1" style="padding-left:50px; width:1000px; padding-right:50px; padding-top:50px;">';
	 print '<tr><td colspan="2" align="left" class="ps">Форма №'.$_GET["frm"].'</td></tr>';	
	 print '<tr><td colspan="2" align="center" class="psb">Сведения о квалификации персонала, обеспечивающего реализацию мероприятий по энергосбережению и повышению энергетической эффективности</td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px"></td></tr>';
	 print '<tr><td colspan="2" align="center" style="height:20px">Количество сотрудников организации, прошедших обучение в области энергосбережения и повышения энергетической эффективности - 0 человек.</td></tr>';
         print '<tr><td colspan="2"  class="ps">
		<table border="0" cellpadding="1" cellspacing="1" bgcolor="#333333">
		<tr bgcolor="#ffffff" align="center"><td>№ п/п</td><td>ФИО</td><td>Наименование должности</td>
		<td>Сведения об образовательной организации проводившей обучение (наименование, адрес, лицензия)</td>
		<td>Наименование курса обучения и его тип (подготовка, переподготовка, повышение квалификации)</td>
		<td>Дата начала и окончания обучения</td>
		<td>Документ об образовании (диплом, удостоверение, сертификат и др.)</td>
		<td>Сведения об аттестации и присвоении квалификации.</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>1.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>2.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>3.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>4.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		<tr bgcolor="#ffffff" align="center"><td>5.</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
		</table></td></tr>';
	}
 print  '</form>';
?>