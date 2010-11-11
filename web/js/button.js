function toggleButton(buttonId, type){

	buttonId = ucfirst(buttonId);
	
	if( !checkButton(buttonId) )
		return false;
	
	if( type=='over' ){

		$('button'+buttonId+'Left').style.backgroundPosition   = '0 -22';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0 -22';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0 -22';
	}else{
		
		$('button'+buttonId+'Left').style.backgroundPosition   = '0 0';
		$('button'+buttonId+'Middle').style.backgroundPosition = '0 0';
		$('button'+buttonId+'Right').style.backgroundPosition  = '0 0';
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
		
		image.src = image.src.replace(/\/disabled/g, '');
		image.src = image.src.replace('/button/', '/button/disabled/');
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