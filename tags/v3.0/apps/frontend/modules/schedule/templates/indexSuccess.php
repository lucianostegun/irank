<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Agenda'=>'eventLive/index', 'Sincronização'=>null)));
?>
<?php echo image_tag('schedule', array('class'=>'logo')) ?>
<div class="moduleIntro image">
	Se você possui um smartphone ou um tablet pode sincronizar seu calendário com a agenda <b>iRank</b>.<br/>
	Assim você sempre ficará sabendo dos eventos que estão ocorrendo próximos a você e pode escolher as notificações	que deseja receber.<br/><br/>
	
	Escolha abaixo sua plataforma para ver o passo a passo de como sincronizar seu calendário.
</div>
<hr class="separator"/>
<div style="margin: 50px 0px; text-align: center">
	<div class="plataform ios"><?php echo link_to(image_tag('blank.gif', array('width'=>150, 'height'=>150)), 'schedule/ios') ?></div>
	<div class="plataform android"><?php echo link_to(image_tag('blank.gif', array('width'=>150, 'height'=>150)), 'schedule/android') ?></div>
	<div class="clear"></div>
</div>