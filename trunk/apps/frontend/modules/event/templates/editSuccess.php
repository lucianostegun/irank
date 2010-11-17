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
	
	$mode = ($pastDate?'show':'form');

	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/'.$mode.'/main', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('member', 'Convidados', 'event/'.$mode.'/member', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/form/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
?>
	<div class="buttonBarForm" id="eventMainButtonBar">
		<?php
			echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitEvent()'));
			if( !$pastDate ){
				
				echo button_tag('confirmPresence', 'Confirmar presença', array('onclick'=>'doConfirmPresence()', 'image'=>'../icon/ok.png', 'visible'=>(!$confirmedPresence && $eventObj->getEnabled())));
				echo button_tag('cancelPresence', 'Cancelar presença', array('onclick'=>'doCancelPresence()', 'image'=>'../icon/nok.png', 'visible'=>($confirmedPresence)));
			}
			echo button_tag('deleteEvent', 'Excluir evento', array('onclick'=>'doDeleteEvent()', 'image'=>'../icon/delete'));
		?>
		<?php echo getFormLoading('event') ?>
		<?php echo getFormStatus(); ?>
	</div>
</form>