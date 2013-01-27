<?php
	$emailAddress = $userSiteObj->getPeople()->getEmailAddress();
	
	$criteria = new Criteria();
	$criteria->add( EmailOptionPeer::EMAIL_ADDRESS, $emailAddress );
	$criteria->add( EmailOptionPeer::LOCK_SEND, true );
	$criteria->setIgnoreCase(true);
	$emailOptionObjList = EmailOptionPeer::doSelect($criteria);
	
	$emailTemplateIdList = array();
	foreach($emailOptionObjList as $emailOptionObj)
		$emailTemplateIdList[] = $emailOptionObj->getEmailTemplateId();
?>
<div class="tabbarIntro">Selecione as notificações que deseja receber</div>
<div class="defaultForm">
	<?php
		$emailOptionAll = true;
		
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::IS_OPTION, true);
		$emailTemplateObjList = EmailTemplate::getList($criteria);
		foreach($emailTemplateObjList as $emailTemplateObj):
			
			$emailTemplateId = $emailTemplateObj->getId();
			$checked         = !in_array($emailTemplateId, $emailTemplateIdList);
			$emailOptionAll &= $checked;
	?>
	<div class="rowCheckbox mt5">
		<div class="field"><?php echo checkbox_tag('emailOption-'.$emailTemplateId, true, $checked, array('class'=>'emailOption')) ?></div>
		<div class="label"><label for="emailOption-<?php echo $emailTemplateId ?>"><?php echo $emailTemplateObj->getDescription() ?></label></div>
	</div>
	<?php endforeach; ?>
	<div class="rowCheckbox mt20">
		<div class="field"><?php echo checkbox_tag('emailOptionAll', true, $emailOptionAll, array('onclick'=>'selectAllEmailOption(this.checked)', 'class'=>'emailOptionAll')) ?></div>
		<div class="label"><label for="emailOptionAll">Selecionar todos (Receber todos os e-mails do iRank)</label></div>
	</div>			
</div>
<div class="tabbarFooter">
	Caso não esteja recebendo as mensagens, configure sua caixa de entrada para aceitar mensagens de endereços <b>@irank.com.br</b> 
</div>
