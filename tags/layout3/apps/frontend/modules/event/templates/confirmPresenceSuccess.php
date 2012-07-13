<?php
	$pathList = array('Eventos'=>'event/index');
	
	$eventName   = $eventObj->getName();
	$rankingName = $eventObj->getRanking()->getName();
	$rankingId   = $eventObj->getRankingId();
	
	$pathList[$rankingName]              = '#goToPage("ranking", "edit", "rankingId", '.$rankingId.', true)';
	$pathList[$eventName]                = '#goToPage("event", "edit", "eventId", '.$eventObj->getId().', true)';
	$pathList['Confirmação de presença'] = null;
		
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
?>


<div align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 550px; margin-top: 20px">
		<tr class="header">
			<th colspan="2"><h1>Presença confirmada!</h1></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center" class="icon">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top" class="message">
				<?php echo __('event.confirmPresence.successMessage', array('%eventName%'=>$eventObj->getEventName())) ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="link">
				<div class="separator"></div>
				<?php echo __('event.confirmPresence.link', array('%link%'=>link_to(__('ClickHere'), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')'))) ?>	
			</td>
		</tr>
	</table>
</div>