<div class="tabbarIntro">Selecione abaixo as notificações que deseja receber para os eventos criados para este ranking</div>
<div class="defaultForm">
	<h1>Notificações por SMS</h1>
	<?php
		$peopleId = $sf_user->getAttribute('peopleId');
		
		$rankingPlayerObj = RankingPlayerPeer::retrieveByPK($rankingId, $peopleId);
		
		$criteria = new Criteria();
		$criteria->add( SmsRankingOptionPeer::PEOPLE_ID, $peopleId );
		$criteria->add( SmsRankingOptionPeer::RANKING_ID, $rankingId );
		$criteria->add( SmsRankingOptionPeer::LOCK_SEND, true );
		$smsRankingOptionObjList = SmsRankingOptionPeer::doSelect($criteria);
		
		echo input_hidden_tag('updateNotifications', true, array('id'=>'rankingUpdateNotifications'));
		
		$smsTemplateIdList = array();
		foreach($smsRankingOptionObjList as $smsRankingOptionObj)
			$smsTemplateIdList[] = $smsRankingOptionObj->getSmsTemplateId();
		
		$smsTemplateObjList = SmsTemplate::getList();
		foreach($smsTemplateObjList as $smsTemplateObj):
			$smsTemplateId = $smsTemplateObj->getId();
	?>
	<div class="rowCheckbox mt5">
		<div class="field"><?php echo checkbox_tag('smsRankingOption-'.$smsTemplateId, true, !in_array($smsTemplateId, $smsTemplateIdList), array()) ?></div>
		<div class="label"><label for="smsRankingOption-<?php echo $smsTemplateId ?>"><?php echo $smsTemplateObj->getDescription() ?></label></div>
	</div>
	<?php endforeach; ?>
	<hr/>
	<div class="rowCheckbox mt5">
		<div class="field"><?php echo checkbox_tag('suppressSmsNotify', true, $rankingPlayerObj->getSuppressSmsNotify(), array('id'=>'rankingSuppressSmsNotify')) ?></div>
		<div class="label"><label for="rankingSuppressSmsNotify">Não receber notificações via <b>SMS</b> para este ranking</label></div>
	</div>
	<br/>
	<br/>
	<h1>Notificações por e-mail</h1>
	<div class="rowCheckbox mt5">
		<div class="field"><?php echo checkbox_tag('suppressEmailNotify', true, $rankingPlayerObj->getSuppressEmailNotify(), array('id'=>'rankingSuppressEmailNotify')) ?></div>
		<div class="label"><label for="rankingSuppressEmailNotify">Não receber notificações via <b>e-mail</b> para este ranking</label></div>
	</div>
</div>