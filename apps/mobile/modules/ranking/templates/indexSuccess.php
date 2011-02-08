<div align="center">
<table width="100%" cellpadding="0" cellspacing="0" class="tableMenu">
  <?php
  	$rankingObjList = $userSiteObj->getRankingList();
  	foreach($rankingObjList as $rankingObj):
  ?>
	<tr onclick="goModule('ranking', 'edit', 'rankingId', <?php echo $rankingObj->getId() ?>)">
		<td><?php echo $rankingObj->getRankingName() ?></td>
	</tr>
  <?php
  	endforeach;
  	
  	if( count($rankingObjList)==0 ):
  ?>
    <br/><div class="text"><?php echo __('ranking.noRanking') ?></div>
  <?php endif; ?>
</table>
</div>