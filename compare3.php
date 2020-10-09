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
	 $query = 'SELECT nab,square FROM objects WHERE id='.$uy[0];
	 $aw = mysql_query ($query,$i);
	 if ($aw) $uy2 = mysql_fetch_row ($aw);  
	 $sum1=$uy2[0]; $sum2=$uy2[1];

	 $query = 'SELECT * FROM devices WHERE object='.$uy[0];
	 $u = mysql_query ($query,$i);
	 if ($u) $uo = mysql_fetch_row ($u);
	 $sts=sprintf("%d%0d01000000",$today["year"]-1,1);
	 $fns=sprintf("%d%0d01000000",$today["year"]-1,$today["mon"]);
	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal1[$object]=$uw[0];

	 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=2 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
	 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
	 $datal0[$object]=$uw[0]; 

	 $today=getdate(); $cn=0;
	 for ($tm=1; $tm<=12; $tm++) $data2[$object][$tm]=$data1[$object][$tm]=$data0[$object][$tm]=0;
	 for ($pm=1; $pm<$today["mon"]; $pm++)
	    {	 
	     $sts=sprintf("%d%02d01000000",$today["year"],$pm); $fns=sprintf("%d%02d01000000",$today["year"],$pm+1);

		 if ($uy[118])
			{
			 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=13 AND source=2 AND value>0.1 AND device='.$uo[11];
			 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
			 $data1[$object][$cn]=$uw[0]; $cntid1=$uw[1];
			 $datas1[$object]+=$data1[$object][$cn];
			}
		 if ($uy[119])
			{
			 $query = 'SELECT SUM(value),COUNT(id) FROM data WHERE date>='.$sts.' AND date<'.$fns.' AND type=4 AND prm=12 AND source=6 AND value>0.1 AND value<100 AND device='.$uo[11];
			 $w = mysql_query ($query,$i); $uw = mysql_fetch_row ($w); 
			 $data0[$object][$cn]=$uw[0]; $cntid0=$uw[1];
	                 $datas0[$object]+=$data0[$object][$cn];
			}

		 $normteplo[$ccn]=$cntid1*0.0322/30*$sum2;
		 $square[$ccn]=$sum2;
		 $nab[$ccn]=$sum1;
		 $nums[$ccn]=$cntid0;
		 $pnt=strstr ($uy[1],"ул.");
		 $name[$ccn]=substr($uy[1],0,$pnt-1);
 		 $adr[$ccn]=strstr ($uy[1],"ул.");	               
		 $photo[$ccn]=$uy[6];

		 if ($square[$ccn]>0) $udteplo[$ccn][$cn]=$data1[$ccn][$cn]/$square[$ccn]; 
		 if ($nab[$ccn]>0) $udvoda[$ccn][$cn]=$data0[$ccn][$cn]/$nab[$ccn];
		 if ($sum1>0) $normvoda[$ccn]=$ui[1]*5.4/30*$sum1;

	     $cn++;
	    }
	 $ccn++; $object++;
	 $uy = mysql_fetch_row ($a); 
	}

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

	 $desc=substr($name[$tt],0,10);
	 $desc = str_replace("'", "", $desc);
	 $desc = str_replace("\"", "", $desc);  

	 $dat0.='&dt'.$tt.'='.$desc;
	 $req.='name'.$tt.'='.$name[$tt].'&';
	 $req2.='name'.$tt.'='.$name[$tt].'&';
	 $req3.='name'.$tt.'='.$name[$tt].'&';
	 $req4.='name'.$tt.'='.$name[$tt].'&';

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

 print '<tr><td align=center class="m_separator">Отчет по экономии воды по отношению к прошлому году в физических величинах и процентах</td></tr>';
 print '<tr><td align=center valign="top"><table width="1200px"><tr><td><table width="400px" bgcolor="lightgray">';
 print '<tr><td class="m_separator">Название</td><td class="m_separator">Количество</td><td class="m_separator">Общая экономия (куб.м.)</td><td class="m_separator">Общая экономия (%)</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)
 if ($ek0[$cn]!=0)            
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$nab[$cn].'</font></td>';
	 print '<td class="menuitem">'.number_format ($ek0[$cn],3).'</td>';
	 print '<td class="menuitem">'.number_format ($ekpr0[$cn],3).'</td></tr>';
	}
 print '</table></td><td valign="top"><img src="charts/barplots29.php?type=4&'.$req4.'"></td></tr></table></td></tr>';
 print '<tr><td align=center class="m_separator">Отчет по экономии тепловой энергии по отношению к прошлому году в физических величинах и процентах</td></tr>';
 print '<tr><td align=center valign="top"><table width="1200px"><tr><td><table width="400px" bgcolor="lightgray">';
 print '<tr><td class="m_separator">Название</td><td class="m_separator">Площадь здания (кв.м.)</td><td class="m_separator">Общая экономия (ГКал)</td><td class="m_separator">Общая экономия (%)</td></tr>';
 for ($cn=0;$cn<$ccn;$cn++)            
	{
	 print '<tr><td align="center" class="m_separator"><font style="font-weight:bold">'.$name[$cn].'</font></td>';
	 print '<td align="center" class="m_separator"><font style="font-weight:bold">'.$square[$cn].'</font></td>';
	 print '<td class="menuitem">'.number_format ($ek1[$cn],3).'</td>';
	 print '<td class="menuitem">'.number_format ($ekpr1[$cn],3).'</td></tr>';
	}
 print '</table></td><td><img src="charts/barplots29.php?type=3&'.$req3.'"></td></tr></table></td></tr>';                      
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