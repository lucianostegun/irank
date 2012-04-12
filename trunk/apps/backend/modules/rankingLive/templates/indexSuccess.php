<?php
	$clubId = $sf_user->getAttribute('clubId');
?>

<div class="widget">
		<div class="title"><span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck" /></span><h6>Rankings</h6></div>                          
		<table cellpadding="0" cellspacing="0" width="100%" class="display dTable withCheck" id="checkAll">
		    <thead>
				<tr>
					<th width="30"><?php echo image_tag('backend/icons/tableArrows') ?></th>
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
					foreach(RankingLive::getList($clubId) as $key=>$rankingLiveObj):
						
						$rankingLiveId       = $rankingLiveObj->getId();
						$rankingLiveIdList[] = $rankingLiveId;
						
						$onclick = 'goToPage(\'rankingLive\', \'edit\', \'rankingLiveId\', '.$rankingLiveId.')"';
				?>
				<tr class="gradeA" onmouseover="$(this).addClass('hover')" onmouseout="$(this).removeClass('hover')" id="rankingLiveIdRow-<?php echo $rankingLiveId ?>">
					<td><input type="checkbox" id="titleCheck<?php echo $key+2 ?>" name="checkRow" /></td> 
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
			</tbody>
			<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="rankingLiveNoRecordsRow">
				<td colspan="8">Nenhum registro encontrado</td>
			</tr>
        </table>  
    </div>
</div>