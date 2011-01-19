<div class="commonBar"><span>Convidar amigos</span></div>
<div class="innerContent">
	Convide agora mesmo todos seus amigos para juntar-se a você no <b>iRank</b>.<br/>
	Informe abaixo apenas o primeiro nome e o e-mail de seus amigos e eles receberão<br/>
	um e-mail de convite para ingressar gratuitamente ao site.
</div>

<table width="100%" border="0" cellspacing="1" cellpadding="2" class="gridTable">
	<tr class="header">
  		<th>Formulário de convite</th>
  	</tr>
  	<tr>
  		<td>
  			<table width="100%" border="0" cellspacing="0" cellpadding="0" class="defaultForm">
  				<tr>
				    <td align="left" valign="top">
				
					<?php
						echo form_remote_tag(array(
							'url'=>'friendInvite/sendInvite',
							'success'=>'handleSuccessFriendInvite( request.responseText )',
							'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "friendInviteForm", "friendInvite", false, "friendInvite" )',
							'encoding'=>'utf8',
							'loading'=>'showIndicator()'
							), array( 'id'=>'friendInviteForm' ));
					?>			
							
							<div class="row">
								<div class="label">Seu nome</div>
								<div class="field"><?php echo input_tag('peopleName', $peopleName, array('class'=>'required', 'id'=>'friendInvitePeopleName')) ?></div>
							</div>
							<div class="row">
								<div class="label">Seu e-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', $emailAddress, array('size'=>35, 'maxlength'=>150, 'class'=>'required', 'id'=>'friendInviteEmailAddress')) ?></div>
							</div>
							
							<br/>
							Informe o nome e-mail dos amigos que deseja convidar<br/><br/>
							<?php for($i=1; $i <= 10; $i++): ?>
							<div class="row">
								<div class="halfLabel">Nome</div>
								<div class="field"><?php echo input_tag('friendName'.$i, null, array('size'=>15, 'autocomplete'=>'off', 'id'=>'friendInviteFriendName'.$i)) ?></div>
								<div class="halfLabel">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress'.$i, null, array('size'=>25, 'autocomplete'=>'off', 'id'=>'friendInviteEmailAddress'.$i)) ?></div>
								<div class="image" id="friendInviteImage<?php echo $i ?>Div"></div>
								<div class="textFlex" id="friendInviteStatus<?php echo $i ?>Div"></div>
							</div>
						    <?php endfor; ?>
						</form>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Convidar amigos', array('onclick'=>'doSubmitFriendInvite()')); ?>
		<?php echo button_tag('resetForm', 'Limpar formulário', array('onclick'=>'resetFriendInviteForm()')); ?>
		<?php echo getFormLoading('friendInvite') ?>
		<?php echo getFormStatus(null, null, 'Preencha todos os campos obrigatórios'); ?>
	</div>