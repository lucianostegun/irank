<?php
	$pastDate = $eventObj->isPastDate();
	
	echo form_remote_tag(array(
		'url'=>'event/saveResult',
		'success'=>'handleSuccessEventResult( request.responseText )',
		'failure'=>'handleFailureEventResult( request.responseText )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'eventForm' ));
	
	echo input_hidden_tag('eventId', $eventObj->getId());
	
	echo get_partial('event/show/main', array('eventObj'=>$eventObj));
	echo get_partial('event/show/player', array('eventObj'=>$eventObj));

	$resultMode = ($eventObj->isMyEvent() && $eventObj->isEditable()?'form':'show');

	if( $pastDate ){
		
		echo get_partial('event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
		
		if( $resultMode=='form' ){
			
			echo get_partial('event/form/resultLaunch', array('eventObj'=>$eventObj));
			echo get_partial('event/form/resultPreview', array('eventObj'=>$eventObj));
		}
	}
	
	echo get_partial('event/form/comments', array('eventObj'=>$eventObj));
?>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="toggleView('info')">
		<td>&nbsp;</td>
		<th><?php echo __('event.info') ?></th>
		<td>&nbsp;</td>
	</tr>
	<tr onclick="toggleView('playerList')">
		<td>&nbsp;</td>
		<th><?php echo __('event.guests') ?></th>
		<td>&nbsp;</td>
	</tr>
	<?php if( $pastDate ): ?>
	<tr onclick="toggleView('result')">
		<td>&nbsp;</td>
		<th><?php echo __('event.result') ?></th>
		<td>&nbsp;</td>
	</tr>
	<?php endif; ?>
	<tr onclick="toggleView('comments')">
		<td>&nbsp;</td>
		<th><?php echo __('event.comments') ?></th>
		<td>&nbsp;</td>
	</tr>
	<tr onclick="getICalFile()" class="last">
		<td>&nbsp;</td>
		<th><?php echo image_tag('mobile/icon/calendar', array('align'=>'absmiddle')).__('event.iCalFile') ?></th>
		<td>&nbsp;</td>
	</tr>
</table>
</div>
<br/><br/>