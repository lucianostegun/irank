<?php
	$rankingObjList = $userSiteObj->getRankingList($criteria);
	foreach($rankingObjList as $rankingObj):
		
		$link = 'goModule(\'ranking\', \'edit\', \'rankingId\', '.$rankingObj->getId().')';
?>
<tr onclick="<?php echo $link ?>" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">
	<td align="left"><?php echo $rankingObj->getRankingName() ?></td>
	<td align="left"><?php echo $rankingObj->getGameStyle()->getDescription() ?></td>
	<td align="center"><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
	<td align="center"><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
	<td align="right"><?php echo Util::formatFloat($rankingObj->getDefaultBuyin(), true) ?></td>
	<td align="right"><?php echo $rankingObj->getPlayers() ?></td>
	<td align="right"><?php echo $rankingObj->getEvents() ?></td>
</tr>
<?php
	endforeach;
	
	if( count($rankingObjList)==0 ):
?>
<tr>
	<td colspan="7"><?php echo __('ranking.noRankings') ?></td>
</tr>
<?php endif; ?>