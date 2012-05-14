<?php
	$peopleId = $sf_user->getAttribute('peopleId');
	
	include_partial('home/component/commonBar', array('pathList'=>array('Eventos ao vivo'=>$moduleName.'/index')));
?>
<div class="moduleIntro">
	Acompanhe e participe dos principais eventos presenciais do Brasil.<br/><br/>
	<?php echo link_to('Clique aqui', 'schedule/index') ?> para aprender como sincronizar a agenda de seu smartphone ou tablet<br/>
	para receber automaticamente informações de todos os eventos dos clubes próximos a você. 
</div>

<div class="eventDetailsArea index pt10" align="center">
	<div class="separator"></div>
	<table cellspacing="0" cellpadding="0" class="channel">
		<tr>
			<td id="eventLiveNormal" class="eventLiveTab first active" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Normal</td>
			<td id="eventLiveTable" class="eventLiveTab" onclick="loadEventLiveTab(this); showEventLiveTab(this)" class="last" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Tabela</td>
		</tr>
	</table>
	<div class="separator"></div>
</div>
<div class="eventDetailsList">
	<div id="eventLiveNormalContent" class="eventLiveTabContent active">
		<?php include_partial('eventLive/include/list/normal', array('peopleId'=>$peopleId)) ?>
	</div>
	<div id="eventLiveTableContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
</div>
<br/><br/>
