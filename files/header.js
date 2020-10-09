function clearTextBox(elem, val) {
    if (elem.value == val)
        elem.value = "";
}

function fillTextBox(elem, val) {
    if (elem.value == "")
        elem.value = val;
}

function submitForm(theform) {
    var reqStr = "";

    for (i = 0; i < theform.elements.length; i++) {
        isformObject = false;

        switch (theform.elements[i].tagName) {
            case "INPUT":

                switch (theform.elements[i].type) {
                    case "text":
                    case "hidden":
                        reqStr += theform.elements[i].name + "=" + encodeURIComponent(theform.elements[i].value);
                        isformObject = true;
                        break;

                    case "checkbox":
                        if (theform.elements[i].checked) {
                            reqStr += theform.elements[i].name + "=" + theform.elements[i].value;
                        } else {
                            reqStr += theform.elements[i].name + "=";
                        }
                        isformObject = true;
                        break;

                    case "radio":
                        if (theform.elements[i].checked) {
                            reqStr += theform.elements[i].name + "=" + theform.elements[i].value;
                            isformObject = true;
                        }
                }
                break;

            case "TEXTAREA":

                reqStr += theform.elements[i].name + "=" + encodeURIComponent(theform.elements[i].value);
                isformObject = true;
                break;

            case "SELECT":
                var sel = theform.elements[i];
                reqStr += sel.name + "=" + sel.options[sel.selectedIndex].value;
                isformObject = true;
                break;
        }

        if ((isformObject) && ((i + 1) != theform.elements.length)) {
            reqStr += "&";
        }

    }

    //return reqStr;

    window.location = theform.action + "?" + reqStr;

}

function get_cookie(cookie_name) {
    var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');

    if (results)
        return (unescape(results[2]));
    else
        return null;
}

function showhidediv(elementid) {
    if (document.getElementById(elementid).style.display == 'none' || document.getElementById(elementid).style.display == '')
    {
        document.getElementById(elementid).style.display = 'block';
    }
    else 
    {
        document.getElementById(elementid).style.display = 'none';
    }
}