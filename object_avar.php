<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Отчет абонента за '.$prevmonth.'</td></tr>';
  print '<tr><td align="left" class="simple" colspan="2" style="font-size:12px"><strong>Журнал аварийных срабатываний за '.$prevmonth.'</strong></td></tr>';
  print '<tr><td align="center" class="m_separator">Назначение</td><td align=center class="menuitem">Контроль частоты аварийных ситуаций ситуаций на объекте и выявление их причин</td></tr></table>';

  print '<tr><td align=left valign="top">';
  print '<table width="600px" ><tr>';
  print '<td class="m_separator">Объект</td>';
  print '<td class="m_separator">Дата</td><td class="m_separator" align="center">Время срабатывания</td>
	     <td class="m_separator" align="center">Признак</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="menuitem">1</td><td class="menuitem">2</td><td class="menuitem">3</td><td class="menuitem">4</td><td class="menuitem">5</td></tr>';
  print '</table></td><td align=left valign="top">';
  print '<table width="400px">';
  print '<tr><td class="m_separator">Признак</td><td class="m_separator" align="center">Примечание (ВАРИАНТЫ)</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="simple_bold">обрыв, отключение</td><td class="simple" align="center">падение напряжения до "0"</td><td class="simple" align="center">1</td></tr>';
  print '<tr><td class="simple_bold">качество напряжения</td><td class="simple" align="center">падение напряжения ниже 210В</td><td class="simple" align="center">2</td></tr>';
  print '<tr><td class="simple_bold">качество напряжения</td><td class="simple" align="center">скачок напряжения выше 240В</td><td class="simple" align="center">3</td></tr>';
  print '<tr><td class="simple_bold">качество частоты</td><td class="simple" align="center">скачок частоты выше 65Гц</td><td class="simple" align="center">4</td></tr>';
  print '<tr><td class="simple_bold">качество частоты</td><td class="simple" align="center">падение частоты ниже 45Гц</td><td class="simple" align="center">5</td></tr>';
  print '<tr><td class="simple_bold">выход из строя ПУ</td><td class="simple" align="center">выход из строя ПУ</td><td class="simple" align="center">6</td></tr>';

  print '</table></td></tr>';

  print '<tr><td align=left valign="top">';
  print '<table width="600px"><tr>';
  print '<td class="m_separator">Объект</td>';
  print '<td class="m_separator">Дата</td><td class="m_separator" align="center">Время</td>
	     <td class="m_separator" align="center">Признак</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="menuitem">1</td><td class="menuitem">2</td><td class="menuitem">3</td><td class="menuitem">4</td><td class="menuitem">5</td></tr>';

require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/avar_heat.xls');

$objPHPExcel->getProperties()->setCreator("rpksu")
				 ->setLastModifiedBy("Olejek")
				 ->setTitle("Water report")
				 ->setSubject("Water report")
				 ->setDescription("Water report")
				 ->setKeywords("office 2003 openxml php")
				 ->setCategory("Report");
$objPHPExcel->setActiveSheetIndex(0);

  $today=getdate(); 
  if ($_GET["year"]=='') $ye=$today["year"];
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];


  else $mn=$_GET["month"];
  $repdata=$device.'_'.$mn.$ye;
  $mn--;

  $ts=0; $tm=1; $dy=31;
  $st=sprintf ("%d%02d01000000",$ye,$mn);
  $fn=sprintf ("%d%02d01000000",$ye,$mn+1);

  if (!checkdate ($mn,31,$ye)) { $dy=30; }
  if (!checkdate ($mn,30,$ye)) { $dy=29; }
  if (!checkdate ($mn,29,$ye)) { $dy=28; }

  if (!$device) $query = 'SELECT * FROM devices';
  else $query = 'SELECT * FROM devices WHERE device='.$device;
  $y = mysql_query ($query,$i); $cn=0;
  if ($y) $uo = mysql_fetch_row ($y);
  while ($uo)
	{
	 $dev[$cn]=$uo[11];
	 $query = 'SELECT * FROM objects WHERE id='.$uo[8];
	 $e = mysql_query ($query,$i);
	 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
	 $obj[$cn]=$ui2["name"];  $cn++;
	 $uo = mysql_fetch_row ($y);
	}
  $devices=$cn-1;

  for ($tn=0; $tn<=96; $tn++)
	{		
	 if ($tm>$dy) break;
	 $date11[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
	 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$mn,$tm,$ts);
	 for ($cn=0; $cn<=$devices; $cn++)
		 $data0[$tn][$cn]=$data1[$tn][$cn]=$data2[$tn][$cn]='-';
//	 echo $dat[$tn].'<br>';
         if ($ts>=23)
		{
		 $ts=0;	
		 $tm++;
	        }
	 $ts++;
	}
  $qnt=$tn; 
  if ($device) $query = 'SELECT * FROM data WHERE type=1 AND (prm=11 OR prm=16) AND device='.$device.' AND date>='.$st.' AND date<'.$fn.' ORDER BY date DESC';
  else $query = 'SELECT * FROM data WHERE type=1 AND (prm=11 OR prm=16) AND date>='.$st.' AND date<'.$fn.' ORDER BY date DESC';
//  echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  while ($uy) 
	{ 
	 $x=$qnt;
	 for ($tn=0; $tn<=$qnt; $tn++) 
	 if ($uy[2]==$dat[$tn]) $x=$tn;

	 for ($cn=0; $cn<=$devices; $cn++) 
	 if ($uy[4]==$dev[$cn]) $c=$cn;
	 
       	 if ($uy[8]==11 && $uy[6]==0) $data0[$x][$c]=number_format($uy[3],3);
       	 if ($uy[8]==11 && $uy[6]==1) $data1[$x][$c]=number_format($uy[3],3);
       	 if ($uy[8]==16 && $uy[6]==0) $data2[$x][$c]=number_format($uy[3],3);
       	 $uy = mysql_fetch_row ($a);	     	 
	}

  for ($c=0; $c<=$devices; $c++) 
	{
	  $priznak1=0; // utechka
	  $priznak2=0; // otkluchenie
	  $priznak3=0; // otkluchenie 2
	  for ($x=0; $x<=$qnt; $x++) 
		{ 
	  	 if ($data0[$x][$c]>0 && $data1[$x][$c]>0 && $data0[$x][$c]>$data1[$x][$c]*1.04 && !$priznak1) 
			{ 
			 $priznak1=1;
		 	 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x][$c].' AND date='.$date11[$x].' AND kod=3';
			 else $query = 'SELECT * FROM register WHERE value='.$data0[$x][$c].' AND date='.$date11[$x].' AND kod=3 AND device='.$dev[$c];
			 $y = mysql_query ($query,$i);
			 if ($y) $uy = mysql_fetch_row ($y);
			 if (!$uy)
				{
				 if ($device) $query = 'INSERT INTO register SET kod=3 AND device='.$device.',type=12,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'утечка\'';
				 else $query = 'INSERT INTO register	SET device='.$dev[$c].',kod=3,type=12,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'утечка\'';
				 $y = mysql_query ($query,$i);
				}
			}
	  	 if ($data2[$x][$c]==0 && !$priznak2) 
			{ 
			 $priznak2=1; 
	 		 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data2[$x][$c].' AND date='.$date11[$x].' AND kod=2';
	 		 else $query = 'SELECT * FROM register WHERE value='.$data2[$x][$c].' AND date='.$date11[$x].' AND kod=2 AND device='.$dev[$c];
			 $y = mysql_query ($query,$i);
			 if ($y) $uy = mysql_fetch_row ($y);
			 if (!$uy)
				{
				 if ($device) $query = 'INSERT INTO register SET kod=2 AND device='.$device.',type=13,value='.$data2[$x][$c].',date='.$date11[$x].',descr=\'обрыв, отключение\'';
				 else $query = 'INSERT INTO register SET device='.$dev[$c].',kod=2,type=13,value='.$data2[$x][$c].',date='.$date11[$x].',descr=\'обрыв, отключение\'';
				 $y = mysql_query ($query,$i);
				}
			}
	        }      	
	}

 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND type>10 ORDER BY date DESC';
 else $query = 'SELECT * FROM register WHERE type>10 ORDER BY date DESC';
 $y = mysql_query ($query,$i); $x=5;
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{                                           
	 $query = 'SELECT * FROM devices WHERE device='.$uy[1];
	 $y2 = mysql_query ($query,$i); $cn=0;
	 if ($y2) $uo = mysql_fetch_row ($y2);
	 while ($uo)
		{
		 $dev[$cn]=$uo[11];
		 $query = 'SELECT * FROM objects WHERE id='.$uo[8];
		 $e = mysql_query ($query,$i);
		 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
		 $naam=$ui2["name"]; 
		 $uo = mysql_fetch_row ($y2);
		}
	 $dt=substr($uy[5],0,10); $tm=substr($uy[5],11,18);

	 print '<tr><td class="m_separator">'.$naam.'</td><td class="m_separator">'.$dt.'</td><td class="menuitem" align="center">'.$tm.'</td>
		<td class="menuitem">'.$uy[3].'</td><td class="menuitem">'.$uy[6].'</td></tr>';

	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dt);
    	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$tm);
	 $yach='C'.number_format($x); 
		if ($uy[2]==13) $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"обрыв, отключение"));
		else $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"утечка"));
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$uy[6]));
	 $uy = mysql_fetch_row ($y); $x++;
	}                            
   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$filename='reports/report_aheat_'.$repdata.'.xlsx';
$objWriter->save($filename);
  print '</table></td><td align=left valign="top">';
  print '<table width="400px">';
  print '<tr><td class="m_separator">Признак</td><td class="m_separator" align="center">Примечание (ВАРИАНТЫ)</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="simple_bold">выход из строя ПУ</td><td class="simple" align="center">выход из строя ПУ</td><td class="simple" align="center">1</td></tr>';
  print '<tr><td class="simple_bold">обрыв, отключение</td><td class="simple" align="center">падение давления на входящем трубопроводе до "0"</td><td class="simple" align="center">2</td></tr>';
  print '<tr><td class="simple_bold">утечка</td><td class="simple" align="center">перепад объема сетевой воды в обратном трубопроводе по отношению к подающему свыше 4% (утечка)</td><td class="simple" align="center">3</td></tr>';
  print '</table></td></tr>';

  print '<tr><td align=center class="menuitem" colspan=3><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';

  print '<tr><td align=left valign="top">';
  print '<table width="600px"><tr>';
  print '<td class="m_separator">Объект</td>';
  print '<td class="m_separator">Дата</td><td class="m_separator" align="center">Время</td>
	     <td class="m_separator" align="center">Признак</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="menuitem">1</td><td class="menuitem">2</td><td class="menuitem">3</td><td class="menuitem">4</td><td class="menuitem">5</td></tr>';

require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/avar_water.xls');
// Set properties
$objPHPExcel->getProperties()->setCreator("rpksu")
				 ->setLastModifiedBy("Olejek")
				 ->setTitle("Water report")
				 ->setSubject("Water report")
				 ->setDescription("Water report")
				 ->setKeywords("office 2003 openxml php")
				 ->setCategory("Report");
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

  $today=getdate(); 
  if ($_GET["year"]=='') $ye=$today["year"];
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];
  $repdata=$device.'_'.$mn.$ye;
  $mn--;

  $ts=0; $tm=1; $dy=31;
  $st=sprintf ("%d%02d01000000",$ye,$mn);
  $fn=sprintf ("%d%02d01000000",$ye,$mn+1);

  if (!checkdate ($mn,31,$ye)) { $dy=30; }
  if (!checkdate ($mn,30,$ye)) { $dy=29; }
  if (!checkdate ($mn,29,$ye)) { $dy=28; }

  for ($tn=0; $tn<=96; $tn++)
	{		
	 if ($tm>$dy) break;
	 $date11[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
	 $dat[$tn]=sprintf ("%d-%02d-%02d %02d:00:00",$ye,$mn,$tm,$ts);
	 $data0[$tn]=$data1[$tn]=$data2[$tn]='-';
//	 echo $dat[$tn].'<br>';
         if ($ts>=23)
		{
		 $ts=0;	
		 $tm++;
	        }
	 $ts++;
	}
  $qnt=$tn; 
  if ($device) $query = 'SELECT * FROM data WHERE type=1 AND (prm=12 OR prm=16) AND device='.$device.' AND date>='.$st.' AND date<'.$fn.' ORDER BY date DESC';
  $query = 'SELECT * FROM data WHERE type=1 AND (prm=12 OR prm=16) AND date>='.$st.' AND date<'.$fn.' AND device='.$dev[$c].' ORDER BY date DESC';
//  echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  while ($uy) 
	{ 
	 $x=$qnt;
	 for ($tn=0; $tn<=$qnt; $tn++) 
	 if ($uy[2]==$dat[$tn]) $x=$tn;

	 for ($cn=0; $cn<=$devices; $cn++) 
	 if ($uy[4]==$dev[$cn]) $c=$cn;
	 
       	 if ($uy[8]==12 && $uy[6]==6) { $data0[$x][$c]=number_format($uy[3],3); $datasr[$x%24][$c]+=$data0[$x][$c]; $cnt[$x%24][$c]++; }
       	 if ($uy[8]==16 && $uy[6]==2) $data2[$x][$c]=number_format($uy[3],3);
       	 $uy = mysql_fetch_row ($a);	     	 
	}
  for ($c=0; $c<=$devices; $c++) 
  for ($x=0;$x<96;$x++)
	if ($cnt[$x][$c]) $sredvoda[$x][$c]=$datasr[$x][$c]/$cnt[$x][$c];

  for ($c=0; $c<=$devices; $c++)                         
	{
	 $priznak1=0; // otkluchenie
	 $priznak2=0; // utechka
	 for ($x=0; $x<=$qnt; $x++) 
		{
		 //echo $data0[$x].' '.$sredvoda[$x%24].' '.$priznak2.'<br>';
	  	 if ($data0[$x][$c]>0 && $data0[$x][$c]>1.15*$sredvoda[$x%24][$c] && !$priznak2) 
			{ 
			 $priznak2=1; // echo $dat[$x].' '.$data0[$x].' '.$sredvoda[$x].' utechka<br>';
		 	 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x].' AND date='.$date11[$x].' AND kod=2';
		 	 else $query = 'SELECT * FROM register WHERE value='.$data0[$x].' AND date='.$date11[$x].' AND kod=2 AND device='.$dev[$c];
			 //echo $query;
			 $y = mysql_query ($query,$i);
			 if ($y) $uy = mysql_fetch_row ($y);
			 if (!$uy)
				{
				 if ($device) $query = 'INSERT INTO register SET kod=2 AND device='.$device.',type=2,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'утечка\'';
				 else $query = 'INSERT INTO register SET device='.$dev[$c].',kod=2,type=2,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'утечка\'';
				 //echo $query;
				 $y = mysql_query ($query,$i);
				}
			}
	  	 if ($data2[$x][$c]==0 && !$priznak1) 
			{ 
			 $priznak1=1; // echo $dat[$x].' '.$data0[$x].' '.$data2[$x].' otkluchenis<br>';
		 	 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x][$c].' AND date='.$date11[$x].' AND kod=3';
	 		 else $query = 'SELECT * FROM register WHERE value='.$data0[$x][$c].' AND date='.$date11[$x].' AND kod=3';
			 //echo $query.'<br>';
			 $y = mysql_query ($query,$i);
			 if ($y) $uy = mysql_fetch_row ($y);
			 if (!$uy)
				{
				 if ($device) $query = 'INSERT INTO register SET kod=3 AND device='.$device.',type=3,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'обрыв, отключение\'';
				 else $query = 'INSERT INTO register SET device='.$dev[$c].',kod=3,type=3,value='.$data0[$x][$c].',date='.$date11[$x].',descr=\'обрыв, отключение\'';
				 // echo $query.'<br>';
				 $y = mysql_query ($query,$i);
				}
			}
	        }
	}
 if ($device) $query = 'SELECT * FROM register WHERE device='.$device.' AND type<10  ORDER BY date DESC';
 else $query = 'SELECT * FROM register WHERE type<10  ORDER BY date DESC';
 $y = mysql_query ($query,$i); $x=5;
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{
	 $query = 'SELECT * FROM devices WHERE device='.$uy[1];
	 $y2 = mysql_query ($query,$i); $cn=0;
	 if ($y2) $uo = mysql_fetch_row ($y2);
	 while ($uo)
		{
		 $dev[$cn]=$uo[11];
		 $query = 'SELECT * FROM objects WHERE id='.$uo[8];
		 $e = mysql_query ($query,$i);
		 if ($e) $ui2 = mysql_fetch_array ($e, MYSQL_ASSOC);
		 $naam=$ui2["name"]; 
		 $uo = mysql_fetch_row ($y2);
		}

	 $dt=substr($uy[5],0,10); $tm=substr($uy[5],11,18);
	 print '<tr><td class="m_separator">'.$naam.'</td><td class="m_separator">'.$dt.'</td><td class="menuitem" align="center">'.$tm.'</td>
		<td class="menuitem">'.$uy[3].'</td><td class="menuitem">'.$uy[6].'</td></tr>';

	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dt);
    	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$tm);
	 $yach='C'.number_format($x); 
		if ($uy[2]==2) $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"обрыв, отключение"));
		else $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"утечка"));
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$uy[6]));
	 $uy = mysql_fetch_row ($y); $x++;
	}                            
   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$filename='reports/report_awater_'.$repdata.'.xlsx';
$objWriter->save($filename);
  print '</table></td><td align=left valign="top">';
  print '<table width="400px">';
  print '<tr><td class="m_separator">Признак</td><td class="m_separator" align="center">Примечание (ВАРИАНТЫ)</td>
	     <td class="m_separator" align="center">Код</td></tr>';
  print '<tr><td class="simple_bold">выход из строя ПУ</td><td class="simple" align="center">выход из строя ПУ</td><td class="simple" align="center">1</td></tr>';
  print '<tr><td class="simple_bold">обрыв, отключение</td><td class="simple" align="center">падение давления на входящем трубопроводе до "0"</td><td class="simple" align="center">2</td></tr>';
  print '<tr><td class="simple_bold">утечка</td><td class="simple" align="center">увеличение расхода в текущий момент времени по отношению к приведенной (средней) величине аналогичных моментов предыдущих периодов свыше 15%</td><td class="simple" align="center">3</td></tr>';
  print '</table></td></tr>';

print '<tr><td align=center class="menuitem" colspan=3><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
print '</table>';

  print '</table></td></tr>';

  print '</table>';  
?>