<?php
	echo form_tag('event/search', array('id'=>'eventSearchForm', 'onsubmit'=>'doEventSearch(); return false'));
		echo input_hidden_tag('isIE', null);
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Eventos</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	      <tr class="rank_heading">
	        <td>Evento</td>
	        <td>Ranking</td>
	        <td>Data/Hora</td>
	        <td>Local</td>
	        <td>Convidados</td>
	        <td></td>
	      </tr>
	      <tr class="rank_heading">
	        <td><?php echo input_tag('eventName', $sf_request->getParameter('eventName'), array('size'=>15)) ?></td>
	        <td><?php echo select_tag('rankingId', Ranking::getOptionsForSelect($sf_request->getParameter('rankingId'))) ?></td>
	        <td><?php echo input_date_tag('eventDate', Util::formatDate($sf_request->getParameter('eventDate')), array('size'=>10, 'maxlength'=>10)) ?></td>
	        <td><?php echo input_tag('eventPlace', $sf_request->getParameter('eventPlace'), array('size'=>15)) ?></td>
	        <td width="100" colspan="2"><?php echo button_tag('eventFilterSubmit', 'pesquisar', array('onclick'=>'doEventSearch()')) ?></td>
	      </tr>
	      <tbody id="eventListContent">
	      <?php
			include_partial('event/include/search', array('criteria'=>$criteria));
	      ?>
	      </tbody>
	    </table>
	    * Eventos criados para seus rankings
	</td>
  </tr>
</table>
</form>
<div class="buttonBarForm" style="border: 0px transparent">
	<?php echo button_tag('addEvent', 'Novo evento', array('onclick'=>'goModule("event", "new")')) ?>
	<?php echo getFormLoading('event') ?>
</div>