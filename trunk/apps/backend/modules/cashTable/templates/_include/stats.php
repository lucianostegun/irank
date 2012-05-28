<?php
	$players      = $cashTableObj->getPlayers();
	$lastOpenedAt = $cashTableObj->getLastOpenedAt(null);
	$isClosed     = $cashTableObj->isClosed();
	$runningTime  = (is_null($lastOpenedAt)?0:(time()-$lastOpenedAt));
	
	$totalBuyin       = $cashTableObj->getTotalBuyin();
	$totalEntranceFee = $cashTableObj->getTotalEntranceFee();
	$currentValue     = $cashTableObj->getCurrentValue();
	
	echo input_hidden_tag('statsRunningTime', $runningTime);
?>
<div class="numStats mt20">
	<ul>
    	<li style="width: 80px">
    		<label id="statsTotalBuyin"><?php echo Util::formatFloat($totalBuyin, true) ?></label>
    		<span style="white-space: nowrap; margin-left: 16px">Buyin</span>
    	</li>
    	<li style="width: 80px">
    		<label id="statsTotalEntranceFee"><?php echo Util::formatFloat($totalEntranceFee, true) ?></label>
    		<span>Rake</span>
    	</li>
    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>
<div class="numStats">
	<ul>
    	<li>
    		<label id="statsPlayers"><?php echo $players ?></label>
    		<span>Jogadores</span>
    	</li>
    	<li class="last">
    		<label id="statsRunningTimeLabel" style="white-space: nowrap">
    			<?php 
    				if( $isClosed )
    					echo 'Mesa fechada';
    				else
    					echo Util::formatTimeString($runningTime, '%hh %mm %ss');
    			?>
    		</label>
    		<span style="white-space: nowrap; margin-left: 16px">Tempo de jogo</span>
    	</li>
    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>