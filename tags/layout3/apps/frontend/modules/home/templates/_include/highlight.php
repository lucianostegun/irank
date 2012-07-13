<?php
	$highlights      = 6;
	$activeHighlight = rand(1,6);
?>
<div class="homeHighlight">
	<div class="content">

		<div class="contentItem <?php echo ($highlight==1?'active':'') ?>" id="homeHighlight1" style="background: url('/images/home/welcomeChips.png') right 140px no-repeat">
			<h1>Seja bem-vindo</h1>
			<p>O iRank é um site gratuito para criação<br/>e organização de rankings online para jogos de Poker.</p>
			<p>Aqui você poderá criar seus próprios rankings,<br/>definir as configurações de jogo e organizar os eventos,<br/>
			classificações e estatísticas dos torneios entre seus amigos.</p>
		</div>
		
		<div class="contentItem <?php echo ($activeHighlight==2?'active':'') ?>" id="homeHighlight2" style="background: url('/images/home/highlight/facebook.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==3?'active':'') ?>" id="homeHighlight3" style="background: url('/images/home/highlight/calendar.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==4?'active':'') ?>" id="homeHighlight4" style="background: url('/images/temp/math.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==5?'active':'') ?>" id="homeHighlight5" style="background: url('/images/home/highlight/0036499001297851037.jpg') left center no-repeat"></div>
		<div class="contentItem <?php echo ($activeHighlight==6?'active':'') ?>" id="homeHighlight6" style="background: url('/images/home/highlight/newApp.jpg') left center no-repeat"></div>
		<?php
			$photoCaption = 'Foto enviada em <b>16/02/2011</b> pelo usuário <b>lstegun</b> registrada para o evento <b>Sit & Go - NLHE #2</b>';
		?>
		<div class="descriptionBorder">
			<div class="descriptionArea"></div>
			<div class="descriptionText">
			 	<ul>
					<li id="contentItemText1" class="<?php echo ($activeHighlight==1?'active':'') ?>"><p>Se você ainda não é cadastrado,<br/><?php echo link_to('clique aqui', 'sign') ?> e comece agora mesmo a controlar seus jogos!</p></li>
					<li id="contentItemText2" class="<?php echo ($activeHighlight==2?'active':'') ?>"><h1><?php echo link_to('iRank no Facebook', 'http://www.facebook.com/irankpoker', array('target'=>'_blank')) ?></h1><p>Agora o <b>iRank</b> também está no Facebook.<br/>Acesse e curta nossa página para concorrer a prêmios.</p></li>
					<li id="contentItemText3" class="<?php echo ($activeHighlight==3?'active':'') ?>"><h1><?php echo link_to('Sincronize sua agenda', 'schedule/index') ?></h1><p>Assinando o calendário de eventos <b>iRank</b> em seu smartphone ou tablet você será sempre informado sobre os eventos que irão ocorrer próximo a você.</p></li>
					<li id="contentItemText4" class="<?php echo ($activeHighlight==4?'active':'') ?>"><h1>Pontuação personalizada</h1><p>Defina o modelo de pontuação mais adequado ao seu grupo com a nova opção no cadastro de rankings permite a você criar sua própria fórmula para cálculo dos pontos.</p></li>
					<li id="contentItemText5" class="<?php echo ($activeHighlight==5?'active':'') ?>"><h1><?php echo link_to_image('Foto do mês', '/uploads/eventPhoto/event-57/0036499001297851037.jpg', array('rel'=>'lightbox', 'alt'=>$photoCaption)) ?></h1><p><?php echo $photoCaption ?></p></li>
					<li id="contentItemText6" class="<?php echo ($activeHighlight==6?'active':'') ?>"><h1><?php echo link_to('Novo iRank App para iOS', 'http://itunes.apple.com/br/app/irank/id481129223', array('target'=>'_blank')) ?></h1><p>Já está disponível a nova versão do aplicativo iRank para iPhone, iPad e iPod touch.<br/><?php echo link_to('Clique aqui', 'http://itunes.apple.com/br/app/irank/id481129223', array('target'=>'_blank')) ?> e conheça todas as novidades da nova versão.</p></li>
				</ul>
			</div>
		</div>
		<ul class="selector">
			<?php for($highlight=1; $highlight <= $highlights; $highlight++): ?>
			<li id="contentItemSelector<?php echo $highlight ?>" onclick="changeContentItem(<?php echo $highlight ?>)" class="<?php echo ($highlight==$activeHighlight?'active':'') ?>"></li>
			<?php endfor; ?>
		</ul>
	</div>
</div>

<script>
	setupHomeHighlight(6, <?php echo $activeHighlight ?>);
</script>