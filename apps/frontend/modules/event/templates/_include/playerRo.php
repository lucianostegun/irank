<table border="0" cellspacing="1" cellpadding="2" class="gridTabTable">
  <tr class="header">
    <th>Nome</th>
    <th>E-mail</th>
    <th></th>
  </tr>
  <?php
  	$myEvent    = $eventObj->isMyEvent();
  	$peopleIdMe = MyTools::getAttribute('peopleId');
  	
  	$eventPlayerObjList = $eventObj->getPlayerList();
  	foreach($eventPlayerObjList as $eventPlayerObj):
  		
  		$peopleObj = $eventPlayerObj->getPeople();
  		$peopleId  = $peopleObj->getId();
  ?>
  <tr>
    <td><?php echo $peopleObj->getFullName() ?></td>
    <td><?php echo $peopleObj->getEmailAddress() ?></td>
    <td align="center" class="icon">
    	<?php echo image_tag('icon/'.($eventPlayerObj->getEnabled()?'ok':'nok'), array('id'=>'presenceImage'.$peopleId)); ?>
    </td>
  </tr>
  <?php
  	endforeach;
  	
  	if( count($eventPlayerObjList)==0 ):
  ?>
  <tr>
    <td colspan="5">Este ranking ainda não possui convidados</td>
  </tr>
  <?php endif; ?>
</table>