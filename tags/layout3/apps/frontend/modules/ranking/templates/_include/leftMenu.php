<?php
	if( in_array($actionName, array('share')) )
		return;
	
	$isNew       = $rankingObj->isNew();
	$isMyRanking = ($isNew || $rankingObj->isMyRanking());
?>	
<div class="innerMenu" style="display: <?php echo ($isNew && $actionName!='index'?'none':'block') ?>" id="mainMenuRanking">
	<?php if( $isNew && $actionName=='index' ): ?>
	<?php else: ?>
		<?php if( $isMyRanking ): ?>
		<div onclick="addRankingPlayer()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon add">Novo jogador</div></div>
		<div onclick="importRankingData()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon import">Importar informações</div></div>
		
		<div class="separator"></div>
		
		<div onclick="doUnsubscribeRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon unsubscribe">Sair do ranking</div></div>
		<div onclick="doDeleteRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon delete">Excluir ranking</div></div>
		<div class="separator"></div>
		<?php else: ?>
		<div class="separator"></div>
		<div onclick="doUnsubscribeRanking()" class="subitem" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')"><div class="label icon unsubscribe">Sair do ranking</div></div>
		<?php endif; ?>
	<?php endif; ?>
</div>
