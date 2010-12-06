<table width="500" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td colspan="2" align="left" valign="middle" class="poker_heading" style="color: #5a5aFF"><?php echo image_tag('frontend/layout/bullet.gif') ?>Presença confirmada</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 0px 0px 20px">
		<?php echo image_tag('frontend/success', array('align'=>'left', 'style'=>'margin: 0 15 15 15')) ?>
	</td>
    <td align="left" valign="top" style="padding:15px 23px 16px 0px; color: #333333">
	Sua presença foi confirmada no evento <b><?php echo $eventObj->getEventName() ?></b>!<br/><br/>
	Um e-mail foi enviado a todos os convidados do evento informando sobre a sua confirmação.<br/><br/>
	
	Você pode cancelar sua presença ou ainda informar que sua presença não está 100% confirmada.<br/><br/>
	
	<b><?php echo link_to('Clique aqui', '#goModule("event", "show", "eventId", '.$eventObj->getId().')') ?></b> aqui para visualizar os detalhes do evento. 	
	</td>
  </tr>
</table>