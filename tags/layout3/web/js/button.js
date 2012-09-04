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

	if( $(buttonId+'Label')!=null ){
		
		var button = '';
		if( icon ){
			
			if( !(/.[a-z]{3}$/).test(icon) )
				icon += '.png';
			
			icon = 'url(/images/button/'+icon+')';
			
			if( !checkButton(buttonId) ){
				
				icon = icon.replace('button/', 'button/disabled/');
				icon = icon.replace('disabled/disabled/', 'disabled/');
			}
			
			$(buttonId+'Label').style.backgroundImage = icon;
		}
		
		$(buttonId+'Label').innerHTML = label;
	}
	
	
}

function setButtonBarStatus(buttonBarId, className){
	
	if( $(buttonBarId+'ButtonBar')==null )
		return false;
	
	$(buttonBarId+'ButtonBar').className = $(buttonBarId+'ButtonBar').className.replace(/ .*/gi, '');
	
	if( className )
		$(buttonBarId+'ButtonBar').className += ' '+className;
}