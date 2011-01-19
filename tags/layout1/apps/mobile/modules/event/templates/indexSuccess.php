<div class="text">
Selecione o ranking para visualizar os eventos
</div>
<br/>
<table width="100%" cellpadding="0" cellspacing="0" class="tableMenu">
  <?php
  	$rankingObjList = $userSiteObj->getRankingList();
  	foreach($rankingObjList as $rankingObj):
  	
  		$events = $rankingObj->getEvents();
  ?>
	<tr onclick="goModule('event', 'search', 'rankingId', <?php echo $rankingObj->getId() ?>)">
		<td>
			<?php echo $rankingObj->getRankingName() ?><br/>
			<span><?php echo $events ?> evento<?php echo ($events==1?'':'s') ?></span>
		</td>
	</tr>

  <?php endforeach; ?>
  
</table>