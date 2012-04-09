function showIndicator( indicatorId ){

	hideFormStatusError(indicatorId);
	hideFormStatusSuccess(indicatorId);
	hidePaginator(indicatorId);
	showDiv(indicatorId+'HeaderIndicator');
	showDiv(indicatorId+'FooterIndicator');
}

function hideIndicator( indicatorId ){
	
	hideDiv(indicatorId+'HeaderIndicator');
	hideDiv(indicatorId+'FooterIndicator');
	hideDiv('mainFormIndicator');
	showPaginator(indicatorId);
}

function showPaginator( paginatorId ){
	
	paginatorId = paginatorId.replace('Form', '');
	
	showDiv(paginatorId+'Paginator');
}

function hidePaginator( paginatorId ){
	
	paginatorId = paginatorId.replace('Form', '');
	hideDiv(paginatorId+'Paginator');
}

function loadSelectField(element, moduleName, updateDivId, updateElementId){

	var elementId            = element.id;
	var onchangeFunc         = $(updateElementId).onchange;
	$(updateDivId).innerHTML = getWaitSelect();
	
	var successFunc = function(t){
		
		var content = t.responseText;
		
		$(updateDivId).innerHTML    = content;
		$(updateElementId).onchange = onchangeFunc;
	}
	
	var urlAjax = _webRoot+'/'+moduleName+'/getSelectField/'+element.name+'/'+element.value+'/prefix/'+getModuleName();
	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc});
}