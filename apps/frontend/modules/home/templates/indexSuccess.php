<style>
#userResume {
	
}

#userResume #eventResume {
	
	position: 	relative;
	top: 		15px;
}

#userResume #eventResume .calendar {
	
	float: 		left;
	position: 	relative;
	left: 		15px;
}

#userResume #eventResume #eventList {
	
	float: 		left;
	position: 	relative;
	left: 		25px;
	top: 		25px;
}

#userResume #eventResume #eventList .event {

	width: 			355px;
	height: 		52px;
	margin-bottom: 	2px;
	border: 		1px solid #b5ccd6;
	padding: 		5px 5px 5px 55px;
	cursor: 		pointer;
}

#userResume #eventResume #eventList .event .title {

	float: 			left;
	font-weight: 	bold;
}

#userResume #eventResume #eventList .event .where {

	float: 			left;
	margin-left: 	5px;
}

#userResume #eventResume #eventList .event .when {

	clear: 	both;
}

#userResume #eventResume #eventList .event .ranking {

	float: left;
}

#userResume #eventResume #eventList .event .presence {

	position: 				relative;
	top: 					-3px;
	margin-bottom: 			-3px;
	float: 					right;
	border: 				1px solid #b5ccd6;
	-moz-border-radius: 	3px;
	-webkit-border-radius: 	3px;
	border-radius: 			3px;
	padding-left: 			19px;
	background: 			#e8f3f7 url('/images/frontend/home/presenceToYes.png') 3px center no-repeat;
}

#userResume #eventResume #eventList .event .presence.hover,
#userResume #eventResume #eventList .event .presence.yes.hover {

	background-color: 	#d2e3ea
}

#userResume #eventResume #eventList .event .presence.yes {

	background: 	#e8f3f7 url('/images/frontend/home/presenceYes.png') 3px center no-repeat;
}

#userResume #eventResume #eventList .event .presence a {

	margin-left: 	5px;
	margin-right: 	5px;
	color: 			#5c6377;
	text-decoration: 	none;
}

#userResume #eventResume #eventList .event .presence a.confirmed {

	margin-left: 	5px;
	margin-right: 	5px;
	color: 			#44780e;
}

#userResume #eventResume #eventList .event.next {

	background: 	#d2e3ea url('/images/frontend/home/calendar.png') 2px center no-repeat;
}

#userResume #eventResume #eventList .event.next.hover,
#userResume #eventResume #eventList .event.previous.hover {

	background-color: 	#e8f3f7;
}

#userResume #eventResume #eventList .event.previous {

	background: 	#deeaef url('/images/frontend/home/podium.png') 2px center no-repeat;
}

#userResume #eventResume #eventList .loadEvents {

	width: 			400px;
	margin-top: 	4px;
	padding: 		3px 10px 3px 5px;
	cursor: 		pointer;
	text-align: 	right;
}

#userResume #eventResume #eventList .loadEvents a {

	color: 			#5c6377;
	font-size: 		12px;
}
</style>

<div id="userResume">
	<?php echo image_tag('temp/homeChart', array('style'=>'position: relative; top: 10px; left: 15px')) ?>
	
	
	<div id="eventResume">
		<div class="calendar">
			<?php echo image_tag('temp/calendar') ?>
		</div>
		<div id="eventList">
			<div class="event next" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ JJ's Casino Club</div>
				<div class="when">14/02/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="presence yes" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
					<?php echo link_to('presença confirmada', '#return false', array('class'=>'confirmed')) ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="event next" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ Reyllagio</div>
				<div class="when">31/01/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="presence" onmouseover="this.className=this.className.replace('presence', 'presence hover')" onmouseout="this.className=this.className.replace(' hover', '')">
					<?php echo link_to('confirmar presença', '#return false', array('class'=>'')) ?>
				</div>
				<div class="clear"></div>
			</div>
			<div class="event previous" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ AP 31 Cassinos Bar</div>
				<div class="when">24/01/2012 22:45</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="clear"></div>
			</div>
			<div class="event previous" onmouseover="this.className+=' hover'" onmouseout="this.className=this.className.replace(' hover', '')">
				<div class="title">Sit & Go - NLHE</div>
				<div class="where">@ JJ's Casino Club</div>
				<div class="when">17/01/2012 20:00</div>
				<div class="ranking">Poker friends - NLHE 2012</div>
				<div class="clear"></div>
			</div>
			<div class="loadEvents">
				<?php echo link_to('carregar mais eventos', '#return false') ?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
	</div>
	<br/><br/><br/><br/>
	<br/><br/><br/><br/>
</div>


<div class="homeHighlight">
	<div class="content">
		
		<div class="contentItem" style="background: url('/images/frontend/home/welcomeChips.png') right 140px no-repeat">
			<h1>Seja bem-vindo</h1>
			<p>O iRank é um site gratuito para criação<br/>e organização de rankings online para jogos de Poker.</p>
			<p>Aqui você poderá criar seus próprios rankings,<br/>definir as configurações de jogo e organizar os eventos,<br/>
			classificações e estatísticas dos torneios entre seus amigos.</p>
		</div>
		
		<div class="descriptionBorder">
			<div class="descriptionArea"></div>
			<div class="descriptionText">
			 	<ul>
					<li class="selected"><p>Se você ainda não é cadastrado,<br/><?php echo link_to('clique aqui', 'sign') ?> e comece agora mesmo a controlar seus jogos!</p></li>
					<li></li>
					<li></li>
					<li></li>
				</ul>
			</div>
		</div>
		<ul class="indicator">
			<li class="selected"></li>
			<li></li>
			<li></li>
			<li></li>
		</ul>
	</div>
</div>

<div class="channels">
	<div class="channel">
		<div class="image"><?php echo image_tag('frontend/home/stats') ?></div>
		<div class="description">
			<h1>Estatísticas</h1>
			Gere gráficos de gastos, lucros, balanço e desempenho dos jogadores.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('frontend/home/event') ?></div>
		<div class="description">
			<h1>Notificação de eventos</h1>
			Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('frontend/home/photo') ?></div>
		<div class="description">
			<h1>Mural de fotos</h1>
			Compartilhar os melhores momentos dos eventos postando suas fotos no mural.
		</div>
	</div>
	<div class="channel" style="height: 88px">
		<div class="image"><?php echo image_tag('frontend/home/rankingHistory') ?></div>
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
?>

<div id="photoVote">
	<h1>Concurso de fotos</h1>
	<div class="photo" onmouseover="showOptionBar('left')" onmouseout="hideOptionBar('left')" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdLeft ?>') center center no-repeat">
		<div class="optionBar" id="optionBarLeft">
			<div class="option zoom" title="denunciar foto" onmouseover="this.className='option zoom hover'" onmouseout="this.className='option zoom'"></div>
			<div class="option report" title="denunciar foto" onmouseover="this.className='option report hover'" onmouseout="this.className='option report'"></div>
		</div>
	</div>
	<div class="photo" onmouseover="showOptionBar('right')" onmouseout="hideOptionBar('right')" style="background: url('/index.php/home/eventPhoto/id/<?php echo $eventPhotoIdRight ?>') center center no-repeat">
		<div class="optionBar" id="optionBarRight">
			<div class="option zoom" title="denunciar foto" onmouseover="this.className='option zoom hover'" onmouseout="this.className='option zoom'"></div>
			<div class="option report" title="denunciar foto" onmouseover="this.className='option report hover'" onmouseout="this.className='option report'"></div>
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
		<div class="image"><?php echo image_tag('frontend/home/tour') ?></div>
		<div class="description">
			<h1>iRank tour</h1>
			Faça um passeio virtual e conheça todas as funcionalidades do site.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('frontend/home/event') ?></div>
		<div class="description">
			<h1>Notificação de eventos</h1>
			Notificação instantânea da criação/edição dos eventos e lembrete dos jogos agendados.
		</div>
	</div>
	<div class="channel">
		<div class="image"><?php echo image_tag('frontend/home/photo') ?></div>
		<div class="description">
			<h1>Mural de fotos</h1>
			Compartilhar os melhores momentos dos eventos postando suas fotos no mural.
		</div>
	</div>
</div>