<div id="main"  style="width:100%; left: 0px;">
<div id="leftcolumn">
	<div id="leftmenu">
	<div id="leftmenu_general_a" style="margin-top: 10px;">
		<div class="m_separator">��������� ��������</div>
		<div class="menuitem first"><a href="index.php?sel=rasphour&type=1" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">����� ���� 5��</a></div>
		<div class="menuitem"><a href="index.php?sel=rasphour&type=5" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">����� ���� 9��</a></div>
		<div class="menuitem"><a href="index.php?sel=rasphour&type=4" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">�����</a></div>
		<div class="menuitem"><a href="index.php?sel=rasphour&type=3" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">����</a></div>
		<div class="menuitem"><a href="index.php?sel=rasphour&type=2" onmouseover="arrowOn(this);" onmouseout="arrowOff(this);">��������</a></div>
	</div>
	</div>
</div>
<div id="maincontent" style="width:820px">

<table border="0" cellpadding="2" cellspacing="0"><tbody><tr><td align="center" colspan=2><h1>�������� ����������� ����� - ������ ����</h1></td></tr></table>
<table border="0" cellpadding="2" cellspacing="2"><tbody>
<tr bgcolor="#476a94"><td align=center><font color="white">��������� ����������� ����� �� ������� �����</td><td align=center><font color="white">��������� ����������� ����� �� ���� ������</td></tr>
<tr><td><img src="charts/xyplot_hourly.php?type=1&types=<?php print $_GET["type"];?>"></td><td><img src="charts/xyplot_hourly.php?type=2&types=<?php print $_GET["type"];?>"></td></tr>
<tr bgcolor="#476a94"><td align=center><font color="white">��������� ����������� ����� �� ������� ����� (��� �������)</td><td align=center><font color="white">��������� ����������� ����� �� ���� ������ (��� �������)</td></tr>
<tr><td><img src="charts/barplot_hourly.php?type=1"></td><td><img src="charts/barplot_hourly.php?type=2"></td></tr>
</tbody></table>
</td></tr>
</tbody></table>
</div>