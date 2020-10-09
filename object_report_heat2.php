<?php
  if ($_POST["month"]==$_POST["month2"] && $_POST["day"]==$_POST["day2"] && $_POST["month"]>1) $_POST["month"]=$_POST["month"]-1;
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2"><font style="size:16px">Сводная таблица</font></td></tr>';
  print '<tr><td align=center class="simple" colspan="2"></td></tr>';
  print '<tr><td align=center class="m_separator" colspan="2">Данных по узлу коммерческого учета тепла по базе теплосчетчика "Тэкон-19"</td></tr>';
  $month=$_POST["month"]; include ("time.inc"); $mon=$month;
  $month=$_POST["month2"]; include ("time.inc"); $mon2=$month;
  print '<tr><td align=center class="m_separator">С '.$_POST["day"].' '.$mon.' '.$_POST["year"].'</td><td align=center class="m_separator">По '.$_POST["day2"].' '.$mon2.' '.$_POST["year2"].'</td></tr>';
  print '<tr><td align=center class="m_separator">Абонент</td><td align=center class="m_separator">'.$name.'</td></tr>';
  print '<tr><td align=center class="m_separator">Адрес</td><td align=center class="m_separator">'.$adr.'</td></tr>';

  print '<tr><td align=left colspan="2">';           
  print '<table width="800px">';
  print '<tr><td class="m_separator" rowspan="2">№ п/п</td>
	 <td class="m_separator" rowspan="2">Дата</td><td class="m_separator" align="center" rowspan="2">Тепловая энергия, Qпотр, ГКал</td>
	     <td class="m_separator" align="center" colspan="1" rowspan="2">Объем теплоносителя, Подача м3, Mпр</td>
	     <td class="m_separator" align="center" colspan="1" rowspan="2">Объем теплоносителя, Обратная м3, Mобр</td>
	     <td class="m_separator" align="center" colspan="1" rowspan="2">Расход теплоносителя, Т/ч, пр</td>
	     <td class="m_separator" align="center" colspan="1" rowspan="2">Расход теплоносителя, Т/ч, обр</td>
	     <td class="m_separator" align="center" colspan="3">Температура</td>
	     <td class="m_separator" align="center" rowspan="2">Часы работы, Tиспр</td></tr>';
  print '<tr><td class="menuitem" align="center">Подающий, t1,C</td><td class="menuitem" align="center">Обратный, t2,C</td>
	 <td class="menuitem" align="center">dt,C</td></tr>';

require_once 'phpexcel/Classes/PHPExcel.php';
require_once 'phpexcel/Classes/PHPExcel/Cell/AdvancedValueBinder.php';
PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );
$objPHPExcel = PHPExcel_IOFactory::load('reports/heat2.xls');

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
$objPHPExcel->getActiveSheet()->setCellValue('D12',iconv ('CP1251','UTF-8',$name));
$objPHPExcel->getActiveSheet()->setCellValue('D13',iconv ('CP1251','UTF-8',$adr));

	 $today=getdate(); 
 	 if ($_GET["year"]=='') $ye=$today["year"];
 	 else $ye=$_GET["year"];
	 if ($_GET["month"]=='') $mn=$today["mon"];
	 else $mn=$_GET["month"];
	 //if ($mn>1) $mn--;
	 $repdata=$mn.$ye;
	 if ($_POST["day"]!='') $stday=$_POST["day"]; else $stday=1;

	 $tm=1; $dy=31; $x=18; $cn=1;
	 if (!checkdate ($mn,31,$ye)) { $dy=30; }
	 if (!checkdate ($mn,30,$ye)) { $dy=29; }
	 if (!checkdate ($mn,29,$ye)) { $dy=28; }
	 for ($tn=$stday; $tn<=$dy; $tn++)
		{		
		 $date1=sprintf ("%d%02d%02d000000",$ye,$mn,$tn);
		 $date2=sprintf ("%d%02d%02d",$ye,$mn,$tn);
		 $dat=sprintf ("%02d-%02d-%d",$tn,$mn,$ye); $dat2=sprintf ("%d-%02d-%02d",$ye,$mn,$tn);

		 $query = 'SELECT * FROM data WHERE type=2 AND device='.$device.' AND date='.$date1;
		 //echo $query;
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);
		 while ($uy)
		      {          
		         if ($uy[8]==18 && $uy[6]==0 && $uy[3]>=0) $data8[$x]=number_format($uy[3],2);
		       	 if ($uy[8]==4 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
		       	 if ($uy[8]==4 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);

		       	 if ($uy[8]==11 && $uy[6]==0) $data2[$x]=$uy[3];
		       	 if ($uy[8]==11 && $uy[6]==1) $data3[$x]=$uy[3];

		       	 if ($uy[8]==12 && $uy[6]==21) $data4[$x]=$uy[3];
		       	 if ($uy[8]==12 && $uy[6]==22) $data5[$x]=$uy[3];

		       	 if ($uy[8]==13 && $uy[6]==23) $data6[$x]=$uy[3];
		       $uy = mysql_fetch_row ($a);	     
		      }
		 if ($data6[$x]=='' && $data6[$x-1]>0) $data6[$x]=$data6[$x-1];
		 if ($data4[$x]=='' && $data4[$x-1]>0) $data4[$x]=$data4[$x-1];
		 if ($data5[$x]=='' && $data5[$x-1]>0) $data5[$x]=$data5[$x-1];

		 print '<tr><td class="m_separator">'.$cn.'</td><td class="m_separator">'.$dat.'</td><td class="simple" align="center">'.$data6[$x].'</td>
			<td class="simple" align="center">'.number_format($data4[$x],2).'</td><td class="simple" align="center">'.number_format($data5[$x],2).'</td>
			<td class="simple" align="center">'.number_format($data2[$x]/24,2).'</td><td class="simple" align="center">'.number_format($data3[$x]/24,2).'</td>
			<td class="simple" align="center">'.$data0[$x].'</td><td class="simple" align="center">'.$data1[$x].'</td>
			<td class="simple" align="center">'.number_format($data0[$x]-$data1[$x],2).'</td>
			<td class="simple" align="center">'.$data8[$x].'</td></tr>';
		 $gpr+=$data2[$x]/24; $gob+=$data3[$x]/24;
		 $tpr+=$data0[$x]; $tob+=$data1[$x];
		 $tisp+=$data8[$x];

		 $objPHPExcel->getActiveSheet()->insertNewRowBefore($x, 1);
		 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$cn);
		 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dat);
               	 $yach='C'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data6[$x]);
		 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data4[$x]);
		 $yach='E'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data5[$x]);
		 $yach='F'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data2[$x]/24,2));
		 $yach='G'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data3[$x]/24,2));
		 $yach='H'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data0[$x]);
		 $yach='I'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data1[$x]);
		 $yach='J'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data0[$x]-$data1[$x],2));
		 $yach='K'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$data8[$x]);
		 $it1+=$data8[$x]; $it2+=$data2[$x]/24; $it3+=$data3[$x]/24; $it4+=$data2[$x]; $it5+=$data3[$x]; $it6+=$data6[$x]; $x++;


		 $dyb=31;
		 if (!checkdate ($mn,31,$ye)) { $dyb=30; }
		 if (!checkdate ($mn,30,$ye)) { $dyb=29; }
		 if (!checkdate ($mn,29,$ye)) { $dyb=28; }
		 if ($tn==$dyb && $mn<$_GET["month2"])
			{
			 $tn=0; $mn++;
			 if ($mn==$_GET["month2"]) $dy=$_GET["day2"]; else $dy=31;
			}			 
		 $cn++;
	       }
	 $objPHPExcel->getActiveSheet()->insertNewRowBefore(21+$x, 1);
	 $itogo='Итого:';	 
	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$itogo));
	 //$objPHPExcel->getActiveSheet()->setBorderStyle(BORDER_MEDIUM);
       	 $yach='C'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($data6[$x-1]-$data6[18],2));
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format(($data4[$x-1]-$data4[18]),2));
	 $yach='E'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format(($data5[$x-1]-$data5[18]),2));
	 $yach='F'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($gpr/$cn,2));
	 $yach='G'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($gob/$cn,2));
	 $yach='H'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($tpr/$cn,2));
	 $yach='I'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($tob/$cn,2));
	 $yach='J'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($tpr/$cn-$tob/$cn,2));
	 $yach='K'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,number_format($tisp,2));

	 $yach1='A'.number_format(21+$x); $yach2='J'.number_format(21+$x); $yach=$yach1.':'.$yach2;
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getTop()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getBottom()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getLeft()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 $objPHPExcel->getActiveSheet()->getStyle($yach)->getBorders()->getRight()->setBorderStyle(PHPExcel_Style_Border::BORDER_MEDIUM);
	 print '<tr><td class="m_separator" colspan="2">Итого</td><td class="m_separator" align="center">'.number_format($data6[$x-1]-$data6[18],2).'</td>
	 	<td class="m_separator" align="center">'.number_format(($data4[$x-1]-$data4[18]),2).'</td><td class="m_separator" align="center">'.number_format(($data5[$x-1]-$data5[18]),2).'</td>
	 	<td class="m_separator" align="center">'.number_format($gpr/$cn,2).'</td><td class="m_separator" align="center">'.number_format($gob/$cn,2).'</td>
	 	<td class="m_separator" align="center">'.number_format($tpr/$cn,2).'</td><td class="m_separator" align="center">'.number_format($tob/$cn,2).'</td>
		<td class="m_separator" align="center">'.number_format($tpr/$cn-$tob/$cn,2).'</td>
		<td class="m_separator" align="center">'.number_format($tisp,2).'</td></tr>';
	 print '</table></td></tr>';
	 print '<tr><td align=center height="10px"></td></tr>';
	 //echo date('H:i:s') . " Write to Excel2007 format\n";
	 $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
	 $objWriter->setOffice2003Compatibility(true);
	 $filename='reports/report_heat2_'.$repdata.'.xlsx';
	 $objWriter->save($filename);
       	 print '<tr><td align=center class="menuitem" colspan=2><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
	 print '</table>';

?>