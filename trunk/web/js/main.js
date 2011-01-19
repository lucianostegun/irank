function handleMainSearchFocus(fieldObj){
	
	fieldObj.value = '';
}

function handleMainSearchBlur(fieldObj){
	
	if( fieldObj.value=='' )
		fieldObj.value = 'Procurar jogadores e eventos...';
}

function doQuickSearch(){
	
	
	if( $('mainSearch').value == 'Procurar jogadores e eventos...' )
		$('mainSearch').value = '';
	
	$('mainSearchForm').submit();
}