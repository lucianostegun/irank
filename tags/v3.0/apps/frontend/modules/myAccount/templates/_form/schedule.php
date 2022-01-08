<?php
	$scheduleStateId   = $userSiteObj->getOptionValue('scheduleStateId');
	$scheduleCityId    = $userSiteObj->getOptionValue('scheduleCityId');
	$scheduleAlarmTime = $userSiteObj->getOptionValue('scheduleAlarmTime', '4H');
	
	$cityObj = CityPeer::retrieveByPK($scheduleCityId);
	
	$location = '';
?>
<div class="tabbarIntro">Selecione as informações para personalizar a sincronização de sua agenda.</div>
<div class="defaultForm">
	<div class="row">
		<div class="label">Estado</div>
		<div class="field"><?php echo select_tag('scheduleStateId', State::getOptionsForSelect($scheduleStateId), array('onchange'=>'loadCityField(this.value)', 'id'=>'myAccountScheduleCityId')) ?></div>
	</div>
	<div class="row">
		<div class="label">Cidade</div>
		<div class="field" id="myAccountScheduleStateIdDiv"><?php echo select_tag('scheduleCityId', City::getOptionsForSelect($scheduleStateId, $scheduleCityId), array('id'=>'myAccountScheduleStateId')) ?></div>
	</div>
	<div class="row">
		<div class="label">Tempo de alerta</div>
		<div class="field"><?php echo select_tag('scheduleAlarmTime', options_for_select(array('4H'=>'4 horas antes', '2H'=>'2 horas antes', '1H'=>'1 hora antes', '30M'=>'30 minutos antes', '15M'=>'15 minutos antes'), $scheduleAlarmTime), array('id'=>'myAccountScheduleAlarmTime')) ?></div>
	</div>
</div>