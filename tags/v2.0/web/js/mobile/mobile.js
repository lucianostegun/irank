function handleRotate(){

	var orientation = window.orientation;
	
	var hiddenColumnList = document.getElementsByClassName('hiddenColumn');

	for(var i=0; i < hiddenColumnList.length; i++)
		hiddenColumnList[i].style.display = (orientation==90 || orientation==-90?'table-cell':'none');
}

window.addEventListener("orientationchange", handleRotate);
