<?php
print  '<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" colspan=2><h1>���������� ������������� ������������� �������������� ��� ������� '.$name.'</h1></td></tr></table>
	<table border="0" cellpadding="2" cellspacing="2"><tbody>
	<tr><td align=center class="m_separator" colspan="2">��������� ����������� ����� �� ������� �����</td><td align=center class="m_separator">��������� ����������� ����� �� ���� ������</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=1"></td><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=2"></td><td>
	</td></tr>
	<tr><td align=center class="m_separator" colspan="2">��������� ����������� ���� �� ������� �����</td><td align=center class="m_separator">��������� ����������� ���� �� ���� ������</td></tr>
	<tr><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=3"></td><td><img src="charts/barplot_hourly.php?dev='.$device.'&type=4"></td><td>
	</td></tr>
</tbody></table>
</td></tr>
</tbody></table>';
?>