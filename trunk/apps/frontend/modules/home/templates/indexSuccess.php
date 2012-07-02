<div id="userResume" class="<?php echo ($isAuthenticated?'logged':'') ?>">
<?php
	if( $isAuthenticated ){
		
		include_partial('home/resume/events');
		include_partial('home/resume/quickResume');
	}
?>
<div class="clear"></div>
</div>
<div class="homeHighlight">
	<div class="content">

		<div class="contentItem active" id="homeHighlight1" style="background: url('/images/home/welcomeChips.png') right 140px no-repeat">
			<h1>Seja bem-vindo</h1>
			<p>O iRank é um site gratuito para criação<br/>e organização de rankings online para jogos de Poker.</p>
			<p>Aqui você poderá criar seus próprios rankings,<br/>definir as configurações de jogo e organizar os eventos,<br/>
			classificações e estatísticas dos torneios entre seus amigos.</p>
		</div>
		
		<div class="contentItem" id="homeHighlight2" style="background: url('/images/home/highlight/facebook.jpg') left center no-repeat"></div>
		<div class="contentItem" id="homeHighlight3" style="background: url('/images/home/highlight/calendar.jpg') left center no-repeat"></div>
		<div class="contentItem" id="homeHighlight4" style="background: url('/images/temp/math.jpg') left center no-repeat"></div>
		<div class="contentItem" id="homeHighlight5" style="background: url('/images/home/highlight/0036499001297851037.jpg') left center no-repeat"></div>
		<?php
			$photoCaption = 'Foto enviada em <b>16/02/2011</b> pelo usuário <b>lstegun</b> registrada para o evento <b>Sit & Go - NLHE #2</b>';
		?>
		<div class="descriptionBorder">
			<div class="descriptionArea"></div>
			<div class="descriptionText">
			 	<ul>
					<li id="contentItemText1" class="active"><p>Se você ainda não é cadastrado,<br/><?php echo link_to('clique aqui', 'sign') ?> e comece agora mesmo a controlar seus jogos!</p></li>
					<li id="contentItemText2"><h1><?php echo link_to('iRank no Facebook', 'http://www.facebook.com/irankpoker', array('target'=>'_blank')) ?></h1><p>Agora o <b>iRank</b> também está no Facebook.<br/>Acesse e curta nossa página para concorrer a prêmios.</p></li>
					<li id="contentItemText3"><h1><?php echo link_to('Sincronize sua agenda', 'schedule/index') ?></h1><p>Assinando o calendário de eventos <b>iRank</b> em seu smartphone ou tablet você será sempre informado sobre os eventos que irão ocorrer próximo a você.</p></li>
					<li id="contentItemText4"><h1>Pontuação personalizada</h1><p>Defina o modelo de pontuação mais adequado ao seu grupo com a nova opção no cadastro de rankings permite a você criar sua própria fórmula para cálculo dos pontos.</p></li>
					<li id="contentItemText5"><h1><?php echo link_to_image('Foto do mês', '/uploads/eventPhoto/event-57/0036499001297851037.jpg', array('rel'=>'lightbox', 'alt'=>$photoCaption)) ?></h1><p><?php echo $photoCaption ?></p></li>
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
		<div class="image"><?php echo link_to(image_tag('home/schedule'), 'schedule/index') ?></div>
		<div class="description">
			<h1><?php echo link_to('Calendário assinado', 'schedule/index') ?></h1>
			Sincronize o calendário de seu tablet ou smartphone com nossa agenda de eventos. 
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/stats') ?></div>
		<div class="description">
			<h1>Estatísticas</h1>
			Gere gráficos de gastos, lucros, balanço e desempenho dos jogadores.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('home/eventReminder') ?></div>
		<div class="description">
			<h1>Notificação de eventos</h1>
			Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
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
$eventPhotoContestObj = EventPhotoContest::getPhotoPair();

$eventPhotoIdLeft  = $eventPhotoContestObj->getEventPhotoIdLeft();
$eventPhotoIdRight = $eventPhotoContestObj->getEventPhotoIdRight();

$zoomLeft  = 'home/eventPhoto?id='.$eventPhotoIdLeft.'&zoom=1';
$zoomRight = 'home/eventPhoto?id='.$eventPhotoIdRight.'&zoom=1';
?>

<div style="position: relative">
<div class="eventLiveResumeArea">
	<?php include_partial('home/resume/eventLive', array('limit'=>3, 'offset'=>0, 'includeTitle'=>true)); ?>
</div>

<div class="eventLiveResumeArea" style="position: absolute; top: 3px; left: 393px">
	<?php include_partial('home/resume/eventLive', array('limit'=>3, 'offset'=>3, 'includeTitle'=>false)); ?>
</div>
</div>

<div id="photoVote">
	<h1>Concurso de fotos</h1>
	<div class="intro">Escolha a melhor entre duas fotos postadas pelos jogadores</div>
	<div class="photoOption" onmouseover="showOptionBar('left')" onmouseout="hideOptionBar('left')">
		<div class="photo" id="eventPhotoContestPhotoLeft" onclick="selectPhotoContest('left')" title="Clique para votar nesta foto" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdLeft ?>') center center no-repeat"></div>
		<div class="optionBar" id="optionBarLeft">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomLeft, array('id'=>'eventPhotoContestLinkLeft', 'rel'=>'lightbox')) ?>
			</div>
			<div class="option reported" id="photoContestReportLeft">Foto denunciada!</div>
			<div class="option report" title="denunciar foto" onclick="selectPhotoContest('left', true)" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	
	
	<div class="photoOption" onmouseover="showOptionBar('right')" onmouseout="hideOptionBar('right')">
		<div class="photo" id="eventPhotoContestPhotoRight" onclick="selectPhotoContest('right')" title="Clique para votar nesta foto" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdRight ?>') center center no-repeat"></div>
		<div class="optionBar" id="optionBarRight">
			<div class="option zoom" title="aumentar foto" onmouseover="changeClassName(this, 'option zoom hover')" onclick="" onmouseout="changeClassName(this, 'option zoom')">
				<?php echo link_to(image_tag('blank.gif', array('width'=>32)), $zoomRight, array('id'=>'eventPhotoContestLinkRight', 'rel'=>'lightbox')) ?>
			</div>
			<div class="option reported" id="photoContestReportRight">Foto denunciada!</div>
			<div class="option report" title="denunciar foto" onclick="selectPhotoContest('right')" onmouseover="changeClassName(this, 'option report hover')" onmouseout="changeClassName(this, 'option report')"></div>
		</div>
	</div>
	
	
	
	<div class="clear"></div>
	<div class="links">
		<?php echo link_to('ver todas as fotos', 'photoWall/index') ?> | <?php echo link_to('classificação atual', 'photoWall/ranking') ?>
	</div>
</div>

<div class="clear"></div>




<br/>