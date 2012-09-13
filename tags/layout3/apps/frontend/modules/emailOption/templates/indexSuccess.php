<?php include_partial('home/component/commonBar', array('pathList'=>array(__('contact.title')=>'contact/index'))); ?>
<div class="moduleIntro">
	<?php echo image_tag('email', array('align'=>'left', 'style'=>'margin-right: 10px; position: relative; top: -5px')) ?>
	Editando as preferências de envio de e-mail para o endereço <b><?php echo $emailAddress ?></b>.<br/>
	Selecione os tipos de mensagem que NÃO deseja receber neste endereço.<br/>
	Você poderá editar suas opções de recebimento sempre que desejar.
</div>
<div class="clear"></div>
<?php
	echo form_remote_tag(array(
		'url'=>'emailOption/save',
		'success'=>'handleSuccessEmailOption(request.responseText)',
		'failure'=>'handleFailureEmailOption(request.responseText)',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array('id'=>'emailOptionForm'));
		
	echo input_hidden_tag('emailAddress', $emailAddress);
	echo input_hidden_tag('emailToken', $emailToken);
	
	$criteria = new Criteria();
	$criteria->add( EmailOptionPeer::EMAIL_ADDRESS, $emailAddress );
	$criteria->add( EmailOptionPeer::LOCK_SEND, true );
	$criteria->setIgnoreCase(true);
	$emailOptionObjList = EmailOptionPeer::doSelect($criteria);
	
	$emailTemplateIdList = array();
	foreach($emailOptionObjList as $emailOptionObj)
		$emailTemplateIdList[] = $emailOptionObj->getEmailTemplateId();
?>
<div class="defaultForm" style="margin: 50px 30px 0px 30px; padding: 20px 0px">
	<?php
		$criteria = new Criteria();
		$criteria->add( EmailTemplatePeer::IS_OPTION, true);
		$emailTemplateObjList = EmailTemplate::getList($criteria);
		foreach($emailTemplateObjList as $emailTemplateObj):
			$emailTemplateId = $emailTemplateObj->getId();
	?>
	<div class="rowCheckbox mt5">
		<div class="field"><?php echo checkbox_tag('emailOption-'.$emailTemplateId, true, in_array($emailTemplateId, $emailTemplateIdList), array('onclick'=>'checkEmailOptionAll(this)', 'class'=>'emailOption')) ?></div>
		<div class="label"><label for="emailOption-<?php echo $emailTemplateId ?>"><?php echo $emailTemplateObj->getDescription() ?></label></div>
	</div>
	<?php endforeach; ?>
	<div class="rowCheckbox mt20">
		<div class="field"><?php echo checkbox_tag('emailOptionAll', true, false, array('onclick'=>'selectAllEmailOption(this.checked)', 'class'=>'emailOptionAll')) ?></div>
		<div class="label"><label for="emailOptionAll">Selecionar todos (Não receber e-mails do iRank)</label></div>
	</div>
</div>
<div class="buttonBar" style="margin: 0px 30px 0px 30px">
	<?php echo button_tag('save', 'Salvar', array('onclick'=>'saveEmailOption()')) ?>
</div>
</form>
