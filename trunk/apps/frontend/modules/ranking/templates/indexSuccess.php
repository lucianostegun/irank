<div class="commonBar"><span>Rankings</span></div>
<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
		<th width="200"><?php echo __('ranking.name') ?></th>
		<th><?php echo __('ranking.style') ?></th>
		<th><?php echo __('ranking.start') ?></th>
		<th><?php echo __('ranking.finish') ?></th>
		<th>Buy-in</th>
		<th><?php echo __('ranking.players') ?></th>
		<th><?php echo __('ranking.events') ?></th>
	</tr>
	<?php
		$rankingObjList = $userSiteObj->getRankingList();
		foreach($rankingObjList as $rankingObj):
			
			$link = 'goModule(\'ranking\', \'edit\', \'rankingId\', '.$rankingObj->getId().')';
	?>
	<tr onclick="<?php echo $link ?>" onmouseover="this.className='recordRowOver'" onmouseout="this.className=''">
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
</table>