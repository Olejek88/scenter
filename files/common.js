/*common layout functions*/

function Get_Cookie(name) {
  var start = document.cookie.indexOf( name + "=" );
  var len = start + name.length + 1;

  if ( ( !start ) && ( name != document.cookie.substring( 0, name.length ) ) ) return "";
  if ( start == -1 ) return "";

  var end = document.cookie.indexOf( ";", len );
  if ( end == -1 ) end = document.cookie.length;
  return unescape( document.cookie.substring( len, end ) );
}

function Set_Cookie(name, value, days) {
  var today = new Date();
  var expire = new Date();
  if (days==null || days==0) days = 1;
  expire.setTime(today.getTime() + 3600000*24*days);
  document.cookie = name+"="+escape(value) + ";expires="+expire.toGMTString();
}

function GetLogonName() {
  var szLogonName = Get_Cookie("vlln");
  //if (szLogonName == "") szLogonName = "Visitor";
  return szLogonName;
}

function GetCopyrightYear() {
  var today = new Date();
  return today.getFullYear();
  //return "2008";
}

function mouseovercolor_over(obj) {
  obj.style.backgroundColor = '#D0EEC2';
}

function mouseovercolor_out(obj) {
  obj.style.backgroundColor = '';
}

function strrev(str) {
   if (!str) return '';
   var revstr = '';
   for (var i=str.length-1; i>=0; i--) revstr += str.charAt(i);
   return revstr;
}

function ThousandSeparator(str) {
  if (!str) return '';
  var output = '';
  str = strrev(str);
  for (var i=0; i<str.length; i++) {
    if (i>0 && i%3 == 0) output += ',';
    output += str.charAt(i);
  }
  output = strrev(output);

  return output;
}

/* For Google Analytics ======================= */
/*
function IncludeJS(jsfile)
{
  var script  = document.createElement('script');
  script.src  = jsfile;
  script.type = 'text/javascript';
  script.defer = true;

  document.getElementsByTagName('head').item(0).appendChild(script);
}

IncludeJS("google-analytics.aspx");
*/
//document.write('<script type="text/javascript" src="http://www.google-analytics.com/urchin.js">_uacct="UA-2478150-1";urchinTracker();</script>');

/* ============================================== */
