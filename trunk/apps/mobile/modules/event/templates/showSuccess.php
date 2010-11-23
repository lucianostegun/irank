<?php echo getPageHeader('Visualização de evento') ?>
<?php
	$eventId = $eventObj->getId();
	echo input_hidden_tag('eventId', $eventId);
	
	$confirmedPresence = $eventObj->isConfirmed($peopleId);
	$pastDate          = $eventObj->isPastDate();
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', 'Evento', 'event/show/main', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->addTab('player', 'Convidados', 'event/show/player', array('eventObj'=>$eventObj));
	if( $pastDate )
		$dhtmlxTabBarObj->addTab('result', 'Resultado', 'event/show/result', array('eventObj'=>$eventObj));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( !$pastDate ):
?>
	<div class="buttonBarForm" id="eventMainButtonBar">
		<?php echo button_tag('resultSubmit', 'Salvar', array('onclick'=>'doSubmitEventResult()')) ?>
		<?php echo button_tag('confirmPresence', 'Confirmar presença', array('onclick'=>'doConfirmPresence()', 'image'=>'../icon/ok.png', 'visible'=>!$confirmedPresence)) ?>
		<?php echo button_tag('cancelPresence', 'Cancelar presença', array('onclick'=>'doCancelPresence()', 'image'=>'../icon/nok.png', 'visible'=>$confirmedPresence)) ?>
		<?php echo getFormLoading('event') ?>
		<?php echo getFormStatus(); ?>
	</div>
<?php endif; ?>
</form>