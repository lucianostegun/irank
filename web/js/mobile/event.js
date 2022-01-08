var _SaveResultAlert  = false;
var _lastFieldValue   = null;
var _SavingInProgress = false;

function handleSuccessEventResult(content){

	_SavingInProgress = false;
	alert('Resultado salvo com sucesso!');

	hideIndicator('event');
}

function handleFailureEventResult(content){
	
	_SavingInProgress = false;
	enableButton('mainSubmit');
	
	handleFormFieldError( request.responseText, 'eventForm', 'event', false, 'event' );
	alert('Erro ao salvar os resultados!\nVerifique os campos em destaque.');
}

function doSubmitEvent(content){

	if( _SavingInProgress ){
		
		alert('A atualização do resultado está em andamento!\nPor favor, aguarde.');
		return false;
	}

	if( !_SaveResultAlert && !confirm('ATENÇÃO!\n\nOs resultados salvos serão enviados por e-mail a todos os convidados e estarão disponíveis para edição até que outro evento posterior seja criado.\n\nDeseja prosseguir?') )
		return false;
	
	_SaveResultAlert = true;
	
	showIndicator('event');
	disableButton('mainSubmit');
	_SavingInProgress = true;
	$('eventForm').onsubmit();
}

function handleOnFocus(fieldObj){
	
	var value = fieldObj.value;
	
	_lastFieldValue = value;
	
	if( value.match(/^0(,00)?/) )
		fieldObj.value = '';
}

function handleOnBlur(fieldObj){
	
	var value = fieldObj.value;
	if( value=='' )
		fieldObj.value = _lastFieldValue;
}