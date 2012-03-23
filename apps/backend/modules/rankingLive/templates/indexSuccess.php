<?php
	echo form_remote_tag(array(
		'url'=>'rankingLive/delete',
		'success'=>'handleSuccessRankingLiveIndex(request.responseText)',
		'failure'=>'handleFailureRankingLiveIndex(request.responseText)',
		'loading'=>'showIndicator("rankingLive")',
		'encoding'=>'UTF8',
	), array('id'=>'rankingLiveForm'));
?>
<article class="module width_full">
	<header></header>
	<table class="tablesorter hoHeader" cellspacing="0"> 
	<thead> 
		<tr> 
			<th class="checkbox"></th> 
			<th>Nome</th> 
			<th>Início</th> 
			<th>Término</th> 
			<th>Classificação</th> 
			<th>Modalidade</th> 
			<th>Formato</th> 
		</tr> 
	</thead> 
	<tbody id="rankingLiveTbody"> 
		<?php
			$rankingLiveIdList = array();
			foreach(RankingLive::getList() as $rankingLiveObj):
				
				$rankingLiveId       = $rankingLiveObj->getId();
				$rankingLiveIdList[] = $rankingLiveId;
				
				$onclick = 'goToPage(\'rankingLive\', \'edit\', \'rankingLiveId\', '.$rankingLiveId.')"';
		?>
		<tr onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')" id="rankingLiveIdRow-<?php echo $rankingLiveId ?>">
			<td><?php echo checkbox_tag('rankingLiveId[]', $rankingLiveId) ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getRankingName() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getStartDate('d/m/Y') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getFinishDate('d/m/Y') ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getRankingType()->getDescription() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getGameType()->getDescription() ?></td> 
			<td onclick="<?php echo $onclick ?>"><?php echo $rankingLiveObj->getGameStyle()->getDescription() ?></td> 
		</tr> 
		<?php
			endforeach;
			
			$recordCount = count($rankingLiveIdList);
		?>
		<tr class="<?php echo ($recordCount?'hidden':'') ?>" id="rankingLiveNoRecordsRow">
			<td colspan="4">Nenhum registro disponível para edição</td>
		</tr>
	</tbody> 
	</table>
<?php include_partial('home/include/paginator', array('prefix'=>'rankingLive', 'recordCount'=>$recordCount)) ?>
</article><!-- end of content manager article -->
</form>