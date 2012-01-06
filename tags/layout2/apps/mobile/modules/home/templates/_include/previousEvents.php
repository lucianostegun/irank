<br/>
<h1><?php echo __('resume.lastEvents') ?></h1>

<?php
	$eventCount = count($eventObjList);
	if( $eventCount==0 ):
?>
	<center><i><?php echo __('resume.noRealizedEvents') ?></i></center>
<?php else: ?>
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="tableMenu">
		<?php foreach($eventObjList as $key=>$eventObj): ?>
		<tr>
			<td onclick="goModule('event', 'show', 'eventId', <?php echo $eventObj->getId() ?>)" class="option <?php echo ($key==0?'firstLine':'').($key==($eventCount-1)?' lastLine':'') ?>">
				<?php echo $eventObj->getEventName() ?><br/>
				<span><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i').' @ '.$eventObj->getRankingPlace()->getPlaceName() ?></span>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php endif; ?>