<?php
	$pastDate          = $eventObj->isPastDate() && !$isClone;
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
	if( !$pastDate )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));

	echo getPageHeader('Cadastro de evento');
	
	if( !$eventObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
	 
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
	$mode       = ($pastDate && !$isClone?'show':'form');
	$resultMode = ($isEditable?'form':'show');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/'.$mode.'/main', array('eventObj'=>$eventObj, 'pastDate'=>$pastDate, 'confirmedPresence'=>$confirmedPresence));
	$dhtmlxTabBarObj->addTab('player', 'Convidados', 'event/'.$mode.'/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( $isEditable ):
?>
	<div class="buttonBarForm" id="eventMainButtonBar">
		<?php
			echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitEvent()'));
			echo button_tag('deleteEvent', 'Excluir evento', array('onclick'=>'doDeleteEvent()', 'image'=>'../icon/delete', 'style'=>'float: right'));
		?>
		<?php echo getFormLoading('event') ?>
		<?php echo getFormStatus(); ?>
	</div>
<?php endif; ?>
</form>