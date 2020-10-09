function arrowOn( obj ) {
	var elem = obj.parentNode;
	//elem.style.backgroundImage = 'url(images/arrow_mo_green.jpg)';
	//elem.style.backgroundRepeat = 'no-repeat';
	//elem.style.backgroundPosition = '123px -3px';
	elem.style.backgroundColor = '#ccc';
	/* elem.style.backgroundColor = '#2E7F21'; */
}
function arrowOff( obj ) {
	var elem = obj.parentNode;
	//elem.style.backgroundImage = '';
	//elem.style.backgroundPosition = 'inherit';
	elem.style.backgroundColor = '';

}
function t_on( obj ) {
	obj.style.backgroundColor = 'gold';
}
function t_off( obj ) {
	obj.style.backgroundColor = '';
}