<?php if( $isAuthenticated ): ?>
	<div id="userResume"><?php include_partial('home/resume/events') ?></div>
<?php endif; ?>


<div class="homeHighlight">
	<div class="content">
		

		<div class="contentItem active" id="homeHighlight1" style="background: url('/images/home/welcomeChips.png') right 140px no-repeat">
			<h1>Seja bem-vindo</h1>
			<p>O iRank é um site gratuito para criação<br/>e organização de rankings online para jogos de Poker.</p>
			<p>Aqui você poderá criar seus próprios rankings,<br/>definir as configurações de jogo e organizar os eventos,<br/>
			classificações e estatísticas dos torneios entre seus amigos.</p>
		</div>
		
		<div class="contentItem" id="homeHighlight2" style="background: url('/images/home/highlight/calendar.jpg') left center no-repeat"></div>
		
		<div class="contentItem" id="homeHighlight3" style="background: url('/images/temp/math.jpg') left center no-repeat"></div>
		
		<div class="contentItem" id="homeHighlight4" style="background: #303030">
			conteúdo #4
		</div>

		<div class="contentItem" id="homeHighlight5" style="background: #303030">
			conteúdo #5
		</div>
		
		<div class="descriptionBorder">
			<div class="descriptionArea"></div>
			<div class="descriptionText">
			 	<ul>
					<li id="contentItemText1" class="active"><p>Se você ainda não é cadastrado,<br/><?php echo link_to('clique aqui', 'sign') ?> e comece agora mesmo a controlar seus jogos!</p></li>
					<li id="contentItemText2"><h1>Sincronize sua agenda</h1><p>Assinando o calendário de eventos <b>iRank</b> em seu smartphone ou tablet você será sempre informado sobre os eventos que irão ocorrer próximo a você.</p></li>
					<li id="contentItemText3"><h1>Pontuação personalizada</h1><p>Defina o modelo de pontuação mais adequado ao seu grupo com a nova opção no cadastro de rankings permite a você criar sua própria fórmula para cálculo dos pontos.</p></li>
					<li id="contentItemText4"><p>Pellentesque non nibh arcu. Fusce egestas, turpis quis congue tempus, ligula risus varius tortor, ac facilisis elit leo eget tellus. Donec suscipit adipiscing arcu</p></li>
					<li id="contentItemText5"><p>Nulla aliquet ligula eget arcu adipiscing scelerisque. Quisque euismod nisl at nunc semper vel adipiscing enim imperdiet. Duis vehicula, magna vel congue tempus</p></li>
				</ul>
			</div>
		</div>
		<ul class="selector">
			<li id="contentItemSelector1" onclick="changeContentItem(1)" class="active"></li>
			<li id="contentItemSelector2" onclick="changeContentItem(2)"></li>
			<li id="contentItemSelector3" onclick="changeContentItem(3)"></li>
			<li id="contentItemSelector4" onclick="changeContentItem(4)"></li>
			<li id="contentItemSelector5" onclick="changeContentItem(5)"></li>
		</ul>
	</div>
</div>

<script>
setupHomeHighlight(5);
</script>

<div class="channels">
	<div class="channel">
		<div class="image"><?php echo image_tag('home/stats') ?></div>
		<div class="description">
			<h1>Estatísticas</h1>
			Gere gráficos de gastos, lucros, balanço e desempenho dos jogadores.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/event') ?></div>
		<div class="description">
			<h1>Notificação de eventos</h1>
			Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/photo') ?></div>
		<div class="description">
			<h1>Mural de fotos</h1>
			Compartilhar os melhores momentos dos eventos postando suas fotos no mural.
		</div>
	</div>
	<div class="channel" style="height: 88px">
		<div class="image"><?php echo image_tag('home/rankingHistory') ?></div>
		<div class="description">
			<h1>Histórico</h1>
			Histórico de posições, total gastos, prêmios e tudo sobre os rankings nas datas que houveram eventos.
		</div>
	</div>
</div>

<div class="clear"></div>
<?php
$eventPhotoIdLeft  = Util::executeOne('SELECT id FROM event_photo WHERE is_shared AND NOT deleted AND width > 365 ORDER BY RANDOM() LIMIT 1');
$eventPhotoIdRight = Util::executeOne('SELECT id FROM event_photo WHERE is_shared AND NOT deleted AND width > 365 AND id <> '.$eventPhotoIdLeft.' ORDER BY RANDOM() LIMIT 1');

$zoomLeft  = 'home/eventPhoto?id='.$eventPhotoIdLeft.'&zoom=1';
$zoomRight = 'home/eventPhoto?id='.$eventPhotoIdRight.'&zoom=1';
?>

<div id="photoVote">
	<h1>Concurso de fotos</h1>
	<div class="intro">Escolha a melhor entre duas fotos postadas pelos jogadores</div>
	<div class="photo" onmouseover="showOptionBar('left')" onmouseout="hideOptionBar('left')" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdLeft ?>') center center no-repeat">
		<div class="optionBar" id="optionBarLeft">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomLeft, array('rel'=>'lightbox')) ?>
			</div>
			<div class="option report" title="denunciar foto" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	<div class="photo" onmouseover="showOptionBar('right')" onmouseout="hideOptionBar('right')" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdRight ?>') center center no-repeat">
		<div class="optionBar" id="optionBarRight">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomRight, array('rel'=>'lightbox')) ?>
			</div>
			<div class="option report" title="denunciar foto" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	<div class="clear"></div>
	<div class="links">
		<?php echo link_to('regulamento', 'photoConquest/rules') ?> | <?php echo link_to('classificação atual', 'photoConquest/ranking') ?>
	</div>
</div>

<div class="clear"></div>
<br/>











<div class="baseChannels">
	<div class="channel">
		<div class="image"><?php echo image_tag('home/tour') ?></div>
		<div class="description">
			<h1>iRank tour</h1>
			Faça um passeio virtual e conheça todas as funcionalidades do site.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/event') ?></div>
		<div class="description">
			<h1>Notificação de eventos</h1>
			Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/photo') ?></div>
		<div class="description">
			<h1>Mural de fotos</h1>
			Compartilhar os melhores momentos dos eventos postando suas fotos no mural.
		</div>
	</div>
</div>