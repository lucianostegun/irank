<?php
	$criteria = new Criteria();
	$criteria->addAscendingOrderByColumn( CashTablePeer::CASH_TABLE_NAME );
	
	if( $clubId )
		$criteria->add( ClubPeer::ID, $clubId);
	
	$startTop  = 100;
	$startLeft = 250;
	$row = 0;
	$col = 0;
	foreach(CashTable::getList($criteria) as $cashTableObj):
		
		$cashTableId  = $cashTableObj->getId();
		$seats        = $cashTableObj->getSeats();
		$onclick      = 'goToPage(\'cashTable\', \'edit\', \'cashTableId\', '.$cashTableId.')';
		
		$top  = $startTop+($row*220);
		$left = $startLeft+($col*300);
		
		$layoutTop  = $cashTableObj->getLayoutTop();
		$layoutLeft = $cashTableObj->getLayoutLeft();
		$players    = $cashTableObj->getPlayers();
		
		if( $layoutTop) $top   = $layoutTop;
		if( $layoutLeft) $left = $layoutLeft;
		
		$col++;
		
		if( $col >= 3 ){
			
			$row++;
			$col = 0;
		}
?>
<div class="cashTableLayout<?php echo ($seats>6?' full':'') ?>" ondblclick="<?php echo $onclick ?>" style="top: <?php echo $top ?>px; left: <?php echo $left ?>px" id="cashTable-<?php echo $cashTableId ?>">
	<div class="cashTableInfo tableStatus <?php echo $cashTableObj->getTableStatus() ?>"><?php echo $cashTableObj->getTableStatus(true) ?></div>
	<div class="cashTableInfo tableName"><?php echo $cashTableObj->getCashTableName() ?></div>
	<div class="cashTableInfo">Jogadores: <?php echo $players.'/'.$seats ?></div>
	<div class="mt40"></div>
	<div class="cashTableInfo base"><?php echo $cashTableObj->getGameType()->getDescription() ?> <?php echo $cashTableObj->getGameLimit()->getDescription() ?></div>
	<div class="cashTableInfo base"><?php echo Util::formatFloat($cashTableObj->getBuyin(), true) ?> + <?php echo Util::formatFloat($cashTableObj->getEntranceFee(), true) ?></div>
</div>
<?php endforeach; ?>
<div class="clear"></div>