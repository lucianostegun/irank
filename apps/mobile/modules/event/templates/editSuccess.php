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
			
			echo get_partial('event/form/resultLunch', array('eventObj'=>$eventObj));
			echo get_partial('event/form/resultPreview', array('eventObj'=>$eventObj));
		}
	}
	
	echo get_partial('event/form/comments', array('eventObj'=>$eventObj));
?>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="toggleView('info')">
		<td width="10" class="topLeft">&nbsp;</td>
		<td class="middle label"><?php echo __('event.info') ?></td>
		<td width="10" class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="toggleView('playerList')">
		<td width="10" class="left">&nbsp;</td>
		<td class="middle label"><?php echo __('event.guests') ?></td>
		<td width="10" class="right">&nbsp;</td>
	</tr>
	<?php if( $pastDate ): ?>
	<tr onclick="toggleView('result')">
		<td width="10" class="left">&nbsp;</td>
		<td class="middle label"><?php echo __('event.result') ?></td>
		<td width="10" class="right">&nbsp;</td>
	</tr>
	<?php endif; ?>
	<tr onclick="toggleView('comments')">
		<td width="10" class="left">&nbsp;</td>
		<td class="middle label"><?php echo __('event.comments') ?></td>
		<td width="10" class="right">&nbsp;</td>
	</tr>
	<tr onclick="getICalFile()">
		<td width="10" class="baseLeft">&nbsp;</td>
		<td class="base label"><?php echo image_tag('mobile/icon/calendar', array('align'=>'absmiddle')).__('event.iCalFile') ?></td>
		<td width="10" class="baseRight">&nbsp;</td>
	</tr>
</table>
</div>
<br/><br/>