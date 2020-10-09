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
  
  //objXMLHttp.onreadystatechange = OnAjaxStateChanged;
  //objXMLHttp.setRequestHeader('Accept','message/x-jl-formresult')
  //objXMLHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  //objXMLHttp.open('GET', url, true);
  objXMLHttp.open('GET', url, false);
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

function AddToCart(obj) {

    for (i = 0; i < document.getElementsByName(obj).length; i++) {
        if (document.getElementsByName(obj)[i].type == 'radio') {
            if (document.getElementsByName(obj)[i].checked) {
                var str = document.getElementsByName(obj)[i].value;
                //str = "/Store/Cart/Index.aspx?pub_code=" + str.replace(":", "&list_source_id=");
                //alert(str);
                //str = "http://www.valueline.com/cart/viewcart.aspx?product=" + str;
                str = "https://www.ec-server.valueline.com/ssl/viewcart.aspx?product=" + str;
                //str = "https://www.ec-server.valueline.com/ektron/viewcart.aspx?product=" + str;
                window.location = str;
                return;
            }
        }
    }

    alert("Please select a specific subscription.");
    return false;
}

function CommaFormatted(amount)
{
	var delimiter = ","; // replace comma if desired
	var a = amount.split('.',2)
	var d = a[1];
	var i = parseInt(a[0]);
	if(isNaN(i)) { return ''; }
	var minus = '';
	if(i < 0) { minus = '-'; }
	i = Math.abs(i);
	var n = new String(i);
	var a = [];
	while(n.length > 3)
	{
		var nn = n.substr(n.length-3);
		a.unshift(nn);
		n = n.substr(0,n.length-3);
	}
	if(n.length > 0) { a.unshift(n); }
	n = a.join(delimiter);
	if(d.length < 1) { amount = n; }
	else { amount = n + '.' + d; }
	amount = minus + amount;
	return amount;
}

function idx_num_format(pnumber,rlength)
{
	if (isNaN(pnumber)) { return 0 };
	if (pnumber=='') { return 0 };
	var result=Math.round(pnumber*Math.pow(10,rlength))/Math.pow(10,rlength);
        result = result + "";

	if (result.indexOf("-") != -1) { result = "<font color=red>" + result; }
        else { result = "<font color=black>" + result; }

	return result;
}

