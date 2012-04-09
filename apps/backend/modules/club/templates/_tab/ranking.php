<div class="inner_table">
	<table class="tablesorter hoHeader" cellspacing="0"> 
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
			$rankingLiveIdList = array();
			foreach(RankingLive::getList($clubId) as $rankingLiveObj):
				
				$rankingLiveId       = $rankingLiveObj->getId();
				$rankingLiveIdList[] = $rankingLiveId;
				
				$onclick = 'goToPage(\'rankingLive\', \'edit\', \'rankingLiveId\', '.$rankingLiveId.', true)"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="rankingLiveIdRow-<?php echo $rankingLiveId ?>">
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getRankingName() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getStartDate('d/m/Y') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getFinishDate('d/m/Y') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getRankingType()->getDescription() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getGameType()->getDescription() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getGameStyle()->getDescription() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getEventCount() ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($rankingLiveIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="rankingLiveNoRecordsRow">
			<td colspan="7">Nenhum ranking foi cadastro até o momento.<br/><?php echo link_to('Clique aqui', 'rankingLive/new') ?> para cadastrar o primeiro ranking.</td>
		</tr>
	</tbody> 
	</table>
</div>