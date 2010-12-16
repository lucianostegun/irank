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

	if( $pastDate )
		echo get_partial('event/'.$resultMode.'/result', array('eventObj'=>$eventObj));
?>
<br/>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="hideDiv('playerListDiv'); hideDiv('resultDiv'); showDiv('infoDiv'); goTop()">
		<td width="20" class="topLeft">&nbsp;</td>
		<td class="middle label">Informações</td>
		<td width="20" class="topRight">&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('resultDiv'); showDiv('playerListDiv'); goTop()">
		<td width="20" class="<?php echo ($pastDate?'left':'baseLeft') ?>">&nbsp;</td>
		<td class="<?php echo ($pastDate?'middle':'base') ?> label">Convidados</td>
		<td width="20" class="<?php echo ($pastDate?'right':'baseRight') ?>">&nbsp;</td>
	</tr>
	<?php if( $pastDate ): ?>
	<tr onclick="hideDiv('infoDiv'); hideDiv('playerListDiv'); showDiv('resultDiv'); goTop()">
		<td width="20" class="baseLeft">&nbsp;</td>
		<td class="base label">Resultado</td>
		<td width="20" class="baseRight">&nbsp;</td>
	</tr>
	<?php endif; ?>
</table>
</div>
<br/><br/>