<table width="100%" cellspacing="1" cellpadding="0" style="margin-top: 5px" class="defaultForm">
	<tr>
		<td valign="top">
			<div class="row">
				<div class="label" id="rankingRankingNameLabel">Nome</div>
				<div class="field"><?php echo input_tag('rankingName', $rankingObj->getRankingName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'id'=>'rankingRankingName')) ?></div>
				<div class="error" id="rankingRankingNameError" onclick="showFormErrorDetails('ranking', 'rankingName')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingGameStyleIdLabel">Estilo</div>
				<div class="field"><?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingObj->getGameStyleId()), array('class'=>'required', 'id'=>'rankingGameStyleId')) ?></div>
				<div class="error" id="rankingGameStyleIdError" onclick="showFormErrorDetails('ranking', 'gameStyleId')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingStartDateLabel">Início</div>
				<div class="field"><?php echo input_date_tag('startDate', $rankingObj->getStartDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'rankingStartDate')) ?></div>
				<div class="error" id="rankingStartDateError" onclick="showFormErrorDetails('ranking', 'startDate')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingFinishDateLabel">Término</div>
				<div class="field"><?php echo input_date_tag('finishDate', $rankingObj->getFinishDate(), array('size'=>10, 'maxlength'=>10, 'id'=>'rankingFinishDate')) ?></div>
				<div class="error" id="rankingFinishDateError" onclick="showFormErrorDetails('ranking', 'finishDate')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingIsPrivateLabel">Exibição</div>
				<div class="field"><?php echo select_tag('isPrivate', options_for_select(array('0'=>'Público', '1'=>'Privado'), $rankingObj->getIsPrivate()), array('id'=>'rankingIsPrivate')) ?></div>
				<div class="error" id="rankingIsPrivateError" onclick="showFormErrorDetails('ranking', 'IsPrivate')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingRankingTypeIdLabel">Classificação</div>
				<div class="field"><?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingObj->getRankingTypeId()), array('id'=>'rankingRankingTypeId')) ?></div>
				<div class="error" id="rankingRankingTypeIdError" onclick="showFormErrorDetails('ranking', 'RankingTypeId')"></div>
			</div>
			<div class="row">
				<div class="label" id="rankingDefaultBuyinLabel">Buy-in padrão</div>
				<div class="field"><?php echo input_tag('defaultBuyin', Util::formatFloat($rankingObj->getDefaultBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'style'=>'text-align: right', 'id'=>'rankingDefaultBuyin')) ?></div>
				<div class="error" id="rankingDefaultBuyinError" onclick="showFormErrorDetails('ranking', 'defaultBuyin')"></div>
				<div class="textFlex">Ex: 0,00</div>
			</div>
		</td>
	</tr>
</table>