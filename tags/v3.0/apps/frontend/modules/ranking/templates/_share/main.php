<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top" width="500">
			<div class="row">
				<div class="label" id="rankingRankingNameLabel"><?php echo __('ranking.name') ?></div>
				<div class="text flex"><?php echo $rankingObj->getRankingName() ?></div>
			</div>
			<?php if( $rankingObj->getRankingTag() ): ?>
			<div class="row">
				<div class="label" id="rankingRankingTagLabel"><?php echo __('ranking.rankingTag') ?></div>
				<div c	lass="text flex"><?php echo $rankingObj->getRankingTag() ?>@irank.com.br</div>
			</div>
			<?php endif; ?>
			<div class="row">
				<div class="label" id="rankingGameStyleIdLabel"><?php echo __('ranking.style') ?></div>
				<div class="text flex"><?php echo $rankingObj->getGameStyle()->getDescription() ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingStartDateLabel"><?php echo __('ranking.start') ?></div>
				<div class="text flex"><?php echo $rankingObj->getStartDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingFinishDateLabel"><?php echo __('ranking.finish') ?></div>
				<div class="text flex"><?php echo $rankingObj->getFinishDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingRankingTypeIdLabel"><?php echo __('ranking.classify') ?></div>
				<div class="text flex"><?php echo $rankingObj->getRankingType()->getDescription() ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingStartTimeLabel"><?php echo __('ranking.startTime') ?></div>
				<div class="text flex"><?php echo $rankingObj->getStartTime('H:i') ?></div>
			</div>
			<div class="row" id="rankingEntranceFeeRow">
				<div class="label" id="rankingEntranceFeeLabel"><?php echo __('ranking.entranceFee') ?></div>
				<div class="text flex"><?php echo Util::formatFloat($rankingObj->getEntranceFee(), true) ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingBuyinLabel"><?php echo __('ranking.buyin') ?></div>
				<div class="text flex"><?php echo Util::formatFloat($rankingObj->getBuyin(), true) ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingScoreSchemaLabel"><?php echo __('ranking.scoreSchema') ?></div>
				<div class="text flex"><?php echo $rankingObj->getScoreSchema(true) ?></div>
			</div>
			<div class="row" id="rankingScoreFormulaRowDiv" style="display: <?php echo ($rankingObj->getScoreSchema()=='custom'?'block':'none')?>">
				<div class="label" id="rankingScoreFormulaLabel"><?php echo __('ranking.scoreFormula') ?></div>
				<div class="text flex" id="rankingScoreFormulaDiv"><?php echo $rankingObj->getScoreFormula(true) ?></div>
			</div>
		</td>
	</tr>
</table>