<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Отчет абонента за '.$prevmonth.'</td></tr>';
  print '<tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Для передачи поставщику</td></tr>';
  print '<tr><td align="center" colspan="2"><h1>Отчет абонента за май 2011г.</h1></td></tr>';
  print '<tr><td align="left" class="simple" colspan="2" style="font-size:12px"><strong>Во исполнении договора №        от  2011 г.</strong>
	<br>на отпуск питьевой воды и прием сточных вод п.п. 2.2.2., 4.1.2. и п. 32 (раздел 4), п. 88 (раздел 8) 
	<br>"Правил пользования системами коммунального водоснабжения и канализации в РФ", утвержденных "Постановлением Правительства РФ " № 167 от 12.02.1999 г. 
	<br>Абонент '.$name.' направляет Вам сведения по учету полученной питьевой воды и сброшенных сточных вод.
	</td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px">';
  print '<tr><td class="m_separator">№ п/п</td><td class="m_separator" align="center">Наименование услуги</td>
	     <td class="m_separator" align="center">Адрес объекта</td>
	     <td class="m_separator" align="center">Код присоединения</td>
	     <td class="m_separator" align="center" colspan="2">Показания приборов учета</td>
	     <td class="m_separator" align="center">Расход за месяц, м3</td></tr>';

  $today=getdate(); $startday=1;
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
	 $date1=sprintf ("%d%02d01000000",$ye,$mn,$startday);
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

  print '<tr><td class="m_separator"></td><td class="menuitem" align="center"></td>
	     <td class="menuitem"></td>
	     <td class="menuitem"></td>
	     <td class="menuitem" align="center">Предыдущие на '.$dat2.'</td><td class="menuitem" align="center">Последние на '.$dat1.'</td>
	     <td class="menuitem" align="center"></td></tr>';

  print '<tr><td class="m_separator">1</td><td class="simple" align="center">ХВС</td>
	     <td class="simple">'.$adr.'</td>
	     <td class="simple"></td>';
  if ($data2>0) print '<td class="simple" align="center">'.number_format($data2,2).'</td>';
	else print '<td class="simple" align="center">-</td>';
  if ($data1>0)  print '<td class="simple" align="center">'.number_format($data1,2).'</td>';
	else print '<td class="simple" align="center">-</td>';
  if ($data1>0 && $data2>0) print '<td class="simple" align="center">'.number_format($data1-$data2,2).'</td></tr>';
	else print '<td class="simple" align="center">-</td></tr>';


require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/water.xls');

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
$filename='reports/report_water_'.$repdata.'.xlsx';
$objWriter->save($filename);
print '<tr><td align=center class="menuitem" colspan=2><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
print '</table>';

?>