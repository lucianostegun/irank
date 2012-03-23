function showIndicator( indicatorId ){

	hideFormStatusError(indicatorId);
	hideFormStatusSuccess(indicatorId);
	hidePaginator(indicatorId);
	showDiv(indicatorId+'Indicator');
}

function hideIndicator( indicatorId ){
	
	hideDiv(indicatorId+'Indicator');
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