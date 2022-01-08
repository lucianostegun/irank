var _LastFormReplyId  = null
var _IsSendingComment = false;

function sendComment(eventCommentId){

	if( _IsSendingComment )
		return true;
	
	_IsSendingComment = true;
	
	eventCommentId = (eventCommentId?eventCommentId:'');

	var fieldObj     = $('eventCommentComment'+eventCommentId)
	var comment      = fieldObj.value;
	var eventId      = $('eventId').value;
	var eventPhotoId = $('eventCommentEventPhotoId').value;
	var isPhoto      = (eventPhotoId!='');
	
	fieldObj.className = 'eventComment';
	
	if( !comment || comment==i18n_event_commentTab_commentText ){
		
		fieldObj.className = 'eventCommentError';
		fieldObj.title     = i18n_event_commentTab_typeSomething;
		_IsSendingComment  = false;
		return false;
	}
	
	comment = comment.replace(/[\n\r]/g, '|n');
	comment = urlencode(comment);
	
	disableButton('postComment'+eventCommentId);
	$('commentsCharCount'+eventCommentId).innerHTML = i18n_event_commentTab_publishing;
	
	fieldObj.disabled = true;
	
	var successFunc = function(t){

		_IsSendingComment = false;
		
		var content = t.responseText;
		
		var eventCommentIdNew = content.match(/eventComment[0-9]*Div/)+'';
		eventCommentIdNew     = eventCommentIdNew.replace(/[^0-9]/gi, '');
		
		var commentDiv = document.createElement('div');
		commentDiv.id = 'event'+(isPhoto?'Photo':'')+'Comment'+eventCommentIdNew+'TmpDiv';
		
		commentDiv.innerHTML = content;		
		
		$('comment'+(isPhoto?'Photo':'')+'ListDiv').appendChild(commentDiv);
		
		removeLastReplyForm(isPhoto);
		
		adjustContentTab();
		
		resetCommentForm(eventCommentId);
	};
		
	var failureFunc = function(t){

		_IsSendingComment = false;
		
		var content = t.responseText;
		
		enableButton('postComment'+eventCommentId);
		$('commentsCharCount'+eventCommentId).innerHTML = i18n_event_commentTab_publishingError;
		
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
	
	var divId    = 'event'+(isPhoto?'Photo':'')+'Comment'+eventCommentId+'Div';
	var divIdTmp = 'event'+(isPhoto?'Photo':'')+'Comment'+eventCommentId+'TmpDiv';

	hideDiv(divId);
	hideDiv(divIdTmp);
	
	var successFunc = function(t){

		try{

			$('comment'+(isPhoto?'Photo':'')+'ListDiv').removeChild( $(divId) );
		}catch(e){
			
			$('comment'+(isPhoto?'Photo':'')+'ListDiv').removeChild( $(divIdTmp) );
		}
		
		if( eventCommentId==_LastFormReplyId )
			_LastFormReplyId = null;
	};
		
	var failureFunc = function(t){

		var content = t.responseText;

		alert(i18n_event_commentsTab_commentDeleteError);
		
		showDiv(divId);
		showDiv(divIdTmp);
		
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
	
	// O campo vai ser null quando estiver vendo pela página /event/share
	if( $('commentsCharCount'+eventCommentId)==null )
		return;
	
	$('commentsCharCount'+eventCommentId).innerHTML  = '140 '+i18n_leftChars;
	$('eventCommentComment'+eventCommentId).disabled = false;
	$('eventCommentComment'+eventCommentId).value    = i18n_event_commentTab_commentText;
	
	_LastFormReplyId = null;
}

function handleCommentFocus(fieldObj){
	
	var comment = fieldObj.value;
	if( comment==i18n_event_commentTab_commentText )
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
		
	$('commentsCharCount'+eventCommentId).innerHTML = leftChars+' '+(leftChars==1?i18n_leftChar:i18n_leftChars);
	
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

function removeLastReplyForm(isPhoto){

	if( _LastFormReplyId )
		$('event'+(isPhoto?'Photo':'')+'Comment'+_LastFormReplyId+'Div').removeChild($('replyForm'+_LastFormReplyId+'Div'));
	
	_LastFormReplyId = null;
}

function replyComment(eventCommentId, isPhoto){

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
	
	$('event'+(isPhoto?'Photo':'')+'Comment'+eventCommentId+'Div').appendChild(formDiv);
	showDiv('commentsCharCount'+eventCommentId, true);
	showDiv('commentsPostButton'+eventCommentId, true);
	
	$('eventCommentComment'+eventCommentId).focus();
	
	adjustContentTab();
}