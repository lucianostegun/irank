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

function removeAccents(str) {
	

}

String.prototype.removeAccents = function(){

	str = this;
	
	var rExps = [ {re : /[\xC0-\xC6]/g, ch : 'A'}, {
		re : /[\xE0-\xE6]/g, ch : 'a'}, {
		re : /[\xC8-\xCB]/g, ch : 'E'}, {
		re : /[\xE8-\xEB]/g, ch : 'e'}, {
		re : /[\xCC-\xCF]/g, ch : 'I'}, {
		re : /[\xEC-\xEF]/g, ch : 'i'}, {
		re : /[\xD2-\xD6]/g, ch : 'O'}, {
		re : /[\xF2-\xF6]/g, ch : 'o'}, {
		re : /[\xD9-\xDC]/g, ch : 'U'}, {
		re : /[\xF9-\xFC]/g, ch : 'u'}, {
		re : /[\xD1]/g, ch : 'N'}, {
		re : /[\xF1]/g, ch : 'n'} ];
	
	for ( var i = 0, len = rExps.length; i < len; i++)
		str = str.replace(rExps[i].re, rExps[i].ch);
	
	return str;
}