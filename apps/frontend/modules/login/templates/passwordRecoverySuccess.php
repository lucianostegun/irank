<?php include_partial('home/component/commonBar', array('pathList'=>array('Login'=>null, __('passwordRecovery.title')=>null))); ?>

<div class="moduleIntro" style="height: 90px">
	<?php echo image_tag('recovery', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
	<?php echo __('passwordRecovery.intro') ?>
</div>


<div id="passwordRecoveryFormDiv" align="center">

	<?php
		echo form_remote_tag(array(
			'url'=>'login/resetPassword',
			'success'=>'handleSuccessPasswordRecovery(request.responseText)',
			'failure'=>'handleFailurePasswordRecovery(request.responseText)',
			'encoding'=>'utf8',
			'loading'=>'showIndicator()'
			), array( 'id'=>'passwordRecoveryForm' ));
	?>
	<table cellspacing="0" cellpadding="0" class="formTable" style="width: 400px; margin-top: 20px">
		<tr>
			<th><h1>Recuperação de senha</h1></th>
		</tr>
		<tr>
			<td valign="top">
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
					<tr>
						<td valign="top">
							<div class="row">
								<div class="labelHalf">Username</div>
								<div class="field"><?php echo input_tag('username', null, array('id'=>'passwordRecoveryUsername', 'size'=>20, 'maxlength'=>15)) ?></div>
							</div>
							<div class="row">
								<div class="labelHalf">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'passwordRecoveryEmailAddress', 'size'=>35, 'maxlength'=>100)) ?></div>
							</div>
						</td>
					</tr>
					</tr>
						<td>
							<div class="separator"></div>
							<div class="buttonBarForm">
								<?php echo button_tag('mainSubmit', __('button.resetPassword'), array('onclick'=>'doSubmitPasswordRecovery()')) ?>
								<?php echo getFormStatus(null, null, __('login.passwordRecovery.resetPasswordError')) ?>
								<?php echo getFormLoading('passwordRecovery') ?>
							</div>						
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</div>

<div id="successDiv" style="display: none" align="center">

	<table border="0" cellspacing="0" cellpadding="0" class="formTable" style="width: 550px; margin-top: 20px">
		<tr>
			<th colspan="2"><h1>Senha redefinida com sucesso!</h1></th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center" class="icon">
				<?php echo image_tag('success', array('align'=>'left')) ?>
			</td>
			<td align="left" valign="top" class="message">
				<?php echo __('login.passwordRecovery.successMessage') ?>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top" class="link">
				<div class="separator"></div>
				<?php echo link_to(__('ClickHere'), '/home', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('homeLink') ?>.<br/>
			</td>
		</tr>
	</table>

</div>
</form>