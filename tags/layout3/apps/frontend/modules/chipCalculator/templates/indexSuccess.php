<?php include_partial('home/component/commonBar', array('pathList'=>array('Calculadora de fichas'=>null))); ?>
<div class="moduleIntro mt10">
	<?php echo image_tag('chipCalculator', array('align'=>'left', 'style'=>'margin-right: 15px; margin-top: -10px')) ?>
	Seja bem vindo à calculadora de fichas <b>iRank</b>.<br/>
	Ela foi criada para facilitar a divisão de fichas em seus torneios baseado nos valores das fichas que você tem disponível 
	e também no stack inicial que pretende utilizar em seu evento.<br/><br/>
	<hr class="mb20"/>
	O resultado será a distribuição ideal de fichas para cada valor disponível<br/>
	assim como uma sugestão de configuração de blinds que você pode utilizar com essa distribuição.<br/><br/>
</div>

<?php
	echo form_tag('chipCalculator/getChipSet', array('target'=>'_blank', 'id'=>'chipCalculatorForm'));
	echo input_hidden_tag('chips', null, array('id'=>'chipCalculatorChips'));
	echo input_hidden_tag('forceRandom', null, array('id'=>'chipCalculatorForceRandom'));
?>
<div class="steps" id="start">
	<br/>
	<div class="step hidden" id="step-001">
		<h1>Início</h1>
		<div class="intro">
			Para começar, selecione o valor total em fichas que cada jogador irá iniciar o torneio.
		</div>
		<div class="defaultForm">
			<div class="row hidden" id="chipCalculatorStartStackFieldDiv">
				<div class="label">Stack inicial</div>
				<div class="field"><?php echo input_tag('startStack', null, array('maxlength'=>5, 'class'=>'required', 'id'=>'chipCalculatorStartStack')) ?></div>
			</div>
			
			<div class="text" id="chipCalculatorStartStackOptionsDiv">
				<?php
					$stackSetList = array();
					$stackSetList[] = array('name'=>'BAIXO', 'stack'=>array(100, 200, 300, 400, 500, 600, 800), 'chips'=>array(1,5,10,25,50,100));
					$stackSetList[] = array('name'=>'MÉDIO', 'stack'=>array(1000, 1500, 2000, 2500, 3000, 4000, 5000, 6000, 8000), 'chips'=>array(25,50,100,500,'1K'));
					$stackSetList[] = array('name'=>'ALTO (Deep Stack)', 'stack'=>array(10000, 15000, 20000, 30000, 40000, 50000, 100000), 'chips'=>array(100,500,'1K','5K','10K'));
					
					foreach($stackSetList as $stackSet):
				?>
				<h2>STACK <?php echo $stackSet['name'] ?><span onclick="alert(this.title)" title="Ideal para fichas <?php echo implode(' / ', $stackSet['chips']) ?>"></span></h2>
				<?php foreach($stackSet['stack'] as $stack): ?>
				<span class="stackOption" title="<?php echo $stack ?>" onclick="selectStartStack(this, '<?php echo implode(' / ', $stackSet['chips']) ?>')"><?php echo ($stack>2000 && ($stack%1000==0)?(($stack/1000).'K'):$stack) ?></span>
				<?php endforeach; ?>
				<div class="clear mt10"></div>
				<?php endforeach; ?>
			</div>

			<div class="intro note"><b>DICA:</b> As fichas de 1 e 5 podem ser utilizadas como 1000 e 5000 no caso de <a href="javascript:void(0)" class="dictionary" title="Clique para saber a definição de &quot;deep stack&quot;">deep stacks</a></div>
		</div>
	</div>
	<div class="step" id="step-002">
		<h1>Fichas disponíveis</h1>
		<div class="intro">
			Selecione entre 3 e 6 fichas que você tem disponíveis.<br/>
			Para o stack inicial de <b><span id="startStackLabel">5000</span></b> recomenda-se utilizar fichas de <b><span id="suggestChipLabel"></span></b></b>
		</div>
		<div class="defaultForm">
			<div class="chipList">
				<?php
					$chipList = array(1,5,10,25,50,100,500,1000,5000,10000);
					foreach($chipList as $chip):
				?>
				<div class="chip <?php echo ($chip<0?'active':'') ?>" id="chip-<?php echo abs($chip) ?>" onclick="selectChip(this)" style="background-image: url('/images/chips/chip<?php echo abs($chip) ?>.png')">
					<div class="check"></div>
				</div>
				<?php
					endforeach;
				?>
			</div>
		
			<div class="intro note" id="deepStackExchangeChipsTip"><b>Lembrete:</b> As fichas de 1 e 5 podem ser utilizadas como 1000 e 5000 caso seja necessário.</div>
		</div>
	</div>
	<div class="step hidden" id="step-003">
		<h1>Opções avançadas</h1>
		<div class="intro">
			Os campos abaixo irão definir a melhor estrutura de blinds para seu evento.<br/>
			Caso queira apenas calcular a divisão de fichas, clique em "Ignorar opções"
		</div>
		<div class="defaultForm">
			<div class="row">
				<div class="label">Jogadores</div>
				<div class="field"><?php echo input_tag('players', null, array('maxlength'=>2, 'id'=>'chipCalculatorPlayers')) ?></div>
			</div>
			
			<div class="row">
				<div class="label">Duração do jogo</div>
				<div class="field"><?php echo input_tag('gameDuration', null, array('maxlength'=>2, 'id'=>'chipCalculatorGameDuration')) ?></div>
				<div class="text">Quantas horas você quer que dure o jogo</div>
			</div>
			
			<div class="row">
				<div class="label">Duração do blind</div>
				<div class="field"><?php echo input_tag('blindDuration', null, array('maxlength'=>2, 'id'=>'chipCalculatorBlindDuration')) ?></div>
				<div class="text">Quantos minutos você quer que dure cada nível</div>
			</div>
			
			<div class="row">
				<div class="label">Rebuy</div>
				<div class="field"><?php echo checkbox_tag('allowRebuy', true, false, array('id'=>'chipCalculatorAllowRebuy')) ?></div>
			</div>
			<div class="row">
				<div class="label">Addon</div>
				<div class="field"><?php echo checkbox_tag('allowAddon', true, false, array('id'=>'chipCalculatorAllowAddon')) ?></div>
			</div>
			<div class="row">
				<div class="label">Ante</div>
				<div class="field"><?php echo checkbox_tag('allowAnte', true, false, array('id'=>'chipCalculatorAllowAnte')) ?></div>
			</div>
		</div>
	</div>
	<div class="step hidden" id="step-004">
		<h1>Resultado</h1>
		<div id="loadingResult"></div>
		<div id="chipSetResult"></div>
		<div id="chipSetResultFooter">
			Não gostou da distribuição? <?php echo link_to('Clique aqui', '#getChipSet(true)') ?> para obter uma nova configuração aleatória.<br/>
			<hr/>
			Algumas configurações podem variar dependendo das fichas selecionadas e/ou stack inicial escolhido.<br/>
			Isso pode ocorrer porque em alguns é feito cálculo de distribuição aleatória.<br/><br/>
		</div>
	</div>
	<div class="clear"></div>
</div>
<div id="stepPaginator">
	<?php
		echo button_tag('navigatorNext', 'Próximo', array('image'=>'next.png', 'onclick'=>'showNext()', 'class'=>'right'));
		echo button_tag('navigatorPrevious', 'Anterior', array('image'=>'previous.png', 'onclick'=>'showPrevious()', 'disabled'=>true, 'class'=>'right'));
		echo button_tag('ignore', 'Ignorar', array('image'=>'nok.png', 'onclick'=>'ignoreStep()', 'class'=>'right', 'visible'=>false, 'style'=>'margin-right: 20px'));
	?>
</div>
</form>
<script>
	setupSteps(4);
	putLoading('loadingResult', 'Calculando distribuição ideal...<br/>Por favor, aguarde.');
</script>