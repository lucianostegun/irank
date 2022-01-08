<?php
	$peopleObj = $userSiteObj->getPeople();
	
	$criteria = new Criteria();
	$criteria->add( SmsOptionPeer::PEOPLE_ID, $peopleObj->getId() );
	$criteria->add( SmsOptionPeer::LOCK_SEND, true );
	$criteria->setIgnoreCase(true);
	$smsOptionObjList = SmsOptionPeer::doSelect($criteria);
	
	$smsTemplateIdList = array();
	foreach($smsOptionObjList as $smsOptionObj)
		$smsTemplateIdList[] = $smsOptionObj->getSmsTemplateId();
	
	$userSiteConfigObj = $userSiteObj->getConfig();
	
	$agreedSmsTerms    = $userSiteConfigObj->getAgreedSmsTerms();
	$smsValidationCode = $userSiteConfigObj->getsmsValidationCode();
?>
<div class="tabbarIntro">
	Agora você também pode receber notificações dos eventos em seu celular.<br/>
	Informe seu número e selecione as notificações que deseja receber.
</div>
<div class="defaultForm">

	<div class="row">
		<div class="label">DDD/Telefone</div>
		<div class="field"><?php echo input_tag('phoneDdd', $peopleObj->getPhoneDdd(), array('size'=>2, 'maxlength'=>2, 'onkeyup'=>'goToField(this.value, 2, "myAccountPhoneNumber", event )', 'id'=>'myAccountPhoneDdd')) ?></div>
		<div class="field"><?php echo input_tag('phoneNumber', $peopleObj->getPhoneNumber(), array('size'=>10, 'maxlength'=>10, 'onkeyup'=>'maskPhoneNoDDD(event)', 'id'=>'myAccountPhoneNumber')) ?></div>
		<div class="text" id="rankingSmsValidationCodeLink">
			<?php
				if( is_null($smsValidationCode) )
					echo link_to('Validar telefone', '#sendSmsValidationCode()');
				elseif( $smsValidationCode!='0000' && !$agreedSmsTerms )
					echo 'Código de validação já enviado';
				elseif( $smsValidationCode=='0000' )
					echo 'Número validado';
			?>
		</div>
	</div>
	<div class="row <?php echo (is_null($smsValidationCode) || $smsValidationCode=='0000'?'hidden':'') ?>" id="myAccountSmsValidationCodeRow">
		<div class="label">Código de validação</div>
		<div class="field"><?php echo input_tag('smsValidationCode', null, array('size'=>4, 'maxlength'=>4, 'style'=>'text-transform: uppercase', 'id'=>'myAccountSmsValidationCode')) ?></div>
		<div class="text"><?php echo link_to('Validar código', '#validateSmsCode()') ?></div>
	</div>
	
	<div class="row <?php echo ($agreedSmsTerms || !$smsValidationCode?'hidden':'') ?>" id="myAccountAgreeSmsTermsRow">
		<div class="field textR" style="width: 168px"><?php echo checkbox_tag('agreeSmsTerms', true, false, array('id'=>'myAccountAgreeSmsTerms')) ?></div>
		<div class="textCheckbox"><label for="myAccountAgreeSmsTerms">Li e concordo com os <?php echo link_to('termos de envio de SMS', 'myAccount/smsTerm', array('target'=>'_blank')) ?></label></div>
		<div class="clear errorHelp" style="margin-left: 177px" id="myAccountAgreeSmsTermsError">É preciso ler e aceitar os termos de envio de SMS para concluir a validação</div>
	</div>
	
	<div class="<?php echo ($agreedSmsTerms?'':'hidden') ?>" id="myAccountSmsTemplateOptions">
		
		<div class="row">
			<div class="label">Créditos</div>
			<div class="text flex"><?php echo $userSiteObj->getSmsCredit() ?></div>
			<div class="text"><?php echo link_to('Obter mais créditos', 'store/details?IRK-SMS=', array('target'=>'_blank')) ?></div>
		</div>
		
		<hr/>
		
		<?php
			$smsOptionAll       = true;
			$smsTemplateObjList = SmsTemplate::getList();
			foreach($smsTemplateObjList as $smsTemplateObj):
				
				$smsTemplateId = $smsTemplateObj->getId();
				$checked = !in_array($smsTemplateId, $smsTemplateIdList);
				
				$smsOptionAll &= $checked;
		?>
		<div class="rowCheckbox mt5">
			<div class="field"><?php echo checkbox_tag('smsOption-'.$smsTemplateId, true, $checked, array('onclick'=>'checkSmsOptionAll(this)', 'class'=>'smsOption')) ?></div>
			<div class="label"><label for="smsOption-<?php echo $smsTemplateId ?>"><?php echo $smsTemplateObj->getDescription() ?></label></div>
		</div>
		<?php endforeach; ?>
		<div class="rowCheckbox mt20">
			<div class="field"><?php echo checkbox_tag('smsOptionAll', true, $smsOptionAll, array('onclick'=>'selectAllSmsOption(this.checked)', 'class'=>'smsOptionAll')) ?></div>
			<div class="label"><label for="smsOptionAll">Selecionar todos (Receber mensagens para todas as notificações)</label></div>
		</div>
	</div>			
</div>
<div class="tabbarFooter">
	<b>Dica:</b><br/>
	Você pode optar por receber notificações apenas dos rankings que desejar.<br/>
	Acesse o ranking que deseja editar e selecione a opção desejada no menu <b>Editar notificações</b>
</div>