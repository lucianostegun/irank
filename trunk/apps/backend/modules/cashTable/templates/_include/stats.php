<?php
	$numStatList  = $cashTableObj->getStats();
	$lastOpenedAt = $cashTableObj->getLastOpenedAt(null);
	$runningTime  = (is_null($lastOpenedAt)?0:(time()-$lastOpenedAt));
	
	$totalBuyin       = $cashTableObj->getTotalBuyin();
	$totalEntranceFee = $cashTableObj->getTotalEntranceFee();
	$currentValue     = $cashTableObj->getCurrentValue();
	
	echo input_hidden_tag('statsRunningTime', $runningTime);
?>
<div class="numStats mt20">
	<ul>
    	<li style="width: 80px">
    		<label id="statsTotalValue""><?php echo Util::formatFloat($totalBuyin, true) ?></label>
    		<span style="white-space: nowrap; margin-left: 16px">Buyin</span>
    	</li>
    	<li class="last">
    		<label id="statsEntranceFee"><?php echo Util::formatFloat($totalEntranceFee, true) ?></label>
    		<span>Rake</span>
    	</li>
    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>
<div class="numStats">
	<ul>
		<?php
			$i = 0;
			foreach($numStatList as $label=>$info):
				
				$i++;
				$tagName = $info['tagName'];
		?>
    	<li>
    		<label id="stats<?php echo ucfirst($tagName) ?>"><?php echo $info['value'] ?></label>
    		<label id="stats<?php echo ucfirst($tagName) ?>Previous" class="hidden"><?php echo $info['previous'] ?></label>
    		<span><?php echo $label ?></span>
    	</li>
    	<?php endforeach; ?>
    	<li class="last">
    		<label id="statsRunningTimeLabel" style="white-space: nowrap"><?php echo Util::formatTimeString($runningTime, '%hh %mm %ss') ?></label>
    		<span style="white-space: nowrap; margin-left: 16px">Tempo de jogo</span>
    	</li>
    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>