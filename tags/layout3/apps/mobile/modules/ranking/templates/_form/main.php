<div id="infoDiv" align="center">
	
	<br/><br/>
	
	<table width="95%" cellpadding="0" cellspacing="0" border="0" class="mobileForm">
		<tr>
			<td colspan="3" class="formContent">
			
				<table cellpadding="0" cellspacing="0" width="100%" class="formTable">
					<tr>
						<th class="firstLine"><?php echo __('ranking.rankingName') ?></th>
						<td class="firstLine"><?php echo $rankingObj->getRankingName() ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.rankingStyle') ?></th>
						<td><?php echo $rankingObj->getGameStyle()->getDescription() ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.startDate') ?></th>
						<td><?php echo $rankingObj->getStartDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.finishDate') ?></th>
						<td><?php echo $rankingObj->getFinishDate('d/m/Y') ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.rankingType') ?></th>
						<td><?php echo ($rankingObj->getIsPrivate()?'Privado':'Público') ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.classifyType') ?></th>
						<td><?php echo $rankingObj->getRankingType()->getDescription() ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.buyin') ?></th>
						<td><?php echo Util::formatFloat($rankingObj->getBuyin(), true) ?></td>
					</tr>
					<tr>
						<th><?php echo __('ranking.heldEvents') ?></th>
						<td><?php echo sprintf('%02d', $rankingObj->getEvents()) ?></td>
					</tr>
					<tr>
						<th class="lastLine"><?php echo __('ranking.players') ?></th>
						<td class="lastLine"><?php echo sprintf('%02d', $rankingObj->getPlayers()) ?></td>
					</tr>
				</table>
							
			</td>
		</tr>
	</table>
</div>