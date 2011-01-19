<?php
	$pastDate          = $eventObj->isPastDate() && !$isClone;
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	$inviteStatus      = $eventObj->getInviteStatus($peopleId);
	$visibleButtons    = $eventObj->getEnabled();
	
	if( !$pastDate )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));

	$pageAction = ($isClone?'Clonagem':($eventObj->getEnabled()?'Edição':'Criação'));
	
	if( !$eventObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;
?>
<div class="commonBar"><span>Eventos/<?php echo $pageAction ?></span></div>
<?php
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
	$isMyEvent  = $eventObj->isMyEvent();
	$mode       = ($pastDate && !$isClone?'show':'form');
	$resultMode = ($isEditable?'form':'show');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/'.$mode.'/main', array('eventObj'=>$eventObj, 'pastDate'=>$pastDate, 'confirmedPresence'=>$confirmedPresence));
	$dhtmlxTabBarObj->addTab('player', 'Convidados', 'event/'.$mode.'/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('comments', 'Comentários', 'event/form/comments', array('eventObj'=>$eventObj, 'hidden'=>!$eventObj->getVisible()));
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabEvent');
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( $isEditable || $isMyEvent ):
?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php
			if( $isEditable)				
				echo button_tag('mainSubmit', 'Salvar', array('onclick'=>'doSubmitEvent()'));
			
			if( $isMyEvent )
				echo button_tag('cloneEvent', 'Clonar evento', array('onclick'=>'cloneEvent('.$eventId.')', 'image'=>'../icon/clone'));
				
			if( $isEditable)				
				echo button_tag('deleteEvent', 'Excluir evento', array('onclick'=>'doDeleteEvent()', 'image'=>'../icon/delete', 'style'=>'float: right'));
		?>
		<?php echo getFormLoading('event') ?>
		<?php echo getFormStatus(); ?>
	</div>
<?php endif; ?>
</form>
<?php
	DhtmlxWindows::createWindow('eventPhotoView', '', 380, 125, 'event/dialog/photoView', array());
	DhtmlxWindows::createWindow('rankingPlaceAdd', 'Cadastro de locais', 550, 125, 'ranking/dialog/placeAdd', array());
?>