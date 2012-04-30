<div style="margin: 20px 0px 5px 25px">
	Selecione uma data para visualizar o histórico do ranking: <?php echo select_tag('rankingDate', options_for_select($rankingLiveObj->getDateList(), $rankingDate), array('onchange'=>'loadRankingHistory('.$rankingLiveObj->getId().', this.value)', 'style'=>'margin-left: 10px')) ?>
</div>

<table border="0" cellspacing="0" cellpadding="0" class="gridTable">
	<tr class="header">
		<th style="width: 55px" class="first">Posição</th>
		<th>Nome</th>
		<th style="width: 80px">Pontos</th>
		<th style="width: 80px">Eventos</th>
	</tr>
	<tbody>
	<?php
		$criteria = new Criteria();
		$criteria->add( RankingLivePlayerPeer::TOTAL_EVENTS, 0, Criteria::GREATER_THAN );
		$rankingLivePlayerObjList = $rankingLiveObj->getClassify($criteria, $rankingDate);
		
		$eventPosition = 0;
		
		$peopleIdCurrent = $sf_user->getAttribute('peopleId');
		
		foreach($rankingLivePlayerObjList as $rankingLivePlayerObj):
		
			$peopleObj = $rankingLivePlayerObj->getPeople();
			
			$eventPosition++;
			$peopleId     = $peopleObj->getId();
			$peopleName   = $peopleObj->getFullName();
			$emailAddress = $peopleObj->getEmailAddress();
			$score        = $rankingLivePlayerObj->getTotalScore();
			$events       = $rankingLivePlayerObj->getTotalEvents();
			
			$class = ($peopleIdCurrent==$peopleId?'currentPlayer':'');
	?>
		<tr class="<?php echo $class ?>">
			<td align="right"><?php echo $eventPosition ?>º</td> 
			<td><?php echo $peopleName ?></td>
			<td style="text-align: right"><?php echo Util::formatFloat($score, true, 3) ?></td>
			<td style="text-align: right"><?php echo Util::formatFloat($events) ?></td>
		</tr>
	<?php endforeach; ?>
	</tbody>
</table>