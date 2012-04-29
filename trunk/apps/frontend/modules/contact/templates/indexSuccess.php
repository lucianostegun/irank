<?php include_partial('home/component/commonBar', array('pathList'=>array(__('contact.title')=>'contact/index'))); ?>
<div class="moduleIntro">
	<?php echo image_tag('at', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	<?php echo __('contact.intro') ?><br/><br/>
	Você também pode enviar uma mensagem para o endereço <a href="mailto:contato@irank.com.br">contato@irank.com.br</a>.
</div>
<div class="clear"></div>
<div id="contactFormDiv" align="center">
	<table cellspacing="0" cellpadding="0" class="formTable" style="width: 600px">
		<tr>
			<th><h1><?php echo __('contact.contactForm') ?></h1></th>
		</tr>
		<tr>
			<td valign="top">
				<?php
					echo form_remote_tag(array(
						'url'=>'contact/send',
						'success'=>'handleSuccessContact( request.responseText, true )',
						'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "contactForm", "contact", false, "contact" )',
						'encoding'=>'utf8',
						'loading'=>'showIndicator()'
						), array( 'id'=>'contactForm' ));
				?>
				<div class="defaultForm">
					<div class="row">
						<div class="labelHalf"><?php echo __('contact.contactForm.name') ?></div>
						<div class="field"><?php echo input_tag('fullName', null, array('id'=>'contactFullName', 'size'=>30, 'maxlength'=>50)) ?></div>
					</div>
					<div class="row">
						<div class="labelHalf">E-mail</div>
						<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'contactEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
					</div>
					<div class="row">
						<div class="labelHalf"><?php echo __('contact.contactForm.subject') ?></div>
						<div class="field"><?php echo input_tag('subject', null, array('id'=>'contactSubject', 'size'=>30, 'maxlength'=>50)) ?></div>
					</div>
					<div class="rowTextArea">
						<div class="labelHalf"><?php echo __('contact.contactForm.message') ?></div>
						<div class="field"><?php echo textarea_tag('message', null, array('id'=>'contactMessage', 'cols'=>50)) ?></div>
					</div>
					<div class="separator mt20"></div>
					<div class="buttonBarForm">
						<?php echo button_tag('mainSubmit', __('contact.contactForm.send'), array('onclick'=>'doSubmitContact()')) ?>
						<?php echo getFormStatus(null, null, __('contact.contactForm.errorMessage')) ?>
						<?php echo getFormLoading('contact') ?>
					</div>
				</div>
			</td>
		</tr>
	</table>
</div>

<div id="successDiv" style="display: none" align="center">
	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 550px; margin-top: 20px">
		<tr class="header">
			<th colspan="2"><h1><?php echo __('contact.contactForm.messageSent') ?>!</h1></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center" class="icon">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top" class="message">
				<?php echo __('contact.contactForm.successMessage') ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="link">
				<div class="separator"></div>
				<?php echo link_to(__('ClickHere'), '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('contact.contactForm.newMessageLink') ?>.<br/>
				<?php echo link_to(__('ClickHere'), 'sign', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('contact.contactForm.signUp') ?>.<br/><br/>
				<?php echo __('contact.successFooterMessage') ?>.	
			</td>
		</tr>
	</table>
</div>

</form>
<br/>