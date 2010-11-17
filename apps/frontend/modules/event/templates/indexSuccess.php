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
	      <?php
	      	$eventObjList = Event::getList();
	      	
	      	foreach($eventObjList as $eventObj):
	      		$myEvent = $eventObj->isMyEvent();
	      ?>
	      <tr class="boxcontent" onmouseover="this.className='boxcontentOver'" onmouseout="this.className='boxcontent'">
	        <td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')').($myEvent?'*':'') ?></td>
	        <td><?php echo $eventObj->getRanking()->getRankingName() ?></td>
	        <td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
	        <td><?php echo $eventObj->getEventPlace() ?></td>
	        <td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getMembers()).')' ?></td>
	        <td style="padding: 3px 0px 3px 6px"><?php echo link_to(image_tag('icon/clone'), '#cloneEvent('.$eventObj->getId().')', array('title'=>'Duplicar evento a partir deste')) ?></td>
	      </tr>
	      <?php
	      	endforeach;
	      	
	      	if( count($eventObjList)==0 ):
	      ?>
		  <tr class="boxcontent">
		    <td colspan="5">Não existem eventos disponíveis para seus rankings</td>
		  </tr>
	      <?php endif; ?>
	    </table>
	    * Eventos criados para seus rankings
	</td>
  </tr>
</table>
<div class="buttonBarForm">
	<?php echo button_tag('addEvent', 'Novo evento', array('onclick'=>'goModule("event", "new")')) ?>
	<?php echo getFormLoading('event') ?>
</div>