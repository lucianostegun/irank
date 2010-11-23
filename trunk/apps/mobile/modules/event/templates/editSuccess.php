<?php echo getPageHeader('Cadastro de evento');
	if( !$eventObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
	
	$pastDate = $eventObj->isPastDate(); 
	$eventId  = $eventObj->getId();
	
	echo form_remote_tag(array(
		'url'=>'event/save'.($pastDate?'Result':''),
		'success'=>'handleSuccessEvent'.($pastDate?'Result':'').'( request.responseText )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "eventForm", "event", false, "event" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'eventForm' ));
	
	echo input_hidden_tag('eventId', $eventId);
	
	$isEditable = $eventObj->isEditable();
	$resultMode = ($isEditable?'form':'show');

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/show/main', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('player', 'Convidados', 'event/show/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	
	if( $isEditable && $pastDate ):
?>
	<div class="buttonBarForm" id="eventMainButtonBar">
		<?php
			echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitEvent()'));
		?>
		<?php echo getFormLoading('event') ?>
		<?php echo getFormStatus(); ?>
	</div>
<?php endif; ?>
</form>