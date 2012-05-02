function isDebug(){
	
	return _isDebug;
}

function isMobile(){
	
	return _isMobile;
}

function debug( value ){
	
	clearDebug();
	debugAdd( value );
}

function debugAdd( value ){

	if( $( 'debugDiv' ).innerHTML!='' )
		value = $( 'debugDiv' ).innerHTML + '<br/>'+value;
	else
		value = '<a href="javascript:void(0)" onclick="clearDebug()">Ocultar</a>'+
				' - <a href="javascript:void(0)" onclick="$(\'debugDiv\').style.width = \'800px\'">Expandir</a><hr/>'+value;

	$('debugDiv').innerHTML = value;
	showDiv('debugDiv');
}

function clearDebug(){

	$('debugDiv').innerHTML = '';
	hideDiv('debugDiv');
}

function showDiv( divId, isTableCell, displayType ){

	var div = $( divId );
	if( div && div!='undefined' ){
		
		div.style.display = (isTableCell?'table-cell':(displayType?displayType:'block'));
		div.removeClassName('hidden');
	}
}

function hideDiv( divId ){

	var div = $( divId );
	if( div && div!='undefined' )
		div.style.display = 'none';
}

function showIndicator( indicatorId ){
	
	indicatorId = (indicatorId?ucfirst(indicatorId):'');
	
	if( isMobile() )
		$('indicator').style.top = window.pageYOffset;

	showDiv('indicator'+indicatorId);
	hideFormStatusError(indicatorId);
}

function hideIndicator( indicatorId ){
	
	indicatorId = (indicatorId?ucfirst(indicatorId):'');
	
	hideDiv('indicator'+indicatorId);
	hideDiv('indicator');
}

function isVisible( divId ){

	var div = $( divId );
	if( div && div!='undefined' )
		return (div.style.display != 'none' || div.style.display == '' || div.style.display == 'block');
}

function putLoading(divId, message, mobile){
	
	if( !message )
		message = i18n_innerLoading;
	
	var html = '';
	
	var fontSize = (mobile?'16':'10');
	
	html += '<center>\n';
	html += '<br/>\n';
	html += '	<table>\n';
	html += '		<tr>\n';
	if( !mobile )
	html += '			<td><img src="'+_imageRoot+'/ajaxLoader32.gif"></td>\n';
	html += '			<td style="font-weight: bold; font-size: '+fontSize+'pt; padding-left: 15px">'+message+'</td>\n';
	html += '		</tr>\n';
	html += '	</table>\n';
	html += '<center>\n';

	$(divId).innerHTML = html;
}

function isArray(obj) {

	return obj.constructor == Array;
}

function isBlank(val){

	if(val==null)
		return true;
	
	if(val=='')
		return true;
	
	return false;
}

function isDigit(num) {

	if( num.length>1 )
		return false;
	
	var string="1234567890";
	
	if( string.indexOf(num)!=-1 )
		return true;
	
	return false;
}

function isInteger(val){

	val = val+'';
	
	if( isBlank(val) )
		return false;
	
	for(var i=0;i<val.length;i++)
		if( !isDigit(val.charAt(i)) )
			return false;

	return true;
}

function isNumeric(val){

	return (parseFloat(val,10)==(val*1));
}

function getWaitSelect(fieldName, fieldId, onchange){
		
	var selectWait = _SelectWait;
	
	if( onchange )
		onchange = 'onchange="'+onchange+'"';
	
	selectWait = selectWait.replace('fieldName', fieldName);
	selectWait = selectWait.replace('fieldId', fieldId);
	selectWait = selectWait.replace('onchange', onchange);
	
	return selectWait;
}

function getEmptySelect(fieldName, fieldId, onchange){
	
	var selectEmpty = _SelectEmpty;
	
	if( onchange )
		onchange = 'onchange="'+onchange+'"';
	
	selectEmpty = selectEmpty.replace('fieldName', fieldName);
	selectEmpty = selectEmpty.replace('fieldId', fieldId);
	selectEmpty = selectEmpty.replace('onchange', onchange);
	
	return selectEmpty;
}

function linkTo(linkText, url, target){
	
	if( !target )
		target = 'top';
	
	url = url.replace('?', '/');
	url = url.replace(/=/g, '/');
	url = url.replace(/^[\\/]/, '');
	
	return '<a href="'+_webRoot+'/'+url+'" target="_'+target+'">'+truncate(linkText, 30)+'</a>';
}

function linkToFunction(label, module, action, fieldName, fieldValue){
	
	return '<a href="javascript:void(0)" onclick="goModule(\''+module+'\', \''+action+'\', \''+fieldName+'\', \''+fieldValue+'\')">'+label+'</a>';
}

function toCurrency(value, decimalPlaces){
	
	decimalPlaces = (decimalPlaces?decimalPlaces:2);
	return toFloat(value, true, decimalPlaces);
}

function toFloat(value, display, decimalPlaces){

	decimalPlaces = (typeof(decimalPlaces)=='undefined'?2:decimalPlaces);
	
	if( !value ){
		
		if( display )
			return '0,00';
		else
			return 0;
	}
	
	value = value+' ';
	
	var separator = (i18n_culture=='pt_BR'?',':'.');
	
	if( (/^[0-9]+\.[0-9]{1,2} $/).test(value) )		
		value = value.replace('.', ',');
	
	if( (/^[0-9]+[,\.][0-9]{3,} $/).test(value) ){
		
		value = value.replace(',', '.');
		value = number_format(value, decimalPlaces, separator, (separator=='.'?',':'.'));
	}

	value = value.replace(/[^0-9,-]/ig, '');
	value = value.replace(',', '.');
	
	value = parseFloat(value);
	
	if( display )
		value = number_format(value, decimalPlaces, separator, (separator=='.'?',':'.'));
	
	return value;
}

function parseInfo(infoList){

	try{
		
		eval('var obj = '+infoList+';');
		return obj;
	}catch(error){
		
		return null;
	}
}

function parseMessage(errorMessage){

	if( (errorMessage).match(/^!/) )
		return errorMessage.replace('!', '\n\n');
	else
		return null;
}

function getScreenWidth(){

	return document.body.offsetWidth;
}

function getScreenHeight(){
	
	return document.body.offsetHeight;
}

function isIE(){
	
	return (navigator.appName.indexOf("Microsoft")!= -1)
}

function Trim( value, char ){
	
	if( char ){
		
		eval('value = value.replace(/^'+char+'*/g, \'\');');
		eval('value = value.replace(/'+char+'*$/g, \'\');')
	}else{
		
		value = value.replace(/^ */g, '');
		value = value.replace(/ *$/g, '');
		value = value.replace(/^\t*/g, '');
		value = value.replace(/\t*$/g, '');
		value = value.replace(/^\n*/g, '');
		value = value.replace(/\n*$/g, '');
	}
	
	return value;
}

function replaceChar( value, char, newChar) {

    for (i=0; i < value.length; i++)
    	if (value.substring(i, i+1) == char)
            value = value.replace(char, newChar);
    
    return value;
}

function getSelectText(fieldId){

	return $(fieldId).options[$(fieldId).selectedIndex].text;
}

function getWaitSelect(){
	
	return '<select disabled><option>Carregando...</option></select>';
}

function getEmptySelect(fieldName, fieldId){
	
	var selectEmpty = '<select name="fieldName" id="fieldId"><option value="">Selecione</option></select>';
	
	selectEmpty = selectEmpty.replace('fieldName', fieldName);
	selectEmpty = selectEmpty.replace('fieldId', fieldId);
	
	return selectEmpty;
}

function getModuleName(){
	
	return _ModuleName;
}

function isModuleName(moduleName){
	
	return (moduleName==_ModuleName);
}

function getActionName(){
	
	return _ActionName;
}

function getOrdinalSufix(number){
	
	if( i18n_culture=='pt_BR' )
		return 'º';
	
	number = number+'';
	
	var sufix = '';
	if( i18n_culture=='en_US' ){
		if( number.match(/1$/) ) sufix = 'st';
		else if( number.match(/2$/) ) sufix = 'nd';
		else if( number.match(/3$/) ) sufix = 'rd';
		else sufix = 'th';
		
		return sufix;
	}
}

function changeClassName(element, className){
	
	element.className = className;
}

function goToPage(moduleName, actionName, fieldName, fieldValue, newWindow, evt){
	
	if( evt && (evt.metaKey || evt.altKey) )
		newWindow = true
	
	if( fieldName && fieldValue || newWindow )
		return goModule(moduleName, actionName, fieldName, fieldValue, newWindow );
	
	var urlLocation = _webRoot+'/'+moduleName+'/'+actionName;
	urlLocation = urlLocation.replace(/\/\//g, '/');
	urlLocation = urlLocation.replace(/\/$/g, '');

	location.href = urlLocation;
}