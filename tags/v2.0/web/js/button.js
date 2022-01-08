function toggleButton(buttonId, type){

	buttonId = ucfirst(buttonId);
	
	if( !checkButton(buttonId) )
		return false;
	
	if( type=='over' ){

		$('button'+buttonId+'Left').style.backgroundPosition   = '0px -22px';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0px -22px';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0px -22px';
	}else{
		
		$('button'+buttonId+'Left').style.backgroundPosition   = '0px 0px';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0px 0px';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0px 0px';
	}
}

function checkButton( buttonId ){

	buttonId = ucfirst(buttonId);
	
	if( $('button'+buttonId)==null )
		return false;
	
	var disabled = $('button'+buttonId).className == 'buttonDisabled';

	return !disabled;
}

function enableButton( buttonId ){

	buttonId = ucfirst(buttonId);
	
	if( $('button'+buttonId)!=null ){
		
		$('button'+buttonId).className = 'button';
		$('button'+buttonId).disabled  = false;
	}
	
	image = $(buttonId+'Image');
	if( image!=null )
		image.src = image.src.replace('/disabled', '');
}

function disableButton( buttonId ){
	
	buttonId = ucfirst(buttonId);
	
	if( $('button'+buttonId)!=null ){
		
		$('button'+buttonId).className = 'buttonDisabled';
		$('button'+buttonId).disabled  = false;
	}

	image = $(buttonId+'Image');
	if( image!=null ){

		var imagePath = image.src.replace(/\/disabled/g, '');

		var lastPath = imagePath.match(/\/[a-zA-Z0-9-_\.]+$/);
		imagePath = imagePath.replace(lastPath, '/disabled'+lastPath);
		image.src = imagePath;
	}
}

function showButton( buttonId ){

	buttonId = ucfirst(buttonId);
	showDiv('button'+buttonId);
}

function hideButton( buttonId ){
	
	buttonId = ucfirst(buttonId);
	hideDiv('button'+buttonId);
}



function setButtonLabel( buttonId, label, icon ){

	buttonId = ucfirst(buttonId);
	
	if( $('button'+buttonId)!=null ){
		
		var button = '';
		if( icon )
			button = '<img id="EventFilterSubmitImage" align="absmiddle" style="margin-top: -2px; margin-right: 5px" src="/images/button/'+icon+'" alt="AjaxLoader" />';
		
		$('button'+buttonId+'Label').innerHTML = button+label;
	}
	
	
}