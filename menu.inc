            <div id="tab1">
                <ul id="mainNavigationLeft" class="left">
                    <li class="navigateStocks" id="listocks"><a href="map.php">�������</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 2px;">
                            <li><a href="map.php">����� ��������</a></li>
                            <li><a href="index.php?sel=table">������� �� ��������</a></li>
                            <li><a href="index.php?sel=table2">������������� �����</a></li>
                            <li><a href="table3.php">������������� (��� ������)</a></li>
                            <li><a href="table4.php">������� �� �������������</a></li>
                        </ul>
                    </li>
                    <li class="navigateFunds" id="lifunds"><a href="index.php?sel=all">�����</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 2px;">
	                   <li><a href="index.php?sel=analys3&analys=3">����� �� �������� ������������� �������</a></li>
                        <li><a href="index.php?sel=analys3">����� � ���������� �� �261</a></li>
                        <li><a href="index.php?sel=analys3&analys=8">����� � ���������� �� �261</a></li>
                        </ul>
                    </li>

		    <?php
		    //if ($_COOKIE["name"]=='chkts' || $_COOKIE["name"]=='admin' || $_COOKIE["name"]=='school')
			if (1)
			{
			 print '<li class="navigateOptions" id="lioptions"><a href="index.php?sel=analys3&analys=10">�����</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 8px;">
	                        <li><a href="index.php?sel=analys6">������� ������� �� �����</a></li>
	                        <li><a href="index.php?sel=analys3&analys=10">������������� ������� ��������� ������������ � ������������ �����������</a></li>
        	                <li><a href="index.php?sel=analys3&analys=13">����� � ����������� �����</a></li>
	                        <li><a href="index.php?sel=analys3&analys=113">����� � ����������� ����� (��� �������)</a></li>
        	                <li><a href="index.php?sel=compare5">������� ����� �� �������� �������� �������</a></li>                           
	                        <li><a href="index.php?sel=compare4&allmu=1&type=3">������������� ������ ��������� ����������� �����</a></li>
        	                <li><a href="index.php?sel=analys4">�������� ����������� ����� �������������</a></li>
	                        <li><a href="index.php?sel=analys3&analys=1">����� �� �������� �������� �������</a></li>
	                        <li><a href="index.php?sel=analys3&analys=6">����� �� �������� �����</a></li>
	                        <li><a href="index.php?sel=analys3&analys=7">����� �� ������� �������������</a></li>
	                        <li><a href="index.php?sel=analys3&analys=9">��������� ��������� ����������� ����� �� ���</a></li>
        	                </ul>
                	    	</li>';
			}
			if (1)
		    //if ($_COOKIE["name"]=='vds' || $_COOKIE["name"]=='admin' || $_COOKIE["name"]=='school')
			{
			 print '<li class="navigateConvertibles" id="liconvertibles"><a href="index.php?sel=analys5&type=4">��������</a>
	                        <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 8px;">
                        	<li><a href="index.php?sel=analys7">����� � ����������� ���� 2</a></li>
        	                <li><a href="index.php?sel=analys5&type=2">������� ����������� ����</a></li>
                	        <li><a href="index.php?sel=analys5&type=4">����������� �� �������</a></li>
                        	<li><a href="index.php?sel=analys3&analys=14">����� � ����������� ����</a></li>
	                        <li><a href="index.php?sel=analys3&analys=4">����� �� �������� �������� ����</a></li>
        	                <li><a href="index.php?sel=analys3&analys=5">����� � ������������������ ������� ����</a></li>
                	        </ul></li>';
			}
		    ?>
                  </ul>
            </div>
            <div id="tab2">
                <ul id="mainNavigationMiddle" class="middle">
                    <li class="navigateProducts" id="Li1"><a href="index.php?sel=all">������</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 6px;">
                            <li><a href="index.php?sel=all">����� �����</a></li>
                            <li><a href="index.php?sel=trends&type=1">�����������</a></li>
                            <li><a href="index.php?sel=trends&type=2">������ �������������</a></li>
                            <li><a href="index.php?sel=trends&type=3">�������� �������</a></li>
                        </ul>
                    </li>
		    <?php
		    if ($_COOKIE["name"]=='admin')
			{
			 print '<li class="navigateMarkets" id="Li11"><a href="index.php?sel=details&name=channels" class="submenu">��������</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 5px;">
				<li><a href="index.php?sel=details&name=var2">���������� ���������</a></li>
				<li><a href="index.php?sel=details&name=channels">������ ���������</a></li>
				<li><a href="index.php?sel=answers">���������� �������</a></li>
				<li><a href="index.php?sel=details&name=protocols">���������</a></li>
				<li><a href="index.php?sel=norm">��������� ����������� �� �������</a></li>

                	        <li><a href="index.php?sel=register">������ ������</a></li>
                        	<li><a href="index.php?sel=input3">���� ������ �����</a></li>
	                        <li><a href="index.php?sel=input4">���� ������ ����</a></li>
        	                <li><a href="index.php?sel=what">�������� ������</a></li>
                	        <li><a href="index.php?sel=what_add">�������� ����� �����������</a></li>
	                        </ul>
		                </li>
        		        <li class="navigateTools" id="Li14"><a href="" class="submenu">������� ���������</a>
	                	<ul style="margin-top: 5px; display: none; position: absolute; margin-left: 7px;">
	                        <li><a href="index.php?sel=compare&type=3">��������� ������� ��������</a></li>
				<li><a href="index.php?sel=compare2&type=3">��������� ��������� �����������</a></li>
	                        <li><a href="index.php?sel=analys2&type=3">������ ���������� ���������� �261-�� � �������� ������ ������������ ��������</a></li>
				<li><a href="index.php?sel=rasphour">������������� ����������� �� �������</a></li>
                	        <li><a href="index.php?sel=compare4&allmu=1&type=3">������������� ������ ��������� ����������� �����</a></li>
                        	<li><a href="index.php?sel=compare4&allmu=1&type=3">������� ����� �� �������� �������� �������</a></li>
	                        <li><a href="index.php?sel=consumption&cons=1">����������� �����</a></li>
        	                </ul>
		                </li>
		                <li class="navigateAbout" id="Li23">
		                <a href="info.php" class="submenu">����������</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: -7px;">
		                <li class="2ndmenu"><a href="index.php?sel=about">� ��</a></li>
		                <li><a href="index.php?sel=partners">��������</a></li>
		                </ul>
		                </li>';
				}
			?>
                </ul>
            </div>
            <div id="tab3">
                <span class="valign"><a href="index.php?sel=object&menu=object_avar">��������������</a></span>
            </div>
            <div id="tab4">
                <span><a href="<?php print $_SERVER['REQUEST_URI']; ?>&print=1"><img border="0" src="files/print.gif"></a></span>
            </div>
