<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Timer'=>'timer/index', 'Apresentação'=>null)));
?>
<div class="moduleIntro">
	<?php echo image_tag('timer/clock', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 50px')) ?>
	O <b>iRank</b> apresenta o <b>iRank Timer</b>, a mais nova ferramenta multiplataforma e totalmente gratuita<br/>
	desenvolvida para que você controle o níveis dos blinds de seus eventos de poker.<br/><br/>
	Agora você poderá levar sempre com você um temporizador simples de usar, fácil de configurar e que pode ser usado<br/>
	em seu smartphone, tablet, computador ou até mesmo sua TV.<br/><br/>
	
	Crie sua própria configuração e divirta-se.
</div>
<div class="mt5" id="timerWizardHash"></div>
<div class="clear"></div>
<div class="separator"></div>
<div class="timerBar">
	<?php
		echo button_tag('newBlindset', 'Nova configuração', array('onclick'=>'startTimerWizard()'));
		echo button_tag('addBlindLevel', 'Novo nível', array('onclick'=>'addBlindLevel()', 'image'=>'../icon/plus', 'class'=>'hidden'));
	
		echo button_tag('navigatorConclude', 'Concluir', array('image'=>'ok.png', 'onclick'=>'showNext()', 'class'=>'right hidden'));
		echo button_tag('navigatorNext', 'Próximo', array('image'=>'next.png', 'onclick'=>'showNext()', 'disabled'=>true, 'class'=>'right hidden'));
		echo button_tag('navigatorPrevious', 'Anterior', array('image'=>'previous.png', 'onclick'=>'showPrevious()', 'disabled'=>true, 'class'=>'right hidden'));
	?>
	<h3>Configurações de blinds</h1>
	<div class="clear"></div>
</div>
<div class="hidden" id="timerWizard"></div>
<div id="timerList"><?php include_partial('timer/include/timerList') ?></div>