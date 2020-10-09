<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Ведомость учета тепловой энергии и теплоносителя за '.$prevmonth.'</td></tr>';
  print '<tr><td align=center class="simple" colspan="2"></td></tr>';
  print '<tr><td align=center class="m_separator">Название потребителя</td><td align=center class="menuitem">'.$name.'</td></tr>';
  print '<tr><td align=center class="m_separator">Назначение</td><td align=center class="menuitem">Для передачи поставщику</td></tr>';

  print '<tr><td align=left colspan="2">';
  print '<table width="800px">';
  print '<tr><td class="m_separator">Дата</td><td class="m_separator" align="center">Время работы, час</td>
	     <td class="m_separator" align="center" colspan="2">Температура воды</td>
	     <td class="m_separator" align="center">Разница температур, dT,С</td>
	     <td class="m_separator" align="center" colspan="2">Часовой расход</td>
	     <td class="m_separator" align="center" colspan="2">Количество воды</td>
	     <td class="m_separator" align="center">Количество тепла</td></tr>';
  print '<tr><td class="m_separator"></td><td class="menuitem" align="center"></td>
	 <td class="menuitem" align="center">Подача, t1,C</td><td class="menuitem" align="center">Обратка, t2,C</td>
	 <td class="menuitem" align="center">dt,C</td>
	 <td class="menuitem" align="center">Подача, g1,т/ч</td><td class="menuitem" align="center">Обратка, g2,т/ч</td>
	 <td class="menuitem" align="center">Подача, G1,т</td><td class="menuitem" align="center">Обратка, G2,т</td>
	 <td class="menuitem" align="center">Q,ГКал</td></tr>';

require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/heat.xls');

// Set properties
$objPHPExcel->getProperties()->setCreator("rpksu")
				 ->setLastModifiedBy("Olejek")
				 ->setTitle("Heat report")
				 ->setSubject("Heat report")
				 ->setDescription("Heat report")
				 ->setKeywords("office 2003 openxml php")
				 ->setCategory("Report");
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Heat Report');
// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);
$schet='учёта тепловой энергии и теплоносителя за '.$prevmonth.' г.';
$objPHPExcel->getActiveSheet()->setCellValue('A7',iconv ('CP1251','UTF-8',$schet));
$schet='Название потребителя '.$name.' ';
$objPHPExcel->getActiveSheet()->setCellValue('A9',iconv ('CP1251','UTF-8',$schet));

	 $today=getdate(); 
 	 if ($_GET["year"]=='') $ye=$today["year"];
 	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 //if ($mn>1) $mn--;
	 $repdata=$mn.$ye;

	 $tm=1; $dy=31; $x=18;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }

	 for ($tn=1; $tn<=$dy; $tn++)
		{		
		 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
		 $date2=sprintf ("%d%02d%02d",$ye,$mn,$tn);
		 $dat=sprintf ("%02d-%02d-%d",$tn,$mn,$ye); $dat2=sprintf ("%d-%02d-%02d",$ye,$mn,$tn);

/*		 $query = 'SELECT AVG(value) FROM data WHERE type=1 AND prm=11 AND source=0 AND device='.$device.' AND date LIKE \'%'.$dat2.'%\'';
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a); $g1=$uy[0];
		 $query = 'SELECT AVG(value) FROM data WHERE type=1 AND prm=11 AND source=1 AND device='.$device.' AND date LIKE \'%'.$dat2.'%\'';
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a); $g2=$uy[0]; */

		 $query = 'SELECT * FROM data WHERE type=2 AND device='.$device.' AND date='.$date1;
		 //echo $query;
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);
		 while ($uy)
		      {          
		         if ($uy[8]==18 && $uy[6]==0) $data8[$x]=number_format($uy[3],2);
		       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
		       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);

		       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
		       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=number_format($uy[3],3);
		       	 if ($uy[8]==13 && $uy[6]==2) $data6[$x]=number_format($uy[3],4);
		       $uy = mysql_fetch_row ($a);	     
		      }
		 print '<tr><td class="m_separator">'.$dat.'</td><td class="simple" align="center">'.$data8[$x].'</td>
			<td class="simple" align="center">'.$data0[$x].'</td><td class="simple" align="center">'.$data1[$x].'</td>
			<td class="simple" align="center">'.number_format($data0[$x]-$data1[$x],2).'</td>
			<td class="simple" align="center">'.number_format($data2[$x]/24,2).'</td><td class="simple" align="center">'.number_format($data3[$x]/24,2).'</td>
			<td class="simple" align="center">'.$data2[$x].'</td><td class="simple" align="center">'.$data3[$x].'</td>
			<td class="simple" align="center">'.$data6[$x].'</td></tr>';

		 $objPHPExcel->getActiveSheet()->insertNewRowBefore($x, 1);
		 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dat);
               	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data8[$x]);
		 $yach='C'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data0[$x]);
		 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data1[$x]);
		 $yach='E'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data0[$x]-$data1[$x],2));
		 $yach='F'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data2[$x]/24,2));
		 $yach='G'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data3[$x]/24,2));
		 $yach='H'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data2[$x]);
		 $yach='I'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data3[$x]);
		 $yach='J'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data6[$x]);
		 $it1+=$data8[$x]; $it2+=$data2[$x]/24; $it3+=$data3[$x]/24; $it4+=$data2[$x]; $it5+=$data3[$x]; $it6+=$data6[$x]; $x++;

	       }
	 $objPHPExcel->getActiveSheet()->insertNewRowBefore(21+$x, 1);
	 $itogo='Итого:';	 
	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$itogo));
	 //$objPHPExcel->getActiveSheet()->setBorderStyle(BORDER_MEDIUM);
       	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it1);
	 $yach='C'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,'-');
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,'-');
	 $yach='E'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,'-');
	 $yach='F'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it2);
	 $yach='G'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it3);
	 $yach='H'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it4);
	 $yach='I'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it5);
	 $yach='J'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$it6);
	 $yach1='A'.number_format(21+$x); $yach2='J'.number_format(21+$x); $yach=$yach1.':'.$yach2;
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);


	 print '<tr><td class="m_separator">Итого</td><td class="m_separator" align="center">'.$it1.'</td>
		   <td class="m_separator" align="center">-</td><td class="m_separator" align="center">-</td><td class="m_separator" align="center">-</td>
		   <td class="m_separator" align="center">'.number_format($it2,2).'</td>
		   <td class="m_separator" align="center">'.number_format($it3,2).'</td><td class="m_separator" align="center">'.number_format($it4,2).'</td>
		   <td class="m_separator" align="center">'.number_format($it5,2).'</td><td class="m_separator" align="center">'.number_format($it6,2).'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 //echo date('H:i:s') . " Write to Excel2007 format\n";
	 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	 $objWriter->setOffice2003Compatibility(true);
	 $filename='reports/report_heat_'.$repdata.'.xlsx';
	 $objWriter->save($filename);
       	 print '<tr><td align=center class="menuitem" colspan=2><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
	 print '</table>';

?>