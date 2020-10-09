<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Акт приема-передачи электроэнергии</td></tr>';
  print '<tr><td align="left" class="simple" colspan="2" style="font-size:12px">Настоящий акт составлен о том, что за '.$prevmonth.' передано из сетей ОАО "Челябэнерго" следующее количество электроэнергии</td></tr>';
  print '<tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Для передачи поставщику</td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px">';
  print '<tr><td class="m_separator" colspan="3">Точка поставки эл/эн потребителю</td>
	     <td class="m_separator" align="center" rowspan="2">Код точки учета</td>
	     <td class="m_separator" align="center" rowspan="2">Объект эл.снабжения, адрес</td>
	     <td class="m_separator" align="center" rowspan="2">№, тип счетчика</td>
	     <td class="m_separator" align="center" rowspan="2">Показания на текущий месяц</td>
	     <td class="m_separator" align="center" rowspan="2">Показания на прошлый месяц</td>
	     <td class="m_separator" align="center" rowspan="2">Разность показаний</td>
	     <td class="m_separator" align="center" rowspan="2">Расчет. коэф.</td>
	     <td class="m_separator" align="center" rowspan="2">Потери, %</td>
	     <td class="m_separator" align="center" rowspan="2">Потери, кВт*ч</td>
	     <td class="m_separator" align="center" rowspan="2">Итого, кВт*ч</td></tr>
	 <tr><td class="m_separator">ТП</td><td class="m_separator">Скц.</td><td class="m_separator">Яч.</td></tr>
	 <tr align="center"><td class="m_separator">1</td><td class="m_separator">2</td><td class="m_separator">3</td>
	 <td class="m_separator">4</td><td class="m_separator">5</td><td class="m_separator">6</td>
	 <td class="m_separator">7</td><td class="m_separator">8</td><td class="m_separator">9</td>
	 <td class="m_separator">10</td><td class="m_separator">11</td>
	 <td class="m_separator">12</td><td class="m_separator">13</td></tr>';

  $today=getdate(); 
  if ($_GET["year"]=='') $ye=$today["year"];
  else $ye=$_GET["year"];
  if ($_GET["month"]=='') $mn=$today["mon"];
  else $mn=$_GET["month"];
  $adr=strstr ($name,"ул.");
  $repdata=$mn.$ye;
  if ($startday==1)
	{
	 $date1=sprintf ("%d%02d%02d000000",$ye,$mn+1,$startday);
	 $date2=sprintf ("%d%02d%02d000000",$ye,$mn,$startday);
	}
  else 	
 	{
	 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$startday);
	 $date2=sprintf ("%d%02d%02d000000",$ye,$mn-1,$startday);
	}
  echo $date2.' - '.$date1.'<br>';

  $data1=$data2=$dat1=$dat2='-';
  $query = 'SELECT * FROM data WHERE type=2 AND prm=12 AND source=26 AND device='.$device.' AND date<='.$date1.' ORDER BY date DESC';
  //echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  if ($uy) { $data1=$uy[3]; $dat1=substr($uy[2],0,10); }
  $query = 'SELECT * FROM data WHERE type=2 AND prm=12 AND source=26 AND device='.$device.' AND date>='.$date2.' ORDER BY date';
  //echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  if ($uy) { $data2=$uy[3]; $dat2=substr($uy[2],0,10); }

  print '<tr><td class="m_separator"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem"></td>
	     <td class="menuitem"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td>
	     <td class="menuitem" align="center"></td><td class="menuitem" align="center"></td></tr>';


require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/electr.xls');

// Set properties
$objPHPExcel->getProperties()->setCreator("rpksu")
				 ->setLastModifiedBy("Olejek")
				 ->setTitle("Water report")
				 ->setSubject("Water report")
				 ->setDescription("Water report")
				 ->setKeywords("office 2003 openxml php")
				 ->setCategory("Report");
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
//$objPHPExcel->getActiveSheet()->setTitle('Heat Report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
//$objPHPExcel->getActiveSheet()->setCellValue('D11',$name);
$objPHPExcel->getActiveSheet()->setCellValue('D11',iconv ('CP1251','UTF-8',$name));
//$objPHPExcel->getActiveSheet()->setCellValue('D13',$name);
$itogo='Отчет абонента за '.$prevmonth;	 
$yach='A6'; $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$itogo));

  $yach='C18';// $objPHPExcel->getActiveSheet()->setCellValue($yach,$name);
  $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$adr));

  $yach='E18'; $objPHPExcel->getActiveSheet()->setCellValue($yach,$data2);
  $yach='F18'; $objPHPExcel->getActiveSheet()->setCellValue($yach,$data1);
  $yach='G18'; $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data1-$data2,2));
   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
//$objWriter->setOffice2003Compatibility(true);
$filename='reports/report_electr_'.$repdata.'.xlsx';
$objWriter->save($filename);
print '<tr><td align=center class="menuitem" colspan=5><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
print '</table>';
print '<table><tr><td align=center class="menuitem" width="500px">Энергоснабжающая организация</td><td align=center class="menuitem" width="500px">Потребитель</td></tr></table>';
?>