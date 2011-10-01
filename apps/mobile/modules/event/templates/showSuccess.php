<?php if( $eventObj->getIsFreeroll() ): ?>
	<div class="warning">
		<b>ATENÇÃO!</b><br/>
		Esta versão ainda não suporta lançamento de resultados para eventos Freeroll.
		<br/>Por favor, acesse a <?php echo link_to('versão clássica', 'home/classic') ?> para lançar os resultados deste evento.
	</div>
<?php endif; ?>
<?php
	$pastDate = $eventObj->isPastDate();
	
	echo get_partial('event/show/main', array('eventObj'=>$eventObj));
	echo get_partial('event/show/player', array('eventObj'=>$eventObj));
	echo get_partial('event/show/result', array('eventObj'=>$eventObj));
	echo get_partial('event/form/comments', array('eventObj'=>$eventObj));
	
	echo input_hidden_tag('eventId', $eventObj->getId());
?>
<div align="center">
<table width="95%" cellpadding="0" cellspacing="0" class="menu">
	<tr onclick="hideDiv('playerListDiv'); hideDiv('resultDiv'); hideDiv('commentsDiv'); showDiv('infoDiv'); goTop()">
		<td>&nbsp;</td>
		<th><?php echo __('event.info') ?></th>
		<td>&nbsp;</td>
	</tr>
	<tr onclick="hideDiv('infoDiv'); hideDiv('resultDiv'); hideDiv('commentsDiv'); showDiv('playerListDiv'); goTop()">
		<td>&nbsp;</td>
		<th><?php echo __('event.guests') ?></th>
		<td>&nbsp;</td>
	</tr>
	<?php if( $pastDate ): ?>
	<tr onclick="hideDiv('infoDiv'); hideDiv('playerListDiv'); hideDiv('commentsDiv'); showDiv('resultDiv'); goTop()">
		<td>&nbsp;</td>
		<th><?php echo __('event.result') ?></th>
		<td>&nbsp;</td>
	</tr>
	<?php endif; ?>
	<tr onclick="hideDiv('infoDiv'); hideDiv('resultDiv'); hideDiv('playerListDiv'); showDiv('commentsDiv'); goTop()">
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