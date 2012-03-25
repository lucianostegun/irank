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

function loadSelectField(element, moduleName, updateDivId){

	$(updateDivId).innerHTML = getWaitSelect();
	
	var urlAjax = _webRoot+'/'+moduleName+'/getSelectField/'+element.name+'/'+element.value;
	new Ajax.Updater(updateDivId, urlAjax, {asynchronous:true, evalScripts:false});
}