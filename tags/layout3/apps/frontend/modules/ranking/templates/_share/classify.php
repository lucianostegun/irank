<div class="tabbarIntro">
	<div class="row">
		<div class="cell" style="width: 500px"><?php echo __('ranking.classifyTab.intro') ?></div>
	</div>
	<div class="clear"></div>
</div>
<div id="rankingClassifyDiv">
	<?php include_partial('ranking/include/classify', array('rankingObj'=>$rankingObj, 'rankingDate'=>null, 'readOnly'=>true)); ?>
</div>