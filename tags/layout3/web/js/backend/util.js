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

function parseMessage(errorMessage){

	if( (errorMessage).match(/^!/) )
		return errorMessage.replace('!', '\n');
	else if( errorMessage.length < 100 )
		return '\n'+errorMessage;
	else
		return null
}

function AjaxRequest(urlAjax, options){
	
	$.ajax({type:'POST', url: urlAjax, data:options.parameters, error: options.onFailure, success: options.onSuccess});
}

function getRandomString(length, possible){
	
    var text = '';
    if( !possible )
    	possible = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';

    for(var i=0; i < length; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));

    return text;
}