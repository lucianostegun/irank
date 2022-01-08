var _LastFormReplyId = null;
var _IsPublishing    = false;

function sendComment(eventCommentId){

	if( _IsPublishing ){
	
		alert('Aguarde a publicação do comentário atual');
		return false;
	}
	
	_IsPublishing = true;
	eventCommentId = (eventCommentId?eventCommentId:'');

	var fieldObj = $('commentsComment'+eventCommentId)
	var comment  = fieldObj.value;
	var eventId  = $('eventId').value;
	
	if( !comment || comment=='Clique aqui para enviar seu comentário' ){
		
		alert('Digite alguma mensagem para publicar');
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
		eventCommentIdNew = eventCommentIdNew.replace(/[^0-9]/gi, '');

		var commentDiv = document.createElement('div');
		commentDiv.id = 'eventComment'+eventCommentIdNew+'TmpDiv';
		
		commentDiv.innerHTML = content;
		
		$('commentListDiv').appendChild(commentDiv);
		
		$('commentsCharCount'+eventCommentId).innerHTML = 'Comentário postado';
		window.setTimeout('resetCommentForm('+eventCommentId+')', 1000);
		
		_IsPublishing = false;
	};
		
	var failureFunc = function(t){

		var content = t.responseText;
		
		enableButton('postComment'+eventCommentId);
		$('commentsCharCount'+eventCommentId).innerHTML = 'Erro ao publicar o comentário!';
		
		fieldObj.disabled = false;
		_IsPublishing     = false;
		
		if( isDebug() )
			debug(content);
	};
	
	var urlAjax = _webRoot+'/event/saveComment/eventId/'+eventId+'?comment='+comment;

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function deleteComment(eventCommentId){

	showIndicator();
	
	var successFunc = function(t){

		try{
			
			$('commentListDiv').removeChild( $('eventComment'+eventCommentId+'Div') );
		}catch(e){
			
			$('commentListDiv').removeChild( $('eventComment'+eventCommentId+'TmpDiv') );
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
	
	var urlAjax = _webRoot+'/event/deleteComment/eventCommentId/'+eventCommentId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function resetCommentForm(eventCommentId){
	
	eventCommentId = (eventCommentId?eventCommentId:'');
	
	hideDiv('commentButtonBarDiv');
	$('commentsCharCount'+eventCommentId).innerHTML = '140 caracteres restantes';
	$('commentsComment'+eventCommentId).disabled    = false;
	$('commentsComment'+eventCommentId).value       = 'Clique aqui para enviar seu comentário';
	
	$('commentBaseLeft').src         = $('commentBaseLeft').src.replace('Gray', '');
	$('commentBaseRight').src        = $('commentBaseRight').src.replace('Gray', '');
	$('commentBaseMiddle').className = 'baseMiddle';
}

function handleCommentFocus(fieldObj){
	
	var comment = fieldObj.value;
	if( comment=='Clique aqui para enviar seu comentário' )
		fieldObj.value = '';
	
	var eventCommentId = fieldObj.id.replace('commentsComment', '');
		
	showDiv('commentButtonBarDiv', true);
	$('commentBaseLeft').src         = $('commentBaseLeft').src.replace('baseLeft.png', 'baseLeftGray.png');
	$('commentBaseRight').src        = $('commentBaseRight').src.replace('baseRight.png', 'baseRightGray.png');
	$('commentBaseMiddle').className = 'baseMiddleGray'
}

function countChars(fieldObj){

	var leftChars = (140-fieldObj.value.length);
	
	if( leftChars < 0 )
		leftChars = 0;
	
	var eventCommentId = fieldObj.id.replace('commentsComment', '');
		
	$('commentsCharCount'+eventCommentId).innerHTML = leftChars+' caracter'+(leftChars==1?'':'es')+' restante'+(leftChars==1?'':'s');
	
	if( leftChars==0 )
		fieldObj.value = fieldObj.value.substring(0,140);
}

function showAllComments(){
	
	var eventId = $('eventId').value;
	
	putLoading('commentListDiv', false, true);
	
	var successFunc = function(t){

		var content = t.responseText;
		$('commentListDiv').innerHTML = content;
	};
	
	var urlAjax = _webRoot+'/event/getCommentList/eventId/'+eventId;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}

function confirmDelete(eventCommentId){
	
	var onclick = function(){
		
		deleteComment(eventCommentId);
	}
	
	$('deleteIcon'+eventCommentId).src     = $('deleteIcon'+eventCommentId).src.replace('icon/delete', 'button/delete');
	$('deleteIcon'+eventCommentId).onclick = onclick
}