<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top" width="500">
			<div class="row">
				<div class="label" id="rankingRankingNameLabel"><?php echo __('ranking.name') ?></div>
				<div class="text"><?php echo $rankingObj->getRankingName() ?></div>
			</div>
			<?php if( $rankingObj->getRankingTag() ): ?>
			<div class="row" id="rankingRankingTagRow" style="display: none">
				<div class="label" id="rankingRankingTagLabel"><?php echo __('ranking.rankingTag') ?></div>
				<div class="textFlex" id="rankingRankingTagText"><?php echo $rankingObj->getRankingTag() ?>@irank.com.br</div>
			</div>
			<?php endif; ?>
			<div class="row">
				<div class="label" id="rankingRankingCreditLabel"><?php echo __('ranking.rankingCredit') ?></div>
				<div class="text" id="rankingRankingCreditField"><?php echo Util::formatFloat($rankingObj->getCredit(), true) ?> [<?php echo link_to(__('details'), '#showFreerollDetails()') ?>]</div>
			</div>
			<div class="row">
				<div class="label" id="rankingGameStyleIdLabel"><?php echo __('ranking.style') ?></div>
				<div class="text"><?php echo $rankingObj->getGameStyle()->getDescription() ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingStartDateLabel"><?php echo __('ranking.start') ?></div>
				<div class="text"><?php echo $rankingObj->getStartDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingFinishDateLabel"><?php echo __('ranking.finish') ?></div>
				<div class="text"><?php echo $rankingObj->getFinishDate('d/m/Y') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingIsPrivateLabel"><?php echo __('ranking.display') ?></div>
				<div class="text"><?php echo ($rankingObj->getIsPrivate()?__('ranking.private'):__('ranking.public')) ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingRankingTypeIdLabel"><?php echo __('ranking.classify') ?></div>
				<div class="text"><?php echo $rankingObj->getRankingType()->getDescription() ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingBuyinLabel"><?php echo __('ranking.buyin') ?></div>
				<div class="text"><?php echo Util::formatFloat($rankingObj->getBuyin(), true) ?></div>
			</div>
		</td>
		<td valign="top">
			<?php include_partial('ranking/include/freeroll', array('rankingObj'=>$rankingObj)); ?>
		</td>
	</tr>
</table>