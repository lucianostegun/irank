<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable classifyTable">
	<tr class="header">
		<th class="first" ></th>
		<th >#</th>
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
		$rankingPosition      = 0;
		$peopleIdCurrent      = $sf_user->getAttribute('peopleId');
		$lastRankingPosition  = null;
		$positionChangeIcon   = 'blank.gif';
		$positionChangeTitle  = 'Primeira participação no ranking';
		
		foreach($rankingPlayerObjList as $rankingPlayerObj):
  		
			$peopleObj = $rankingPlayerObj->getPeople();
			$peopleId  = $peopleObj->getId();
			
			if( !$rankingPlayerObj->getTotalEvents() )
				continue;
			
			$class = ($peopleId==$peopleIdCurrent?'itsMe':'');
			$rankingPosition++;
			
			if( $rankingDate ){
				
				$lastRankingPosition = Util::executeOne('SELECT get_previous_player_position('.$rankingObj->getId().', '.$peopleId.', \''.Util::formatDate($rankingDate).'\')');
				$positionChangeIcon  = (is_null($lastRankingPosition)?'blank.gif':($rankingPosition < $lastRankingPosition?'misc/up2':($rankingPosition>$lastRankingPosition?'misc/down2':'misc/neutral2')));
				$positionChangeTitle = (is_null($lastRankingPosition)?'Primeira participação no ranking':($rankingPosition < $lastRankingPosition?"Subiu da {$lastRankingPosition}ª para a {$rankingPosition}ª posição":($rankingPosition>$lastRankingPosition?"Caiu da {$lastRankingPosition}ª para a {$rankingPosition}ª posição":"Se manteve na {$rankingPosition}ª posição")));
			}
	?>
	<tr class="<?php echo $class ?>">
		<td style="width: 20px; text-align: center"><?php echo image_tag($positionChangeIcon, array('title'=>$positionChangeTitle)) ?></td>
		<td style="width: 25px; text-align: right">#<?php echo $rankingPosition ?></td>
		<td><?php echo mail_to($peopleObj->getEmailAddress(), $peopleObj->getFullName()) ?></td>
		<td style="width: 60px" align="right"><?php echo $rankingPlayerObj->getTotalEvents() ?></td>
		<td style="width: 60px" align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalScore(), true, 3) ?></td>
		<td style="width: 60px" align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPaid(), true) ?></td>
		<td style="width: 60px" align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalPrize(), true) ?></td>
		<td style="width: 60px" align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalBalance(), true) ?></td>
		<td style="width: 60px" align="right"><?php echo Util::formatFloat($rankingPlayerObj->getTotalAverage(), true, 3) ?></td>
	</tr>
	<?php
		endforeach;
		
		if( count($rankingPlayerObjList)==0 ):
	?>
	<tr>
		<td colspan="9"><?php echo __('ranking.classifyTab.noPlayers') ?></td>
	</tr>
	<?php endif; ?>
	<tr>
		<td colspan="9" class="footer"><b>B+R+A</b> = Buy-in + Rebuys + Add-ons</td>
	</tr>
</table>