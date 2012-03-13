<div class="commonBar"><span><?php echo __('passwordRecovery.title') ?></span></div>


<div class="innerContent">
	<?php echo image_tag('recovery', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
	<?php echo __('passwordRecovery.intro') ?><br/><br/><br/><br/>
</div>


<div id="passwordRecoveryFormDiv">

	<table width="100%" cellspacing="1" cellpadding="2" class="gridTable">
		<tr>
			<td valign="top">
				<?php
					echo form_remote_tag(array(
						'url'=>'login/resetPassword',
						'success'=>'handleSuccessPasswordRecovery( request.responseText, true )',
						'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "passwordRecoveryForm", "passwordRecovery", false, "passwordRecovery" )',
						'encoding'=>'utf8',
						'loading'=>'showIndicator()'
						), array( 'id'=>'passwordRecoveryForm' ));
				?>
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
					<tr>
						<td valign="top">
							<div class="row">
								<div class="label">Username</div>
								<div class="field"><?php echo input_tag('username', null, array('id'=>'passwordRecoveryUsername', 'size'=>20, 'maxlength'=>15)) ?></div>
							</div>
							<div class="row">
								<div class="label">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'passwordRecoveryEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', __('button.resetPassword'), array('onclick'=>'doSubmitPasswordRecovery()')) ?>
		<?php echo getFormStatus(null, null, __('login.passwordRecovery.resetPasswordError')) ?>
		<?php echo getFormLoading('passwordRecovery') ?>
	</div>
</div>

<div id="successDiv" style="display: none" align="center">

	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2"><?php echo __('contact.contactForm.messageSent') ?>!</th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				<?php echo __('login.passwordRecovery.successMessage') ?><br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to(__('ClickHere'), '/home', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> <?php echo __('homeLink') ?>.<br/>
			</td>
		</tr>
	</table>

</div>
</form>