<br/>
<h1><?php echo __('resume.nextEvents') ?></h1>

<?php
	$eventCount = count($eventObjList);
	if( $eventCount==0 ):
?>
	<center><i><?php echo __('resume.noScheduledEvents') ?></i></center>
<?php else: ?>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td width="0" class="topLeft"><?php echo image_tag('mobile/form/topLeft') ?></td>
			<td width="100%" class="topMiddle"></td>
			<td width="0" class="topRight"><?php echo image_tag('mobile/form/topRight') ?></td>
		</tr>
	</table>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="tableMenu">
		<?php foreach($eventObjList as $key=>$eventObj): ?>
		<tr>
			<td onclick="goModule('event', 'edit', 'eventId', <?php echo $eventObj->getId() ?>)" class="option <?php echo ($key==0?'firstLine':'').($key==($eventCount-1)?' lastLine':'') ?>">
				<?php echo $eventObj->getEventName() ?><br/>
				<span><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' @ '.$eventObj->getRankingPlace()->getPlaceName() ?></span>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td class="baseLeft" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseLeft') ?></td>
			<td width="100%" class="baseMiddle"></td>
			<td class="baseRight" width="0" valign="bottom"><?php echo image_tag('mobile/form/baseRight') ?></td>
		</tr>
	</table>
<?php endif; ?>