	<div class="formRow">
		<label>Tempo para pendência</label>
		<div class="formRight">
			<?php echo input_tag('hoursToPending', $genericObj->getSettings('hoursToPending'), array('size'=>2, 'maxlength'=>2, 'id'=>'settingsHoursToPending')) ?>
			<div class="formNote">Tempo (em horas) para que o resultado um evento seja considerado "pendente".</div>
		</div>
		<!--<div class="clear" style="height: 25px"></div>
		<label>Texto padrão Facebook</label>
		<div class="formRight">
			<?php echo textarea_tag('facebookTemplate', $genericObj->getSettings('facebookTemplate'), array('maxlength'=>140, 'id'=>'settingsFacebookTemplate')) ?>
			<div class="formNote">
				Texto padrão para divulgação no Facebook, utilize as tags:<br/>
				<b>&lt;eventName&gt;</b> -  Para o nome do evento
				<b>&lt;eventDateTime&gt;</b> - Para o link (endereço) do evento no iRank
				<b>&lt;weekDay&gt;</b> - Dia da semana em que o evento vai acontecer
				<b>&lt;clubName&gt;</b> - Nome do Clube
				<b>&lt;clubLocation&gt;</b> - Localização do Clube
				<b>&lt;allowedRebuys&gt;</b> - Permite rebuys
				<b>&lt;allowedAddons&gt;</b> - Permite addons
				<b>&lt;isFreeroll&gt;</b> - É um evento gratuito (freeroll)
				<b>&lt;rakePercent&gt;</b> - Percentual da casa
				<b>&lt;entranceFee&gt;</b> - Taxa de entrada
				<b>&lt;buyin&gt;</b> - Valor do buyin
				<b>&lt;blindTime&gt;</b> - Tempo do blind
				<b>&lt;stackChips&gt;</b> - Ficha para início do jogo
				<b>&lt;players&gt;</b> - Número de jogadores
				<b>&lt;savedResult&gt;</b> - Resultado disponível no site
			</div>
		</div>-->
		<div class="clear" style="height: 25px"></div>
		<label>Texto padrão Twitter</label>
		<div class="formRight">
			<?php echo textarea_tag('twitterTemplate', $genericObj->getSettings('twitterTemplate'), array('id'=>'settingsTwitterTemplate')) ?>
			<div class="formNote">
				Texto padrão para divulgação no Twitter, utilize as tags:<br/>
				<b>&lt;eventName&gt;</b> -  Para o nome do evento<br/>
				<b>&lt;eventDateTime&gt;</b> - Data do evento<br/>
				<b>&lt;weekDay&gt;</b> - Dia da semana em que o evento vai acontecer<br/>
				<b>&lt;clubName&gt;</b> - Nome do Clube<br/>
				<b>&lt;clubLocation&gt;</b> - Localização do Clube<br/>
				<b>&lt;allowedRebuys&gt;</b> - Permite rebuys<br/>
				<b>&lt;allowedAddons&gt;</b> - Permite addons<br/>
				<b>&lt;isFreeroll&gt;</b> - É um evento gratuito (freeroll)<br/>
				<b>&lt;rakePercent&gt;</b> - Percentual da casa<br/>
				<b>&lt;entranceFee&gt;</b> - Taxa de entrada<br/>
				<b>&lt;buyin&gt;</b> - Valor do buyin<br/>
				<b>&lt;blindTime&gt;</b> - Tempo do blind<br/>
				<b>&lt;stackChips&gt;</b> - Ficha para início do jogo<br/>
				<b>&lt;players&gt;</b> - Número de jogadores<br/>
				<b>&lt;savedResult&gt;</b> - Resultado disponível no site<br/>
				<b>&lt;eventUrl&gt;</b> - Link (endereço) da página web do evento<br/>
				
			</div>
		</div>
		<div class="clear"></div>
	</div>
