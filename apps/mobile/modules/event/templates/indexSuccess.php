<div class="text">
<?php echo __('event.intro') ?>
</div>
<br/>
<table width="100%" cellpadding="0" cellspacing="0" class="tableMenu flat">
  <?php
  	$rankingObjList = $userSiteObj->getRankingList();
  	foreach($rankingObjList as $rankingObj):
  	
  		$events = $rankingObj->getEvents();
  ?>
	<tr onclick="goModule('event', 'search', 'rankingId', <?php echo $rankingObj->getId() ?>)">
		<td>
			<?php echo $rankingObj->getRankingName() ?><br/>
			<span><?php echo $events ?> <?php echo __('event.'.(($events==1?'event':'events'))) ?></span>
		</td>
	</tr>
  <?php endforeach; ?>
</table>