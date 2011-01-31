function enableToolbarOnIndex(){
	
	toolbarObj.enableItem('toolbarEdit');
	toolbarObj.enableItem('toolbarView');
	toolbarObj.enableItem('toolbarDelete');
	
	try{ eval('onSelect'+ucfirst(getModuleName())+'();') }catch( error ){}
}

function disableToolbarOnIndex(){
	
	toolbarObj.disableItem('toolbarEdit');
	toolbarObj.disableItem('toolbarView');
	toolbarObj.disableItem('toolbarSave');
	toolbarObj.disableItem('toolbarDelete');
}

function disableToolbarOnDelete(){
	
	toolbarObj.disableItem('toolbarEdit');
	toolbarObj.disableItem('toolbarDelete');
	toolbarObj.disableItem('toolbarSave');
	toolbarObj.enableItem('toolbarNew');
}

function showToolbar( tagId ){

	toolbarObj.showItem('toolbar'+ucfirst(tagId));
	toolbarObj.showItem('sep'+ucfirst(tagId));
}

function hideToolbar( tagId ){

	toolbarObj.hideItem('toolbar'+ucfirst(tagId));
	toolbarObj.hideItem('sep'+ucfirst(tagId));
}

function enableToolbar( tagId ){

	toolbarObj.enableItem('toolbar'+ucfirst(tagId));
}

function disableToolbar( tagId ){

	toolbarObj.disableItem('toolbar'+ucfirst(tagId));
}

function defaultOpenToEditToolbar(){
	
	enableToolbar('new');
	enableToolbar('save');
	disableToolbar('edit');
	enableToolbar('delete');
	disableToolbar('view');
	enableToolbar('index');
}

function defaultSavingToolbar(){
	
	disableToolbar('new');
	disableToolbar('save');
	disableToolbar('delete');
}

function defaultCloseToEditToolbar(){
	
	enableToolbar('new');
	disableToolbar('save');
	enableToolbar('edit');
	enableToolbar('delete');
	disableToolbar('view');
	enableToolbar('index');
}

function defaultGetNewRecordToolbar(){

	disableToolbar('new');
	enableToolbar('save');
	hideToolbar('edit');
	hideToolbar('view');
	disableToolbar('delete');
}

function defaultSuccessToolbar(){
	
	showToolbar('new');
	showToolbar('delete');
	enableToolbar('new');
	enableToolbar('delete');
	enableToolbar('save');
}

function setActionDescription( actionType, recordName ){

	var actionDescription = $('actionDescriptionDiv').innerHTML;
	
	if( actionType=='edit' )
		$('actionDescriptionDiv').innerHTML = actionDescription.replace('Visualizando', 'Editando');
	else if( actionType=='view' )
		$('actionDescriptionDiv').innerHTML = actionDescription.replace('Editando', 'Visualizando');
	else if( actionType=='new' )
		$('actionDescriptionDiv').innerHTML = 'Criando novo registro';
	else	
		$('actionDescriptionDiv').innerHTML = '<b>'+actionType+':</b> <i>'+recordName+'</i>';
}

function toggleToolbar(color){

	if( !color )
		color = '';

//	$('toolbarDiv').style.background = 'url("/images/backend/background'+ucfirst(color)+'.gif") repeat-x';
//	$('toolbarObj').style.background = 'url("/js/dhtmlx/dhtmlxToolbar/imgs/dhxtoolbar_dhx_skyblue/dhxtoolbar_bg'+(color?'_'+color:'')+'.gif")';
}