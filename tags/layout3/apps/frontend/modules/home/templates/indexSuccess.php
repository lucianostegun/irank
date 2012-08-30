<div id="userResume" class="<?php echo ($isAuthenticated?'logged':'') ?>">
<?php
	if( $isAuthenticated ){
		
		include_partial('home/resume/events');
		include_partial('home/resume/quickResume');
	}
	
	Util::lightbox();
?>
<div class="clear"></div>
</div>

<?php include_partial('home/include/highlight') ?>

<div class="channels">
	<div class="channel">
		<div class="image"><?php echo link_to(image_tag('home/money'), 'myAccount/bankroll') ?></div>
		<div class="description">
			<h1><?php echo link_to('Controle de bankroll', 'myAccount/bankroll') ?></h1>
			Ferramenta completa para controle e estatísticas de seu bankroll. 
		</div>
	</div>
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
	<?php include_partial('store/include/offerHome') ?>
</div>

<div class="clear"></div>
<?php
$eventPhotoContestObj = EventPhotoContest::getPhotoPair();

$eventPhotoIdLeft  = $eventPhotoContestObj->getEventPhotoIdLeft();
$eventPhotoIdRight = $eventPhotoContestObj->getEventPhotoIdRight();

$zoomLeft  = 'home/eventPhoto?id='.$eventPhotoIdLeft.'&zoom=1';
$zoomRight = 'home/eventPhoto?id='.$eventPhotoIdRight.'&zoom=1';
?>

<?php
	include_partial('blog/include/highlight');
?>

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