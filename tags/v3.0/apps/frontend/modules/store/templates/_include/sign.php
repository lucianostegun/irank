			<h3>Cadastro de novo usuário</h3>
			
			<div class="mt10 ml30">Para concluir seu cadastro e prosseguir com a compra, preencha os campos abaixo e clique em <b>Prosseguir</b>.</div>
			<table cellspacing="0" cellpadding="0" class="formTable">
				<tr>
					<td valign="top">
						<div class="defaultForm">
							<div class="row">
								<div class="label" id="signUsernameLabel">Username</div>
								<div class="field"><?php echo input_tag('username', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signUsername')) ?></div>
								<div class="error" id="signUsernameError"></div>
							</div>
							<div class="row">
								<div class="label" id="signEmailAddressLabel">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', null, array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'signEmailAddress')) ?></div>
								<div class="error" id="signEmailAddressError"></div>
							</div>
							<div class="row">
								<div class="label" id="signFirstNameLabel">Nome</div>
								<div class="field"><?php echo input_tag('firstName', null, array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'signFirstName')) ?></div>
								<div class="error" id="signFirstNameError"></div>
							</div>
							<div class="row">
								<div class="label" id="signLastNameLabel">Sobrenome</div>
								<div class="field"><?php echo input_tag('lastName', null, array('size'=>20, 'maxlength'=>25, 'id'=>'signLastName')) ?></div>
								<div class="error" id="signLastNameError"></div>
							</div>
							<div class="row">
								<div class="label" id="signPasswordLabel">Senha</div>
								<div class="field"><?php echo input_password_tag('password', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPassword')) ?></div>
								<div class="error" id="signPasswordError"></div>
							</div>
							<div class="row">
								<div class="label" id="signPasswordConfirmLabel">Confirmação</div>
								<div class="field"><?php echo input_password_tag('passwordConfirm', null, array('size'=>15, 'maxlength'=>15, 'class'=>'required', 'id'=>'signPasswordConfirm')) ?></div>
								<div class="error" id="signPasswordConfirmError"></div>
							</div>
			
							<div class="row">
								<div class="field textR" style="width: 101px"><?php echo checkbox_tag('agreeUserTerms', true, false, array('id'=>'signAgreeUserTerms')) ?></div>
								<div class="textCheckbox"><label for="signAgreeUserTerms">Li e concordo com os <?php echo link_to('termos de uso do site', 'sign/userTerms', array('target'=>'_blank')) ?></label></div>
								<div class="clear errorHelp" style="margin-left: -95px" id="signAgreeUserTermsError">É preciso ler e aceitar os termos de uso para concluir o cadastro</div>
							</div>
						</div>
					</td>
				</tr>
			</table>
			<div class="separator"></div>
			<div class="buttonBarForm" id="signMainButtonBar">
				<?php echo button_tag('mainSubmit', 'Prosseguir', array('onclick'=>'doSubmitSign()')) ?>
				<?php echo getFormLoading('sign') ?>
				<?php echo getFormStatus(null, false, 'Erro ao salvar o cadastro!', 'Cadastro salvo com sucesso!'); ?>
			</div>