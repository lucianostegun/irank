<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Artigos'=>'blog/index', '7 Dicas para organizar seu torneio'=>null)));
?>
<div class="moduleIntro">
	<h1>Dicas</h1>
	<h2>7 Dicas para organizar seu próprio torneio de Poker</h2>
	<h3>Publicado por <b>iRank</b> em <b>15/08/2012 22h40</b> nas categorias&nbsp;</h3>
	<h3 class="tags">
		<?php echo link_to('dicas', 'blog/tag/dicas') ?>, 
		<?php echo link_to('poker', 'blog/tag/poker') ?>, 
		<?php echo link_to('torneios', 'blog/tag/torneios') ?>
	</h3>
	<div class="clear"></div>
	<!-- AddThis Button BEGIN -->
	<div class="share addthis_default_style">
		<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
		<a class="addthis_button_tweet" style="position: relative; left: -10px"></a>
		<a class="addthis_counter addthis_pill_style" style="position: absolute; margin-left: 182px"></a>
	</div>
	<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-501b327e1cbc0097"></script>
	<!-- AddThis Button END -->
	<br/>
	<br/>
	<br/>
	
	<?php echo image_tag('blog/home-game.jpg') ?>
	<h1 class="imageFooter">Tudo o que você precisa saber para transformar suas noites de poker<br/>em um torneio divertido e organizado para você e seus amigos</h1>
	<br/>
	
	<p>O poker está cada vez mais popular.<br/>
	Todos os dias novas pessoas descobrem e se interessam por esse esporte que não para de crescer.</p>
	
	<p>Mas não são todos que se sentem prontos para encarar uma mesa mais experiente em uma casa de poker, onde ao invés de enfrentar os amigos
	irá enfrentar dezenas de desconhecidos de todos os estilos de jogo, além de pagar um buyin muito maior do que está acostumado.</p>
	
	<p>Mas isso não é motivo para ficar apenas nos jogos online, não é mesmo?<br/>
	Você pode organizar uma noite de poker em sua própria casa, para jogar e se divertir com os amigos, pagando um valor acessível para todos.</p>
	
	<p>Por isso preparamos este artigo para ajudar você a criar e organizar seu próprio torneio de poker, com dicas rápidas e simples que vão ajudar
	<p>a transformar sua noite de poker em um super campeonato entre os amigos.</p>
	
	<h4>1 - Jogadores</h4>
	<p>Um bom jogo de poker entre amigos aceita entre 5 e 9 jogadores na mesma mesa. Acima disso será necessário dividir os jogadores em 2 mesas 
	e abaixo disso o ideal é que se jogue um <b>Ring Game</b>.</p>
	<p>Caso seu espaço seja limitado, impedindo a criação de uma segunda mesa, crie um evento <b>Sit & Go</b>, encerrando as inscrições quando
	o evento atingir a quantidade desejada de jogadores para o início do jogo.</p>
	
	<h4>2 - Data e Hora</h4>
	<p>A melhor forma de garantir a presença dos jogadores é manter um dia e hora para a realização dos jogadores. Dessa forma todos
	terão reservado um dia na semana para as famosas noites de poker com os amigos.</p>
	<p>Defina um horário para chegada, um horário para o início. Incentive a pontualidade combinando uma quantidade diferenciada em fichas 
	para aqueles que chegarem no horário.</p>
	
	<h4>3 - Valores</h4>
	<p>Defina os valores do Buyin, Rebuy e Addon, deixando bem claro quantos Rebuys/Addons serão permitidos, até qual nível do jogo eles são aceitos e
	quantas fichas o jogador tem direito a cada recompra.</p>
	<p>Torneios com rebuys ilimitados acabam gerando desigualdade pois nem todos estarão dispostos a gastar tanto em uma mesma noite, tendo que controlar
	o estilo de jogo para se manter vivo na mesa.</p>
	<p>Geralmente o período de Addon dá direito a uma quantidade de maior de fichas em relação ao Buyin. Isso aumentará o pode deixando o jogo mais interessante
	e competitivo.</p> 
	
	<h4>4 - Rake</h4>
	<p>Outra opção interessante é determinar uma taxa de entrada, geralmente 10% do valor do Buyin. Esse valor pode ser usado para promover um torneio freeroll ou 
	para cobrir os gastos de quem estiver recebendo os amigos, incentivando assim a mais pessoas oferecem a casa para as noites de poker.</p>
	
	<h4>5 - Tempo e Níveis</h4>
	<p>Defina o tempo e valores de cada nível (ou blinds). Evite usar botões de dealer com tempo. Existem disponíveis diversos aplicativos para controle de blinds
	para iOS, Android e até mesmo softwares para PCs e Macs.</p>
	
	<div class="distinctText">
		<ul>
			<li><?php echo link_to('Poker Blind Timer', 'http://itunes.apple.com/us/app/poker-blind-timer/id342136771?mt=8', array('target'=>'_blank')) ?> - Aplicativo compatível com iPhone, iPad e iPod touch</li>
			<li><?php echo link_to('Poker Blinds Timer', 'https://play.google.com/store/apps/details?id=com.voxisland.pokerblinds&hl=en', array('target'=>'_blank')) ?> - Aplicativo para dispositivos Android</li>
		</ul>
	</div>
	
	<h4>6 - Premiação</h4>
	<p>É muito importante que a divisão do prêmio seja decidida antes do jogo começar. Determine a proporção de <b>Jogadores premiados</b> X <b>Valor por posição</b>.</p>
	<p>A quantidade de jogadores premiados pode ser determinada pelo valor arrecadado. Por exemplo:</p>
	<div class="distinctText">
		<ul>
			<li>Até 100,00 - 2 posições premiadas (65% e 35%)</li>
			<li>Até 200,00 - 3 posições premiadas (50%, 30% e 20%)</li>
			<li>Acima de 200,00 - 4 posições premiadas (40%, 30%, 20%, 10%)</li>
		</ul><br/>
		<i>Sugestões fictícias. Você pode determinar sua própria proporção de premiação.</i>
	</div>

	<h4>7 - Utilize o iRank</h4>
	<p>O iRank oferece a você diversas ferramentas para ajudar a organizar seu torneio.</p>
	<ul>
		<li><?php echo link_to('Crie seu ranking', 'ranking/new') ?>, configure todas as opções e cadastre seus amigos.</li>
		<li><?php echo link_to('Crie seus eventos', 'event/new') ?> e convide automaticamente todos os jogadores.</li>
		<li><?php echo link_to('Gere estatísticas', 'stats/new') ?> em gráficos e planilhas para acompanhar seu desempenho.</li>
	</ul>
	
	<p>Instale o <b><?php echo link_to('iRank App', 'http://itunes.apple.com/us/app/irank/id481129223', array('target'=>'_blank')) ?></b> disponível para iPhone, iPad e iPod touch.<br/>
	Confira as principais funções:
		
		<ul>
			<li>Confirmação de presença dos jogadores</li>
			<li>Controle de entrada de Buyins</li>
			<li>Lançar jogadores que fizeram Rebuys e Addons</li>
			<li>Controlar eliminação dos jogadores em tempo real</li>
			<li>Postar fotos e comentários direto do evento</li>
			<li>Salvar e divulgar resultado</li>
			<li>Acompanhar clasificação do ranking</li>
		</ul>
		
	<p>Caso tenha alguma dúvida ou sugestão sobre a organização de torneios caseiros de poker, entre em contato conosco.</p>
</div>
<div class="clear"></div>