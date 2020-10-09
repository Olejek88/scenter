<div id="main"  style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">Сравнение объектов</div>
		<?php
		 $query = 'SELECT * FROM uprav';
		 $a = mysql_query ($query,$i);
		 if ($a) $uy = mysql_fetch_row ($a);  
		 while ($uy)
			{		
			 print '<div class="menuitem first"><a href="index.php?sel=compare2&type='.$uy[0].'" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">'.$uy[1].'</a></div>';
			 $uy = mysql_fetch_row ($a);
			}
		?>
	</div>
	</div>
</div>
<div id="maincontent" style="width:820px">
<?php
 print '<table border="0" cellpadding="2" cellspacing="2"><tbody>';
 $query = 'SELECT * FROM objects WHERE type='.$_GET["type"];
 $a = mysql_query ($query,$i); $ccn=0; $object=0;
 if ($a) $uy = mysql_fetch_row ($a);  
 while ($uy)
	{
	 $uteplo[$object]=$uy[117]; $uvoda[$object]=$uy[118];
	 $query = 'SELECT nab,square FROM objects WHERE id='.$uy[0];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $sum1=$uy2[0]; $sum2=$uy2[1];

	 $query = 'SELECT * FROM uprav WHERE id='.$uy[2];
	 $a2 = mysql_query ($query,$i);
	 if ($a2) $uy2 = mysql_fetch_row ($a2);
	 $uprav[$object]=$uy2[1]; 

	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $sts=sprintf("%d0101000000",$today["year"]-1);
	 $fns=sprintf("%d1301000000",$today["year"]-1);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal0[$object]=$uw[0]; 

	 $today=getdate(); $cn=0;
	 for ($tm=1; $tm<=12; $tm++) $data2[$object][$tm]=$data1[$object][$tm]=$data0[$object][$tm]=0;
	 for ($pm=1; $pm<=12; $pm++)
	    {	 
	     $sts=sprintf("%d%02d01000000",$today["year"],$pm); $fns=sprintf("%d%02d01000000",$today["year"],$pm+1);

		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data1[$object][$cn]=$uw[0]; $cntid1=$uw[1];
		 $datas1[$object]+=$data1[$object][$cn];

		 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
		 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
		 $data0[$object][$cn]=$uw[0]; $cntid0=$uw[1];
                 $datas0[$object]+=$data0[$object][$cn];

		 $normteplo[$ccn]=$cntid1*0.0322/30*$sum2;
		 $square[$ccn]=$sum2;
		 $nab[$ccn]=$sum1;
		 $nums[$ccn]=$cntid0;
		 $pnt=strstr ($uy[1],"ул.");
		 $name[$ccn]=$uy[1];
 		 $adr[$ccn]=$uy[3];	               
		 $photo[$ccn]=$uy[6];

		 if ($square[$ccn]>0) $udteplo[$ccn][$cn]=$data1[$ccn][$cn]/$square[$ccn]; 
		 if ($nab[$ccn]>0) $udvoda[$ccn][$cn]=$data0[$ccn][$cn]/$nab[$ccn];
		 if ($sum1>0) $normvoda[$ccn]=$ui[1]*5.4/30*$sum1;
		 $udv[$ccn]+=$udvoda[$ccn][$cn];
		 $udt[$ccn]+=$udteplo[$ccn][$cn];
	     $cn++;
	    }
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}
 $req7='mon=позапрошлый месяц&';
 $req8='mon=прошлый месяц&';
 $req9='mon=этот месяц&';
 
 for ($tt=0; $tt<$ccn; $tt++)
	{
	 if ($nab[$tt]) $datad0[$tt]=$datas0[$tt]/$nab[$tt]; else $datad0[$tt]=0;
	 $datas0[$tt]=$datad0[$tt];
	 if ($square[$tt]) $datad1[$tt]=$datas1[$tt]/$square[$tt]; else $datad1[$tt]=0;
	 $datas1[$tt]=$datad1[$tt];

	 $nab2[$tt]=$square3[$tt]=0;
	 $ek1[$tt]=-$datas1[$tt]+$datal1[$tt];
	 $ek0[$tt]=-$datas0[$tt]+$datal0[$tt];
	 if ($datal1[$tt]) $ekpr1[$tt]=($datal1[$tt]-$datas1[$tt])*100/$datal1[$tt];;
	 if ($datal0[$tt]) $ekpr0[$tt]=($datal0[$tt]-$datas0[$tt])*100/$datal0[$tt];;

	 $desc=substr($name[$tt],0,25);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 $dat0.='&dt'.$tt.'='.$desc;
	 $req.='name'.$tt.'='.$desc.'&';
	 $req2.='name'.$tt.'='.$desc.'&';
	 $req3.='name'.$tt.'='.$desc.'&';
	 $req4.='name'.$tt.'='.$desc.'&';

	 $req7.='name'.$tt.'='.$desc.'&';
	 $req8.='name'.$tt.'='.$desc.'&';
	 $req9.='name'.$tt.'='.$desc.'&';
	 $req7.='da'.$tt.'='.$datad0[$tt].'&';
	 $req8.='da'.$tt.'='.$data0[$tt][4].'&';
	 $req9.='da'.$tt.'='.$data0[$tt][5].'&';

	 $req17.='name'.$tt.'='.$desc.'&';
	 $req18.='name'.$tt.'='.$desc.'&';
	 $req19.='name'.$tt.'='.$desc.'&';
	 $req17.='da'.$tt.'='.$datad1[$tt].'&';
	 $req18.='da'.$tt.'='.$data1[$tt][4].'&';
	 $req19.='da'.$tt.'='.$data1[$tt][5].'&';
	 
	 $req.='da'.$tt.'='.$datad0[$tt].'&';
	 $req2.='da'.$tt.'='.$datad1[$tt].'&';
	 $req3.='da'.$tt.'='.$ek1[$tt].'&';
	 $req4.='da'.$tt.'='.$ek0[$tt].'&';
	}

sort($datad0);
reset($datad0);
 for ($tt=0; $tt<$ccn; $tt++)
 for ($rr=0; $rr<$ccn; $rr++)
 if ($datas0[$rr]==$datad0[$tt] && !$nab2[$tt]) 
	{ 
	 $name2[$tt]=$name[$rr];	 
	 $nab2[$tt]=$nab[$rr];
	 $datas2[$tt]=$datas0[$rr];	 
	}

sort($datad1);
reset($datad1);
 for ($tt=0; $tt<$ccn; $tt++)
 for ($rr=0; $rr<$ccn; $rr++)
// if ($datas1[$rr]==$datad1[$tt] && !$square3[$tt]) 
 if ($datas1[$rr]==$datad1[$tt]) 
	{ 
	 $name3[$tt]=$name[$rr];	 
	 $square3[$tt]=$square[$rr];
	 $datas3[$tt]=$datas1[$rr];	 
	}

 print '<tr><td align=center class="m_separator">Сравнение удельного потребления воды в 2011 году (куб.м. на ребенка)</td></tr>';
 print '<tr><td><table width="100%" bgcolor="lightgray">';
 print '<tr><td class="m_separator">№ п/п</td><td class="m_separator">Наименование главного распорядителя бюджетных средств</td>
		<td class="m_separator">Наименование подведомственного бюджетного учреждения</td><td class="m_separator">Адрес учреждения</td><td class="m_separator">Январь</td><td class="m_separator">Февраль</td><td class="m_separator">Март</td><td class="m_separator">Апрель</td><td class="m_separator">Май</td><td class="m_separator">Июнь</td><td class="m_separator">Июль</td><td class="m_separator">Август</td><td class="m_separator">Сентябрь</td><td class="m_separator">Октябрь</td><td class="m_separator">Ноябрь</td><td class="m_separator">Декабрь</td><td class="m_separator">Итого за год</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)            
 if ($uvoda[$cn])
	{
	 $sums=0;
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($cn+1,0).'</font></td>
		<td align="center" class="m_separator"><font style="font-weight:bold">'.$uprav[$cn].'</font></td>
		<td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$adr[$cn].'</font></td>';
	 for ($pm=1; $pm<=12; $pm++)
	    	{
		 if ($udvoda[$cn][$pm]>0) print '<td class="menuitem">'.number_format ($udvoda[$cn][$pm],3).'</td>';
	         else print '<td class="menuitem" align="center">-</td>';
		 $total[$pm]+=$udvoda[$cn][$pm];
		 $sums+=$udvoda[$cn][$pm];
		}
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($sums,2).'</font></td>';	 
	 print '</tr>';
	}
 print '</table></td></tr>';
 print '<tr><td align=center height="5px"></td></tr>';
 print '<tr><td align=center class="m_separator">Итоговый рейтинг удельных расхода воды в год по увеличению расхода</td></tr>';
 print '<tr><td align=center valign="top"><table width="100%"><tr><td valign="top"><table bgcolor="lightgray">';
 print '<tr><td class="m_separator">Название</td><td class="m_separator">Количество</td><td class="m_separator">2012 (куб.м.)</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)
 if ($datas2[$cn]>0)
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$name2[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$nab2[$cn].'</font></td>';
	 print '<td class="menuitem">'.number_format ($datas2[$cn],3).'</td></tr>';
	}
 print '</table></td><td valign=top><img src="charts/barplots29.php?type=2&'.$req7.'"></td><td valign=top><img src="charts/barplots29.php?type=2&'.$req8.'"></td><td valign=top><img src="charts/barplots29.php?type=2&'.$req9.'"></td></tr></table></td></tr>';

 print '<tr><td align=center class="m_separator">Сравнение удельного потребления тепла в 2011 году (ГКал на 1 кв.м.)</td></tr>';
 print '<tr><td align=center height="5px"></td></tr>';
 print '<tr><td><table width="100%" bgcolor="lightgray">';
 print '<tr><td class="m_separator">№ п/п</td><td class="m_separator">Наименование главного распорядителя бюджетных средств</td>
		<td class="m_separator">Наименование подведомственного бюджетного учреждения</td><td class="m_separator">Адрес учреждения</td><td class="m_separator">Январь</td><td class="m_separator">Февраль</td><td class="m_separator">Март</td><td class="m_separator">Апрель</td><td class="m_separator">Май</td><td class="m_separator">Июнь</td><td class="m_separator">Июль</td><td class="m_separator">Август</td><td class="m_separator">Сентябрь</td><td class="m_separator">Октябрь</td><td class="m_separator">Ноябрь</td><td class="m_separator">Декабрь</td><td class="m_separator">Итого за год</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)            
 if ($uteplo[$cn])
	{
	 $sums=0;
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($cn+1,0).'</font></td>
		<td align="center" class="m_separator"><font style="font-weight:bold">'.$uprav[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$adr[$cn].'</font></td>';
	 for ($pm=1; $pm<=12; $pm++)
	    	{
		 if ($udteplo[$cn][$pm]) print '<td class="menuitem" align="center">'.number_format ($udteplo[$cn][$pm],4).'</td>';
		 else print '<td class="menuitem">0</td>';
		 $total[$pm]+=$udteplo[$cn][$pm];
		 $sums+=$udteplo[$cn][$pm];
		}
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.number_format($sums,2).'</font></td>';	 
	 print '</tr>';
	}
 print '</table></td></tr>';
 print '<tr><td align=center class="m_separator">Итоговый рейтинг удельных расхода тепловой энергии в год на 1 кв.м. по увеличению расхода</td></tr>';
 print '<tr><td align=center valign="top"><table width="100%"><tr><td valign="top"><table bgcolor="lightgray">';
 print '<tr><td class="m_separator">Название</td><td class="m_separator">Площадь здания (кв.м.)</td><td class="m_separator">2012 (ГКал)</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)            
 if ($datas3[$cn]>0)
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$name3[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$square3[$cn].'</font></td>';
	 print '<td class="menuitem">'.number_format ($datas3[$cn],3).'</td></tr>';
	}
 print '</table></td><td><img src="charts/barplots29.php?type=1&'.$req17.'"></td><td><img src="charts/barplots29.php?type=1&'.$req18.'"></td><td><img src="charts/barplots29.php?type=1&'.$req19.'"></td></tr></table></td></tr>';
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