<?php
	$isNew       = $rankingObj->isNew();
	$isMyRanking = ($isNew || $rankingObj->isMyRanking());
?>	
<div class="innerMenu">
<?php if( $isNew && $actionName=='index' ): ?>
	<div onclick="goToPage('ranking', 'new')" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon add">Novo ranking</div></div>
	<div class="separator double"></div>
<?php endif; ?>
	<div id="mainMenuRanking" style="display: <?php echo ($isNew?'none':'block') ?>">
		<?php if( $isMyRanking ): ?>
		<div onclick="addRankingPlayer()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon add">Novo jogador</div></div>
		<div onclick="importRankingData()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon import">Importar informações</div></div>
		
		<div class="separator double"></div>
		
		<div onclick="doUnsubscribeRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon unsubscribe">Sair do ranking</div></div>
		<div onclick="doDeleteRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete">Excluir ranking</div></div>
		<div class="separator"></div>
		<?php else: ?>
		<div class="separator double"></div>
		<div onclick="doUnsubscribeRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon unsubscribe">Sair do ranking</div></div>
		<?php endif; ?>
	</div>	
</div>





	
	
	
