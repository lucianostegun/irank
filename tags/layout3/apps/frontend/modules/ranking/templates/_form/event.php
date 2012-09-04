<div class="tabbarIntro"><?php echo __('ranking.eventsTab.intro') ?></div>
<div id="rankingPlayerDiv">
	<?php include_partial('ranking/include/event', array('rankingObj'=>$rankingObj, 'readOnly'=>false)); ?>
</div>