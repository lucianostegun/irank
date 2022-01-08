var _LastFormReplyId = null

function sendComment(eventCommentId){

	eventCommentId = (eventCommentId?eventCommentId:'');
	
	var fieldObj     = $('eventCommentComment'+eventCommentId)
	var comment      = fieldObj.value;
	var eventId      = $('eventId').value;
	var eventPhotoId = $('eventCommentEventPhotoId').value;
	var isPhoto      = (eventPhotoId!='');
	
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

		var eventCommentIdNew = content.match(/eventComment[0-9]*Div/)+'';

		eventCommentIdNew = eventCommentIdNew.replace(/[^0-9]/, '');

		var commentDiv = document.createElement('div');
		commentDiv.id = 'event'+(isPhoto?'Photo':'')+'Comment'+eventCommentIdNew+'TmpDiv';
		
		commentDiv.innerHTML = content;		

		$('comment'+(isPhoto?'Photo':'')+'ListDiv').appendChild(commentDiv);
		
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
	
	var urlAjax = _webRoot+'/event/save'+(isPhoto?'Photo':'')+'Comment/eventId/'+eventId+'?eventPhotoId='+eventPhotoId+'&comment='+comment;

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function deleteComment(eventCommentId){

	var eventPhotoId = $('eventCommentEventPhotoId').value;
	var isPhoto      = (eventPhotoId!='');
	
	showIndicator();
	
	var successFunc = function(t){

		try{
		
			$('comment'+(isPhoto?'Photo':'')+'ListDiv').removeChild( $('event'+(isPhoto?'Photo':'')+'Comment'+eventCommentId+'Div') );
		}catch(e){
			
			$('comment'+(isPhoto?'Photo':'')+'ListDiv').removeChild( $('event'+(isPhoto?'Photo':'')+'Comment'+eventCommentId+'TmpDiv') );
		}
		
		hideIndicator();
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		hideIndicator();
		alert('Não foi possível excluir o comentário!\nTente novamente mais tarde.');
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/delete'+(isPhoto?'Photo':'')+'Comment/event'+(isPhoto?'Photo':'')+'CommentId/'+eventCommentId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function resetCommentForm(eventCommentId){
	
	eventCommentId = (eventCommentId?eventCommentId:'');
	
	enableButton('postComment');
	hideDiv('commentsCharCount');
	hideDiv('commentsPostButton');
	$('commentsCharCount'+eventCommentId).innerHTML  = '140 caracteres restantes';
	$('eventCommentComment'+eventCommentId).disabled = false;
	$('eventCommentComment'+eventCommentId).value    = 'Clique aqui para enviar seu comentário';
}

function handleCommentFocus(fieldObj){
	
	var comment = fieldObj.value;
	if( comment=='Clique aqui para enviar seu comentário' )
		fieldObj.value = '';
	
	var eventCommentId = fieldObj.id.replace('eventCommentComment', '');
		
	showDiv('commentsCharCount'+eventCommentId, true);
	showDiv('commentsPostButton'+eventCommentId, true);
	
	adjustContentTab();
}

function countChars(fieldObj){

	var leftChars = (140-fieldObj.value.length);
	
	if( leftChars < 0 )
		leftChars = 0;
	
	var eventCommentId = fieldObj.id.replace('eventCommentComment', '');
		
	$('commentsCharCount'+eventCommentId).innerHTML = leftChars+' caracter'+(leftChars==1?'':'es')+' restante'+(leftChars==1?'':'s');
	
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