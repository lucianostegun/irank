<?php
	$isNew             = $eventObj->isNew();
	$pastDate          = ($isNew?false:$eventObj->isPastDate() && !$isClone);
	$confirmedPresence = ($isNew?false:$eventObj->isConfirmed($peopleId));
	$inviteStatus      = ($isNew?'none':$eventObj->getInviteStatus($peopleId));
	$visibleButtons    = $eventObj->getEnabled();

	if( !$pastDate && $inviteStatus!='deleted' )	
		include_partial('event/include/presenceBar', array('inviteStatus'=>$inviteStatus, 'visibleButtons'=>$visibleButtons));

	$pageAction = ($isClone?__('Cloning'):($eventObj->isNew()?__('Creating'):__('Editing')));
	
	if( !$eventObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;

	$pathList = array('Eventos'=>'event/index');
	
	if( $isNew ){
		
		$pathList['Novo evento'] = '';
	}else{
		
		$eventName   = $eventObj->getName();
		$rankingName = $eventObj->getRanking()->getName();
		$rankingId   = $eventObj->getRankingId();
		$pathList[$rankingName] = '#goToPage("ranking", "edit", "rankingId", '.$rankingId.', true)';
		$pathList[$eventName]   = '';
	}
		
	include_partial('home/component/commonBar', array('pathList'=>$pathList));

	$eventId  = $eventObj->getId();
	
	echo form_remote_tag(array(
		'url'=>'event/save'.($pastDate?'Result':''),
		'success'=>'handleSuccessEvent'.($pastDate?'Result':'').'(request.responseText)',
		'failure'=>'handleFailureEvent(request.responseText)',
		'encoding'=>'UTF8',
		), array( 'id'=>'eventForm' ));
	
	echo input_hidden_tag('eventId', $eventId);
	echo input_hidden_tag('isClone', $isClone);
	echo input_hidden_tag('isFreeroll', $eventObj->getIsFreeroll());
	echo input_hidden_tag('prizeConfig', $eventObj->getPrizeConfig(), array('id'=>'eventPrizeConfig'));
	echo input_hidden_tag('prizePot', $eventObj->getPrizePot(), array('id'=>'eventPrizePot'));
	echo input_hidden_tag('hasShare', $eventObj->getIsFreeroll(), array('id'=>'eventHasShare'));
	
	$isEditable = $eventObj->isEditable();
	$isMyEvent  = $eventObj->isMyEvent();
	$mode       = ($pastDate && !$isClone?'show':'form');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'event/'.$mode.'/main', array('eventObj'=>$eventObj, 'isClone'=>$isClone, 'pastDate'=>$pastDate, 'confirmedPresence'=>$confirmedPresence));
	$dhtmlxTabBarObj->addTab('player', __('Guests'), 'event/'.$mode.'/player', array('eventObj'=>$eventObj, 'hidden'=>$isNew));
	$dhtmlxTabBarObj->addTab('result', __('Result'), 'event/show/result', array('eventObj'=>$eventObj, 'hidden'=>(!$pastDate)));

	$dhtmlxTabBarObj->addTab('comments', __('Comments'), 'event/form/comments', array('eventObj'=>$eventObj, 'hidden'=>!$eventObj->getVisible()));
	$dhtmlxTabBarObj->addHandler('onSelect', 'onSelectTabEvent');
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	$facebookButton = button_tag('facebookResultResult', __('button.share'), array('image'=>'facebook.png', 'onclick'=>'shareFacebook('.$eventId.')', 'visible'=>$eventObj->getSavedResult()));
	
	if( $isEditable ):
?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php
				echo button_tag('mainSubmitResult', __('button.launchResult'), array('onclick'=>'openEventResult()', 'visible'=>$pastDate));
				echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitEvent()', 'visible'=>!$pastDate));
				
				echo $facebookButton;
			
			echo getFormLoading('event');
			echo getFormStatus('Evento salvo com sucesso!', 'Erro ao salvar as informações do evento!');
		?>
	</div>
<?php else: ?>
	<div class="buttonTabBar" id="eventMainButtonBar">
		<?php
			echo $facebookButton;
		?>
	</div>
<?php endif; ?>
</form>
<?php
	DhtmlxWindows::createWindow('rankingPlaceAdd', __('event.gamePlaceRegister'), 550, 125, 'ranking/dialog/placeAdd', array());
	DhtmlxWindows::createWindow('rankingPlayerAdd', __('ranking.playerRegister'), 380, 125, 'ranking/dialog/playerAdd', array('rankingId'=>$eventObj->getRankingId()));
	
	if( ($isEditable || $isMyEvent) )
		DhtmlxWindows::createWindow('eventResult', __('event.resultTab.intro'), 680, 550, 'event/dialog/result', array('eventObj'=>$eventObj, 'ajax'=>(!$pastDate)));
?>