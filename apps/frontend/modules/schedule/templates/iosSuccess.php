<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Agenda'=>'eventLive/index', 'Sincronização'=>null)));
?>
<div class="moduleIntro">
	<?php echo image_tag('schedule/ios', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Veja abaixo como sincronizar seu iPhone, iPad ou iPod touch com a agenda <b>iRank</b>.<br/><br/>
	
	Saiba também como configurar seu smartphone ou tablet com <?php echo link_to('android', 'schedule/android') ?>.
</div>
<div class="clear"></div>
<div class="steps">
	<div class="step">
		<div class="image"><?php echo image_tag('schedule/ios/001') ?></div>
		<div class="info">
			<h1>1 <div class="title">Ajustes</div></h1>
				<div class="instructions">Em <b>Ajustes</b> selecione a opção <b>Mail, Contatos, Calendários</b>.</div>
		</div>
	</div>
</div>