<div class="commonBar"><span>Contato</span></div>
<div class="innerContent">
	<?php echo image_tag('at', array('align'=>'left', 'style'=>'margin-right: 10px')) ?>
	Você pode entrar em contato conosco preenchendo o<br/>formulário abaixo e nos enviando sua mensagem.<br/><br/>
	Você também pode esclarecer suas dúvidas através de nosso <b><u><?php echo link_to('FAQ', 'faq/index') ?></u></b>.
	<br/><br/>
</div>
<div id="contactFormDiv">
	<table width="100%" cellspacing="1" cellpadding="2" class="gridTable">
		<tr class="header">
			<th>Formulário de contato</th>
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
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
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
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Enviar', array('onclick'=>'doSubmitContact()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao enviar a mensagem') ?>
		<?php echo getFormLoading('contact') ?>
	</div>
</div>
<div id="successDiv" style="display: none" align="center">
	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2">Mensagem enviada!</th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				Sua mensagem foi enviada com sucesso!<br/>
				Assim que possível entraremos em contato para respondê-la.<br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to('clique aqui', '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para enviar uma nova mensagem.<br/>
				<?php echo link_to('clique aqui', 'sign', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> e cadastre-se gratuitamente.<br/><br/>
				Caso você já seja um usuário utilize o login na barra lateral à esquerda da página.	
			</td>
		</tr>
	</table>
</div>
</form>
<br/>