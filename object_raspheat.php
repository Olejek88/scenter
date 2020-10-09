<?php
print  '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" colspan=2><h1>Мониторинг рационального использования энергоресурсов для объекта '.$name.'</h1></td></tr></table>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>
	<tr><td align=center class="m_separator">Сравнительный анализ средних значений потребления тепловой энергии по дням недели за '.$prevmonth.' года (Гкал)</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=1"></td></tr>
	<tr><td></td></tr>
	<tr><td align=center class="m_separator">Анализ средних значений потребления тепловой энергии по часам за '.$prevmonth.' года (Гкал)</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=2"></td></tr>
	<tr><td></td></tr>
</tbody></table>
</td></tr>
</tbody></table>';
?>