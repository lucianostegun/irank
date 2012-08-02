function checkButton( buttonId ){

	if( $(buttonId+'Button')==null )
		return false;
	
	var disabled = $(buttonId+'Button').hasClassName('disabled');

	return !disabled;
}

function enableButton( buttonId ){

	buttonId = buttonId.replace(/Button$/, '');
	
	if( $(buttonId+'Button')==null )
		return false;
	
	$(buttonId+'Button').removeClassName('disabled');
	
	var backgroundImage = $(buttonId+'Label').style.backgroundImage;
	$(buttonId+'Label').style.backgroundImage = backgroundImage.replace('/disabled', '');
}

function disableButton( buttonId ){
	
	buttonId = buttonId.replace(/Button$/, '');
	
	if( $(buttonId+'Button')==null )
		return false;
	
		$(buttonId+'Button').addClassName('disabled');
	
	var backgroundImage = $(buttonId+'Label').style.backgroundImage;

	backgroundImage = backgroundImage.replace(/\/disabled/g, '');
	backgroundImage = backgroundImage.replace(/\/button\//g, '/button/disabled/');
	$(buttonId+'Label').style.backgroundImage = backgroundImage;
	
	return backgroundImage;
}

function showButton( buttonId ){

	showDiv(buttonId+'Button');
}

function hideButton( buttonId ){
	
	hideDiv(buttonId+'Button');
}



function setButtonLabel( buttonId, label, icon ){

	if( $(buttonId+'Button')!=null ){
		
		var button = '';
		if( icon )
			button = '<img id="EventFilterSubmitImage" align="absmiddle" style="margin-top: -2px; margin-right: 5px" src="/images/button/'+icon+'" alt="AjaxLoader" />';
		
		$(buttonId+'Button'+'Label').innerHTML = button+label;
	}
	
	
}

function setButtonBarStatus(buttonBarId, className){
	
	if( $(buttonBarId+'ButtonBar')==null )
		return false;
	
	$(buttonBarId+'ButtonBar').className = $(buttonBarId+'ButtonBar').className.replace(/ .*/gi, '');
	
	if( className )
		$(buttonBarId+'ButtonBar').className += ' '+className;
}