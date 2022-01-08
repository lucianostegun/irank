$(function() {
	
	$('.cashTableLayout').draggable({
		stop: updateCashTablePosition
	});
});

function updateCashTablePosition(event, ui){
	
	var cashTableId = event.target.id.replace(/[^0-9]/gi, '');
	var top         = ui.position.top;
	var left        = ui.position.left;
	
	var successFunc = function(content){
		
	}

	var failureFunc = function(t){
		
	}
	
	var urlAjax = _webRoot+'/cashTable/updateTablePosition/cashTableId/'+cashTableId+'/top/'+top+'/left/'+left;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}