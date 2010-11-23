<?php
	echo form_remote_tag(array(
		'url'=>'feedback/send',
		'success'=>'handleSuccessFeedback( request.responseText, true )',
		'failure'=>'enableButton("mainSubmit"); handleFormFieldError( request.responseText, "feedbackForm", "feedback", false, "feedback" )',
		'encoding'=>'utf8',
		'loading'=>'showIndicator()'
		), array( 'id'=>'feedbackForm' ));
?>
<div id="feedbackFormDiv">
	<?php echo image_tag('feedback.jpg', array('align'=>'left', 'style'=>'margin-right: 10px; margin-bottom: 20px')) ?>
		Você reparou que nosso site está em versão <b><u><?php echo link_to('beta', 'http://pt.wikipedia.org/wiki/Vers%C3%A3o_beta') ?></u></b>?<br/>
		Isso significa que sua avaliação é muito importante para que possamos <br/>corrigir falhas e adicionar melhorias
		em todas as áreas do site.<br/><br/>
		Pedimos que sempre que possível você entre em contato para nos enviar<br/>sugestões ou nos informar sobre um possível erro, falha ou bug
		que tenha encontrado em nosso site.
		<br/><br/>
		
	<table width="100%" cellspacing="1" cellpadding="0" class="defaultForm" style="border: 1px solid #888A88;">
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
	<div class="buttonBarForm">
		<?php echo button_tag('mainSubmit', 'Enviar feedback', array('onclick'=>'doSubmitFeedback()')) ?>
		<?php echo getFormStatus(null, null, 'Erro ao enviar a mensagem') ?>
		<?php echo getFormLoading('feedback') ?>
	</div>
</div>
<div id="successDiv" style="display: none">
	<table width="500" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
	  <tr>
		<td align="left" valign="middle" class="poker_heading" style="color: #5a5aFF"><?php echo image_tag('frontend/layout/bullet.gif') ?>Muito obrigado!</td>
	  </tr>
	  <tr>
	    <td align="left" valign="top" style="padding:15px 23px 16px 20px; color: #333333">
		<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0 15 15 15')) ?>
		Seu feed foi enviado com sucesso!<br/>
		Ele será muito importante para que possamos corrigir falhas e melhorar<br/>
		os serviços oferecidos.<br/><br/>
		
		<?php echo link_to('clique aqui', '#newMessage()', array('style'=>'padding-bottom: 5px; background: url(\'/sf/sf_default/images/icons/linkOut16.png\') no-repeat; padding-left: 25px; font-weight: bold')) ?> para enviar um novo feedback.<br/>
		</td>
	  </tr>
	</table>
</div>
</form>