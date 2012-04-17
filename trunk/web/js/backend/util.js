function showIndicator( indicatorId ){

	hideFormStatusError(indicatorId);
	hideFormStatusSuccess(indicatorId);
	hidePaginator(indicatorId);
	showDiv(indicatorId+'HeaderIndicator');
	showDiv(indicatorId+'FooterIndicator');
}

function hideIndicator( indicatorId ){
	
	hideDiv(indicatorId+'HeaderIndicator');
	hideDiv(indicatorId+'FooterIndicator');
	hideDiv('mainFormIndicator');
	showPaginator(indicatorId);
}

function showPaginator( paginatorId ){
	
	paginatorId = paginatorId.replace('Form', '');
	
	showDiv(paginatorId+'Paginator');
}

function hidePaginator( paginatorId ){
	
	paginatorId = paginatorId.replace('Form', '');
	hideDiv(paginatorId+'Paginator');
}

function loadSelectField(element, moduleName, updateDivId, updateElementId){

	var elementId    = element.id;
	var onchangeFunc = document.getElementById(updateElementId).onchange;
	
	$('#'+updateDivId).html(getWaitSelect());
	
	$('#'+updateDivId+' select').uniform();
	
	var successFunc = function(content){
		
		$('#'+updateDivId).html(content);
		document.getElementById(updateElementId).onchange = onchangeFunc;
		
		$('#'+updateDivId+' select').uniform();
	}
	
	var urlAjax = _webRoot+'/'+moduleName+'/getSelectField/'+element.name+'/'+element.value+'/prefix/'+getModuleName();
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}

function debug( value ){
	
	clearDebug();
	debugAdd( value );
}

function debugAdd( value ){

	if( $('#debugDiv').html()!='' )
		value = $('#debugDiv').html() + '<br/>'+value;
	else
		value = '<a href="javascript:void(0)" onclick="clearDebug()">Ocultar</a>'+
				' - <a href="javascript:void(0)" onclick="$(\'debugDiv\').style.width = \'800px\'">Expandir</a><hr/>'+value;

	$('#debugDiv').html(value);
	showDiv('debugDiv');
}

function clearDebug(){

	$('#debugDiv').html('');
	hideDiv('debugDiv');
}

function showDiv(divId){
	
	$('#'+divId).show();
}

function hideDiv(divId){
	
	$('#'+divId).hide();
}

function showIndicator(indicatorId){
	
}

function hideIndicator(indicatorId){
	
}

function parseMessage(){
	
}

function AjaxRequest(urlAjax, options){
	
	$.ajax({type:'POST', url: urlAjax, data:options.parameters, error: options.onFailure, success: options.onSuccess});
}