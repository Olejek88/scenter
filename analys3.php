<div id="maincontent"  style="width:100%; left: 0px;">
<?php
 $today=getdate();
 if ($_GET["year"]=='') $ye=$today["year"];
 else $ye=$_GET["year"];
 if ($_GET["month"]=='') $mn=$today["mon"];
 else $mn=$_GET["month"];
 //if ($mn>1) $mn--;
 $month=$mn;
 include ("time.inc");
 $prevmonth=$month.', '.$today["year"];
 $tarif_svoda=18.56;
 $ccr=$cct=0;

 $query = 'SELECT * FROM uprav ORDER BY id';
 $a = mysql_query ($query,$i);
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{		
	 $nametype[$uy[0]]=$uy[1];
	 $query = 'SELECT COUNT(id) FROM objects WHERE type='.$uy[0];
	 if ($_GET["analys"]=='4') $query = 'SELECT COUNT(id) FROM objects WHERE uvoda>0 AND type='.$uy[0];
	 if ($_GET["analys"]=='10') $query = 'SELECT COUNT(id) FROM objects WHERE uteplo>0 AND type='.$uy[0];
	 if ($_GET["analys"]=='9') $query = 'SELECT COUNT(id) FROM objects WHERE uteplo>0 AND square>0 AND nlevels=0 AND type='.$uy[0];
	 if ($_GET["analys"]=='13') $query = 'SELECT COUNT(id) FROM objects WHERE nstruts=0 AND (uteplo>0 OR uvoda>0) AND type='.$uy[0];
	 if ($_GET["analys"]=='113') $query = 'SELECT COUNT(id) FROM objects WHERE (uteplo>0 OR uvoda>0) AND type='.$uy[0];
	 if ($_GET["analys"]=='14') $query = 'SELECT COUNT(id) FROM objects WHERE uvoda>0 AND type='.$uy[0];

	 $a2 = mysql_query ($query,$i);
	 $uo = mysql_fetch_row ($a2);
	 $count[$uy[0]]=$uo[0];
	 //echo $count[$uy[0]];
	 $uy = mysql_fetch_row ($a);
	}
 print '<table><tr><td class="m_separator">Выбрать период: '; include("ch_mon2.php"); print '</td></tr></table>';

 if ($_GET["analys"]=='') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Отчет о выполнении ФЗ №261 "Об энергосбережении" по снижению потребления энергоресурсов бюджетными организациями на 3% ежегодно</h1></td></tr></table>';
 if ($_GET["analys"]=='1') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии тепловой энергии в '.$prevmonth.' бюджетными учереждениями , присоединенными к ситуационному центру</h1></td></tr></table>';
 if ($_GET["analys"]=='2') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии тепловой энергии в '.$prevmonth.' бюджетными учереждениями , присоединенными к ситуационному центру</h1></td></tr></table>';
 if ($_GET["analys"]=='3') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии электрической энергии по состоянию на '.$prevmonth.'</h1></td></tr></table>';
 if ($_GET["analys"]=='5') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет о непроизводительных потерях воды по состоянию на '.$prevmonth.'</h1></td></tr></table>';
 if ($_GET["analys"]=='4') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии холодной воды по состоянию на '.$prevmonth.'</h1></td></tr></table>';
 if ($_GET["analys"]=='6') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об экономии тепла по состоянию на '.$prevmonth.'</h1></td></tr></table>';
 if ($_GET["analys"]=='7') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сводный отчет об утечках теплоносителя по состоянию на '.$prevmonth.'</h1></td></tr></table>';
 if ($_GET["analys"]=='8') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Отчет о выполнении ФЗ №261 "Об энергосбережении" по снижению потребления энергоресурсов бюджетными организациями на 3% ежегодно</h1></td></tr></table>';
 if ($_GET["analys"]=='9') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сравнение удельного потребления тепла в '.$today["year"].' году (ГКал на кв.м)</h1></td></tr></table>';
 if ($_GET["analys"]=='12') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Удельное потребление тепла на 1 кв.м. бюджетными организациями, присоединенными к Ситуационному центру за '.$prevmonth.' года</h1></td></tr></table>';
 if ($_GET["analys"]=='13') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Сравнение потребления тепла и воды организациями, присоединенными к Ситуационному центру</h1></td></tr></table>';
 if ($_GET["analys"]=='14') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Абсолютное потребление воды организациями, присоединенными к Ситуационному центру</h1></td></tr></table>';
 if ($_GET["analys"]=='15') print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center"><h1>Потребление воды организациями, присоединенными к Ситуационному центру</h1></td></tr></table>';

 print '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" valign="top">';
 print '<table width="600px" cellspacing="1" bgcolor="#5D6D2f">';
 if ($_GET["analys"]!='')
	{ 
	 print '<tr class="m_separator"><td class="m_separator" align="center" rowspan="2">№п/п</td>';
	 if ($_GET["analys"]!=12 && $_GET["analys"]!=15) print '<td class="m_separator" align="center" rowspan="2">ГРБС</td>';
	 print '<td class="m_separator" align="center" rowspan="2">Наименование подведомственного бюджетного учереждения</td>
	 <td class="m_separator" align="center" rowspan="2">Адрес учереждения</td>';
	}

 if ($_GET["analys"]=='') 
	 print '<tr><td class="m_separator" colspan="7"></td><td class="m_separator" colspan="9" align="center">2010</td><td class="m_separator" colspan="9" align="center">2011</td></tr>
	 <tr class="m_separator"><td class="m_separator" rowspan="2">№п/п</td><td class="m_separator" rowspan="2">ГРБС</td><td class="m_separator" rowspan="2">Наименование подведомственного бюджетного учереждения</td><td class="m_separator" rowspan="2">Адрес учереждения</td><td align="center" colspan="3" class="m_separator">Базовый уровень потребления 2009</td>
	 <td align="center" colspan="3" class="m_separator">вода, м3</td><td align="center" colspan="3" class="m_separator">тепло, ГКал</td><td align="center" colspan="3" class="m_separator">электроэнергия, кВт*ч</td><td align="center" colspan="3" class="m_separator">вода, м3</td><td align="center" colspan="3" class="m_separator">тепло, ГКал</td><td align="center" colspan="3" class="m_separator">электроэнергия, кВт*ч</td></tr>
	 <tr class="m_separator"><td align="center" class="m_separator">вода, м3</td><td align="center" class="m_separator">тепло, ГКал</td><td align="center" class="m_separator">ЭЭ, кВт*ч</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-3%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-6%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-6%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td>
	 <td align="center" class="m_separator">2009-6%</td><td align="center" class="m_separator">Факт</td><td align="center" class="m_separator">% вып. ФЗ</td></tr>';
 if ($_GET["analys"]=='1') 
 print '<td align="center" colspan="2" class="m_separator">Фактическое потребление, Гкал</td>
	 <td align="center" colspan="2" class="m_separator">Договорной уровень потрбления, Гкал</td>
	 <td align="center" rowspan="2" class="m_separator">Экономия по отношению к договорному уровню, Гкал</td>
	 <td align="center" rowspan="2" class="m_separator">Экономия по отношению к договорному уровню, %</td>
	 <td align="center" colspan="2" class="m_separator">Стоимость экономии к договорному уровню, руб</td></tr>
	 <tr><td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td>
	 <td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td>
	 <td align="center" class="menuitem">Текущий месяц</td><td align="center" class="menuitem">С начала года</td></tr>';
 if ($_GET["analys"]=='3') 
 print '<td align="center" colspan="2" class="m_separator">Потребление, кВт*ч</td>
	 <td align="center" colspan="2" class="m_separator">Экономия к прошлому году</td>
	 <td align="center" rowspan="2" class="m_separator">Стоимость экономии к прошлому году, руб</td></tr>
	 <tr><td align="center" class="menuitem">За '.($today["mon"]-1).' мес. '.$today["year"].'</td><td align="center" class="menuitem">'.($today["mon"]-1).' мес. '.$today["year"].'</td>
	 <td align="center" class="menuitem">кВт*ч</td><td align="center" class="menuitem">%</td></tr>';
 if ($_GET["analys"]=='4') 
 print '<td align="center" rowspan="2" class="m_separator">норматив м3</td>
	 <td align="center" colspan="2" class="m_separator">факт</td>
	 <td align="center" colspan="2" class="m_separator">Экономия к прошлому году</td>
	 <td align="center" colspan="2" class="m_separator">Экономия к нормативу</td>
	 <td align="center" rowspan="2" class="m_separator">Стоимость экономии воды по отношению к нормативу</td>
	 <td align="center" rowspan="2" class="m_separator">Стоимость экономии воды по отношению к прошлому году</td></tr>
	 <tr><td align="center" class="menuitem">За '.($today["mon"]-1).' мес. '.($today["year"]-1).'</td><td align="center" class="menuitem">'.($today["mon"]-1).' мес. '.$today["year"].'</td>
	 <td align="center" class="menuitem">куб.м.</td><td align="center" class="menuitem">%</td>
	 <td align="center" class="menuitem">куб.м.</td><td align="center" class="menuitem">%</td></tr>';
 if ($_GET["analys"]=='5') 
 print  '<td align="center" colspan="2" class="m_separator">Фактический размер потребления, м3</td>
	 <td align="center" colspan="2" class="m_separator">Непроизводительные потери воды, м3</td>
	 <td align="center" colspan="2" class="m_separator">Непроизводительные потери воды, %</td>
	 <td align="center" colspan="2" class="m_separator">Переплата за непроизводительные потери воды, руб</td></tr>
	 <tr><td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td>
	 <td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td>
	 <td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td>
	 <td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td></tr>';
 if ($_GET["analys"]=='6') 
 print  '<td align="center" rowspan="2" class="m_separator">Расчетное потребление по проектной нагрузке</td>
	 <td align="center" rowspan="2" class="m_separator">Договорной уровень</td>
	 <td align="center" colspan="2" class="m_separator">Данные приборов учета</td>
	 <td align="center" colspan="2" class="m_separator">Экономия к прошлому году</td>
	 <td align="center" colspan="2" class="m_separator">Экономия к нормативу</td>
	 <td align="center" rowspan="2" class="m_separator">Стоимость экономии воды по отношению к нормативу</td>
	 <td align="center" rowspan="2" class="m_separator">Стоимость экономии воды по отношению к прошлому году</td></tr>
	 <tr><td align="center" class="menuitem">За '.($today["mon"]-1).' мес. '.($today["year"]-1).'</td><td align="center" class="menuitem">'.($today["mon"]-1).' мес. '.$today["year"].'</td>
	 <td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">%</td>
	 <td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">%</td></tr>';
 if ($_GET["analys"]=='7') 
 print  '<td align="center" colspan="2" class="m_separator">Фактический размер утечки, м3</td>
	 <td align="center" colspan="2" class="m_separator">Допустимый размер утечки, м3</td>
	 <td align="center" rowspan="2" class="m_separator">Сверхнорматиные утечки, м3</td>
	 <td align="center" colspan="2" class="m_separator">Переплата за утечки, руб</td></tr>
	 <tr><td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td>
	 <td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td>
	 <td align="center" class="menuitem">'.$month.'</td><td align="center" class="menuitem">с начала года</td></tr>';
 if ($_GET["analys"]=='8') 
 print  '<td align="center" colspan="4" class="m_separator">Фактическое потребление ТЭР в '.($today["year"]-1).' году</td>
 	 <td align="center" colspan="4" class="m_separator">Потребление ТЭР в '.($today["year"]).' году</td>
 	 <td align="center" colspan="4" class="m_separator">Отклонение от требований закона</td>
 	 <td align="center" rowspan="2" class="m_separator">Проведенные мероприятия</td></tr>
	 <tr><td align="center" class="menuitem">Тепло (Гкал)</td><td align="center" class="menuitem">Вода (куб.м)</td><td align="center" class="menuitem">ЭЭ (кВт*ч)</td><td align="center" class="menuitem">Суммарно в денежном выражении (тыс.руб)</td>
	 <td align="center" class="menuitem">Тепло (Гкал)</td><td align="center" class="menuitem">Вода (куб.м)</td><td align="center" class="menuitem">ЭЭ (кВт*ч)</td><td align="center" class="menuitem">Суммарно в денежном выражении (тыс.руб)</td>
	 <td align="center" class="menuitem">Тепло (%)</td><td align="center" class="menuitem">Вода (%)</td><td align="center" class="menuitem">ЭЭ (%)</td><td align="center" class="menuitem">Суммарно в денежном выражении (%)</td></tr>';
 if ($_GET["analys"]=='9') 
	{
	 for ($mon=1;$mon<$today["mon"];$mon++)
		{
		 $month=$mon; include ("time.inc");
		 print '<td class="m_separator" rowspan="2">'.$month.'</td>';
		}
	 print '<td class="m_separator" rowspan="2">Итого за год</td></tr><tr></tr>';
	}
 if ($_GET["analys"]=='10') 
	{
	 $qnt=6;
	 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
	 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
	 if ($endate>$stdate)
		{
		 $qnt=($_POST["year2"]-$_POST["year"])*12+($_POST["month2"]-$_POST["month"])+1;
		 $ye=$today["year"]=$_POST["year"]; $tm=$_POST["month"]; if ($tm>1) $tm--;
		}
	 else
		{
		 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; if ($tm>1) $tm--;
		}

	 print '<td align="center" rowspan="3" class="m_separator">Тариф</td><td align="center" rowspan="3" class="m_separator">K потерь %</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Нормативное потребление</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Фактическое потребление</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Разница между фактическим и нормативными значениями</td>
	 <td align="center" colspan="2" class="m_separator">Разница за период</td></tr>';
	 for ($tn2=0; $tn2<=2; $tn2++)
		{	 
		 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
		 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
		 if ($endate>$stdate)
			{
			 $qnt=($_POST["year2"]-$_POST["year"])*12+($_POST["month2"]-$_POST["month"])+1;
			 $ye=$today["year"]=$_POST["year"]; $tm=$_POST["month"]; if ($tm>1) $tm--;
			}
		 else
			{
			 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; if ($tm>1) $tm--;
			}

		 for ($tn=0; $tn<$qnt; $tn++)
		    {
		     $month=$tm; include("time.inc"); $mon[$tn]=$month;
		     if ($tm<12) $tm++; else { $tm=1; $today["year"]++; }
		    }
		 for ($tn=0; $tn<$qnt; $tn++)
		     	 print '<td class="m_separator" colspan="2" align="center">'.$mon[$tn].'</td>';
        	}
	 print '<td align="center" class="menuitem" rowspan="2">ГКал</td><td align="center" class="menuitem" rowspan="2">руб. с НДС</td></tr>';
	 print '<tr><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td>';
	 for ($tn=0; $tn<$qnt*3; $tn++)
		 print '<td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">руб. с НДС</td>';
	 print '</tr>';

	 $query = 'SELECT * FROM devices WHERE ust=1';
	 $u = mysql_query ($query,$i); $maxd=0;
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}

	 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
	 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
	 if ($endate>$stdate)
		{
		 $qnt=($_POST["year2"]-$_POST["year"])*12+($_POST["month2"]-$_POST["month"])+1;
		 $ye=$today["year"]=$_POST["year"]; $tm=$_POST["month"]; if ($tm>1) $tm--;
		}
	 else
		{
		 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; if ($tm>1) $tm--;
		}

	 //$today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; 
	 //if ($today["mon"]>$qnt) $tm-=$qnt; else { $tm=12+$tm-$qnt; $today["year"]--; }
	 for ($tn=0; $tn<$qnt; $tn++)
	    {
	     $sts=sprintf("%d%02d01000000",$ye,$tm);
	     $fns=sprintf("%d%02d01000000",$ye,$tm+1);
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0 AND value<2000';

	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data2[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}

	     $sts=sprintf("%d%02d01000000",$ye,$tm);
	     $fns=sprintf("%d%02d01000000",$ye,$tm+1);
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=12 AND value>0 AND value<2000';

	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data[$tt][$tn]=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     if ($tm<12) $tm++; else { $tm=1; $ye++; }
	    } 
	}
 if ($_GET["analys"]=='13' || $_GET["analys"]=='113') 
	{
	 $qnt=3;
	 
	 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
	 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
	 if ($_POST["month2"]==$_POST["month"]) $qnt=1;
	 if ($endate>$stdate)
		{
		 $qnt=($_POST["year2"]-$_POST["year"])*12+($_POST["month2"]-$_POST["month"])+1;
		 $ye=$today["year"]=$_POST["year"]; $tm=$_POST["month"]; if ($tm>1) $tm--;
		}
	 else
		{
		 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; if ($tm>1) $tm--;
		 $_POST["month2"]=$today["mon"]; $_POST["month"]=$today["mon"];
		}

	 print '<td align="center" class="m_separator" rowspan="3">Ресурс</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Потребление за прошлый период</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Потребление за период</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Экономия</td>
	 <td align="center" colspan="2" class="m_separator">Разница за период</td></tr>';
	 for ($tn2=0; $tn2<=2; $tn2++)
		{	
		 $tm=$_POST["month2"]; //if ($tm>1) $tm--;
		 for ($tn=0; $tn<$qnt; $tn++)
		    {
		     $month=$tm; include("time.inc"); $mon[$tn]=$month;
		     if ($tm>1) $tm--; else { $tm=12; $today["year"]--; }
		    }
		 for ($tn=$qnt-1; $tn>=0; $tn--)
		     	 print '<td class="m_separator" colspan="2" align="center">'.$mon[$tn].'</td>';
        	}
	 print '<td align="center" class="menuitem" rowspan="2">ГКал | м3</td><td align="center" class="menuitem" rowspan="2">руб. с НДС</td></tr>';
	 print '<tr><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td>';
	 for ($tn=0; $tn<$qnt*3; $tn++)
		 print '<td align="center" class="menuitem">ГКал / м3</td><td align="center" class="menuitem">руб. с НДС</td>';
	 print '</tr>';

	 $query = 'SELECT * FROM devices WHERE ust=1';
	 $u = mysql_query ($query,$i); $maxd=0;
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $grdevices[$maxd]=$uo[18];
		 //if ($devices[$maxd]==$grdevices[$maxd]) 
		 //$grdev[$maxd]=$grdevices[$maxd];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}

	 $today["year"]=$_POST["year"]; $ye=$_POST["year"]; $tm=$_POST["month"]; 
	 //if ($_POST["mon"]>$qnt) $tm-=$qnt; else { $tm=12+$tm-$qnt; $today["year"]--; }

	 for ($tn=0; $tn<$qnt; $tn++)
	    {
	     $sts=sprintf("%d%02d01000000",$today["year"],$tm);
	     $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
	     $sts2=sprintf("%d%02d01000000",$today["year"]-1,$tm);
	     $fns2=sprintf("%d%02d01000000",$today["year"]-1,$tm+1);
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND value<2000';
	     //echo $query.'<br>';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data2[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND (source=6 OR source=5) AND value<2000';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data3[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}

	     $query = 'SELECT device,value FROM data WHERE date>='.$sts2.' AND date<'.$fns2.' AND type=4 AND prm=13 AND source=2 AND value<2000';
	     //echo $query.'<br>';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data12[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts2.' AND date<'.$fns2.' AND type=4 AND prm=12 AND source=6 AND value<2000';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data13[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}

	     if ($tm<12) $tm++; else { $tm=1; $today["year"]++; }

	     if ($_GET["analys"]=='13')
	     for ($tt=0; $tt<=$maxd; $tt++)
		{
		 // dlya kajdogo device nahodim index ego groupdevice i herachim vse na nego
		 for ($tt2=0; $tt2<=$maxd; $tt2++)
			{
			 if ($devices[$tt]==$grdevices[$tt2] && $devices[$tt2]!=$grdevices[$tt2])
				{ 
				 $data2[$tt][$tn]+=$data2[$tt2][$tn]; 
				 $data3[$tt][$tn]+=$data3[$tt2][$tn]; 
				 $data12[$tt][$tn]+=$data12[$tt2][$tn];
				 $data13[$tt][$tn]+=$data13[$tt2][$tn]; $hide[$tt]=1; 
				}
			 //$count[$types[$object]]
			}		 
		}
	    } 
	}

 if ($_GET["analys"]=='15') 
	{
	 $qnt=12;
	 
	 $stdate=sprintf ("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
	 $endate=sprintf ("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
	 if ($endate>$stdate)
		{
		 $qnt=($_POST["year2"]-$_POST["year"])*12+($_POST["month2"]-$_POST["month"])+1;
		 $ye=$today["year"]=$_POST["year"]; $tm=$_POST["month"]; if ($tm>1) $tm--;
		}
	 else
		{
		 $today=getdate(); $ye=$today["year"]; $tm=$today["mon"]; if ($tm>1) $tm--;
		 $_POST["month2"]=$today["mon"]; $_POST["month"]=1;
		}

	 print '<td align="center" class="m_separator" rowspan="3">Ресурс</td>
		<td align="center" colspan="'.($qnt).'" class="m_separator">Потребление за период</td></tr>';
	 $tm=$_POST["month2"]; //if ($tm>1) $tm--;
	 for ($tn=0; $tn<$qnt; $tn++)
	    {
	     $month=$tm; include("time.inc"); $mon[$tn]=$month;
	     if ($tm>1) $tm--; else { $tm=12; $today["year"]--; }
	    }
	 for ($tn=$qnt-1; $tn>=0; $tn--)
	     	 print '<td class="m_separator" align="center">'.$mon[$tn].'</td>';

	 print '</tr>';
	 print '<tr><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td>';
	 for ($tn=0; $tn<$qnt; $tn++) print '<td align="center" class="menuitem">ГКал / м3</td>';
	 print '</tr>';

	 $query = 'SELECT * FROM devices WHERE ust=1';
	 $u = mysql_query ($query,$i); $maxd=0;
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $grdevices[$maxd]=$uo[18];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}

	 $today["year"]=$_POST["year"]; $ye=$_POST["year"]; $tm=$_POST["month"]; 
	 for ($tn=0; $tn<$qnt; $tn++)
	    {
	     $sts=sprintf("%d%02d01000000",$today["year"],$tm);
	     $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
	     $sts2=sprintf("%d%02d01000000",$today["year"]-1,$tm);
	     $fns2=sprintf("%d%02d01000000",$today["year"]-1,$tm+1);
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND (source=6 OR source=5) AND value<2000';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data3[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     if ($tm<12) $tm++; else { $tm=1; $today["year"]++; }
	    } 
	}

 if ($_GET["analys"]=='11') 
	{
	 $qnt=1;
	 print '<td align="center" rowspan="3" class="m_separator">Тариф</td><td align="center" rowspan="3" class="m_separator">K потерь %</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Нормативное потребление</td>
	 <td align="center" colspan="'.($qnt*3).'" class="m_separator">Фактическое потребление</td>
	 <td align="center" colspan="'.($qnt*2).'" class="m_separator">Разница между фактическим и нормативными значениями</td>
	 <td align="center" colspan="2" class="m_separator">Разница за квартал</td></tr>';
	 for ($tn2=0; $tn2<=2; $tn2++)
		{	 
		 $today=getdate(); 
		 $ye=$today["year"]; 
		 if ($_GET["month"]) $tm=$_GET["month"];
		 else $tm=$today["mon"]; 
		 //if ($tm>1) $tm--;
		 for ($tn=0; $tn<$qnt; $tn++)
		    {
		     $month=$tm; include("time.inc"); $mon[$tn]=$month;
		     if ($tm>1) $tm--; else { $tm=12; $today["year"]--; }
		    }
		 if ($tn2==1) print '<td class="m_separator" colspan="3" align="center">'.$mon[0].'</td>';
		 else print '<td class="m_separator" colspan="2" align="center">'.$mon[0].'</td>';
        	}
	 print '<td align="center" class="menuitem" rowspan="2">ГКал</td><td align="center" class="menuitem" rowspan="2">руб. с НДС</td></tr>';
	 print '<tr><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td><td align="center" class="m_separator"></td>';
	 print '<td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">руб. с НДС</td>';
	 print '<td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">ГКал c К</td><td align="center" class="menuitem">руб. с НДС</td>';
	 print '<td align="center" class="menuitem">ГКал</td><td align="center" class="menuitem">руб. с НДС</td>';
	 print '</tr>';

	 $query = 'SELECT * FROM devices WHERE ust=1';
	 $u = mysql_query ($query,$i); $maxd=0;
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}

	 $today=getdate(); $ye=$today["year"]; 
	 if ($_GET["month"]) $tm=$_GET["month"];
	 else $tm=$today["mon"]; 
	 if ($tm>$qnt) $tm-=$qnt-1; else { $tm=13+$tm-$qnt; $today["year"]--; }
	 for ($tn=0; $tn<$qnt; $tn++)
	    {
	     $sts=sprintf("%d%02d01000000",$today["year"],$tm);
	     $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value<2000 AND value>0';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data2[$tt][$tn]+=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=12 AND value<2000 AND value>0';
	     $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
	     while ($uw) 
		{
		 for ($tt=0; $tt<=$maxd; $tt++)
		 if ($uw[0]==$devices[$tt]) $data[$tt][$tn]=$uw[1];
		 $uw = mysql_fetch_row ($w);
		}
	     if ($tm<12) $tm++; else { $tm=1; $today["year"]++; }
	    } 
	}
 if ($_GET["analys"]=='12') 
	{
	 $qnt=1;
	 print '<td align="center" class="m_separator" rowspan="2">площадь (кв.м.)</td>
		<td align="center" class="m_separator" rowspan="2">общий расход тепла за месяц (Гкал)</td>
		<td align="center" class="m_separator" rowspan="2">удельный расход тепла (Гкал/кв.м.)</td>
		<td align="center" class="m_separator" rowspan="2">приоритетность проведения мероприятий</td>
		<td align="center" class="m_separator" rowspan="2">источник информации</td></tr>';
	 print '<tr></tr>';
	              
	 $query = 'SELECT * FROM devices WHERE ust=1';
	 $u = mysql_query ($query,$i); $maxd=0;
	 if ($u) $uo = mysql_fetch_row ($u);
	 while ($uo)
		{
		 $devices[$maxd]=$uo[11];
		 $uo = mysql_fetch_row ($u); $maxd++;
		}
	}
 if ($_GET["analys"]=='14') 
	{
	 print '<td align="center" colspan="3" class="m_separator">потребление</td>
		<td align="center" rowspan="1" class="m_separator">стоимость</td></tr>
		<tr>';

         $month=$_POST["month"]; include("time.inc");
	 print '<td align="center" class="menuitem">На '.($month).' мес</td>';
         $month=$_POST["month2"]; include("time.inc");
	 print '<td align="center" class="menuitem">На '.($month).' мес</td><td align="center" class="menuitem">За период</td><td align="center" class="menuitem">в руб.</td></tr>';
	}
 $today=getdate();
 $tarif_electr=1.19;
 $tarif=1159;
 $query = 'SELECT * FROM objects ORDER BY type';
 if ($_GET["analys"]=='14') $query = 'SELECT * FROM objects WHERE type!=12 AND uvoda>0 ORDER BY type';
 if ($_POST["uprav"]) $query = 'SELECT * FROM objects WHERE type='.$_POST["uprav"].' ORDER BY type';
 if ($_GET["analys"]=='4') $query = 'SELECT * FROM objects WHERE uvoda>0 ORDER BY type';
 if ($_GET["analys"]=='10') $query = 'SELECT * FROM objects WHERE uteplo>0 ORDER BY type';
 if ($_GET["analys"]=='9') $query = 'SELECT * FROM objects WHERE uteplo>0 AND square>0 AND nlevels=0 ORDER BY type';
 if ($_GET["analys"]=='13') $query = 'SELECT * FROM objects WHERE nstruts=0 AND (uteplo>0 OR uvoda>0) ORDER BY type';
 if ($_GET["analys"]=='113') $query = 'SELECT * FROM objects WHERE uteplo>0 OR uvoda>0 ORDER BY type';

 $a = mysql_query ($query,$i); $ccn=1; $object=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $device=$uo[11];

	 $square=$uy[14]; $ist=$uy[23];
	 for ($tm=0; $tm<=$maxd; $tm++) if ($device==$devices[$tm]) break;
	 if ($uo[14]==0) { $uy = mysql_fetch_row ($a); continue;}

	 $types[$object]=$uy[2];
	 $name[$object]=$uy[1];
//echo $object.' '.$hide[$object].'<br>';
	 if ($hide[$object]) $adr[$object]='-'; else  $adr[$object]=$uy[3]; 
	 //if ($hide[$object]) echo $object.' '.$name[$object].'<br>';

	 if (!$object) $type=$types[$object];
	 $square=$uy[14];
	 // analys = 0	
	 if ($_GET["analys"]=='') 
		{
		 $chan=''; $ccc=0;	 
		 $query = 'SELECT * FROM devices WHERE type=15 AND object='.$uy[0];
		 if ($y2 = mysql_query ($query,$i))
		 while ($uo2 = mysql_fetch_row ($y2)) 
			{
			 $query = 'SELECT * FROM channels WHERE device='.$uo2[11];
			 if ($y3 = mysql_query ($query,$i))
			 while ($uo3 = mysql_fetch_row ($y3))
				{
				 if ($ccc==0) $chan.='channel='.$uo3[0];
				 else $chan.=' OR channel='.$uo3[0];
				 $ccc++;
				}
			}

		 if ($type!=$types[$object])
			{
			 if ($it4 && $it5) $it6=$it4-$it5; $ccn=1;
			 if ($it4 && $it5) $itp6=($it4-$it5)*100/$it4;
			 if ($it7 && $it8) $it9=$it7-$it8;
			 if ($it7 && $it8) $itp9=($it7-$it8)*100/$it7;
			 if ($it10 && $it11) $it12=$it10-$it11;
			 if ($it10 && $it11) $itp12=($it10-$it11)*100/$it10;
			 if ($its4 && $its5) $itsp6=($its4-$its5)*100/$its4;
			 if ($its4 && $its5) $its6=$its4-$its5;
			 if ($its7 && $its8) $itsp9=($its7-$its8)*100/$its7;
			 if ($its7 && $its8) $its9=$its7-$its8;
			 if ($its10 && $its11) $itsp12=($its10-$its11)*100/$its10;
			 if ($its10 && $its11) $its12=$its10-$its11;
			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator"></td>';
			 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp6,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp9,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it10,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it11,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp12,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itsp6,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its8,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itsp9,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its10,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its11,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itsp12,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$it6=$it7=$it8=$it9=$it10=$it11=$it12=0;
			 $its1=$its2=$its3=$its4=$its5=$its6=$its7=$its8=$its9=$its10=$its11=$its12=0;
			 $itp6=$itp9=$itp12=0;
			 $itsp6=$itsp9=$itsp12=0;
			}	
		 // 2009
		 $sts=sprintf("%d0101000000",$today["year"]-2);
		 $fns=sprintf("%d1301000000",$today["year"]-2);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); 
		 if ($w) $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND value<2000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal0[$object]=$uw[0]; 
       	
		 // 2010
		 $sts=sprintf("%d0101000000",$today["year"]-1);
		 $fns=sprintf("%d1301000000",$today["year"]-1);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); if ($w) $uw = mysql_fetch_row ($w); 
		 $datal12[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal11[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal10[$object]=$uw[0]; 
       	
		 $norm[$object]=$norm_hvs*$dy*$nab;
		 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date>='.$sts.' AND date<'.$fns.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $dog[$object]=$ui[0];
		 if (!$dog[$object]) $dog[$object]=rand (50000,120000)/100;
		 if (!$norm[$object]) $norm[$object]=rand (30000,60000)/100;
         
		 if ($norm[$object]) $voda09[$object]=$norm[$object]-$norm[$object]*0.03; else $voda09[$object]=0;
		 if ($dog[$object]) $teplo09[$object]=$dog[$object]-$dog[$object]*0.03; else $teplo09[$object]=0;
		 $ee09=0;

		 if ($norm[$object]) $voda10[$object]=$norm[$object]-$norm[$object]*0.06;
		 if ($dog[$object]) $teplo10[$object]=$dog[$object]-$dog[$object]*0.06;
		 $ee10=0;
		 $it1+=$norm[$object];
		 $it2+=$dog[$object];
		 if ($datal0[$object]) $it4+=$voda09[$object];
		 if ($datal1[$object]) $it7+=$teplo09[$object];
		 if ($datal2[$object]) $it10+=$ee09[$object];
		 $its1+=$norm[$object];
		 $its2+=$dog[$object];
		 if ($datal10[$object]) $its4+=$voda10[$object];
		 if ($datal11[$object]) $its7+=$teplo10[$object];
		 if ($datal12[$object]) $its10+=$ee10[$object];

		 if ($datal0[$object] && $voda09[$object]) 
			{ $ot_voda09[$object]=$voda09[$object]-$datal0[$object]; $ot_voda_p09[$object]=($voda09[$object]-$datal0[$object])*100/$voda09[$object]; $it5+=$datal0[$object];  }
		 if ($datal1[$object] && $teplo09[$object]) 
			{ $ot_teplo09[$object]=$teplo09[$object]-$datal1[$object]; $ot_teplo_p09[$object]=($teplo09[$object]-$datal1[$object])*100/$teplo09[$object]; $it8+=$datal1[$object];  }
		 if ($datal2[$object] && $ee09[$object]) 
			{ $ot_ee09[$object]=$ee09[$object]-$datal2[$object]; $ot_ee_p09[$object]=($ee09[$object]-$datal2[$object])*100/$ee09[$object]; $it11+=$datal2[$object];  }

		 if ($datal10[$object] && $voda10[$object]) 
			{ $ot_voda10[$object]=$voda10[$object]-$datal10[$object]; $ot_voda_p10[$object]=($voda10[$object]-$datal10[$object])*100/$voda10[$object]; $its5+=$datal10[$object];  }
		 if ($datal11[$object] && $teplo10[$object]) 
			{ $ot_teplo10[$object]=$teplo10[$object]-$datal11[$object]; $ot_teplo_p10[$object]=($teplo10[$object]-$datal11[$object])*100/$teplo10[$object]; $its8+=$datal11[$object];  }
		 if ($datal12[$object] && $ee10[$object]) 
			{ $ot_ee10[$object]=$ee10[$object]-$datal12[$object]; $ot_ee_p10[$object]=($ee10[$object]-$datal12[$object])*100/$ee10[$object]; $its11+=$datal12[$object];  }

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
		 print '<td align="center" class="simple">'.number_format($norm[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($dog[$object],3).'</td>';
		 print '<td align="center" class="simple">-</td>';

		 print '<td align="center" class="simple">'.number_format($voda09[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal0[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_voda_p09[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($teplo09[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_teplo_p09[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ee09[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_ee_p09[$object],3).'</td>';
      	
		 print '<td align="center" class="simple">'.number_format($voda10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_voda_p10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($teplo10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal11[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_teplo_p10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ee10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal12[$object],0).'</td>';
		 print '<td align="center" class="simple">'.number_format($ot_ee_p10[$object],3).'</td>';
		 print '</tr>';
		}
	 // analys = 1 --------------------------------------------------------------------------
	 if ($_GET["analys"]=='1') 
		{
		 if ($type!=$types[$object])
			{
			 if ($it2 && $it4) $it6=($it4-$it2)*100/$it4;
			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$it6=$it7=$it8=0;
			}
		 $sts=sprintf("%d0101000000",$today["year"]);
		 $fns=sprintf("%d1301000000",$today["year"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];
		 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date>='.$sts.' AND date<'.$fns.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $dog2[$object]=$ui[0];
		 //if (!$dog2[$object]) $dog2[$object]=$today["mon"]*rand (5000,12000)/100;
		 if (!$dog2[$object]) $dog2[$object]=$datal2[$object]+$datal2[$object]*rand (0,50)/1000;
		 if ($today["month"]>1)
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]-1);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			}
		 else
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]+1);
			}
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];
		 $query = 'SELECT SUM(value) FROM data WHERE type=7 AND prm=13 AND date>='.$sts.' AND date<'.$fns.' AND source=2 AND device='.$device;
		 $e = mysql_query ($query,$i);
		 if ($e) $ui = mysql_fetch_row ($e);
		 $dog1[$object]=$ui[0];
		 if (!$dog1[$object]) $dog1[$object]=rand (5000,12000)/100;
	         
		 $it2+=$datal2[$object];
		 $it4+=$dog2[$object];
		 $it1+=$datal1[$object];
		 $it3+=$dog1[$object];
		 if ($datal1[$object] && $dog1[$object]) { $ekr1=($dog1[$object]-$datal1[$object])*$tarif; }
		 if ($datal2[$object] && $dog2[$object]) { $ek=$dog2[$object]-$datal2[$object]; $ekpr=($dog2[$object]-$datal2[$object])*100/$dog2[$object]; $ekr2=($dog2[$object]-$datal2[$object])*$tarif; $it5+=$ek; $it7+=$ekr1; $it8+=$ekr2; }
	
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

	  	 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($dog1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($dog2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ekpr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ekr1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ekr2,3).'</td></tr>';
		}
	 // analys = 3 ------------------------------------- ekonomia ee
	 if ($_GET["analys"]=='3') 
		{
		 $chan=''; $ccc=0;	 
		 $query = 'SELECT * FROM devices WHERE type=15 AND object='.$uy[0];
		 if ($y2 = mysql_query ($query,$i))
		 while ($uo2 = mysql_fetch_row ($y2)) 
			{
			 $query = 'SELECT * FROM channels WHERE device='.$uo2[11];
			 if ($y3 = mysql_query ($query,$i))
			 while ($uo3 = mysql_fetch_row ($y3))
				{
				 if ($ccc==0) $chan.='channel='.$uo3[0];
				 else $chan.=' OR channel='.$uo3[0];
				 $ccc++;
				}
			}

		 if ($type!=$types[$object])
			{
			 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$itp1=0;
			}	
		 // 2010
		 $sts=sprintf("%d%02d01000000",$today["year"]-1,1);
		 $fns=sprintf("%d%02d01000000",$today["year"]-1,$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); if ($w) $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];      	
		 // 2011
		 $sts=sprintf("%d%02d01000000",$today["year"],1);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); if ($w) $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];
		 $ek=$datal1[$object]-$datal2[$object];
       	
		 if ($datal1[$object]) $it1+=$datal1[$object];
		 if ($datal2[$object]) $it2+=$datal2[$object];
		 if ($datal2[$object]) $it3+=$ek;
		 if ($datal1[$object] && $datal2[$object]) $pr=($datal1[$object]-$datal2[$object])*100/$datal1[$object];
		 if ($datal1[$object] && $datal2[$object]) $prr=($datal1[$object]-$datal2[$object])*$tarif_electr;
		 $it5+=$prr;

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($prr,3).'</td>';
		 print '</tr>';
		}
	 // analys = 4 ------------------------------------- ekonomia vodi
	 if ($_GET["analys"]=='4') 
		{
		 if ($type!=$types[$object])
			{
			 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
			 if ($it0 && $it2) $itp0=($it0-$it2)*100/$it0;

			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 $it0=$it1=$it2=$it3=$it4=$it5=$it7=$it8=$itp1=$itp0=0;
			}	
		 $norm[$object]=$uy[15]*3.6;

		 // 2010
		 $sts=sprintf("%d0101000000",$today["year"]-1);
		 $fns=sprintf("%d%02d01000000",$today["year"]-1,$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<20 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];      	
		 // 2011
		 $sts=sprintf("%d0101000000",$today["year"]);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<20 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];
		 $ek=$datal1[$object]-$datal2[$object];
       	         $pr=$pr1=$prr=$prr1=$ek=$ek1=0;

		 if ($norm[$object]) $it0+=$norm[$object];
		 if ($datal1[$object]) $it1+=$datal1[$object];
		 if ($datal2[$object]) $it2+=$datal2[$object];
		 if ($datal1[$object] && $datal2[$object]) $ek=($datal1[$object]-$datal2[$object]); 
		 if ($datal1[$object] && $datal2[$object]) $pr=($datal1[$object]-$datal2[$object])*100/$datal1[$object];
		 if ($datal1[$object] && $datal2[$object]) $prr=($datal1[$object]-$datal2[$object])*$tarif_electr;
		 if ($norm[$object] && $datal2[$object]) $ek1=($norm[$object]-$datal2[$object]);
		 if ($norm[$object] && $datal2[$object]) $pr1=($norm[$object]-$datal2[$object])*100/$norm[$object];
		 if ($norm[$object] && $datal2[$object]) $prr1=($norm[$object]-$datal2[$object])*$tarif_electr;
		 $it3+=$ek; $it5+=$ek1;
		 $it7+=$prr; $it8+=$prr1;

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$norm[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr1,3).'</td>';

		 print '<td align="center" class="simple">'.number_format($prr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($prr1,3).'</td>';
		 print '</tr>';
		}
	 // analys = 5 ------------------------------------- потери воды
	 if ($_GET["analys"]=='5') 
		{
		 $ek1=$ek2=$ekpr1=$ekpr2=0;
		 if ($type!=$types[$object])
			{
			 if ($it2 && $it4) $itp1=($it4)*100/$it2; $ccn=1;
			 if ($it1 && $it3) $itp0=($it3)*100/$it1;

			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$it7=$it8=$itp1=$itp0=0;
			}	
		 $sts=sprintf("%d0101000000",$today["year"],$today["mon"]);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];      	
		 $date1='date LIKE \'%20:00:00%\'';
		 for ($da=21;$da<=23;$da++) $date1.=' OR date LIKE \'%'.$da.':00:00%\'';
		 for ($da=0;$da<=6;$da++) $date1.=' OR date LIKE \'%0'.$da.':00:00%\'';
   	 	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE device='.$device.' AND type=1 AND value>0 AND prm=12 AND source=6 AND value<10 AND date>'.$sts.' AND date<'.$fns.' AND ('.$date1.')';  
		 //echo $query.'<br>';
		 $a2 = mysql_query ($query,$i);
		 //echo $a2.'<br>';
		 if ($a2) 
			{
			 $uy2 = mysql_fetch_row ($a2);
			 //echo $uy2[0].' / '.$uy2[1].'<br>';
			 $datal21[$object]=$uy2[0];
			 //echo $datal21[$object].'<br>';
			}

		 // 2011
		 if ($today["mon"]>1)
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]-1);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			}
		 else
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]+1);
			}
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND device='.$device;
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE device='.$device.' AND type=1 AND value>0 AND prm=12 AND source=6 AND value<10 AND date>'.$sts.' AND date<'.$fns.' AND ('.$date1.')';  
		 //echo $query.'<br>';
		 $a2 = mysql_query ($query,$i);
		 if ($a2) 
			{
			 $uy2 = mysql_fetch_row ($a2);
			 //echo $uy2[0].' / '.$uy2[1].'<br>';
			 $datal11[$object]=$uy2[0];
			 //echo $datal11[$object].'<br>';
			}

		 if ($datal1[$object]) $it1+=$datal1[$object];
		 if ($datal2[$object]) $it2+=$datal2[$object];
		 if ($datal11[$object]) $it3+=$datal11[$object];
		 if ($datal21[$object]) $it4+=$datal21[$object];

		 if ($datal1[$object] && $datal11[$object]) $ek1=($datal11[$object])*100/$datal1[$object]; 
		 if ($datal2[$object] && $datal21[$object]) $ek2=($datal21[$object])*100/$datal2[$object];
		 if ($datal1[$object] && $datal11[$object]) $ekpr1=($datal11[$object])*9.72; 
		 if ($datal2[$object] && $datal21[$object]) $ekpr2=($datal21[$object])*9.72;
		 $it7+=$ekpr1; $it8+=$ekpr2;
		 //echo $datal11[$object].' '.$datal21[$object].'<br>';

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal11[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal21[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek2,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ekpr1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ekpr2,3).'</td>';
		 print '</tr>';
		}
	 // analys = 6 ------------------------------------- ekonomia tepla
	 if ($_GET["analys"]=='6') 
		{
		 if ($type!=$types[$object])
			{
			 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
			 if ($it0 && $it2) $itp0=($it0-$it2)*100/$it0;

			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$it7=$it8=$itp1=$itp0=0;
			}	
		 $norm[$object]=$uy[14]*0.0322*($today["mon"]/2);

		 // 2010
		 $sts=sprintf("%d0101000000",$today["year"]-1);
		 $fns=sprintf("%d%02d01000000",$today["year"]-1,$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 //echo $query;
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0];      	
		 // 2011
		 $sts=sprintf("%d0101000000",$today["year"]);
		 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 //echo $query;
		 $datal2[$object]=$uw[0];
       	         $ek=$pr=$prr=$ek1=$pr1=$prr=$prr1=0;

		 if ($norm[$object]) $it0+=$norm[$object];
		 if ($datal1[$object]) $it1+=$datal1[$object];
		 if ($datal2[$object]) $it2+=$datal2[$object];
		 if ($datal1[$object] && $datal2[$object]) $ek=($datal1[$object]-$datal2[$object]); 
		 if ($datal1[$object] && $datal2[$object]) $pr=($datal1[$object]-$datal2[$object])*100/$datal1[$object];
		 if ($datal1[$object] && $datal2[$object]) $prr=($datal1[$object]-$datal2[$object])*$tarif;
		 if ($norm[$object] && $datal2[$object]) $ek1=($norm[$object]-$datal2[$object]);
		 if ($norm[$object] && $datal2[$object]) $pr1=($norm[$object]-$datal2[$object])*100/$norm[$object];
		 if ($norm[$object] && $datal2[$object]) $prr1=($norm[$object]-$datal2[$object])*$tarif;
		 $it3+=$ek; $it5+=$ek1;
		 $it7+=$prr; $it8+=$prr1;

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$norm[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$norm[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr1,3).'</td>';

		 print '<td align="center" class="simple">'.number_format($prr,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($prr1,3).'</td>';
		 print '</tr>';
		}
	 // analys = 7 ------------------------------------- utechki
	 if ($_GET["analys"]=='7') 
		{
		 if ($type!=$types[$object])
			{
			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 $it1=$it2=$it3=$it4=$it5=$it7=$it6=0;
			}	
		 if ($today["mon"]>1)
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]-1);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			}
		 else
			{
			 $sts=sprintf("%d%02d01000000",$today["year"],$today["mon"]);
			 $fns=sprintf("%d%02d01000000",$today["year"],$today["mon"]+1);
			}
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=11 AND source=0 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 if ($uw) { $datal11[$object]=$uw[0]; $count1=$uw[1]; }
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=11 AND source=1 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 if ($uw) { $datal12[$object]=$uw[0];  $count1=$uw[1]; }
		 if ($datal11[$object]>$datal12[$object]) $datal1[$object]=$datal11[$object]-$datal12[$object];
		 else  $datal1[$object]=$datal12[$object]-$datal11[$object];
		 // 2011
		 $sts=sprintf("%d0101000000",$today["year"]);
		 $fns=sprintf("%d1301000000",$today["year"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=11 AND source=0 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 if ($uw) { $datal21[$object]=$uw[0]; $count2=$uw[1]; }
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=11 AND source=1 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 if ($uw) { $datal22[$object]=$uw[0]; $count2=$uw[1]; }
		 if ($datal21[$object]>$datal22[$object]) $datal2[$object]=$datal21[$object]-$datal22[$object];
		 else $datal2[$object]=$datal22[$object]-$datal21[$object];

		 $norm1[$object]=(0.0143*24)*$count1;
		 $norm2[$object]=(0.0143*24)*($count2);
	         if ($datal1[$object]>$norm2[$object]) $sverh[$object]=$datal1[$object]-$norm2[$object];
		 if ($datal1[$object]>$norm1[$object]) $utech1[$object]=($datal1[$object]-$norm1[$object])*$tarif_svoda;
		 if ($datal2[$object]>$norm2[$object]) $utech2[$object]=($datal2[$object]-$norm2[$object])*$tarif_svoda;

		 if ($datal1[$object]) $it1+=$datal1[$object];
		 if ($datal2[$object]) $it2+=$datal2[$object];
		 if ($norm1[$object]) $it3+=$norm1[$object];
		 if ($norm2[$object]) $it4+=$norm2[$object];
		 if ($sverh[$object]) $it5+=$sverh[$object];
		 if ($utech1[$object]) $it6+=$utech1[$object];
		 if ($utech2[$object]) $it7+=$utech2[$object];

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
  		 print '<td align="center" class="simple">'.$norm1[$object].'</td>';
  		 print '<td align="center" class="simple">'.$norm2[$object].'</td>';
  		 print '<td align="center" class="simple">'.number_format($sverh[$object],3).'</td>';
  		 print '<td align="center" class="simple">'.number_format($utech1[$object],3).'</td>';
  		 print '<td align="center" class="simple">'.number_format($utech2[$object],3).'</td>';
		 print '</tr>';
		}

	 // analys = 8	
	 if ($_GET["analys"]=='8') 
		{
		 if ($type!=$types[$object])
			{
			 if ($it1 && $it5) $it9=($it1-$it5)*100/$it1;
			 if ($it2 && $it6) $it10=($it2-$it6)*100/$it2;
			 if ($it3 && $it7) $it11=($it3-$it7)*100/$it3;
			 if ($it4 && $it8) $it12=($it4-$it8)*100/$it4;
			 if ($it12>100 || $it12<-100) $it12=0;

			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it9,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it10,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it11,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it12,3).'</td>';
			 print '<td align="center" class="m_separator"></td>';
			 $it1=$it2=$it3=$it4=$it5=$it6=$it7=$it8=$it9=$it10=$it11=$it12=0;
			}	
		 // 2010
		 $sts=sprintf("%d0101000000",$today["year"]-1);
		 $fns=sprintf("%d1301000000",$today["year"]-1);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); 
		 if ($w) $uw = mysql_fetch_row ($w); 
		 $datal2[$object]=$uw[0];

		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND value<2000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal0[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal1[$object]=$uw[0]; 
       	
		 // 2011
		 $sts=sprintf("%d0101000000",$today["year"]);
		 $fns=sprintf("%d1301000000",$today["year"]);
		 $query = 'SELECT SUM(value),COUNT(id) FROM data2 WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND ('.$chan.')';
		 $w = mysql_query ($query,$i); 
		 if ($w) $uw = mysql_fetch_row ($w); 
		 $datal12[$object]=$uw[0];

		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal10[$object]=$uw[0];
		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND source=6 AND value<10000 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $datal11[$object]=$uw[0]; 
		 $rub2010=$rub2011=$fz1=$fz2=$fz3=$fz4=0;

		 if ($datal0[$object]>1) $it1+=$datal0[$object];
		 if ($datal1[$object]>1) $it2+=$datal1[$object];
		 if ($datal2[$object]>1) $it3+=$datal2[$object];
		 $rub2010=$datal0[$object]*1154+$datal1[$object]*9.72+$datal2[$object]*1.19;
		 $it4+=$rub2010;
		 if ($datal10[$object]>1) $it5+=$datal10[$object];
		 if ($datal11[$object]>1) $it6+=$datal11[$object];
		 if ($datal12[$object]>1) $it7+=$datal12[$object];
		 $rub2011=$datal10[$object]*1154+$datal11[$object]*9.72+$datal12[$object]*1.19;
		 $it8+=$rub2011;
		 if ($datal0[$object]>1) $fz1+=($datal0[$object]-$datal10[$object])*100/$datal0[$object];
		 if ($datal1[$object]>1) $fz2+=($datal1[$object]-$datal11[$object])*100/$datal1[$object];
		 if ($datal2[$object]>1) $fz3+=($datal2[$object]-$datal12[$object])*100/$datal2[$object];
		 if ($rub2010>1) $fz4+=($rub2010-$rub2011)*100/$rub2010;
		 if ($fz4>100 || $fz4<-100) $fz4=0;
//		 if ($rub2010>1) $fz4+=number_format (((number_format ($rub2010,0)-number_format ($rub2011,0))*100/number_format ($rub2010,0)),2);
		 
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal0[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($rub2010,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal10[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal11[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal12[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($rub2011,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($fz1,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($fz2,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($fz3,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($fz4,3).'</td>';
		 print '<td align="center" class="simple"></td>';
		 print '</tr>';
		}
	 // analys = 9		 
	 if ($_GET["analys"]=='9') 
		{
		 $today=getdate();
		 if ($type!=$types[$object])
			{
			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 for ($mon=1;$mon<$today["mon"];$mon++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its[$mon],4).'</td>';
				 $itr+=$its[$mon];
				}
			 print '<td align="center" class="m_separator">'.number_format($itr,4).'</td>';
			 for ($mon=1;$mon<=12;$mon++) $its[$mon]=0; $itr=0;
			}	
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 $today=getdate();
		 for ($mon=1;$mon<$today["mon"];$mon++)
			{
			 $dy=31;
			 if (!checkdate ($mon,31,$today["year"])) { $dy=30; }
			 if (!checkdate ($mon,30,$today["year"])) { $dy=29; }
			 if (!checkdate ($mon,29,$today["year"])) { $dy=28; }
			 $sts=sprintf("%d%02d01000000",$today["year"],$mon);
			 $fns=sprintf("%d%02d01000000",$today["year"],$mon+1);
			 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND value<2000 AND device='.$uo[11];
			 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);        		
			 if ($square) $datal[$object][$mon]=$uw[0]/$square;
			 print '<td align="center" class="simple">'.number_format($datal[$object][$mon],4).'</td>';
			 $its[$mon]+=$datal[$object][$mon];
			 $it[$object]+=$datal[$object][$mon];
			}
		 print '<td align="center" class="simple">'.number_format($it[$object],3).'</td>';
		 print '</tr>';
		}

	 // analys = 10
	 if ($_GET["analys"]=='10') 
		{
		 if ($type!=$types[$object])
			{
			 print '<tr><td align="center" class="m_separator" colspan="6">Итого</td>';
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its1[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($ots1[$tn],0,'.','').'</td>';
				 $itr1[$tn]+=$its1[$tn]; $otr1[$tn]+=$ots1[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its2[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($ots2[$tn],0,'.','').'</td>';
				 $itr2[$tn]+=$its2[$tn]; $otr2[$tn]+=$ots2[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its3[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($its3[$tn]*tarif,0,'.','').'</td>';
				 $itr3[$tn]+=$its3[$tn]; $otr3[$tn]+=$its3[$tn]*tarif;
				}
			 print '<td align="center" class="m_separator">'.number_format($its4,1,'.','').'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its5,0,'.','').'</td>';
			 for ($tn=0; $tn<$qnt; $tn++) { $its1[$tn]=0; $its2[$tn]=0; $its3[$tn]=0; $ots1[$tn]=0; $ots2[$tn]=0; $ots3[$tn]=0; }
			 $itr4+=$its4; $itr5+=$its5;
			 $its4=$its5=0;
			}	
		 $tarif=$uy[121]; $k=$uy[120];
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$tarif.'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$k.'</font></td>';
		 $it1=$it2=$ot1=$ot2=0;
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format($data[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ($data[$tm][$tn]*$tarif,2,'.','').'</td>';
			 //$it1+=$data[$tm][$tn]; 
			 $its1[$tn]+=$data[$tm][$tn];
			 //$ot1+=$data[$tm][$tn]*$uy[117]; 
			 $ots1[$tn]+=$data[$tm][$tn]*$tarif;
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format(($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format (($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)*$tarif,2,'.','').'</td>';
			 //$it2+=($data2[$tm][$tn]+$data2[$tm][$tn]*$tarif/100); 
			 $its2[$tn]+=($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100);
			 //$ot2+=($data2[$tm][$tn]+$data2[$tm][$tn]*$tarif/100)*$tarif; 
			 $ots2[$tn]+=($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)*$tarif;
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format((($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn]),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ((($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn])*$tarif,2,'.','').'</td>';
                         $its3[$tn]+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn]); $it1+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn]);
			 $ots3[$tn]+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn])*tarif; $it2+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$k/100)-$data[$tm][$tn])*$tarif;
			}

 	         print '<td class="m_separator" align="center">'.number_format($it1,2,'.','').'</td>';
 	         print '<td class="m_separator" align="center">'.number_format($it2,2,'.','').'</td>';
 	         //$itr4+=$it1; $itr5+=$it2;
 	         $its4+=$it1; $its5+=$it2;
		 print '</tr>';
		}
	 if ($_GET["analys"]=='11') 
		{
		 if ($type!=$types[$object])
			{
			 print '<tr><td align="center" class="m_separator" colspan="6">Итого</td>';
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its1[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($ots1[$tn],0,'.','').'</td>';
				 $itr1[$tn]+=$its1[$tn]; $otr1[$tn]+=$ots1[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($itp2[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($its2[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($ots2[$tn],0,'.','').'</td>';
				 $itr2[$tn]+=$its2[$tn]; $otr2[$tn]+=$ots2[$tn];  $itpr2[$tn]+=$itp2[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="center" class="m_separator">'.number_format($its3[$tn],1,'.','').'</td>';
				 print '<td align="center" class="m_separator">'.number_format($ots3[$tn],0,'.','').'</td>';
				 $itr3[$tn]+=$its3[$tn]; $otr3[$tn]+=$ots3[$tn];
				}
			 print '<td align="center" class="m_separator">'.number_format($its4,1,'.','').'</td>';
			 print '<td align="center" class="m_separator">'.number_format($its5,0,'.','').'</td>';
			 for ($tn=0; $tn<$qnt; $tn++) { $its1[$tn]=0; $its2[$tn]=0; $its3[$tn]=0; $ots1[$tn]=0; $ots2[$tn]=0; $ots3[$tn]=0; }
			 $itr4+=$its4; $itr5+=$its5;
			 $its4=$its5=0;
			}	
		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$uy[117].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$uy[116].'</font></td>';
		 $it1=$it2=$ot1=$ot2=0;
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format($data[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ($data[$tm][$tn]*$uy[117],2,'.','').'</td>';
			 //$it1+=$data[$tm][$tn]; 
			 $its1[$tn]+=$data[$tm][$tn];
			 //$ot1+=$data[$tm][$tn]*$uy[117]; 
			 $ots1[$tn]+=$data[$tm][$tn]*$uy[117];
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format(($data2[$tm][$tn]),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format(($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format (($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)*$uy[117],2,'.','').'</td>';
			 //$it2+=($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[117]/100); 
			 $itp2[$tn]+=($data2[$tm][$tn]);
			 $its2[$tn]+=($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100);
			 //$ot2+=($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[117]/100)*$uy[117]; 
			 $ots2[$tn]+=($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)*$uy[117];
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format((($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn]),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ((($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn])*$uy[117],2,'.','').'</td>';
                         $its3[$tn]+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn]); $it1+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn]);
			 $ots3[$tn]+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn])*$uy[117]; $it2+=(($data2[$tm][$tn]+$data2[$tm][$tn]*$uy[116]/100)-$data[$tm][$tn])*$uy[117];
			}

 	         print '<td class="m_separator" align="center">'.number_format($it1,2,'.','').'</td>';
 	         print '<td class="m_separator" align="center">'.number_format($it2,2,'.','').'</td>';
 	         //$itr4+=$it1; $itr5+=$it2;
 	         $its4+=$it1; $its5+=$it2;
		 print '</tr>';
		}
	 //--------------------------------------------------------------------------------------------
	 if ($_GET["analys"]=='14') 
		{
		 if ($type!=$types[$object])
			{
			 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
			 if ($it0 && $it2) $itp0=($it0-$it2)*100/$it0;

			 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
			 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
			 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
			 $itr1+=$it0; $itr2+=$it1; $itr3+=$it2; $itr4+=$it3;
			 $it0=$it1=$it2=$it3=0;   //$ccr++; 
			}	
		 // 2011
		 $sts=sprintf("%d%02d%02d000000",$_POST["year"],$_POST["month"],$_POST["day"]);
		 $fns=sprintf("%d%02d%02d000000",$_POST["year2"],$_POST["month2"],$_POST["day2"]);
		 //echo $sts.' - '.$fns;

		 $query = 'SELECT value FROM data WHERE date<='.$sts.' AND type=2 AND prm=12 AND source=26 AND device='.$uo[11].' ORDER BY date DESC';
		 //echo $query.'<br>';
		 $w = mysql_query ($query,$i); 
		 if ($w) $uw = mysql_fetch_row ($w); 
		 if ($uw) $datal2[$object]=$uw[0];
		 $query = 'SELECT value FROM data WHERE date<='.$fns.' AND type=2 AND prm=12 AND source=26 AND device='.$uo[11].' ORDER BY date DESC';
		 //echo $query.'<br>';

		 $w = mysql_query ($query,$i); 
		 if ($w) $uw = mysql_fetch_row ($w); 
		 if ($uw) $datal1[$object]=$uw[0];

		 $ek=$datal1[$object]-$datal2[$object];
		 $pr=($datal1[$object]-$datal2[$object])*26;

		 $it0+=$datal2[$object]; $it1+=$datal1[$object];
		 $it2+=$ek; $it3+=$pr;

		 if ($ek>0) { $req[$ccr].='da'.$cct.'='.(str_replace("\"", "", $name[$object])).'&dt'.$cct.'='.$ek.'&'; $cct++; }

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.$count[$types[$object]].'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

		 print '<td align="center" class="simple">'.number_format($datal2[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($datal1[$object],3).'</td>';
		 print '<td align="center" class="simple">'.number_format($ek,3).'</td>';
		 print '<td align="center" class="simple">'.number_format($pr,3).'</td>';
		 print '</tr>'; 
		}
	 // analys = 12
	 if ($_GET["analys"]=='12') 
		{
		 $today=getdate(); $ye=$today["year"]; 
		 if ($_GET["month"]) $tm=$_GET["month"];
		 else $tm=$today["mon"]; 
		 $sts=sprintf("%d%02d01000000",$today["year"],$tm);
		 $fns=sprintf("%d%02d01000000",$today["year"],$tm+1);
		 $query = 'SELECT device,value FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value<2000 AND device='.$device;
		 //echo $query;
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w);  $data=0;      		
		 while ($uw) 
			{
			 $data+=$uw[1];
			 $uw = mysql_fetch_row ($w);
			}		 

		 print '<tr><td align="center" class="m_separator">'.($object+1).'</td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$square.'</font></td>';
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($data,3).'</font></td>';
		 if ($square) $ud=$data/$square; else $ud=0;
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.number_format($ud,4).'</font></td>';
		 if ($ud>0.015) $cat=2;
		 if ($ud>0.025) $cat=1;
		 if ($ud<=0.015) $cat=3;
  		 print '<td align="center" class="simple"><font style="font-weight:bold">'.$cat.'</font></td>';
		 print '<td align="center" class="simple">'.$ist.'</td>';
		 print '</tr>';
		}

	 // analys = 15
	 if ($_GET["analys"]=='15') 
		{
		 print '<tr><td align="center" class="m_separator" rowspan="1">'.($object+1).'</td>';
  		 print '<td align="center" class="simple" rowspan="1"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple" rowspan="1"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

  		 if ($uy[118]) {
	  		 print '<td align="center" class="simple"><font style="font-weight:bold">Вода</font></td>';
			 $it11=$it12=$ot1=$ot2=0;
			 for ($tn=0; $tn<$qnt; $tn++)
				{
			     	 print '<td class="simple" align="center">'.number_format ($data3[$tm][$tn],2,'.','').'</td>';
				}
			}
		 else	{
  		 	 print '<td align="center" class="simple3"><font style="font-weight:bold">Вода</font></td>';
			 $it11=$it12=$ot1=$ot2=0;
			 for ($tn=0; $tn<$qnt; $tn++)
				{
			     	 print '<td class="simple3" align="center">н/у</td>';
				}
			}
		 print '</tr>';
		}

	 // analys = 13
	 if ($_GET["analys"]=='13' || $_GET["analys"]=='113') 
		{
		 if ($type!=$types[$object])
			{
			 /*print '<tr><td align="right" class="m_separator" colspan="5" rowspan="2">Итого</td>';
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its1[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots1[$tn],0,'.','').'</td>';
				 $itr1[$tn]+=$its1[$tn]; $otr1[$tn]+=$ots1[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its2[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots2[$tn],0,'.','').'</td>';
				 $itr2[$tn]+=$its2[$tn]; $otr2[$tn]+=$ots2[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its3[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots3[$tn],0,'.','').'</td>';
				 $itr3[$tn]+=$its3[$tn]; $otr3[$tn]+=$ots3[$tn];
				}
			 print '<td align="right" class="m_separator">'.number_format($its4,0,'.','').'</td>';
			 print '<td align="right" class="m_separator" rowspan="2">'.number_format($its6,0,'.','').'</td>';
			 print '</tr>';
			 print '<tr>';
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its11[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots11[$tn],0,'.','').'</td>';
				 $itr11[$tn]+=$its11[$tn]; $otr11[$tn]+=$ots11[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its12[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots12[$tn],0,'.','').'</td>';
				 $itr12[$tn]+=$its12[$tn]; $otr12[$tn]+=$ots12[$tn];
				}
			 for ($tn=0; $tn<$qnt; $tn++)
				{
				 print '<td align="right" class="m_separator">'.number_format($its13[$tn],0,'.','').'</td>';
				 print '<td align="right" class="m_separator">'.number_format($ots13[$tn],0,'.','').'</td>';
				 $itr13[$tn]+=$its13[$tn]; $otr13[$tn]+=$ots13[$tn];
				}
			 print '<td align="right" class="m_separator">'.number_format($its5,0,'.','').'</td>';
			 print '</tr>';*/

			 for ($tn=0; $tn<$qnt; $tn++) { $its1[$tn]=0; $its2[$tn]=0; $its3[$tn]=0; $ots1[$tn]=0; $ots2[$tn]=0; $ots3[$tn]=0; }
			 $itr4+=$its4; $itr5+=$its5; 
			 $its4=$its5=$its6=0; $ccr++; $cct=0;
			}	
		 $tarif=$uy[121]; $k=$uy[120];  // style="visibility:hidden; display:none"

		 if ($hide[$object]) print '<tr><td align="center" class="m_separator" rowspan="2">'.($object+1).'</td>';
		 else print '<tr><td align="center" class="m_separator" rowspan="2">'.($object+1).'</td>';
		 if (!$object || $type!=$types[$object]) print '<td align="center" class="menuitem" rowspan="'.(2*$count[$types[$object]]).'"><div style="writing-mode: tb-rl;">'.$nametype[$types[$object]].'</div></td>';
  		 print '<td align="center" class="simple" rowspan="2"><font style="font-weight:bold">'.$name[$object].'</font></td>';
  		 print '<td align="center" class="simple" rowspan="2"><font style="font-weight:bold">'.$adr[$object].'</font></td>';

  		 if ($uy[117]) {
  		 print '<td align="center" class="simple"><font style="font-weight:bold">Тепло</font></td>';
		 $it1=$it2=$ot1=$ot2=0; 
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format($data12[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ($data12[$tm][$tn]*$tarif,0,'.','').'</td>';
			 $its1[$tn]+=$data12[$tm][$tn];
			 $sits1[$cct]+=($data12[$tm][$tn]);
			 $ots1[$tn]+=$data12[$tm][$tn]*$tarif;
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format(($data2[$tm][$tn]),2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format (($data2[$tm][$tn])*$tarif,0,'.','').'</td>';
			 $its2[$tn]+=($data2[$tm][$tn]);
			 $sits2[$cct]+=($data2[$tm][$tn]);
			 $ots2[$tn]+=($data2[$tm][$tn])*$tarif;
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 if ($data12[$tm][$tn]>0) print '<td class="simple" align="center">'.number_format (($data12[$tm][$tn]-$data2[$tm][$tn]),2,'.','').'</td>';
			 else print '<td class="simple" align="center">'.number_format (0,2,'.','').'</td>';
		     	 if ($data12[$tm][$tn]>0) print '<td class="simple" align="center">'.number_format (($data12[$tm][$tn]-$data2[$tm][$tn])*$tarif,0,'.','').'</td>';
			 else print '<td class="simple" align="center">'.number_format (0,2,'.','').'</td>';
			 if ($data12[$tm][$tn]>0) $its3[$tn]+=$data12[$tm][$tn]-$data2[$tm][$tn]; 
			 if ($data12[$tm][$tn]>0) $ots3[$tn]+=($data12[$tm][$tn]-$data2[$tm][$tn])*$tarif; 

			 if ($data12[$tm][$tn]>0) $it1+=($data12[$tm][$tn]-$data2[$tm][$tn]);
			 if ($data12[$tm][$tn]>0) $it2+=($data12[$tm][$tn]-$data2[$tm][$tn])*$tarif;
			}}
		 else	{
 		 	 print '<td align="center" class="simple3"><font style="font-weight:bold">Тепло</font></td>';
			 $it1=$it2=$ot1=$ot2=0; 
			 for ($tn=0; $tn<$qnt*3; $tn++)
				{
			     	 print '<td class="simple3" align="center">н/у</td>';
			     	 print '<td class="simple3" align="center">н/у</td>';
				}
			}
 	         print '<td class="m_separator" align="rigth">'.number_format($it1,2,'.','').'</td>';
 	         print '<td class="m_separator" align="rigth">'.number_format($it2,0,'.','').'</td>';
 	         $its4+=$it1; $its6+=$it2; 

		 print '</tr>';

		 $tarif=$uy[122];
		 print '<tr>';
  		 if ($uy[118]) {
  		 print '<td align="center" class="simple"><font style="font-weight:bold">Вода</font></td>';
		 $it11=$it12=$ot1=$ot2=0;
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format($data13[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ($data13[$tm][$tn]*$tarif,0,'.','').'</td>';
			 $its11[$tn]+=$data13[$tm][$tn];
			 $ots11[$tn]+=$data13[$tm][$tn]*$tarif;
			 $sits11[$cct]+=($data13[$tm][$tn]);
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format ($data3[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format ($data3[$tm][$tn]*$tarif,0,'.','').'</td>';
			 $its12[$tn]+=($data3[$tm][$tn]);
			 $ots12[$tn]+=($data3[$tm][$tn])*$tarif;
			 $sits12[$cct]+=($data3[$tm][$tn]);
			}
		 for ($tn=0; $tn<$qnt; $tn++)
			{
		     	 print '<td class="simple" align="center">'.number_format ($data13[$tm][$tn]-$data3[$tm][$tn],2,'.','').'</td>';
		     	 print '<td class="simple" align="center">'.number_format (($data13[$tm][$tn]-$data3[$tm][$tn])*$tarif,0,'.','').'</td>';
			 $its13[$tn]+=($data13[$tm][$tn]-$data3[$tm][$tn]);
			 $ots13[$tn]+=($data13[$tm][$tn]-$data3[$tm][$tn])*$tarif; 

			 $it11+=(($data13[$tm][$tn])-$data3[$tm][$tn]);
			 $it12+=(($data13[$tm][$tn])-$data3[$tm][$tn])*$tarif;
			}
			}
		 else	{
  		 	 print '<td align="center" class="simple3"><font style="font-weight:bold">Вода</font></td>';
			 $it11=$it12=$ot1=$ot2=0;
			 for ($tn=0; $tn<$qnt*3; $tn++)
				{
			     	 print '<td class="simple3" align="center">н/у</td>';
			     	 print '<td class="simple3" align="center">н/у</td>';
				}
			}
		 $req[$ccr].='da'.$cct.'='.(str_replace("\"", "", $name[$object])).'&db'.$cct.'='.$sits1[$cct].'&dc'.$cct.'='.$sits2[$cct].'&';
		 $req2[$ccr].='da'.$cct.'='.str_replace("\"", "", $name[$object]).'&db'.$cct.'='.$sits11[$cct].'&dc'.$cct.'='.$sits12[$cct].'&';

 	         print '<td class="m_separator" align="rigth">'.number_format($it11,2,'.','').'</td>';
 	         print '<td class="m_separator" align="rigth">'.number_format($it12,0,'.','').'</td>';
 	         //$itr4+=$it1; $itr5+=$it2;
 	         $its5+=$it11; $its6+=$it12; $cct++;
 	         //$its14+=$it11; $its15+=$it12;
		 print '</tr>';

		}

	 $type=$types[$object];
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}

 if ($_GET["analys"]=='') 
	{
	 if ($it4 && $it5) $itp6=($it4-$it5)*100/$it4;
	 if ($it7 && $it8) $it9=$it7-$it8;
	 if ($it7 && $it8) $itp9=($it7-$it8)*100/$it7;
	 if ($it10 && $it11) $it12=$it10-$it11;
	 if ($it10 && $it11) $itp12=($it10-$it11)*100/$it10;
	 if ($its4 && $its5) $itsp6=($its4-$its5)*100/$its4;
	 if ($its4 && $its5) $its6=$its4-$its5;
	 if ($its7 && $its8) $itsp9=($its7-$its8)*100/$its7;
	 if ($its7 && $its8) $its9=$its7-$its8;
	 if ($its10 && $its11) $itsp12=($its10-$its11)*100/$its10;
	 if ($its10 && $its11) $its12=$its10-$its11;

	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator"></td>';
	 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp6,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp9,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it10,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it11,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp12,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itsp6,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its8,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itsp9,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its10,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its11,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itsp12,3).'</td></tr>';
	}

 if ($_GET["analys"]=='1') 
	{
	 if ($it2 && $it4) $it6=($it4-$it2)*100/$it4;
	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	}
 if ($_GET["analys"]=='3') 
	{
	 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1;
	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 $it1=$it2=$it3=$it4=$it5=$itp1=0;
	}
 if ($_GET["analys"]=='4') 
	{
	 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
	 if ($it0 && $it2) $itp0=($it0-$it2)*100/$it0;

	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	 $it1=$it2=$it3=$it4=$it5=$it7=$it8=$itp1=$itp0=0;
	}
 if ($_GET["analys"]=='5') 
	{
	 if ($it2 && $it4) $itp1=($it4)*100/$it2; $ccn=1;
	 if ($it1 && $it3) $itp0=($it3)*100/$it1;

	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	}
 if ($_GET["analys"]=='6') 
	{
	 if ($it1 && $it2) $itp1=($it1-$it2)*100/$it1; $ccn=1;
	 if ($it0 && $it2) $itp0=($it0-$it2)*100/$it0;

	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it0,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp1,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itp0,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	 $it1=$it2=$it3=$it4=$it5=$it7=$it8=$itp1=$itp0=0;
	}
 if ($_GET["analys"]=='7') 
	{
	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 $it1=$it2=$it3=$it4=$it5=$it7=$it6=0;
	}
 if ($_GET["analys"]=='8') 
	{
	 if ($it1 && $it5) $it9=($it1-$it5)*100/$it1;
	 if ($it2 && $it6) $it10=($it2-$it6)*100/$it2;
	 if ($it3 && $it7) $it11=($it3-$it7)*100/$it3;
	 if ($it4 && $it8) $it12=($it4-$it8)*100/$it4;
	 if ($it12>100 || $it12<-100) $it12=0;

	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 print '<td align="center" class="m_separator">'.number_format($it1,2).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it2,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it3,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it4,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it5,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it6,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it7,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it8,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it9,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it10,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it11,3).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($it12,3).'</td>';
	 print '<td align="center" class="m_separator"></td>';
	}
 if ($_GET["analys"]=='9') 
	{
	 print '<tr><td align="center" class="m_separator" colspan="4">Итого</td>';
	 for ($mon=1;$mon<$today["mon"];$mon++)
	 print '<td align="center" class="m_separator">'.number_format($its[$mon],2).'</td>';
	 for ($mon=1;$mon<$today["mon"];$mon++) $its[$mon]=0;
	 print '<td align="center" class="m_separator">'.number_format($itr,4).'</td>';
	}
 if ($_GET["analys"]=='10') 
	{
	 print '<tr><td align="center" class="m_separator" colspan="6">Итого по ГРБС</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($its1[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots1[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($its2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots2[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($its3[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots3[$tn],0,'.','').'</td>';
		}
	 print '<td align="center" class="m_separator">'.number_format($its4,2,'.','').'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its5,3,'.','').'</td></tr>';
	 print '<tr><td align="center" class="m_separator" colspan="6">Итого по всем объектам</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr1[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr1[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr2[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr3[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr3[$tn],0,'.','').'</td>';
		}
	 print '<td align="center" class="m_separator">'.number_format($itr4,2,'.','').'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr5,3,'.','').'</td></tr>';
	}
 if ($_GET["analys"]=='11') 
	{
	 print '<tr><td align="center" class="m_separator" colspan="6">Итого по ГРБС</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($its1[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots1[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itp2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($its2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots2[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($its3[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($ots3[$tn],0,'.','').'</td>';
		}
	 print '<td align="center" class="m_separator">'.number_format($its4,2,'.','').'</td>';
	 print '<td align="center" class="m_separator">'.number_format($its5,3,'.','').'</td></tr>';
	 print '<tr><td align="center" class="m_separator" colspan="6">Итого по всем объектам</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr1[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr1[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itpr2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr2[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr3[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr3[$tn],0,'.','').'</td>';
		}
	 print '<td align="center" class="m_separator">'.number_format($itr4,2,'.','').'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr5,3,'.','').'</td></tr>';
	}
 if ($_GET["analys"]=='14') 
	{
	 print '<tr><td align="center" class="m_separator" colspan="4" rowspan="2">Итого по ГРБС</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr1,0).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr2,0).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr3,0).'</td>';
	 print '<td align="center" class="m_separator">'.number_format($itr4,0).'</td>';
	 print '</tr>';
	}
 if ($_GET["analys"]=='13') 
	{
	 /*print '<tr><td align="center" class="m_separator" colspan="4" rowspan="2">Итого по ГРБС</td>';
	 print '<td align="center" class="m_separator">Тепло</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr1[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($otr1[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr2[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($otr2[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr3[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($otr3[$tn],0,'.','').'</td>';
		}
	 print '<td align="center" class="m_separator" rowspan="2">'.number_format($its4,2,'.','').'</td>';
	 print '<td align="center" class="m_separator" rowspan="2">'.number_format($its5,3,'.','').'</td></tr>';

	 print '<tr>';
	 print '<td align="center" class="m_separator">Вода</td>';
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr11[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr11[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr12[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr12[$tn],0,'.','').'</td>';
		}
	 for ($tn=0; $tn<$qnt; $tn++)
		{
		 print '<td align="center" class="m_separator">'.number_format($itr13[$tn],1,'.','').'</td>';
		 print '<td align="center" class="m_separator">'.number_format($itr13[$tn],0,'.','').'</td>';
		}
	 print '</tr>';*/
	}

 print '</table></td>
	<td valign="top"><table>';
 $query = 'SELECT * FROM uprav ORDER BY id';
 $a = mysql_query ($query,$i); $ccr=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{		
	 $nametype[$uy[0]]=$uy[1];
	 if ($count[$uy[0]]>2)
		{
		 if ($_GET["analys"]=='13') 
			{
			 print '<tr><td><img src="charts/barplots17.php?type=2&src=1&'.$req[$ccr].'"><td></tr>'; 
			 print '<tr><td><img src="charts/barplots17.php?type=2&src=2&'.$req2[$ccr].'"><td></tr>'; 
			}
		}
	 $uy = mysql_fetch_row ($a); $ccr++;
	}
 if ($_GET["analys"]=='14') 
	 print '<tr><td><img src="charts/barplots18.php?type=2&cons=5&'.$req[0].'"><td></tr>'; 

 print '</table></td></tr>';
?>
</tbody></table>
</td>
</tr>
</tbody></table>
</td></tr></tbody></table>
</td></tr>

<tr><td>
<table>
</table>
</td></tr>
</tbody></table>
</div>