<div class="tabbarIntro"><?php echo __('ranking.optionsTab.intro') ?></div>
<div class="defaultForm">
<?php
	echo input_hidden_tag('options', true);
	
	foreach($rankingObj->getPrizeSplitList() as $rankingPrizeSplitObj):
	
		$paidPlaces = $rankingPrizeSplitObj->getPaidPlaces();
?>
	<div class="row">
		<div class="labelHalf"><?php echo __('ranking.optionsTab.until') ?></div>
		<div class="field"><?php echo input_tag('buyins'.$paidPlaces, $rankingPrizeSplitObj->getBuyins(), array('size'=>2, 'id'=>'rankingSplitPrizeBuyins'.$paidPlaces)) ?></div>
		<div class="label"><?php echo __('ranking.optionsTab.buyins', array('%paidPlaces%'=>$paidPlaces)) ?></div>
		<div class="field"><?php echo input_tag('percentList'.$paidPlaces, $rankingPrizeSplitObj->getPercentList(), array('size'=>18, 'onkeyup'=>'calculateTotalSplitPrize('.$paidPlaces.')', 'id'=>'rankingSplitPrizePercentList'.$paidPlaces)) ?></div>
		<div class="text" id="percent<?php echo $paidPlaces ?>PlacesTotal"></div>
	</div>
<?php endforeach; ?>
</div>