<?php
 include("config/local.php");
 $i = mysql_connect ($mysql_host,$mysql_user,$mysql_password); $e=mysql_select_db ($mysql_db_name);
 $query = "set character_set_client='cp1251'"; mysql_query ($query,$i);
 $query = "set character_set_results='cp1251'"; mysql_query ($query,$i);
 $query = "set collation_connection='cp1251_general_ci'"; mysql_query ($query,$i);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html><head>
<title>Челябинский ситуационный центр</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
<link rel="stylesheet" href="files/structure_collage_ektron.css" type="text/css">
<link rel="stylesheet" href="files/default.css" title="default" type="text/css">
<link rel="alternate stylesheet" href="files/default_larger.css" title="big" type="text/css">
<link rel="stylesheet" type="text/css" href="files/niftyCorners.css">
<link rel="stylesheet" type="text/css" href="files/niftyPrint.htm" media="print">
<link rel="stylesheet" type="text/css" href="files/quotetabs.css">
<script type="text/javascript" src="files/prototype.js"></script>
<script type="text/javascript" src="files/scriptaculous.js"></script>
<script type="text/javascript" src="files/builder.js"></script>
<script type="text/javascript" src="files/effects.js"></script>
<script type="text/javascript" src="files/dragdrop.js"></script>
<script type="text/javascript" src="files/controls.js"></script>
<script type="text/javascript" src="files/slider.js"></script>
<script type="text/javascript" src="files/menubehavior.js"></script>
<script type="text/javascript" src="files/styleswitcher.js"></script>
<script type="text/javascript" src="files/niftycube.js"></script>
<script type="text/javascript" src="files/flashobject.js"></script>

<script type="text/javascript" src="files/common.js"></script>
<script type="text/javascript" src="files/ajax.js"></script> 

<script type="text/javascript">
if (screen.width<1600)
{
document.writeln("<link rel=\"stylesheet\" type=\"text/css\" href=\"files/ektron2.css\" >")
}
else
{
document.writeln("<link rel=\"stylesheet\" type=\"text/css\" href=\"files/ektron.css\" >")
} 
</script>

<script type="text/javascript">

window.onload = function() {
  Nifty("div#loginstatus", "transparent bottom");
  document.fmQuote.Symbol.select();
  setTimeout("RefreshData()", 60000);
}

function RefreshData()
{
  GetAjaxData('getquote_proxy.aspx?symbol=A&randnum=' + Math.random());
  setTimeout("RefreshData()", 60000);
}

function OnAjaxStateChanged() 
{ 
  if (objXMLHttp.readyState == 4 && objXMLHttp.status == 200) {
    try
    {
      var xmldoc = objXMLHttp.responseXML;
      var pricing_data = xmldoc.getElementsByTagName('pricedata');

      document.getElementById("ajax_change").style.backgroundColor = "yellow";

      UpdatePanel(pricing_data, "last");
      UpdatePanel(pricing_data, "change");
      UpdatePanel(pricing_data, "bid");
      UpdatePanel(pricing_data, "ask");
      UpdatePanel(pricing_data, "high");
      UpdatePanel(pricing_data, "low");
      UpdatePanel(pricing_data, "open");
      UpdatePanel(pricing_data, "volume");
      UpdatePanel(pricing_data, "time");
      
      setTimeout("document.getElementById(\"ajax_change\").style.backgroundColor = \"white\";", 500);

      pricing_data = xmldoc.getElementsByTagName('fundamental');
      UpdatePanel(pricing_data, "name");
      UpdatePanel(pricing_data, "yearhigh");
      UpdatePanel(pricing_data, "yearlow");
      UpdatePanel(pricing_data, "eps");
      UpdatePanel(pricing_data, "peratio");

      pricing_data = xmldoc.getElementsByTagName('dividend');
      UpdatePanel(pricing_data, "date");
      UpdatePanel(pricing_data, "amount");
    }
    catch (e) {}
  }
}

function UpdatePanel(xmlDataSet, szTagName)
{ 
  try
  {
    var szPrefix = "";
    
    if (szTagName == "change") {
      if (xmlDataSet[0].getElementsByTagName(szTagName)[0].childNodes[0].nodeValue.indexOf("-") == -1) szPrefix = "<font color=green>+";
      else szPrefix = "<font color=red>";
    }
    
    document.getElementById("ajax_"+szTagName).innerHTML = szPrefix + xmlDataSet[0].getElementsByTagName(szTagName)[0].childNodes[0].nodeValue;
  }
  catch (e) {}
}
</script>

<script type="text/javascript" src="files/jquery.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_003.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron.js"></script>
<script language="javascript" type="text/javascript" src="files/ektron_002.js"></script>
</head>
<body><center>
<?php
if ($_GET["print"]=='')
{
print '<div id="header_ek"><div id="header_top" style="width:100%"></div>
	<div id="header_middle">
        <div id="logo">
            <a href=""><img src="files/logo3.gif" alt="РПК"></a>
        </div>
        <div id="tabs">
            <div id="advisors">
                <a href="index.php?sel=rz1">Поставщикам энергоресурсов</a>    
            </div>
            <div id="investors">
                <a href="index.php?sel=rz2">Техническому персоналу</a>
            </div>
        </div>
	</div><div id="header_bottom">';
include ("menu.inc");
print '</div></div>';
}
?>
</center>
<div id="main" style="width:99%">
<?php
 if ($_GET["menu"]=='' && $_GET["sel"]=='') print '<script> window.location.href="map.php" </script>';
 else { $file=$_GET["sel"].'.php'; include $file; }
?>
</div>

<?php
 if ($_GET["menu"]=='' && $_GET["sel"]=='') include("footer.php");
?>

<br><br><br>
</body></html>
