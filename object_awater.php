<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align=center class="m_separator" colspan="2">Отчет абонента за '.$prevmonth.'</td></tr>';
  print '<tr><td align="left" class="simple" colspan="2" style="font-size:12px"><strong>Журнал аварийных срабатываний (Вода) за '.$prevmonth.'</strong></td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px">';
  print '<tr><td class="m_separator">Дата</td><td class="m_separator" align="center">Время</td>
	     <td class="m_separator" align="center">Значение</td>
	     <td class="m_separator" align="center">Примечания</td></tr>';

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

  for ($tn=0; $tn<=800; $tn++)
	{		
	 if ($tm>$dy) break;
	 $date1[$tn]=sprintf ("%d%02d%02d%02d0000",$ye,$mn,$tm,$ts);
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
  $query = 'SELECT * FROM data WHERE type=1 AND (prm=12 OR prm=16) AND device='.$device.' AND date>='.$st.' AND date<'.$fn.' ORDER BY date DESC';
//  echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  while ($uy) 
	{ 
	 $x=$qnt;
	 for ($tn=0; $tn<=$qnt; $tn++) 
	 if ($uy[2]==$dat[$tn]) $x=$tn;
	 
       	 if ($uy[8]==12 && $uy[6]==6) { $data0[$x]=number_format($uy[3],3); $datasr[$x%24]+=$data0[$x]; $cnt[$x%24]++; }
       	 if ($uy[8]==16 && $uy[6]==2) $data2[$x]=number_format($uy[3],3);
       	 $uy = mysql_fetch_row ($a);	     	 
	}
  for ($x=0;$x<24;$x++)
	if ($cnt[$x]) $sredvoda[$x]=$datasr[$x]/$cnt[$x];
  $priznak1=0; // otkluchenie
  $priznak2=0; // utechka
  for ($x=0; $x<=$qnt; $x++) 
	{
	 //echo $data0[$x].' '.$sredvoda[$x%24].' '.$priznak2.'<br>';
  	 if ($data0[$x]>0 && $data0[$x]>1.15*$sredvoda[$x%24] && !$priznak2) 
		{ 
		 $priznak2=1; // echo $dat[$x].' '.$data0[$x].' '.$sredvoda[$x].' utechka<br>';
	 	 $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x].' AND date='.$date1[$x];
		 //echo $query;
		 $y = mysql_query ($query,$i);
		 if ($y) $uy = mysql_fetch_row ($y);
		 if (!$uy)
			{
			 $query = 'INSERT INTO register	SET device='.$device.',type=2,value='.$data0[$x].',date='.$date1[$x].',descr=\'Увеличение расхода в текущий момент времени по отношению к приведенной (средней) величине аналогичных моментов предыдущих периодов свыше 15%\'';
			 //echo $query;
			 $y = mysql_query ($query,$i);
			}
		}
  	 if ($data2[$x]==0 && !$priznak1) 
		{ 
		 $priznak1=1; // echo $dat[$x].' '.$data0[$x].' '.$data2[$x].' otkluchenis<br>';
	 	 $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x].' AND date='.$date1[$x];
		 //echo $query;
		 $y = mysql_query ($query,$i);
		 if ($y) $uy = mysql_fetch_row ($y);
		 if (!$uy)
			{
			 $query = 'INSERT INTO register	SET device='.$device.',type=3,value='.$data0[$x].',date='.$date1[$x].',descr=\'Обрыв, отключение - падение давления на входящем трубопроводе до "0"\'';
			 //echo $query;
			 $y = mysql_query ($query,$i);
			}
		}
        }
 $query = 'SELECT * FROM register WHERE device='.$device.' AND type<10  ORDER BY date DESC';
 $y = mysql_query ($query,$i); $x=5;
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{
	 $dt=substr($uy[5],0,10); $tm=substr($uy[5],11,18);
	 print '<tr><td class="m_separator">'.$dt.'</td><td class="menuitem" align="center">'.$tm.'</td>
		<td class="menuitem">'.$uy[4].'</td><td class="menuitem">'.$uy[3].'</td></tr>';

	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dt);
    	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$tm);
	 $yach='C'.number_format($x); 
		if ($uy[2]==2) $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"обрыв, отключение"));
		else $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"утечка"));
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$uy[3]));
	 $uy = mysql_fetch_row ($y); $x++;
	}                            
   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$filename='reports/report_awater_'.$repdata.'.xlsx';
$objWriter->save($filename);
print '<tr><td align=center class="menuitem" colspan=3><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
print '</table>';

  print '</table></td></tr>';
  print '</table>';  
?>