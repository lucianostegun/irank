<table border="0" cellspacing="1" cellpadding="2" class="resumeRankingTable">
	<tr>
		<th colspan="8" class="title">Meus rankings</th>
	</tr>
	<?php if( count($rankingObjList) ): ?>
	<tr>
		<td></td>
		<th class="icon"><?php echo image_tag('icon/position', array('title'=>'Posição')) ?></th>
		<th class="icon"><?php echo image_tag('icon/score', array('title'=>'Pontos')) ?></th>
		<th class="icon"><?php echo image_tag('icon/bra', array('title'=>'BRA = Buyin+Rebuy+Addon')) ?></th>
		<th class="icon"><?php echo image_tag('icon/prize', array('title'=>'Ganhos')) ?></th>
		<th class="icon"><?php echo image_tag('icon/balance', array('title'=>'Balanço')) ?></th>
	</tr>
	
	<?php
		$totalPaidFinal  = 0;
		$totalPrizeFinal = 0;

		foreach($rankingObjList as $rankingObj):

			$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($rankingObj->getId(), $peopleId);
			
			$totalPaid  = $rankingPlayerObj->getTotalPaid();
			$totalPrize = $rankingPlayerObj->getTotalPrize();
			
			$totalPaidFinal  += $totalPaid;
			$totalPrizeFinal += $totalPrize;
			
			$position = $rankingPlayerObj->getPosition();
	?>
	<tr>
		<th><?php echo $rankingObj->getRankingName() ?></th>
		<td><?php echo ($position?'#'.$position:'-') ?></td>
		<td><?php echo Util::formatFloat($rankingPlayerObj->getTotalScore(), true, 3) ?></td>
		<td><?php echo Util::formatFloat($totalPaid, true) ?></td>
		<td><?php echo Util::formatFloat($totalPrize, true) ?></td>
		<td><?php echo Util::formatFloat($rankingPlayerObj->getTotalBalance(), true) ?></td>
	</tr>
	<?php endforeach; ?>
	<tr>
		<th class="totalLine"></th>
		<td class="totalLine"></td>
		<td class="totalLine"><?php echo Util::formatFloat($totalPaidFinal, true) ?></td>
		<td class="totalLine"><?php echo Util::formatFloat($totalPrizeFinal, true) ?></td>
		<td class="totalLine"></td>
		<td class="totalLine"></td>
	</tr>
	<?php else: ?>
	<tr>
		<td style="text-align: left">Você não está participando de nenhum ranking</td>
	</tr>
	<?php endif; ?>
</table>
