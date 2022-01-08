<div class="tabbarIntro"><?php echo __('ranking.playersTab.intro') ?></div>

<div id="rankingPlayerDiv">
	<?php
		if( !$rankingObj->isNew() )
			include_partial('ranking/include/player', array('rankingObj'=>$rankingObj, 'readOnly'=>false));
	?>
</div>
