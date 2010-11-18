<?php
	echo form_remote_tag(array(
		'url'=>'contact/send',
		'success'=>'handleSuccessContact( request.responseText, true )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "contactForm", "contact", false, "contact" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'contactForm' ));
?>
<?php echo image_tag('at', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		Você pode entrar em contato conosco preenchendo o<br/>formulário abaixo e nos enviando sua mensagem.
		<br/><br/>
		
	<table width="100%" cellspacing="1" cellpadding="0" class="defaultForm" style="border: 1px solid #888A88;">
		<tr>
			<td valign="top">

				<div class="row">
					<div class="label">Nome</div>
					<div class="field"><?php echo input_tag('fullName', null, array('id'=>'contactFullName', 'size'=>30, 'maxlength'=>50)) ?></div>
				</div>
				<div class="row">
					<div class="label">E-mail</div>
					<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'contactEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
				</div>
				</div>
				<div class="row">
					<div class="label">Assunto</div>
					<div class="field"><?php echo input_tag('subject', null, array('id'=>'contactSubject', 'size'=>30, 'maxlength'=>50)) ?></div>
				</div>
				<div class="rowTextArea">
					<div class="label">Mensagem</div>
					<div class="field"><?php echo textarea_tag('message', null, array('id'=>'contactMessage', 'cols'=>50)) ?></div>
				</div>

			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Enviar', array('onclick'=>'doSubmitContact()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao enviar a mensagem') ?>
		<?php echo getFormLoading('contact') ?>
	</div>
</form>