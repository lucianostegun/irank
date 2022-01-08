var _PaginatorInstanceName = null;

function handleSuccessSearch( content, instanceName ){

//	hideIndicator();
//	
//	eval('var gridboxObj = gridbox'+ucfirst(instanceName)+'Obj;');
//
//	var mode = null;
//	if( $(instanceName+'DatabaseSortDesc') )
//		mode = ($(instanceName+'DatabaseSortDesc').value=='1'?'desc':'asc');
//	
//	updateGridbox( gridboxObj, content, mode );
}

function handleFailureSearch( content ){
	
//	hideIndicator();
//	alert( 'Não foi possível concluir a pesquisa devido a um erro de processamento!' );
//	if( isDebug() )
//		debug( content );
}

function updateGridboxSearch( instanceName, limit, offset ){

	if( !instanceName )
		instanceName = getModuleName();
	else
		eval('gridboxObj = gridbox'+(instanceName==getModuleName()?'':ucfirst(instanceName))+'Obj;');

	if( isNumeric(limit) )  $(instanceName+'Limit').value  = limit;
	if( isNumeric(offset) ) $(instanceName+'Offset').value = offset;
	
	var form = $( instanceName+'Form' );
	updatePaginator( instanceName );

	var formAction  = form.action.replace('save', 'getXml');
	var urlAjax     = formAction+'?'+Form.serialize(form);
	var successFunc = function(t) {
		
		var content = t.responseText;

		disableToolbarOnIndex();
		updateGridbox(gridboxObj, content);
		hideDiv('toolbarActionDiv');
	};
		
	var failureFunc = function(t) {

		var content = t.responseText;
		
		alert( 'Não foi possível carregar as informações do grid!' );
		if( isDebug() )
			debug( content );
	};

	startLoadingGridbox( gridboxObj );

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function updatePaginator( instanceName ){

	var form       = $(instanceName+'Form');
	var formAction = form.action
	var urlAjax    = formAction+'?paginator=1&'+Form.serialize(form);

//	if( $('usingFilter')!=null )
//		$('usingFilter').value = '1';
	
	var successFunc = function(t) {

		if( instanceName==getModuleName() )
			instanceName = '';
		
		var content = t.responseText;
		var info    = content.split('<info>');
		$('paginator'+ucfirst(instanceName)+'Div').innerHTML    = info[0];
		$('totalPages'+ucfirst(instanceName)+'Div').innerHTML   = info[1];
		$('totalRecords'+ucfirst(instanceName)+'Div').innerHTML = info[2];
		$('pageLimit'+ucfirst(instanceName)+'Div').innerHTML    = info[3];
		hideDiv('projectCredit');
	};
		
	var failureFunc = function(t) {

		var content = t.responseText;
		
		alert( 'Não foi possível carregar as páginas da pesquisa!' );
		if( isDebug() )
			debug( content );
	};

	new Ajax.Request(urlAjax, {asynchronous:true, evalScripts:false, onSuccess:successFunc, onFailure:failureFunc});
}

function resetPages( instanceName ){
	
//	$(instanceName+'Offset').value = 0;
}

function setSearchParameters( instanceName ){

//	$(instanceName+'SearchParameters').value = '';
//	var form = $(instanceName+'Form');
//	
//	if( form==null )
//		return false;
//		
//	$(instanceName+'SearchParameters').value = Form.serialize(form);
}

function addSearchButton(){

//	var instanceName = _PaginatorInstanceName
//	
//	if( instanceName==null )
//		return true;

//	var html =  '<a href="javascript:void(0)" onclick="updateGridboxSearch( \''+instanceName+'\', false, 0 )">'+
//				'<img src="/images/backend/buttons/search.png"></a>';
//
//	$('searchButtonTd').innerHTML = html;
}

function updatePaginatorCount(){
	
	if( $('totalRecordsDiv')==null )
		return true;
	
	var content     = $('totalRecordsDiv').innerHTML;
	var label       = content.replace(/[0-9]/g, '');
	var recordCount = content.replace(/[^0-9]/g, '');
	
	recordCount = ((recordCount)*1)-1;
	
	$('totalRecordsDiv').innerHTML = label+' '+recordCount;
}