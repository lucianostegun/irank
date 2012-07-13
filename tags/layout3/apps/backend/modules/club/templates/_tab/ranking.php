<div class="widget">
	<table cellpadding="0" cellspacing="0" width="100%" class="display dTable">
	    <thead> 
			<tr> 
				<th>Nome</th> 
				<th>Início</th> 
				<th>Término</th> 
				<th>Classificação</th> 
				<th>Modalidade</th> 
				<th>Formato</th> 
				<th>Etapas</th> 
			</tr> 
		</thead> 
		<tbody id="rankingLiveTbody"> 
			<?php
				$criteria = new Criteria();
				
				$clubId = $clubObj->getId();
				
				if( $clubObj->getIsNew() )
					$criteria->add( RankingLivePeer::ID, null);
				
				$rankingLiveIdList = array();
				foreach(RankingLive::getList($criteria, $clubId) as $rankingLiveObj):
					
					$rankingLiveId       = $rankingLiveObj->getId();
					$rankingLiveIdList[] = $rankingLiveId;
					
					$onclick = 'goToPage(\'rankingLive\', \'edit\', \'rankingLiveId\', '.$rankingLiveId.', true)"';
			?>
			<tr class="gradeA" onclick="<?php echo $onclick ?>" id="rankingLiveIdRow-<?php echo $rankingLiveId ?>">
				<td width="40%"><?php echo $rankingLiveObj->getRankingName() ?></td> 
				<td width="10%" align="center"><?php echo $rankingLiveObj->getStartDate('d/m/Y') ?></td> 
				<td width="10%" align="center"><?php echo $rankingLiveObj->getFinishDate('d/m/Y') ?></td> 
				<td width="10%"><?php echo $rankingLiveObj->getRankingType()->getDescription() ?></td> 
				<td width="10%"><?php echo $rankingLiveObj->getGameType()->getDescription() ?></td> 
				<td width="10%"><?php echo $rankingLiveObj->getGameStyle()->getDescription() ?></td> 
				<td width="10%"><?php echo $rankingLiveObj->getEventCount() ?></td> 
			</tr> 
			<?php endforeach; ?>
		</tbody>
	</table>
</div>