function doLogin(){
	
	$('#indicator').show();
	$('#loginErrorPanel').hide();
	
	var successFunc = function(content){
		
		window.location = _webRoot+'/home';
		$("#loginErrorPanel").hide("fade", 50);
		$('#indicator').hide();
		$('#headerTitle').html('Redirecionando...');
	}

	var errorFunc = function(t){
		
		$("#loginErrorPanel").fadeTo(0.00, 200, function(){ //fade
			$(this).show();
			$('#indicator').hide();
		});
		
		if( isDebug() )
			debugAdd(t.responseText);
	}
	
	var urlAjax = _webRoot+'/login/login';
	$.ajax({type:'POST', url: urlAjax, data:$('#loginForm').serialize(), error: errorFunc, success: successFunc});  
}