	<div class="formRow">
		<label>Notificação de eventos</label>
		<div class="formRight">
			<?php echo select_tag('emailTemplateIdEventCreateNotify', EmailTemplate::getOptionsForSelectClub($genericObj->getSettings('emailTemplateIdEventCreateNotify')), array('id'=>'settingsEmailTemplateIdEventCreateNotify')) ?>
			<div class="clear"></div>
			<div class="formNote">Template de e-mail padrão para notificação de novos eventos</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Texto padrão Facebook</label>
		<div class="formRight">
			<?php echo textarea_tag('facebookTemplate', $genericObj->getSettings('facebookTemplate'), array('style'=>'width: 500px; height: 80px', 'id'=>'settingsFacebookTemplate')) ?>
			<div class="formNote">
				<?php echo link_to('Exibir palavras chave disponíveis', '#showTags("facebook")', array('id'=>'showFacebookTagsLink')) ?>
				<?php echo link_to('Ocultar', '#hideTags("facebook")', array('class'=>'hidden', 'id'=>'hideFacebookTagsLink')) ?>
			</div>
			<div class="formNote hidden" id="facebookTemplateTags">
				Texto padrão para divulgação no Facebook, utilize as tags:<br/>
				<b>[eventName]</b> -  Para o nome do evento<br/>
				<b>[eventDateTime]</b> - Para o link (endereço) do evento no iRank<br/>
				<b>[weekDay]</b> - Dia da semana em que o evento vai acontecer<br/>
				<b>[clubName]</b> - Nome do Clube<br/>
				<b>[clubLocation]</b> - Localização do Clube<br/>
				<b>[allowedRebuys]</b> - Permite rebuys<br/>
				<b>[allowedAddons]</b> - Permite addons<br/>
				<b>[isFreeroll]</b> - É um evento gratuito (freeroll)<br/>
				<b>[rakePercent]</b> - Percentual da casa<br/>
				<b>[entranceFee]</b> - Taxa de entrada<br/>
				<b>[buyin]</b> - Valor do buyin<br/>
				<b>[blindTime]</b> - Tempo do blind<br/>
				<b>[stackChips]</b> - Ficha para início do jogo<br/>
				<b>[players]</b> - Número de jogadores<br/>
				<b>[savedResult]</b> - Resultado disponível no site
			</div>
		</div>
		<div class="clear"></div>
	</div>

	<div class="formRow">
		<label>Texto padrão Twitter</label>
		<div class="formRight">
			<?php echo textarea_tag('twitterTemplate', $genericObj->getSettings('twitterTemplate'), array('style'=>'width: 500px; height: 80px', 'id'=>'settingsTwitterTemplate')) ?>
			<div class="formNote">
				<?php echo link_to('Exibir palavras chave disponíveis', '#showTags("twitter")', array('id'=>'showTwitterTagsLink')) ?>
				<?php echo link_to('Ocultar', '#hideTags("twitter")', array('class'=>'hidden', 'id'=>'hideTwitterTagsLink')) ?>
			</div>
			<div class="formNote hidden" id="twitterTemplateTags">
				Texto padrão para divulgação no Twitter, utilize as tags:<br/>
				<b>[eventName]</b> -  Para o nome do evento<br/>
				<b>[eventDateTime]</b> - Data do evento<br/>
				<b>[weekDay]</b> - Dia da semana em que o evento vai acontecer<br/>
				<b>[clubName]</b> - Nome do Clube<br/>
				<b>[clubLocation]</b> - Localização do Clube<br/>
				<b>[allowedRebuys]</b> - Permite rebuys<br/>
				<b>[allowedAddons]</b> - Permite addons<br/>
				<b>[isFreeroll]</b> - É um evento gratuito (freeroll)<br/>
				<b>[rakePercent]</b> - Percentual da casa<br/>
				<b>[entranceFee]</b> - Taxa de entrada<br/>
				<b>[buyin]</b> - Valor do buyin<br/>
				<b>[blindTime]</b> - Tempo do blind<br/>
				<b>[stackChips]</b> - Ficha para início do jogo<br/>
				<b>[players]</b> - Número de jogadores<br/>
				<b>[savedResult]</b> - Resultado disponível no site<br/>
				<b>[eventUrl]</b> - Link (endereço) da página web do evento<br/>
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
