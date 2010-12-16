var _LastFormReplyId = null

function sendComment(eventCommentId){

	eventCommentId = (eventCommentId?eventCommentId:'');
	
	var fieldObj = $('commentsComment'+eventCommentId)
	var comment  = fieldObj.value;
	var eventId  = $('eventId').value;
	
	fieldObj.className = 'eventComment';
	
	if( !comment || comment=='Clique aqui para enviar seu comentário' ){
		
		fieldObj.className = 'eventCommentError';
		fieldObj.title     = 'Digite alguma mensagem para publicar';
		return false;
	}
	
	comment = comment.replace(/[\n\r]/g, '|n');
	comment = urlencode(comment);
	
	disableButton('postComment'+eventCommentId);
	$('commentsCharCount'+eventCommentId).innerHTML = 'Publicando...';
	
	fieldObj.disabled = true;
	
	var successFunc = function(t){

		var content = t.responseText;

		var commentDiv = document.createElement('div');
		commentDiv.innerHTML = content;
		
		$('commentListDiv').appendChild(commentDiv);
		
		removeLastReplyForm();
		
		adjustContentTab();
		
		resetCommentForm(eventCommentId);
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		enableButton('postComment'+eventCommentId);
		$('commentsCharCount'+eventCommentId).innerHTML = 'Erro ao publicar o comentário!';
		
		fieldObj.disabled = false;
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/saveComment/eventId/'+eventId+'?comment='+comment;

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function deleteComment(eventCommentId){

	showIndicator();
	
	var successFunc = function(t){

		$('commentListDiv').removeChild( $('eventComment'+eventCommentId+'Div') );
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator();
		alert('Não foi possível excluir o comentário!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/deleteComment/eventCommentId/'+eventCommentId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function resetCommentForm(eventCommentId){
	
	enableButton('postComment');
	hideDiv('commentsCharCount');
	hideDiv('commentsPostButton');
	$('commentsCharCount'+eventCommentId).innerHTML = '140 caracteres restantes';
	$('commentsComment'+eventCommentId).disabled    = false;
	$('commentsComment'+eventCommentId).value       = 'Clique aqui para enviar seu comentário';
}

function handleCommentFocus(fieldObj){
	
	var comment = fieldObj.value;
	if( comment=='Clique aqui para enviar seu comentário' )
		fieldObj.value = '';
	
	var eventCommentId = fieldObj.id.replace('commentsComment', '');
		
	showDiv('commentsCharCount'+eventCommentId, true);
	showDiv('commentsPostButton'+eventCommentId, true);
	
	adjustContentTab();
}

function countChars(fieldObj){

	var leftChars = (140-fieldObj.value.length);
	
	if( leftChars < 0 )
		leftChars = 0;
	
	var eventCommentId = fieldObj.id.replace('commentsComment', '');
		
	$('commentsCharCount'+eventCommentId).innerHTML = leftChars+' caractere'+(leftChars==1?'':'s')+' restante'+(leftChars==1?'':'s');
	
	if( leftChars==0 )
		fieldObj.value = fieldObj.value.substring(0,140);
}

function showAllComments(){
	
	var eventId = $('eventId').value;
	
	putLoading('commentListDiv');
	
	var successFunc = function(t){

		var content = t.responseText;
		$('commentListDiv').innerHTML = content;
		
		adjustContentTab();
	};
	
	var urlAjax = _webRoot+'/event/getCommentList/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}

function changeIcon(linkObj, over){
	
	if( over )
		linkObj.src = linkObj.src.replace('light', '');
	else
		linkObj.src = linkObj.src.replace('delete10', 'delete10light');
}

function removeLastReplyForm(){

	if( _LastFormReplyId )
		$('eventComment'+_LastFormReplyId+'Div').removeChild($('replyForm'+_LastFormReplyId+'Div'));
}

function replyComment(eventCommentId){

	if( eventCommentId==_LastFormReplyId )
		return false;
	
	removeLastReplyForm();
	
	_LastFormReplyId = eventCommentId;
	
	var formContent = $('extraCommentFormDiv').innerHTML;
	formContent     = formContent.replace(/%eventCommentId%/gi, eventCommentId);
	
	var formDiv = document.createElement('div');
	formDiv.className = 'replyFormDiv';
	formDiv.id        = 'replyForm'+eventCommentId+'Div';
	formDiv.innerHTML = formContent;
	
	$('eventComment'+eventCommentId+'Div').appendChild(formDiv);
	showDiv('commentsCharCount'+eventCommentId, true);
	showDiv('commentsPostButton'+eventCommentId, true);
	
	adjustContentTab();
}

function handleTab(event){

	if( event.keyCode!= 9)
		return true;
	
	var fieldObj;

	if( navigator.appName.indexOf("Netscape") != -1 )		
		fieldObj = event.target;
	else
		fieldObj = event.srcElement;

	var eventCommentId = fieldObj.id.replace('commentsComment', '');
}