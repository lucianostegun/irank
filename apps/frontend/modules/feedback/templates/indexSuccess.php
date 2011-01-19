<div class="commonBar"><span>Contato</span></div>
<div class="innerContent">
	<?php echo image_tag('feedback.jpg', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		Reparou que <b>iRank</b> site está em versão <b><u><?php echo link_to('beta', 'http://pt.wikipedia.org/wiki/Vers%C3%A3o_beta') ?></u></b>?<br/>
		Isso significa que sua avaliação é muito importante para que possamos <br/>corrigir falhas e adicionar melhorias
		em todas as áreas do site.<br/><br/>
		Pedimos que sempre que possível você entre em contato para nos enviar<br/>sugestões ou nos informar sobre um possível erro, falha ou bug
		que tenha encontrado no site.
		<br/><br/
</div>

<div id="feedbackFormDiv">
	<table width="100%" cellspacing="1" cellpadding="2" class="gridTable">
		<tr class="header">
			<th>Formulário de retorno</th>
		</tr>
		<tr>
			<td valign="top">

			<?php
				echo form_remote_tag(array(
					'url'=>'feedback/send',
					'success'=>'handleSuccessFeedback( request.responseText, true )',
					'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "feedbackForm", "feedback", false, "feedback" )',
					'encoding'=>'utf8',
					'loading'=>'showIndicator()'
					), array( 'id'=>'feedbackForm' ));
			?>		
				<table width="100%" cellspacing="0" cellpadding="0" class="defaultForm">
					<tr>
						<td valign="top">
			
							<div class="row">
								<div class="label">Nome</div>
								<div class="field"><?php echo input_tag('fullName', null, array('id'=>'feedbackFullName', 'size'=>30, 'maxlength'=>50)) ?></div>
							</div>
							<div class="row">
								<div class="label">E-mail</div>
								<div class="field"><?php echo input_tag('emailAddress', null, array('id'=>'feedbackEmailAddress', 'size'=>40, 'maxlength'=>100)) ?></div>
							</div>
							</div>
							<div class="row">
								<div class="label">Assunto</div>
								<div class="field">Feedback</div>
							</div>
							<div class="rowTextArea" style="height: 120px">
								<div class="label">Mensagem</div>
								<div class="field"><?php echo textarea_tag('message', null, array('id'=>'feedbackMessage', 'style'=>'width: 450px; height: 100px')) ?></div>
							</div>
			
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Enviar feedback', array('onclick'=>'doSubmitFeedback()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao enviar a mensagem') ?>
		<?php echo getFormLoading('feedback') ?>
	</div>
</div>

<div id="successDiv" style="display: none" align="center">
	<table width="500" border="0" cellspacing="0" cellpadding="3" class="gridTableFlex">
		<tr class="header">
			<th colspan="2">Feedback enviado!</th>
		</tr>
		<tr>
			<td align="left" valign="top" rowspan="2" align="center">
				<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0px 0px 0px 15px')) ?>
			</td>
			<td align="left" valign="top">
				Ele será muito importante para que possamos corrigir falhas e melhorar<br/>
				os serviços oferecidos.<br/><br/>
			</td>
		</tr>
		<tr>
			<td align="left" valign="top">
				<?php echo link_to('clique aqui', '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para enviar um novo feedback.<br/>	
			</td>
		</tr>
	</table>
</div>
</form>
<br/>