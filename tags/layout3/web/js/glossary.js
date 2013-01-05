function searchPokerTerm(){
	
	var term = $('glossaryPokerTerm').value;
	if( !term )
		return false;
	
	showIndicator();
	
	var successFunc = function(t){
		
		$('termDescription').innerHTML = '<hr/><h1 class="header">'+term+'</h1>'+t.responseText;
		hideIndicator();
	}
		
	var failureFunc = function(t){
	
		$('termDescription').innerHTML = '<h1>Termo não encontrado!</h1>';
		hideIndicator();
	}
	
	var urlAjax  = _webRoot+'/glossary/getTerm?term='+term;
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}