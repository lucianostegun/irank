<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr class="rank_heading">
    <td width="200">Evento</td>
    <td>Data/Hora</td>
    <td>Local</td>
    <td>Convidados</td>
  </tr>
  <?php foreach($rankingObj->getEventList() as $eventObj): ?>
  <tr class="boxcontent">
    <td><?php echo link_to($eventObj->getEventName(), '#goModule(\'event\', \'edit\', \'eventId\', '.$eventObj->getId().')') ?></td>
    <td align="center"><?php echo $eventObj->getEventDate('d/m/Y').' '.$eventObj->getStartTime('H:i') ?></td>
    <td><?php echo $eventObj->getEventPlace() ?></td>
    <td align="center"><?php echo sprintf('%02d', $eventObj->getInvites()).' ('.sprintf('%02d', $eventObj->getMembers()).')' ?></td>
  </tr>
  <?php endforeach; ?>
</table>