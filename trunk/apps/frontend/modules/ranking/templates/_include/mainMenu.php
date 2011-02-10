<?php
	$rankingObj  = $innerObj;
	$isNew       = $rankingObj->isNew();
	$isMyRanking = $rankingObj->isMyRanking();
	
	if( $isMyRanking ):
?>
	<div class="innerMenu">
	<?php if( !$isNew ): ?>
	<div class="innerItem" style="background: url('/images/icon/add.png') 10px 5px no-repeat"><?php echo link_to(__('button.newPlayer'), '#addRankingPlayer()') ?></div>
	<div class="innerItem" style="background: url('/images/icon/import.png') 10px 5px no-repeat"><?php echo link_to(__('button.importData'), '#importRankingData()') ?></div>
	<?php endif; ?>
	
	<?php if( !$isNew ): ?>
	<br/><br/>
	<div class="innerItem" style="background: url('/images/icon/delete.png') 10px 5px no-repeat"><?php echo link_to(__('button.deleteRanking'), '#doDeleteRanking()') ?></div>
	<?php endif; ?>
</div>
<?php endif; ?>