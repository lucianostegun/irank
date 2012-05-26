<style>

</style>

<script>

</script>

<div class="cashTable">
	<?php
		$tablePositionList = array();
		for($tablePosition=1; $tablePosition <= $cashTableObj->getSeats(); $tablePosition++ )
			$tablePositionList[$tablePosition] = null;
		
		foreach($cashTableObj->getPlayerList() as $cashTablePlayerObj):
			$tablePosition = $cashTablePlayerObj->getTablePosition();
			
			$tablePositionList[$tablePosition] = $cashTablePlayerObj;
	?>
	<div class="seat" onclick="togglePlayer(<?php echo $tablePosition ?>)" id="seat-<?php echo $tablePosition ?>"><label id="playerName-<?php echo $tablePosition ?>"><?php echo $cashTablePlayerObj->getPeople()->getName() ?></label><span class="bankRoll" id="bankRoll-<?php echo $tablePosition ?>"><?php echo Util::formatFloat($cashTablePlayerObj->getBuyin(), true) ?></span><span class="tablePosition"><?php echo $tablePosition ?></span></div>
	<?php endforeach; ?>
	
	<?php
		foreach($tablePositionList as $tablePosition=>$cashTablePlayerObj):
			if( !is_null($cashTablePlayerObj) )
				continue;
	?>
	<div class="seat empty" onclick="togglePlayer(<?php echo $tablePosition ?>)" id="seat-<?php echo $tablePosition ?>"><label id="playerName-<?php echo $tablePosition ?>">Vazio</label><span class="bankRoll" id="bankRoll-<?php echo $tablePosition ?>"><?php echo Util::formatFloat(0, true) ?></span><span class="tablePosition"><?php echo $tablePosition ?></span></div>
	<?php endforeach; ?>
</div>