<?php
	$pathList = array('Agenda'=>$moduleName.'/index');
	$clubId   = $sf_request->getParameter('clubId');
	
	if( $clubId ){
		
		$clubObj = ClubPeer::retrieveByPK($clubId);
		$pathList[$clubObj->toString()] = '#goToPage("club", "details", "id", '.$clubObj->getId().')';
		$pathList['Calendário de eventos'] = null;
	}
	
	include_partial('home/component/commonBar', array('pathList'=>$pathList));
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
			<?php if( $clubId ): ?>
			<td id="eventLiveCalendar" class="eventLiveTab first active" onclick="showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Calendário</td>
			<?php endif; ?>
			<td id="eventLiveNormal" class="eventLiveTab <?php echo ($clubId?'':'first active') ?>" onclick="<?php echo ($clubId?'loadEventLiveTab(this); ':'') ?>showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Normal</td>
			<td id="eventLiveTable" class="eventLiveTab last" onclick="loadEventLiveTab(this); showEventLiveTab(this)" onmouseover="this.addClassName('hover')" onmouseout="this.removeClassName('hover')">Tabela</td>
		</tr>
	</table>
	<div class="separator"></div>
</div>
<div class="eventDetailsList">
	<?php if( $clubId ): ?>
	<div id="eventLiveCalendarContent" class="eventLiveTabContent active">
		<?php include_partial('eventLive/include/list/calendar', array('clubId'=>null)) ?>
	</div>
	<?php endif; ?>
	<div id="eventLiveNormalContent" class="eventLiveTabContent <?php echo ($clubId?'':'active') ?>">
		<?php
			if( $clubId )
				include_partial('home/include/tabLoading', array());
			else
				include_partial('eventLive/include/list/normal', array());
		?>
	</div>
	<div id="eventLiveTableContent" class="eventLiveTabContent">
		<?php include_partial('home/include/tabLoading', array()) ?>
	</div>
</div>
<br/><br/>
