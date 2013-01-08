<?php include_partial('home/component/commonBar', array('pathList'=>array('Calculadora de fichas'=>null))); ?>
<div class="moduleIntro mt10">
	<?php echo image_tag('chipCalculator', array('align'=>'left', 'style'=>'margin-right: 15px; margin-top: -10px')) ?>
	Seja bem vindo à calculadora de fichas <b>iRank</b>.<br/>
	Ela foi criada para facilitar a divisão de fichas em seus torneios baseado nos valores das fichas que você tem disponível 
	e também no stack inicial que pretende utilizar em seu evento.<br/><br/>
	<hr class="mb20"/>
	O resultado será a distribuição ideal de fichas para cada valor disponível<br/>
	assim como uma sugestão de configuração de blinds que você pode utilizar com essa distribuição.<br/><br/>
	
	Para começar, selecione abaixo os valores das fichas que você tem disponível.
</div>
<br/>

<div id="stepPaginator">
	<?php
		echo button_tag('navigatorNext', 'Próximo', array('image'=>'next.png', 'onclick'=>'showNext()', 'class'=>'right'));
		echo button_tag('navigatorPrevious', 'Anterior', array('image'=>'previous.png', 'onclick'=>'showPrevious()', 'disabled'=>true, 'class'=>'right'));
	?>
</div>
<div class="steps">
	<div class="step" id="step-001">
		<h1>Fichas disponíveis</h1>
		<div class="chipList">
			<?php
				$chipList = array(1,5,10,25,50,100,500,1000,5000,10000);
				foreach($chipList as $chip):
			?>
			<div class="chip" id="chip-<?php echo $chip ?>" onclick="selectChip(this)" style="background-image: url('/images/chips/dimmed/chip<?php echo $chip ?>.png')">
				<div class="check"></div>
			</div>
			<?php
				endforeach;
			?>
		</div>
	</div>
	<div class="step hidden" id="step-002">
		<h1>Opções</h1>
		<div class="defaultForm">
			<div class="row">
				<div class="label">Stack inicial</div>
				<div class="field"><?php echo input_tag('startStack', null, array('maxlength'=>5, 'class'=>'required', 'id'=>'chipCalculatorStartStack')) ?></div>
				<div class="text">Quantidade de fichas que cada jogador irá iniciar o torneio</div>
			</div>
			
			<div class="row">
				<div class="label">Jogadores</div>
				<div class="field"><?php echo input_tag('players', null, array('maxlength'=>2, 'id'=>'chipCalculatorPlayers')) ?></div>
				<div class="text">(opcional)</div>
			</div>
			
			<div class="row">
				<div class="label">Tempo de jogo</div>
				<div class="field"><?php echo input_tag('gameDuration', null, array('maxlength'=>5, 'onkeyup'=>'maskTime(event)', 'id'=>'chipCalculatorGameDuration')) ?></div>
				<div class="text">Quanto tempo você quer que dure o jogo (opcional)</div>
			</div>
		</div>
	</div>
	<div class="step hidden" id="step-003">
		<h1>Resultado</h1>
		<div id="loadingResult"></div>
		<div id="chipSetResult"></div>
		<div id="chipSetResultFooter">
			Algumas configurações podem variar dependendo das fichas selecionadas e/ou stack inicial escolhido.<br/>
			Isso pode ocorrer em virtude de um cálculo de distribuição aleatória.<br/><br/>
			Caso não esteja satisfeito com a distribuição obtida , <?php echo link_to('clique aqui', '#getChipSet(true)') ?> para obter uma nova configuração aleatória.<br/>
		</div>
	</div>
<div class="clear"></div>
</div>

<script>
	setupSteps(3);
	putLoading('loadingResult', 'Calculando distribuição ideal...<br/>Por favor, aguarde.');
</script>