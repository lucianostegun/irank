<div class="baseChannels">
	<div class="channel">
		<div class="image"><?php echo link_to(image_tag('home/money'), 'myAccount/bankroll') ?></div>
		<div class="description">
			<h1><?php echo link_to('Controle de bankroll', 'myAccount/bankroll') ?></h1>
			Ferramenta completa para controle e estatísticas de seu bankroll. 
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/stats') ?></div>
		<div class="description">
			<h1><?php echo link_to('Estatísticas', 'statistic/index') ?></h1>
			Gere gráficos de gastos, lucros, balanço e desempenho dos jogadores.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/rankingHistory') ?></div>
		<div class="description">
			<h1><?php echo link_to('Histórico', 'ranking/index') ?></h1>
			Histórico de posições, total gastos, prêmios e resultados nas datas que houveram eventos.
		</div>
	</div>
</div>