<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('icon/help', array('style'=>'margin: 2 8 0 10')) ?>FAQ - Dúvidas Frequentes</td>
  </tr>
  <tr>
    <td align="left" valign="top" class="moduleText">
		O F.A.Q. é uma área de ajuda onde você encontra respostas objetivas para dúvidas frequentes dos usuários.<br/>
		Clique sobre a pergunta para visualizar a resposta. Caso sua dúvida não esteja listada clique no botão <b>Enviar minha dúvida</b>.<br/><br/>
    </td>
  </tr>
  <tr id="sendQuestionTr">
	<td align="left" valign="top" style="padding:0px 23px 16px 20px;">
		<?php echo button_tag('sendMyQuestion', 'Enviar minha dúvida', array('onclick'=>'showQuestionForm()')) ?>
    </td>
  </tr>
  <tr>
  	<td>		
		<?php include_partial('faq/include/form'); ?>
		<?php include_partial('faq/include/success'); ?>
	</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px; border-top:#999999 2px solid;">

		<table width="95%" cellspacing="1" cellpadding="0" class="faqTable">
		<?php
			foreach(Faq::getList() as $faqObj):
				
				$faqId = $faqObj->getId();
		?>
		  <tr>
			<th class="question" onclick="toggleFaq(<?php echo $faqId ?>)"><?php echo $faqObj->getQuestion() ?></th>
		  </tr>
		  <tr>
			<td class="answer" id="faqAnswer<?php echo $faqId ?>" style="display: none">
				<?php echo $faqObj->getAnswer() ?>
			</td>
		  </tr>
		  <tr>
			<td height="7"></td>
		  </tr>
		<?php endforeach; ?>
		</table>
    	
	</td>
  </tr>
</table>