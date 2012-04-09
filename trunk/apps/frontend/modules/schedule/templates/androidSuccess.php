<?php
	include_partial('home/component/commonBar', array('pathList'=>array('Agenda'=>'eventLive/index', 'Sincronização'=>'schedule/index', 'Android'=>null)));
?>
<div class="moduleIntro">
	<?php echo image_tag('schedule/android', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Veja abaixo como sincronizar seu smartphone ou table Andoid com a agenda <b>iRank</b>.<br/><br/>
	
	Saiba também como configurar seu smartphone ou tablet com <?php echo link_to('iPhone, iPad e iPod touch', 'schedule/ios') ?>.
</div>
<div class="clear"></div>