            <div id="tab1">
                <ul id="mainNavigationLeft" class="left">
                    <li class="navigateStocks" id="listocks"><a href="map.php">Объекты</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 2px;">
                            <li><a href="map.php">Карта объектов</a></li>
                            <li><a href="index.php?sel=table">Сводная по объектам</a></li>
                            <li><a href="index.php?sel=table2">Накопительные итоги</a></li>
                            <li><a href="table3.php">Накопительные (для печати)</a></li>
                            <li><a href="table4.php">Сводная по электричеству</a></li>
                        </ul>
                    </li>
                    <li class="navigateFunds" id="lifunds"><a href="index.php?sel=all">Общие</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 2px;">
	                   <li><a href="index.php?sel=analys3&analys=3">Отчет об экономии электрической энергии</a></li>
                        <li><a href="index.php?sel=analys3">Отчет о выполнении ФЗ №261</a></li>
                        <li><a href="index.php?sel=analys3&analys=8">Отчет о выполнении ФЗ №261</a></li>
                        </ul>
                    </li>

		    <?php
		    //if ($_COOKIE["name"]=='chkts' || $_COOKIE["name"]=='admin' || $_COOKIE["name"]=='school')
			if (1)
			{
			 print '<li class="navigateOptions" id="lioptions"><a href="index.php?sel=analys3&analys=10">Тепло</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 8px;">
	                        <li><a href="index.php?sel=analys6">Сводная таблица по теплу</a></li>
	                        <li><a href="index.php?sel=analys3&analys=10">Сравнительная таблица сравнения нормативного и фактического потребления</a></li>
        	                <li><a href="index.php?sel=analys3&analys=13">Отчет о потреблении тепла</a></li>
	                        <li><a href="index.php?sel=analys3&analys=113">Отчет о потреблении тепла (все объекты)</a></li>
        	                <li><a href="index.php?sel=compare5">Сводный отчет об экономии тепловой энергии</a></li>                           
	                        <li><a href="index.php?sel=compare4&allmu=1&type=3">Сравнительный анализ удельного потребления тепла</a></li>
        	                <li><a href="index.php?sel=analys4">Удельное потребление тепла организациями</a></li>
	                        <li><a href="index.php?sel=analys3&analys=1">Отчет об экономии тепловой энергии</a></li>
	                        <li><a href="index.php?sel=analys3&analys=6">Отчет об экономии тепла</a></li>
	                        <li><a href="index.php?sel=analys3&analys=7">Отчет об утечках теплоносителя</a></li>
	                        <li><a href="index.php?sel=analys3&analys=9">Сравнение удельного потребления тепла за год</a></li>
        	                </ul>
                	    	</li>';
			}
			if (1)
		    //if ($_COOKIE["name"]=='vds' || $_COOKIE["name"]=='admin' || $_COOKIE["name"]=='school')
			{
			 print '<li class="navigateConvertibles" id="liconvertibles"><a href="index.php?sel=analys5&type=4">Водосбыт</a>
	                        <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 8px;">
                        	<li><a href="index.php?sel=analys7">Отчет о потреблении воды 2</a></li>
        	                <li><a href="index.php?sel=analys5&type=2">Дневное потребление воды</a></li>
                	        <li><a href="index.php?sel=analys5&type=4">Потребление по месяцам</a></li>
                        	<li><a href="index.php?sel=analys3&analys=14">Отчет о потреблении воды</a></li>
	                        <li><a href="index.php?sel=analys3&analys=4">Отчет об экономии холодной воды</a></li>
        	                <li><a href="index.php?sel=analys3&analys=5">Отчет о непроизводительных потерях воды</a></li>
                	        </ul></li>';
			}
		    ?>
                  </ul>
            </div>
            <div id="tab2">
                <ul id="mainNavigationMiddle" class="middle">
                    <li class="navigateProducts" id="Li1"><a href="index.php?sel=all">Тренды</a>
                      <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 6px;">
                            <li><a href="index.php?sel=all">Общий экран</a></li>
                            <li><a href="index.php?sel=trends&type=1">Температуры</a></li>
                            <li><a href="index.php?sel=trends&type=2">Расход теплоносителя</a></li>
                            <li><a href="index.php?sel=trends&type=3">Тепловая энергия</a></li>
                        </ul>
                    </li>
		    <?php
		    if ($_COOKIE["name"]=='admin')
			{
			 print '<li class="navigateMarkets" id="Li11"><a href="index.php?sel=details&name=channels" class="submenu">Детально</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: 5px;">
				<li><a href="index.php?sel=details&name=var2">Измеряемые параметры</a></li>
				<li><a href="index.php?sel=details&name=channels">Каналы измерения</a></li>
				<li><a href="index.php?sel=answers">Статистика ответов</a></li>
				<li><a href="index.php?sel=details&name=protocols">Протоколы</a></li>
				<li><a href="index.php?sel=norm">Нормативы потребления по месяцам</a></li>

                	        <li><a href="index.php?sel=register">Журнал работы</a></li>
                        	<li><a href="index.php?sel=input3">Ввод данных тепло</a></li>
	                        <li><a href="index.php?sel=input4">Ввод данных вода</a></li>
        	                <li><a href="index.php?sel=what">Плановые работы</a></li>
                	        <li><a href="index.php?sel=what_add">Добавить новое мероприятие</a></li>
	                        </ul>
		                </li>
        		        <li class="navigateTools" id="Li14"><a href="" class="submenu">Сводная аналитика</a>
	                	<ul style="margin-top: 5px; display: none; position: absolute; margin-left: 7px;">
	                        <li><a href="index.php?sel=compare&type=3">Сравнение типовых объектов</a></li>
				<li><a href="index.php?sel=compare2&type=3">Сравнение удельного потребления</a></li>
	                        <li><a href="index.php?sel=analys2&type=3">Анализ выполнения требований №261-ФЗ о снижении объема потребленных ресурсов</a></li>
				<li><a href="index.php?sel=rasphour">Распределение потребления по времени</a></li>
                	        <li><a href="index.php?sel=compare4&allmu=1&type=3">Сравнительный анализ удельного потребления тепла</a></li>
                        	<li><a href="index.php?sel=compare4&allmu=1&type=3">Сводный отчет об экономии тепловой энергии</a></li>
	                        <li><a href="index.php?sel=consumption&cons=1">Потребление тепла</a></li>
        	                </ul>
		                </li>
		                <li class="navigateAbout" id="Li23">
		                <a href="info.php" class="submenu">Информация</a>
		                <ul style="margin-top: 5px; display: none; position: absolute; margin-left: -7px;">
		                <li class="2ndmenu"><a href="index.php?sel=about">О СЦ</a></li>
		                <li><a href="index.php?sel=partners">Партнеры</a></li>
		                </ul>
		                </li>';
				}
			?>
                </ul>
            </div>
            <div id="tab3">
                <span class="valign"><a href="index.php?sel=object&menu=object_avar">Предупреждения</a></span>
            </div>
            <div id="tab4">
                <span><a href="<?php print $_SERVER['REQUEST_URI']; ?>&print=1"><img border="0" src="files/print.gif"></a></span>
            </div>
