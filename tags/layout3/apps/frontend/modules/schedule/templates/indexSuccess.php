<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Agenda'=>'eventLive/index', 'Sincronização'=>null)));
?>
<div class="moduleIntro">
	<?php echo image_tag('schedule/calendar', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Se você possui um smartphone ou um tablet pode sincronizar seu calendário com a agenda <b>iRank</b>.<br/>
	Assim você sempre ficará sabendo dos eventos que estão ocorrendo próximos a você<br/>
	e pode escolher as notificações	que deseja receber.<br/><br/>
	
	Escolha abaixo sua plataforma para ver o passo a passo de como sincronizar seu calendário.
</div>
<div class="clear"></div>
<div style="margin: 50px 0px; text-align: center">
	<div class="plataform ios"><?php echo link_to(image_tag('blank.gif', array('width'=>150, 'height'=>150)), 'schedule/ios') ?></div>
	<div class="plataform android"><?php echo link_to(image_tag('blank.gif', array('width'=>150, 'height'=>150)), 'schedule/android') ?></div>
	<div class="clear"></div>
</div>