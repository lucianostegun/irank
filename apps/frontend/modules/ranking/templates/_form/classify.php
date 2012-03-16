<div class="tabbarIntro">
	<div class="row">
		<div class="cell" style="width: 500px"><?php echo __('ranking.classifyTab.intro') ?></div>
		<div class="cell" style="padding-right: 15px; text-align: right; font-weight: bold"><?php echo __('ranking.classifyTab.log') ?>:</div> 
		<div class="cell">
			<?php
				$orderByList   = array(EventPeer::EVENT_DATE=>'desc');
				$eventDateList = $rankingObj->getEventDateList('d/m/Y', true, $orderByList);
				$optionList    = array();
				foreach($eventDateList as $eventDate)
					$optionList[$eventDate] = $eventDate;
					
				echo select_tag('rankingDate', $optionList, array('onchange'=>'loadRankingHistory(this.value)'));
			?>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div id="rankingClassifyDiv">
	<?php include_partial('ranking/include/classify', array('rankingObj'=>$rankingObj, 'rankingDate'=>null)); ?>
</div>