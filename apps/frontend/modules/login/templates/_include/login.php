<div id="login">
	<div class="commonBar"><span>LOGIN</span></div>
	<table cellspacing="2" cellpadding="1" border="0">
		<tr>
			<td colspan="2" id="loginStatus"><?php echo __('login.errorMessage'); ?></td>
		</tr>
		<tr>
			<th>Username</th>
			<td class="field"><?php echo input_tag('username', null, array('maxlength'=>150, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginUsername')) ?></td>
		</tr>
		<tr>
			<th><?php echo __('login.password') ?></th>
			<td class="field"><?php echo input_password_tag('password', null, array('maxlength'=>15, 'onkeyup'=>'handleSubmitEnter(event, doQuickLogin)', 'id'=>'loginPassword')) ?></td>
		</tr>
		<tr>
			<td style="text-align: right"><?php echo checkbox_tag('keepLogin', true, true, array('id'=>'loginKeepLogin')) ?></td>
			<th style="text-align: left"><?php echo __('login.keepLogin') ?></th>
		</tr>
		<tr>
			<th></th>
			<td style="padding-top: 5px"><?php echo button_tag('doLogin', __('login.enter'), array('onclick'=>'doQuickLogin()')) ?></td>
		</tr>
		<tr>
			<td style="padding-top: 10px; text-align: center" colspan="2">
				<?php echo link_to(__('login.signUp'), 'sign/index') ?>
				<?php echo link_to(__('login.forgotPassword'), 'login/passwordRecovery', array('style'=>'margin-left: 20px')) ?>
			</td>
		</tr>
	</table>
</div>
<?php sfContext::getInstance()->getResponse()->addJavascript( 'frontend/login' ); ?>