function handleRotate(){
	
	var width  = document.body.clientWidth;
	var height = document.body.clientHeight;
	
	var hiddenColumnList = document.getElementsByClassName('hiddenColumn');
	for(var i=0; i < hiddenColumnList.length; i++)
		hiddenColumnList[i].style.display = (width > height?'table-cell':'none');
}

window.addEventListener("orientationchange", handleRotate);
