var objXMLHttp;

function GetAjaxData(url)
{
  objXMLHttp = null;
  
  if (url.length == 0) return;
  
  objXMLHttp = GetXmlHttpObject();
  if (objXMLHttp == null)
  {
    //alert ("Your browser does not support AJAX!");
    return;
  } 
  
  objXMLHttp.onreadystatechange = OnAjaxStateChanged;
  //objXMLHttp.setRequestHeader('Accept','message/x-jl-formresult')
  //objXMLHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  objXMLHttp.open('GET', url, true);
  objXMLHttp.send(null);
} 

function GetXmlHttpObject()
{
  var objHttpRequest = null;
  try
  {
    // Firefox, Opera 8.0+, Safari
    objHttpRequest = new XMLHttpRequest();
    if (objHttpRequest.overrideMimeType) {
      objHttpRequest.overrideMimeType('text/xml');
    }
  }
  catch (e)
  {
    // Internet Explorer
    try
    {
      objHttpRequest = new ActiveXObject("Msxml2.XMLHTTP");
    }
    catch (e)
    {
      objHttpRequest = new ActiveXObject("Microsoft.XMLHTTP");
    }
  }
  
  return objHttpRequest;
}
