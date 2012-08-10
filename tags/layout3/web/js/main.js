var _SearchEmptyText = null;

function handleMainSearchFocus(fieldObj){
	
	_SearchEmptyText = fieldObj.value;
	
	fieldObj.value = '';
}

function handleMainSearchBlur(fieldObj){
	
	if( fieldObj.value=='' )
		fieldObj.value = _SearchEmptyText;
}

function doQuickSearch(){
	
	if( $('mainSearch').value=='' )
		return false;
	
	$('mainSearchForm').submit();
}

function changeDefaultLanguage(culture){

	var handlerFunc = function(t) {
		
		window.location.reload(true);
	};
		
	var errFunc = function(t) {
	
		alert(i18n_changeLanguageError);
		hideIndicator();
	};
	
	showIndicator();	
	var urlAjax  = _webRoot+'/home/changeLanguage/culture/'+culture;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:handlerFunc, onFailure:errFunc});
}

function loadStylesheet(cssPath){

	if( !(/\.css$/i).test(cssPath) )
		cssPath += '.css';
	
	var head  = document.getElementsByTagName('head')[0];
    var link  = document.createElement('link');
    link.rel  = 'stylesheet';
    link.type = 'text/css';
    link.href = cssPath;
    link.media = 'all';
    head.appendChild(link);
}

function setLastBarPath(pathName){
	
	$('lastCommonBarPath').innerHTML = pathName
}

function getTabLoader(){
	
	var html = '<center><br/><br/><br/>';
	html    += '<table>';
	html    += '	<tr>';
	html    += '		<td><img src="'+_imageRoot+'/ajaxLoader32.gif" /></td>';
	html    += '		<td style="font-weight: bold; font-size: 20px; padding-left: 15px">Carregando informações...</td>';
	html    += '	</tr>';
	html    += '</table>';
	html    += '</center>';
	
	return html;
}

function clearCommonBarMessage(){
	
	$('topSystemMessage').innerHTML = '';
}

function setCommonBarMessage(message, className){
	
	className = (className?className:'info');
	
	var div = document.createElement('div');
	div.className = 'message '+className;
	div.innerHTML = message;
	
	clearCommonBarMessage();
	$('topSystemMessage').appendChild(div);
}