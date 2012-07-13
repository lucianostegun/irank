<?php
	$isNew             = $eventPersonalObj->isNew();
	$pastDate          = ($isNew?false:$eventPersonalObj->isPastDate() && !$isClone);
	$visibleButtons    = $eventPersonalObj->getEnabled();

	$pageAction = ($isClone?__('Cloning'):($eventPersonalObj->isNew()?__('Creating'):__('Editing')));
	
	$pathList = array(__('eventPersonal.title')=>'eventPersonal/index');
	
	if( $isNew )
		$pathList['Novo evento'] = '';
	else{

		$eventName = $eventPersonalObj->getEventName();		
		$pathList[$eventName] = '';
	}
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
	
	if( !$eventPersonalObj->getEnabled() || $isClone ):
?>
<script>setRecordSaved(false);</script>
<?php
	endif;

	$eventPersonalId  = $eventPersonalObj->getId();
	
	echo form_remote_tag(array(
		'url'=>'eventPersonal/save',
		'success'=>'handleSuccessEventPersonal(request.responseText)',
		'failure'=>'handleFailureEventPersonal(request.responseText)',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'eventPersonalForm' ));
	
	echo input_hidden_tag('eventPersonalId', $eventPersonalId);
	echo input_hidden_tag('isClone', $isClone);
	
	$isEditable = $eventPersonalObj->isEditable();
	$isMyEvent  = $eventPersonalObj->isMyEvent();
	$mode       = ($isMyEvent?'form':'show');
	
	$dhtmlxTabBarObj = new DhtmlxTabBar('main');
	$dhtmlxTabBarObj->addTab('main', __('Event'), 'eventPersonal/'.$mode.'/main', array('eventPersonalObj'=>$eventPersonalObj, 'isClone'=>$isClone, 'pastDate'=>$pastDate));
	$dhtmlxTabBarObj->setHeight(250);
	$dhtmlxTabBarObj->build();
	
	if( $isEditable ):
?>
	<div class="buttonTabBar" id="eventPersonalMainButtonBar">
		<?php
			echo button_tag('mainSubmit', __('button.save'), array('onclick'=>'doSubmitEventPersonal()'));
			
			echo getFormLoading('eventPersonal');
			echo getFormStatus();
		?>
	</div>
<?php endif; ?>
</form>