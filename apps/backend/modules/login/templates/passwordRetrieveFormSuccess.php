<div style="margin-top: 20px; padding: 0 10 0 10; font-size: 8pt">Para recuperar sua senha, <br/>informe abaixo seu login e seu e-mail.<br/></div>
<?php
	echo form_remote_tag(array(
		'url'=>'login/retrievePassword',
		'success'=>'handleSuccessPasswordRetrieve( request.responseText )',
		'failure'=>'enableButton("passwordRetrieveSend"); handleFormFieldError( request.responseText, "passwordRetrieveForm", "passwordRetrieve" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator("passwordRetrieveForm")',
		), array( 'id'=>'passwordRetrieveForm' ));
?>
<div class="defaultForm" style="width: 400px; margin-bottom: 2px">
	<div class="row">
	  <div class="label">Usuário</div>
	  <div class="field"><?php echo input_tag( 'username', null, array( 'size'=>20, 'id'=>'passwordRetrieveUsername' )) ?></div>
	</div>
	<div class="row">
	  <div class="label">E-mail</div>
	  <div class="field"><?php echo input_tag( 'emailAddress', null, array( 'size'=>35, 'id'=>'passwordRetrieveEmailAddress' )) ?></div>
	</div>
</div>

<div class="buttonBarForm" style="width: 400px; margin-top: 0px">
	<?php echo button_tag('passwordRetrieveSend', 'Recuperar senha', array('onclick'=>'doRetrievePassword()')) ?>
	<?php echo getLoading('passwordRetrieveForm') ?>
</div>
</form>