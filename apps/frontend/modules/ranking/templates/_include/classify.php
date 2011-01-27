<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
	<tr class="header">
		<th>#</th>
		<th><?php echo __('Player') ?></th>
		<th><?php echo __('Events') ?></th>
		<th><?php echo __('Score') ?></th>
		<th>B+R+A</th>
		<th><?php echo __('Profit') ?></th>
		<th><?php echo __('Balance') ?></th>
		<th><?php echo __('Average') ?></th>
	</tr>
	<?php
		$rankingType          = $rankingObj->getRankingType(true);
		$rankingPlayerObjList = $rankingObj->getClassify($rankingDate);
		$position             = 0;
		foreach($rankingPlayerObjList as $rankingPlayerObj):
  		
			$peopleObj = $rankingPlayerObj->getPeople();
	?>
	<tr>
		<td>#<?php echo (($position++)+1) ?></td>
		<td><?php echo mail_to($peopleObj->getEmailAddress(), $peopleObj->getFullName()) ?></td>
		<td align="right"><?php echo $rankingPlayerObj->getTotalEvents() ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalScore(), true, 3) ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPaid(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPrize(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalBalance(), true) ?></td>
		<td align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalAverage(), true, 3) ?></td>
	</tr>
	<?php
		endforeach;
		
		if( count($rankingPlayerObjList)==0 ):
	?>
	<tr>
		<td colspan="8"><?php echo __('ranking.classifyTab.noPlayers') ?></td>
	</tr>
	<?php endif; ?>
</table>
<div class="tabbarFooterInfo"><b>B+R+A</b> = Buy-in + Rebuys + Add-ons</div>