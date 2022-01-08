<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top" width="500">
			<div class="row">
				<div class="label" id="rankingRankingNameLabel"><?php echo __('ranking.name') ?></div>
				<div class="field"><?php echo input_tag('rankingName', $rankingObj->getRankingName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'rankingRankingName')) ?></div>
				<div class="error" id="rankingRankingNameError" onclick="showFormErrorDetails('ranking', 'rankingName')"></div>
			</div>
			<?php if( !$rankingObj->getRankingTag() ): ?>
			<div class="row" id="rankingBuildEmailGroupRowDiv">
				<div class="label">Criar grupo de e-mail</div>
				<div class="fieldCheckbox" id="rankingBuildEmailGroupField"><?php echo checkbox_tag('buildEmailGroup', true, false, array('onclick'=>'toggleEmailAlias(this.checked)', 'id'=>'rankingBuildEmailGroup')) ?></div>
				<div class="help" id="rankingBuildEmailGroupHelp" title="Cria um e-mail @irank.com.br que envia de uma só vez a mesma mensagem a todos os participantes do ranking"><?php echo link_to(image_tag('icon/help'), '#showFormHelp("rankingBuildEmailGroup")') ?></div>
			</div>
			<?php endif; ?>
			<?php if( !$rankingObj->getRankingTag() ): ?>
			<div class="row" id="rankingRankingTagRow" style="display: none">
				<div class="label" id="rankingRankingTagLabel"><?php echo __('ranking.rankingTag') ?></div>
				<div class="field" id="rankingRankingTagField"><?php echo input_tag('rankingTag', 'a_', array('size'=>20, 'maxlength'=>20, 'class'=>'required', 'id'=>'rankingRankingTag')) ?></div>
				<div class="textFlex" id="rankingRankingTagText">@irank.com.br</div>
				<div class="error" id="rankingRankingTagError" onclick="showFormErrorDetails('ranking', 'rankingTag')"></div>
			</div>
			<?php else: ?>
			<div class="row">
				<div class="label" id="rankingRankingTagLabel"><?php echo __('ranking.rankingTag') ?></div>
				<div class="textFlex"><?php echo $rankingObj->getRankingTag() ?>@irank.com.br</div>
				<div class="help" id="rankingRankingTagHelp" title="As mensagens enviadas ao endereço <?php echo $rankingObj->getRankingTag() ?>@irank.com.br serão automaticamente enviadas a todos os participantes do ranking"><?php echo link_to(image_tag('icon/help'), '#showFormHelp("rankingRankingTag")') ?></div>
				<?php echo input_hidden_tag('rankingTag', $rankingObj->getRankingTag(), array('id'=>'rankingRankingTag')) ?>
			</div>
			<?php endif; ?>
			<?php if( !$rankingObj->isNew() ): ?>
			<div class="row">
				<div class="label" id="rankingRankingCreditLabel"><?php echo __('ranking.rankingCredit') ?></div>
				<div class="field" id="rankingRankingCreditField"><?php echo Util::formatFloat($rankingObj->getCredit(), true) ?> [<?php echo link_to(__('details'), '#showFreerollDetails()') ?>]</div>
			</div>
			<?php endif; ?>
			<div class="row">
				<div class="label" id="rankingGameStyleIdLabel"><?php echo __('ranking.style') ?></div>
				<div class="field"><?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingObj->getGameStyleId()), array('class'=>'required', 'id'=>'rankingGameStyleId')) ?></div>
				<div class="error" id="rankingGameStyleIdError" onclick="showFormErrorDetails('ranking', 'gameStyleId')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingStartDateLabel"><?php echo __('ranking.start') ?></div>
				<div class="field"><?php echo input_date_tag('startDate', $rankingObj->getStartDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'rankingStartDate')) ?></div>
				<div class="error" id="rankingStartDateError" onclick="showFormErrorDetails('ranking', 'startDate')"></div>
				<div class="textFlex">Ex: <?php echo __('dateFormat') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingFinishDateLabel"><?php echo __('ranking.finish') ?></div>
				<div class="field"><?php echo input_date_tag('finishDate', $rankingObj->getFinishDate(), array('size'=>10, 'maxlength'=>10, 'id'=>'rankingFinishDate')) ?></div>
				<div class="error" id="rankingFinishDateError" onclick="showFormErrorDetails('ranking', 'finishDate')"></div>
				<div class="textFlex">Ex: <?php echo __('dateFormat') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingIsPrivateLabel"><?php echo __('ranking.display') ?></div>
				<div class="field"><?php echo select_tag('isPrivate', options_for_select(array('0'=>__('ranking.public'), '1'=>__('ranking.private')), $rankingObj->getIsPrivate()), array('id'=>'rankingIsPrivate')) ?></div>
				<div class="error" id="rankingIsPrivateError" onclick="showFormErrorDetails('ranking', 'IsPrivate')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingRankingTypeIdLabel"><?php echo __('ranking.classify') ?></div>
				<div class="field"><?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingObj->getRankingTypeId()), array('id'=>'rankingRankingTypeId')) ?></div>
				<div class="error" id="rankingRankingTypeIdError" onclick="showFormErrorDetails('ranking', 'RankingTypeId')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingBuyinLabel"><?php echo __('ranking.buyin') ?></div>
				<div class="field"><?php echo input_tag('buyin', Util::formatFloat($rankingObj->getBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'rankingBuyin')) ?></div>
				<div class="error" id="rankingBuyinError" onclick="showFormErrorDetails('ranking', 'buyin')"></div>
				<div class="textFlex">Ex: <?php echo __('zero.zeroZero') ?></div>
			</div>
			<div class="row">
				<div class="label" id="rankingScoreSchemaLabel"><?php echo __('ranking.scoreSchema') ?></div>
				<div class="field"><?php echo select_tag('scoreSchema', Ranking::getOptionsForSelectScoreSchema($rankingObj->getScoreSchema()), array('onchange'=>'handleRankingFloridaSchema(this.value)', 'id'=>'rankingScoreSchema')) ?></div>
				<div class="error" id="rankingScoreSchemaError" onclick="showFormErrorDetails('ranking', 'ScoreSchema')"></div>
			</div>
			<div class="row" id="rankingScoreFormulaRowDiv" style="display: <?php echo ($rankingObj->getScoreSchema()=='custom'?'block':'none')?>">
				<div class="label" id="rankingScoreFormulaLabel"><?php echo __('ranking.scoreFormula') ?></div>
				<div class="textFlex" id="rankingScoreFormulaDiv"><?php echo $rankingObj->getScoreFormula(true) ?></div>
				<div class="textFlex"><?php echo link_to(image_tag('icon/edit'), '#windowRankingScoreFormulaShow()', array('title'=>'Editar fórmula')) ?></div>
			</div>
		</td>
		<td valign="top">
			<?php include_partial('ranking/include/freeroll', array('rankingObj'=>$rankingObj)); ?>
		</td>
	</tr>
</table>