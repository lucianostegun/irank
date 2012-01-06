<div align="center">
<table width="100%" cellpadding="0" cellspacing="0" class="tableMenu flat">
  <?php
  	foreach($rankingObj->getEventList() as $eventObj):
  ?>
	<tr onclick="goModule('event', 'edit', 'eventId', <?php echo $eventObj->getId() ?>)">
		<td>
			<?php echo $eventObj->getEventName() ?><br/>
			<span><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?><span>
			<span>(<?php echo $eventObj->getEventPlace() ?>)<span>
		</td>
	</tr>
  <?php
  	endforeach;
  ?>
</table>
</div>