function isDebug(){
	
	return _isDebug;
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

function showDiv( divId ){

	var div = $( divId );
	if( div && div!='undefined' )
		div.style.display = 'block';
}

function hideDiv( divId ){

	var div = $( divId );
	if( div && div!='undefined' )
		div.style.display = 'none';
}

function showIndicator( indicatorId ){
	
	indicatorId = (indicatorId?ucfirst(indicatorId):'');

	showDiv('indicator'+indicatorId);
	showDiv('indicator');
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

function putLoading(divId, message){
	
	if( !message )
		message = 'Carregando,<br/>aguarde...';
	
	var html = '';
	
	html += '<center>\n';
	html += '<br/>\n';
	html += '	<table>\n';
	html += '		<tr>\n';
	html += '			<td><img src="'+_imageRoot+'/ajaxLoader32.gif"></td>\n';
	html += '			<td style="font-weight: bold; font-size: 10pt; padding-left: 15px">'+message+'</td>\n';
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

	if (num.length>1){return false;}
	var string="1234567890";
	if (string.indexOf(num)!=-1){return true;}
	return false;
}

function isInteger(val){

	val = val+'';
	if (isBlank(val)){return false;}
	for(var i=0;i<val.length;i++){
		if(!isDigit(val.charAt(i))){return false;}
		}
	return true;
}

function isNumeric(val){

	return(parseFloat(val,10)==(val*1));
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

function toFloat( value ){

	if( !value )
		return 0;
	
	value = value+' ';
	
	if( (/^[0-9]+\.[0-9]{1,2} $/).test(value) )		
		value = value.replace('.', ',');

	value = value.replace(/[^0-9,-]/ig, '');
	value = value.replace(',', '.');
	
	value = parseFloat(value);
	
	return parseFloat(value);
}

function parseInfo(infoList){

	eval('var obj = '+infoList+';');
	return obj;
}

function parseMessage(errorMessage){

	if( (errorMessage).match(/^!/) )
		return errorMessage.replace('!', '');
	else
		return false;
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

    for (i=0; i < value.length; i++) {
    
    	if (value.substring(i, i+1) == char){

            value = value.replace(char, newChar);
        }
    }
    
    return value;
}

function getSelectText(fieldId){

	return $(fieldId).options[$(fieldId).selectedIndex].text;
}