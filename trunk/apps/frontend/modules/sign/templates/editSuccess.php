<div class="commonBar"><span>Edição de perfil</span></div>
	
<div id="successDiv" style="display: <?php echo ($showSuccess?'block':'none') ?>">
	<center>
	<br/>
	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2">Cadastro concluído!</th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				<b>Parabéns!</b><br/>
				Você já é um usuário <b>iRank</b>!<br/><br/>
				
				A partir de agora você já pode criar seus próprios rankings<br/>
				organizar eventos, obter relatórios e estatísticas dos jogos<br/>
				entre seus amigos.<br/><br/>
				
				Você está automaticamente identificado no site e já pode começar!<br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to('clique aqui', 'ranking/create', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para criar seu primeiro ranking.<br/>
				<?php echo link_to('clique aqui', 'sign/edit', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para editar as informações de seu cadastro.<br/><br/>
			</td>
		</tr>
	</table>
	</center>
</div>
<div id="formDiv" style="display: <?php echo ($showSuccess?'none':'block') ?>">
	<table width="100%" cellspacing="1" cellpadding="2" class="gridTable">
		<tr class="header">
			<th>Formulário de edição</th>
		</tr>
		<tr>
			<td valign="top">
				<?php
					echo form_remote_tag(array(
						'url'=>'sign/save',
						'success'=>'handleSuccessSign( request.responseText )',
						'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "signForm", "sign", false, "sign" )',
						'encoding'=>'utf8',
						'loading'=>'showIndicator()'
						), array( 'id'=>'signForm' ));
					
					echo input_hidden_tag('username', $userSiteObj->getUsername(), array('id'=>'signUsername'));
					echo input_hidden_tag('password', $userSiteObj->getPassword(), array('id'=>'signPassword'));
					echo input_hidden_tag('passwordConfirm', $userSiteObj->getPassword(), array('id'=>'signPasswordConfirm'));
				?>
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
					<tr>
						<td valign="top">
							<div class="row">
								<div class="label" id="signUsernameLabel">Username</div>
								<div class="text"><?php echo $userSiteObj->getUsername() ?></div>
							</div>
							<div class="row">
								<div class="label" id="signEmailAddressLabel">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', $userSiteObj->getPeople()->getEmailAddress(), array('size'=>25, 'maxlength'=>150, 'class'=>'required', 'id'=>'signEmailAddress')) ?></div>
								<div class="error" id="signEmailAddressError" onclick="showFormErrorDetails('sign', 'emailAddress')"></div>
							</div>
							<div class="row">
								<div class="label" id="signFirstNameLabel">Nome</div>
								<div class="field"><?php echo input_tag('firstName', $userSiteObj->getPeople()->getFirstName(), array('size'=>20, 'maxlength'=>25, 'class'=>'required', 'id'=>'signFirstName')) ?></div>
								<div class="error" id="signFirstNameError" onclick="showFormErrorDetails('sign', 'firstName')"></div>
							</div>
							<div class="row">
								<div class="label" id="signLastNameLabel">Sobrenome</div>
								<div class="field"><?php echo input_tag('lastName', $userSiteObj->getPeople()->getLastName(), array('size'=>20, 'maxlength'=>25, 'id'=>'signLastName')) ?></div>
								<div class="error" id="signLastNameError" onclick="showFormErrorDetails('sign', 'lastName')"></div>
							</div>
							<div class="row" id="passwordChangeRowDiv">
								<div class="label">Senha</div>
								<div class="text"><?php echo link_to('Trocar senha de acesso', '#togglePasswordField()') ?></div>
							</div>
							<div id="passwordAreaDiv"></div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Gravar alterações', array('onclick'=>'doSubmitSign()')) ?>
		<?php echo getFormLoading('sign') ?>
		<?php echo getFormStatus() ?>
	</div>
	</div>
</form>