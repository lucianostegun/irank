function changeColor(element, color){

	element.style.backgroundColor = '#'+color;
}

function exportSearchExcel(moduleName){
	
	var form = $(moduleName+'Form');
	form.action = form.action.replace('getXml', 'exportExcel');
	form.submit();
	form.action = form.action.replace('exportExcel', 'getXml');
}

function exportSearchPDF(moduleName){
	
	var form = $(moduleName+'Form');
	form.action = form.action.replace('getXml', 'exportPDF');
	form.submit();
	form.action = form.action.replace('exportPDF', 'getXml');
}

function goBack(){
	
	history.back(-1);
}

function setModuleName( moduleName, imageName ){
	
	if( _ModuleName!=null )
		return true;
	
	var moduleObj = new dhtmlXToolbarObject('moduleObj');
	moduleObj.setIconsPath('/images/backend/toolbar/');
	
	var moduleName = "<div class='moduleName'><img src='/images/backend/module/"+imageName+"' align='absmiddle'>"+moduleName+"</div>";
	moduleName     = moduleName.replace(/</g, '&lt;');
	moduleName     = moduleName.replace(/>/g, '&gt;');
    moduleObj.addText('info', 1, moduleName);

    _ModuleName = moduleName;
}