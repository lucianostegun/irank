<?php
	$numStatList = $eventLiveObj->getStats();
?>
<div class="numStats">
	<ul>
		<?php
			$i = 0;
			foreach($numStatList as $label=>$info):
				
				$i++;
				$tagName = $info['tagName'];
		?>
    	<li class="<?php echo ($i==count($numStatList)?'last':'') ?>">
    		<label id="stats<?php echo ucfirst($tagName) ?>"><?php echo $info['value'] ?></label>
    		<label id="stats<?php echo ucfirst($tagName) ?>Previous" class="hidden"><?php echo $info['previous'] ?></label>
    		<span><?php echo $label ?></span>
    	</li>
    	<?php endforeach; ?>
    </ul>
    <div class="clear"></div>
</div>
<div class="sRoundStats">
	<ul>
		<?php
			$i = 0;
			foreach($numStatList as $label=>$info):
				$i++;
				
				$changes = $info['changes'];
				$tagName = $info['tagName'];
				$class   = ($changes>0?'roundPos':($changes<0?'roundNeg':'roundZero'));
				
				
		?>
    	<li><a href="javascript:void(0)"><span class="<?php echo $class ?>" id="stats<?php echo ucfirst($tagName) ?>Percent"><?php echo Util::formatFloat(abs($changes), true, 0) ?>%</span></a></li>
    	<?php endforeach; ?>

    </ul>
    <div class="clear"></div>
</div>
<div class="sidebarSep"></div>