function doLogin(){
	
	var successFunc = function(t){
		
		window.location = _webRoot+'/home';
		$("#loginErrorPanel").hide("fade", 50);
	}

	var errorFunc = function(t){
		
		$("#loginErrorPanel").fadeTo(0.00, 200, function(){ //fade
			$(this).show();
		});
	}
	
	var urlAjax = _webRoot+'/login/login';
	$.ajax({type:'POST', url: urlAjax, data:$('#loginForm').serialize(), error: errorFunc, success: successFunc});  
}