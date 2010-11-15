<table width="100%" border="0" cellspacing="0" cellpadding="0" class="onlinepokerrooms_bg2">
  <tr>
	<td align="left" valign="middle" class="poker_heading"><?php echo image_tag('frontend/layout/bullet.gif') ?>Eventos</td>
  </tr>
  <tr>
    <td align="left" valign="top" style="padding:15px 23px 16px 20px;">
    	<table width="100%" border="0" cellspacing="1" cellpadding="0">
	      <tr class="rank_heading">
	        <td width="200">Evento</td>
	        <td>Data</td>
	        <td>Hora</td>
	        <td>Local</td>
	        <td>Convidados</td>
	      </tr>
	      <?php
	      	foreach(Event::getList() as $eventObj):
	      		$myEvent = $eventObj->isMyEvent();
	      ?>
	      <tr class="boxcontent">
	        <td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')').($myEvent?'*':'') ?></td>
	        <td align="center"><?php echo $eventObj->getEventDate('d/m/Y') ?></td>
	        <td align="center"><?php echo $eventObj->getStartTime('H:i') ?></td>
	        <td><?php echo $eventObj->getEventPlace() ?></td>
	        <td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getMembers()).')' ?></td>
	      </tr>
	      <?php endforeach; ?>
	    </table>
	    * Eventos criados para seus rankings
	</td>
  </tr>
</table>
<div class="buttonBarForm">
	<?php echo button_tag('addEvent', 'Novo evento', array('onclick'=>'goModule("event", "new")')) ?>
	<?php echo getFormLoading('event') ?>
</div>