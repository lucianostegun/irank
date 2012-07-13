<table border="0" cellspacing="0" cellpadding="0" class="gridTable gridTabTable">
  <tr class="header">
    <th class="first"><?php echo __('Player') ?></th>
    <th>E-mail</th>
    <th class="noBorder">&nbsp;</th>
  </tr>
  <?php
  	$myEvent    = $eventObj->isMyEvent();
  	$peopleIdMe = MyTools::getAttribute('peopleId');
  	
  	$eventPlayerObjList = $eventObj->getPlayerList('result');
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="center" class="icon">
    	<?php echo image_tag('icon/'.($eventPlayerObj->getEnabled()?'ok':'nok')); ?>
    </td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr>
    <td colspan="5"><?php echo __('event.playersTab.noPlayer') ?></td>
  </tr>
  <?php endif; ?>
</table>