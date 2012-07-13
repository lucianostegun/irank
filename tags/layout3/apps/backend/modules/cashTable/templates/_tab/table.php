<?php
	$seats               = $cashTableObj->getSeats();
	$dealerStartPosition = $cashTableObj->getDealerStartPosition();
?>
<div class="cashTable <?php echo ($seats <= 6?'small':'large') ?>" id="cashTableArea">
	<?php
		$currentCashTableObj = new stdClass();
		
		for($tablePosition=1; $tablePosition <= $seats; $tablePosition++){
			
			$fieldName = "tablePosition$tablePosition";
			$currentCashTableObj->$fieldName = null;
		}
		
		foreach($cashTableObj->getPlayerList() as $cashTablePlayerObj):
			
			$tablePosition = $cashTablePlayerObj->getTablePosition();
			$fieldName     = "tablePosition$tablePosition";
			
			$bankroll   = $cashTablePlayerObj->getTotalBuyin();
			$peopleId   = $cashTablePlayerObj->getPeopleId();
			$peopleName = $cashTablePlayerObj->getPeople()->getName();
			
			$currentCashTableObj->$fieldName = array('peopleId'=>$peopleId,
													 'bankroll'=>$bankroll,
													 'playerName'=>$peopleName);
	?>
	<div class="seat" onclick="togglePlayer(<?php echo $tablePosition ?>)" id="seat-<?php echo $tablePosition ?>"><label id="playerName-<?php echo $tablePosition ?>"><?php echo $peopleName ?></label><span class="bankroll" id="bankroll-<?php echo $tablePosition ?>"><?php echo Util::formatFloat($bankroll, true) ?></span><span class="tablePosition"><?php echo $tablePosition ?></span></div>
	<?php endforeach; ?>
	
	<?php
		foreach($currentCashTableObj as $tablePosition=>&$cashTablePlayer):
			
			if( !is_null($cashTablePlayer) )
				continue;
			
			$tablePosition = str_replace('tablePosition', '', $tablePosition);
			$cashTablePlayer = null;
	?>
	<div class="seat empty" onclick="togglePlayer(<?php echo $tablePosition ?>)" id="seat-<?php echo $tablePosition ?>"><label id="playerName-<?php echo $tablePosition ?>">Vazio</label><span class="bankroll" id="bankroll-<?php echo $tablePosition ?>"><?php echo Util::formatFloat(0, true) ?></span><span class="tablePosition"><?php echo $tablePosition ?></span></div>
	<?php
		endforeach;
	
		$peopleObjDealer = $cashTableObj->getPeople();
		$peopleName      = 'Vazio';
		$class           = 'empty';
		
		$currentCashTableObj->dealer = null;
		
		if( is_object($peopleObjDealer) ){
			
			$class      = null;
			$peopleName = $peopleObjDealer->getName();
			$currentCashTableObj->dealer = array('peopleId'=>$peopleObjDealer->getId(),
												 'playerName'=>$peopleName);
		}
	?>
	<div class="seat dealer <?php echo $class ?>" onclick="toggleDealer()" id="seat-dealer"><label id="dealerName"><?php echo $peopleName ?></label><span class="tablePosition">dealer</span></div>
	<div id="dealerButton" class="position-<?php echo $dealerStartPosition ?>"><?php echo image_tag('backend/cashTable/dealer') ?></div>
</div>
<script>
	currentCashTableObj = <?php echo Util::parseInfo($currentCashTableObj) ?>
</script>
