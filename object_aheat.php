<?php
  print '<table border="0" cellpadding="0" cellspacing="0"><tbody>';
  print '<tr><td align="left" class="simple" colspan="2" style="font-size:12px"><strong>Журнал аварийных срабатываний (Тепло) за '.$prevmonth.'</strong></td></tr>';
  print '<tr><td align=left colspan="2">';
  print '<table width="1000px">';
  print '<tr><td class="m_separator">Дата</td><td class="m_separator" align="center">Время</td>
	     <td class="m_separator" align="center">Признак</td>
	     <td class="m_separator" align="center">Примечание</td></tr>';

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
  $query = 'SELECT * FROM data WHERE type=1 AND (prm=11 OR prm=16) AND device='.$device.' AND date>='.$st.' AND date<'.$fn.' ORDER BY date DESC';
//  echo $query;
  $a = mysql_query ($query,$i);
  if ($a) $uy = mysql_fetch_row ($a);
  while ($uy) 
	{ 
	 $x=$qnt;
	 for ($tn=0; $tn<=$qnt; $tn++) 
	 if ($uy[2]==$dat[$tn]) $x=$tn;
	 
       	 if ($uy[8]==11 && $uy[6]==0) $data0[$x]=number_format($uy[3],3);
       	 if ($uy[8]==11 && $uy[6]==1) $data1[$x]=number_format($uy[3],3);
       	 if ($uy[8]==16 && $uy[6]==0) $data2[$x]=number_format($uy[3],3);
       	 $uy = mysql_fetch_row ($a);	     	 
	}

  $priznak1=0; // utechka
  $priznak2=0; // otkluchenie
  $priznak3=0; // otkluchenie 2
  for ($x=0; $x<=$qnt; $x++) 
	{ 
  	 if ($data0[$x]>0 && $data1[$x]>0 && $data0[$x]>$data1[$x]*1.04 && !$priznak1) 
		{ 
		 $priznak1=1;
	 	 $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data0[$x].' AND date='.$date1[$x];
		 $y = mysql_query ($query,$i);
		 if ($y) $uy = mysql_fetch_row ($y);
		 if (!$uy)
			{
			 $query = 'INSERT INTO register	SET device='.$device.',type=12,value='.$data0[$x].',date='.$date1[$x].',descr=\'Перепад объема сетевой воды в обратном трубопроводе по отношению к подающему свыше 4% (утечка)\'';
			 $y = mysql_query ($query,$i);
			}
		}
  	 if ($data2[$x]==0 && !$priznak2) 
		{ 
		 $priznak2=1; 
	 	 $query = 'SELECT * FROM register WHERE device='.$device.' AND value='.$data2[$x].' AND date='.$date1[$x];
		 $y = mysql_query ($query,$i);
		 if ($y) $uy = mysql_fetch_row ($y);
		 if (!$uy)
			{
			 $query = 'INSERT INTO register	SET device='.$device.',type=13,value='.$data2[$x].',date='.$date1[$x].',descr=\'Падение давления на входящем трубопроводе до "0"\'';
			 $y = mysql_query ($query,$i);
			}
		}
        }

 $query = 'SELECT * FROM register WHERE device='.$device.' AND type>10 ORDER BY date DESC';
 $y = mysql_query ($query,$i); $x=5;
 if ($y) $uy = mysql_fetch_row ($y);
 while ($uy)
	{                                           
	 $dt=substr($uy[5],0,10); $tm=substr($uy[5],11,18);

	 print '<tr><td class="m_separator">'.$dt.'</td><td class="menuitem" align="center">'.$tm.'</td>
		<td class="menuitem">'.$uy[3].'</td><td class="menuitem">'.$uy[4].'</td></tr>';

	 $yach='A'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$dt);
    	 $yach='B'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,$tm);
	 $yach='C'.number_format($x); 
		if ($uy[2]==13) $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"обрыв, отключение"));
		else $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',"утечка"));
	 $yach='D'.number_format($x); $objPHPExcel->getActiveSheet()->setCellValue($yach,iconv ('CP1251','UTF-8',$uy[3]));
	 $uy = mysql_fetch_row ($y); $x++;
	}                            
   
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$filename='reports/report_aheat_'.$repdata.'.xlsx';
$objWriter->save($filename);
print '<tr><td align=center class="menuitem" colspan=3><a href="'.$filename.'">Скачать отчет в формате Excel</a></td></tr>';
print '</table>';

  print '</table></td></tr>';
  print '</table>';  
?>