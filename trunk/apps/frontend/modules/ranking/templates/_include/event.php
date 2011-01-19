<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
	<tr class="header">
		<th width="200">Evento</th>
		<th>Data/Hora</th>
		<th>Local</th>
		<th>Convidados</th>
	</tr>
	<?php foreach($rankingObj->getEventList() as $eventObj): ?>
	<tr>
		<td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')') ?></td>
		<td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
		<td><?php echo $eventObj->getEventPlace() ?></td>
		<td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getPlayers()).')' ?></td>
	</tr>
	<?php endforeach; ?>
</table>