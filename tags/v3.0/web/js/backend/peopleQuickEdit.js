$(function() {
	
	$('#peopleQuickEditDialog').dialog({
		autoOpen: false,
		modal: true,
		resizable: false,
		width: 650,
		height: 450,
		buttons: {
			Ok: function() {
				doQuickSavePeople();
			},
			Cancelar: function() {
				closePeopleQuickEditDialog();
			}
		}
	});
});

function doQuickSavePeople(){
	
	$('#peopleQuickEditForm').submit()
}

var handleSuccessPeopleQuickEdit = function(content){
	
}

function handleFailurePeopleQuickEdit(content){
	
	handleFormFieldError(content, 'peopleQuickEdit');
}

function openPeopleQuickEditDialog(){

	$('#peopleQuickEditDialog').dialog('open');
}

function closePeopleQuickEditDialog(){
	
	$('#peopleQuickEditDialog').dialog('close');
}

function quickEditPeople(peopleId){
	
	var eventLiveId = $('#eventLiveId').val();
	
	showIndicator();
	
	var successFunc = function(content){
		
		var peopleObj = parseInfo(content);
		
		$('#peopleQuickEditPeopleId').val(peopleObj.id);
		$('#peopleQuickEditPeopleName').val(peopleObj.fullName);
		$('#peopleQuickEditEmailAddress').val(peopleObj.emailAddress);
		$('#peopleQuickEditPhoneNumber').val(peopleObj.phoneNumber);
		openPeopleQuickEditDialog();
		hideIndicator();
	}

	var failureFunc = function(t){
		
		alert('Não foi possível carregar as informações desta pessoa!\nPor favor, tente novamente.');
		hideIndicator();
	}
	
	var urlAjax = _webRoot+'/people/getInfo/peopleId/'+peopleId;
	AjaxRequest(urlAjax, {asynchronous:true, evalScripts:false, onFailure:failureFunc, onSuccess:successFunc});
}