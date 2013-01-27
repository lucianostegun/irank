<div class="defaultForm half mt5" id="ranking">

	<div class="row">
		<div class="label" id="rankingRankingNameLabel">Nome do ranking</div>
		<div class="field"><?php echo input_tag('rankingName', $rankingObj->getRankingName(), array('size'=>25, 'maxlength'=>25, 'class'=>'required', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingRankingName')) ?></div>
		<div class="help" id="rankingRankingNameHelp" title="O nome do ranking será utilizado como nome do torneio e estará sempre relacionado com seus eventos\nUtilize um nome fácil e curto, relacionado ao ano, temporada ou grupo de amigos."></div>
		<div class="error" id="rankingRankingNameError" onclick="showFormErrorDetails('ranking', 'rankingName')"></div>
	</div>
	<?php if( !$rankingObj->getRankingTag() ): ?>
	<div class="row" id="rankingRankingTagRow">
		<div class="label" id="rankingRankingTagLabel">Tag</div>
		<div class="field" id="rankingRankingTagField"><?php echo input_tag('rankingTag', null, array('size'=>20, 'maxlength'=>20, 'class'=>'required', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingRankingTag')) ?></div>
		<div class="help" id="rankingRankingTagHelp" title="Será criado um e-mail @irank.com.br que enviará de uma só vez a mesma mensagem a todos os participantes do ranking.\nTambém utilizado para gerar os permalinks do evento."></div>
		<div class="error" id="rankingRankingTagError" onclick="showFormErrorDetails('ranking', 'rankingTag')"></div>
	</div>
	<?php else: ?>
	<div class="row">
		<div class="label" id="rankingRankingTagLabel">Tag</div>
		<div class="text flex"><?php echo $rankingObj->getRankingTag() ?>@irank.com.br</div>
		<div class="help" id="rankingRankingTagHelp" title="As mensagens enviadas ao endereço <?php echo $rankingObj->getRankingTag() ?>@irank.com.br serão automaticamente enviadas a todos os participantes do ranking"><?php echo link_to(image_tag('icon/help'), '#showFormHelp("ranking", "rankingTag")') ?></div>
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
		<div class="field"><?php echo select_tag('gameStyleId', VirtualTable::getOptionsForSelect('gameStyle', $rankingObj->getGameStyleId()), array('class'=>'required', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingGameStyleId')) ?></div>
		<div class="help" id="rankingGameStyleIdHelp" title="Organiza os eventos em diferentes estilos e permite que você tenha duas temporadas diferentes com o mesmo nome."></div>
		<div class="error" id="rankingGameStyleIdError" onclick="showFormErrorDetails('ranking', 'gameStyleId')"></div>
	</div>
	<div class="row">
		<div class="label" id="rankingStartDateLabel"><?php echo __('ranking.start') ?></div>
		<div class="field"><?php echo input_date_tag('startDate', $rankingObj->getStartDate(), array('size'=>10, 'maxlength'=>10, 'class'=>'required', 'id'=>'rankingStartDate')) ?></div>
		<div class="error" id="rankingStartDateError" onclick="showFormErrorDetails('ranking', 'startDate')"></div>
		<div class="text flex">Ex: <?php echo __('dateFormat') ?></div>
	</div>
	<div class="row">
		<div class="label" id="rankingFinishDateLabel"><?php echo __('ranking.finish') ?></div>
		<div class="field"><?php echo input_date_tag('finishDate', $rankingObj->getFinishDate(), array('size'=>10, 'maxlength'=>10, 'id'=>'rankingFinishDate')) ?></div>
		<div class="error" id="rankingFinishDateError" onclick="showFormErrorDetails('ranking', 'finishDate')"></div>
		<div class="text flex">Ex: <?php echo __('dateFormat') ?></div>
	</div>
	<div class="row">
		<div class="label" id="rankingIsPrivateLabel"><?php echo __('ranking.display') ?></div>
		<div class="field"><?php echo select_tag('isPrivate', options_for_select(array('0'=>__('ranking.public'), '1'=>__('ranking.private')), $rankingObj->getIsPrivate()), array('onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingIsPrivate')) ?></div>
		<div class="help" id="rankingIsPrivateHelp" title="Define se o ranking ficará visível como um ranking público, permitindo que as informações básicas sejam visualizados por jogadores ainda não inscritos.\nExibições públicas permitem que outros jogadores solicitem a participação nos eventos para os administradores dos eventos."></div>
		<div class="error" id="rankingIsPrivateError" onclick="showFormErrorDetails('ranking', 'IsPrivate')"></div>
	</div>
	<div class="row">
		<div class="label" id="rankingRankingTypeIdLabel"><?php echo __('ranking.classify') ?></div>
		<div class="field"><?php echo select_tag('rankingTypeId', VirtualTable::getOptionsForSelect('rankingType', $rankingObj->getRankingTypeId()), array('class'=>'required', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingRankingTypeId')) ?></div>
		<div class="help" id="rankingRankingTypeIdHelp" title="Fator de classificação dos jogadores. Este campo será levado em consideração para definir a posição dos jogadores dentro do ranking."></div>
		<div class="error" id="rankingRankingTypeIdError" onclick="showFormErrorDetails('ranking', 'RankingTypeId')"></div>
	</div>
	<div class="row">
		<div class="label" id="rankingStartTimeLabel"><?php echo __('ranking.startTime') ?></div>
		<div class="field"><?php echo input_tag('startTime', $rankingObj->getStartTime('H:i'), array('size'=>5, 'maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'rankingStartTime')) ?></div>
		<div class="error" id="rankingStartTimeError" onclick="showFormErrorDetails('ranking', 'startTime')"></div>
	</div>
	<div class="row" id="rankingEntranceFeeRow">
		<div class="label" id="rankingEntranceFeeLabel"><?php echo __('ranking.entranceFee') ?></div>
		<div class="field"><?php echo input_tag('entranceFee', Util::formatFloat($rankingObj->getEntranceFee(), true), array('onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'class'=>'textR', 'id'=>'rankingEntranceFee')) ?></div>
		<div class="error" id="rankingEntranceFeeError" onclick="showFormErrorDetails('ranking', 'entranceFee')"></div>
		<div class="text flex">Ex: <?php echo __('zero.zeroZero') ?></div>
	</div>
	<div class="row">
		<div class="label" id="rankingBuyinLabel"><?php echo __('ranking.buyin') ?></div>
		<div class="field"><?php echo input_tag('buyin', Util::formatFloat($rankingObj->getBuyin(), true), array('size'=>6, 'maxlength'=>6, 'onkeyup'=>'maskCurrency(event)', 'class'=>'textR', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'id'=>'rankingBuyin')) ?></div>
		<div class="error" id="rankingBuyinError" onclick="showFormErrorDetails('ranking', 'buyin')"></div>
		<div class="help" id="rankingBuyinHelp" title="Este valor será utilizado como valor padrão sempre que um novo evento for criado.\nO valor pode ser alterado para cada evento caso seja necessário."></div>
		<div class="text flex">Ex: <?php echo __('zero.zeroZero') ?></div>
	</div>
	<div class="row">
		<div class="label" id="rankingScoreSchemaLabel"><?php echo __('ranking.scoreSchema') ?></div>
		<div class="field"><?php echo select_tag('scoreSchema', Ranking::getOptionsForSelectScoreSchema($rankingObj->getScoreSchema(), false), array('class'=>'required', 'onfocus'=>'showFormHelp(this)', 'onblur'=>'hideFormHelp(this)', 'onchange'=>'handleRankingScoreSchema(this.value)', 'id'=>'rankingScoreSchema')) ?></div>
		<div class="help" id="rankingScoreSchemaHelp" title="Define como serão calculados os pontos que cada jogador irá receber após participar de um evento.\nVocê pode escolher entre os modelos existentes ou criar uma fórmula personalizada utilizando as variáveis e funções disponíveis."></div>
		<div class="error" id="rankingScoreSchemaError" onclick="showFormErrorDetails('ranking', 'ScoreSchema')"></div>
	</div>
	<div class="row" id="rankingScoreFormulaRowDiv" style="display: <?php echo ($rankingObj->getScoreSchema()=='custom'?'block':'none')?>">
		<div class="label" id="rankingScoreFormulaLabel"><?php echo __('ranking.scoreFormula') ?></div>
		<div class="text flex" id="rankingScoreFormulaDiv"><?php echo $rankingObj->getScoreFormula(true) ?></div>
		<div class="text flex"><?php echo link_to(image_tag('icon/edit'), '#windowRankingScoreFormulaShow()', array('title'=>'Editar fórmula')) ?></div>
	</div>
	<?php include_partial('ranking/include/freeroll', array('rankingObj'=>$rankingObj)); ?>
</div>
<?php include_partial('util/include/formHelp', array('tagName'=>'ranking')) ?>