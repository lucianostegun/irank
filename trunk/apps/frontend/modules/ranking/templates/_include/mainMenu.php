<?php
	$rankingObj  = $innerObj;
	$isNew       = $rankingObj->isNew();
	$isMyRanking = ($isNew || $rankingObj->isMyRanking());
	
	if( $isMyRanking ):
?>
<div class="innerMenu" style="display: <?php echo ($isNew?'none':'block') ?>" id="mainMenuRanking">
	<div class="innerItem" style="background: url('/images/icon/add.png') 10px 5px no-repeat"><?php echo link_to(__('button.newPlayer'), '#addRankingPlayer()') ?></div>
	<div class="innerItem" style="background: url('/images/icon/import.png') 10px 5px no-repeat"><?php echo link_to(__('button.importData'), '#importRankingData()') ?></div>
	
	<br/><br/>
	<div class="innerItem" style="background: url('/images/icon/delete.png') 10px 5px no-repeat"><?php echo link_to(__('button.deleteRanking'), '#doDeleteRanking()') ?></div>
</div>
<?php endif; ?>